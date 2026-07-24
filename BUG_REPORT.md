# Forbsign Code Review — Bug Report

Generated: 2026-07-13  
Updated: 2026-07-20 (added UI/S3 findings + spreadsheet sheet)  
Scope: full codebase (app/, routes/, config/, resources/views/, resources/js/) — vendor/ excluded.

**Sheet (Excel / Google Sheets):** [`BUG_REPORT_SHEET.csv`](./BUG_REPORT_SHEET.csv)  
**Interactive canvas:** open `forbsign-bug-report-sheet.canvas.tsx` beside chat

Severity key: **Critical** (money/security/data loss, fix now) · **High** (broken feature or real security gap) · **Medium** (real bug, limited blast radius) · **Low** (edge case / cleanup)

---

## Sheet summary (counts)

| Status | Critical | High | Medium | Low | Total |
|--------|----------|------|--------|-----|-------|
| Open   | ~18      | ~18  | ~18    | ~8  | ~62   |
| Fixed (UI/S3 session) | — | 3 | 3 | — | 6 |

Import `BUG_REPORT_SHEET.csv` into Google Sheets or Excel for filtering by Category / Severity / Status / Priority.

---

## 1. Payments & Checkout (Critical — fix first)

These directly affect money and order integrity.

1. **Stripe amount taken from client input, not server total** — `app/Http/Controllers/User/CheckoutController.php:226`, `resources/views/user/checkout.blade.php:185`
   Charge is built from `$request->price * 100` (a hidden form field). The correct line, `$cartTotal * 100`, is present but commented out directly below. Editing the hidden `price` input in devtools lets a customer pay any amount they choose while the DB order/transaction still shows the real total.
   **Fix:** always charge `$cartTotal * 100` computed server-side from the session cart; never trust `$request->price`.

2. **`stripePost()` never calls Stripe — fake payment success** — `app/Http/Controllers/User/CheckoutController.php:394-426`
   Hardcodes `transaction_id = 'askldfja12312'` and sets status to succeeded unconditionally from a plain `Request`, with no call to the Stripe API. Any authenticated user can POST here and have any order marked paid for free. Reachable via `resources/views/user/payment.blade.php` (a second, older Stripe.js v2 checkout flow that coexists with the main one).
   **Fix:** verify the charge/payment intent with Stripe's API (or webhook) before marking an order paid; remove or rewrite this action.

3. **Cart option price trusted from client request** — `app/Http/Controllers/User/CartController.php:56-67`
   `addToCart()` builds `$adjustedPrice` from `$opt['price']`/`$opt['price_prefix']` sent in the request payload instead of looking up the real price from `ProductOptionValue` in the DB. This tampered price flows into the session cart and is later trusted by `CheckoutController` and `OrderItem.price`.
   **Fix:** re-fetch each selected option's price from the DB by ID server-side; never accept a price/prefix value from the client.

4. **Raw card number/CVV/expiry POSTed to the app server** — `resources/views/user/payment.blade.php:116-146, 269-283`
   The JS intended to strip card fields before submit calls `.empty()` on the inputs, which clears child DOM nodes, not the value — `.val()` never gets cleared. Raw PAN/CVV/expiry get submitted to the Laravel backend alongside the Stripe token, landing in request logs. This is a PCI-DSS-relevant sensitive-data exposure.
   **Fix:** remove this legacy Stripe.js v2 flow entirely (it duplicates the working `checkout.blade.php` flow) or fix the JS to null out `.val()` and switch to Stripe Elements/tokenization so raw card data never touches the server.

5. **Main product stock check has no row lock (overselling race)** — `app/Http/Controllers/User/CheckoutController.php:194-200`
   The primary `total_stock` check-then-decrement isn't wrapped in `lockForUpdate()`, unlike the option-value branch just above it which does lock. Two concurrent checkouts can both pass the check before either decrements stock.
   **Fix:** wrap the read+decrement in a DB transaction with `lockForUpdate()`, consistent with the option-value branch.

6. **Order confirmation page has no ownership check (IDOR)** — `app/Http/Controllers/User/CheckoutController.php:284`
   `thankYou(Order $order)` uses route-model binding with no check that the order belongs to the logged-in user. Any user can view another customer's order (name, address, items, total) by changing the ID in the URL.
   **Fix:** add `abort_unless($order->user_id === auth()->id(), 403)`.

7. **Hardcoded product ID in custom-sign builder** — `resources/views/user/customize-product.blade.php:178`
   The "Add to Cart" button has `data-product-id="94"` hardcoded. The controller (`HomeController::customize_product`) never passes a product/id to the view. Every customization submission is recorded against product 94 regardless of which product the customer actually picked.
   **Fix:** pass the actual product to the view and render its real ID in the button's data attribute.

8. **Dead external form posting to a third-party template-vendor URL** — `resources/views/user/payment.blade.php:153-182`
   A hidden Flutterwave modal form POSTs to `https://geniusdevs.com/codecanyon/omnimart40/flutterwave/submit` (the original CodeCanyon demo endpoint) with a hardcoded fake token. Not linked from a visible button today, but live markup that could exfiltrate data if ever triggered.
   **Fix:** delete this leftover template markup.

9. **Two disconnected cart/checkout systems** — `app/Http/Controllers/User/CheckoutController.php` (`checkout_submit_cash_on_delivery`, `stripePost`, `checkout_submit_back_transfer`) vs. the session-cart-based `index()`/`StripePayment()`; also `HomeController::add_to_cart` (DB `Cart` model) vs. `CartController` (session cart).
   Two parallel implementations of "cart" and "checkout" exist side by side with different trust assumptions (one blindly stores `$request->transaction` as the transaction ID). Confusing and risky — unclear which is actually live in production.
   **Fix:** pick one cart/checkout implementation and delete the other; audit which routes/views currently point to which.

---

## 2. Cross-tenant IDOR in Client (vendor) controllers — High/Critical

Pattern: `index()`/`create()`/`store()` correctly scope queries by `client_id`, but `edit()`/`update()`/`delete()`/`update_status()` forget to — any logged-in client (store owner) can view, modify, or delete another tenant's data by guessing/incrementing an ID.

- `app/Http/Controllers/Client/ProductController.php:154, 200, 324, 350` — edit/update/delete/update_status unscoped. **Critical** (price/stock tampering, deletion of another store's products).
- `app/Http/Controllers/Client/ManageController.php:65` — `change_payment_status($id)` unscoped; any client can flip another tenant's transaction paid/unpaid. **Critical**
- `app/Http/Controllers/Client/ManageController.php:132-137` — `transactions_delete($id)` unscoped, and uses `Order::whereOrderId(...)` which queries a column (`order_id`) that lives on `Transaction`, not `Order` (whose PK is `id`) — likely throws an SQL error or deletes nothing. **Critical**
- `app/Http/Controllers/Client/OptionController.php:82, 103` — `edit()`/`update()` scope by `auth()->id()` (default guard) instead of `auth()->guard('client')->id()` — will 404 for legitimate clients almost every time. **High**
- `app/Http/Controllers/Client/OptionController.php:146, 165` — `option_value_update`/`option_value_delete` have no ownership check at all. **High**
- `app/Http/Controllers/Client/FaqCategoryController.php:52, 65, 78` — edit/update/delete unscoped. **High**
- `app/Http/Controllers/Client/FaqController.php:44, 57, 62` — edit/update/delete unscoped. **High**
- `app/Http/Controllers/Client/BrandController.php:53, 60, 84, 96` — edit/update/delete/update_status unscoped. **High**
- `app/Http/Controllers/Client/CategoryController.php:70, 88, 112, 120` — edit/update/delete/update_status unscoped; also `delete()` redirects to `admin.category.index` instead of the client route (line 115). **High / Medium**
- `app/Http/Controllers/Client/BlogController.php:98` — `update()` unscoped while `edit()`/`delete()` are correctly scoped — inconsistent. **Medium**
- `app/Http/Controllers/Client/SubscribeController.php:18-25` — `destroy()` looks up the row with proper scoping but never actually calls `->delete()` — subscribers are never removed despite the "deleted" message. **Medium**

**Fix (applies to all of the above):** add `->where('client_id', auth()->guard('client')->id())` (or the correct guard) to every lookup in `edit`, `update`, `delete`, and any status-toggle method — not just `index`/`store`.

## 3. User-facing IDOR (non-payment)

- `app/Http/Controllers/User/CompareController.php:17` — `remove_compare($id)` calls `Compare::findOrFail($id)` but never calls `->delete()` (feature is a no-op), and has no ownership check even if fixed. **High**
- `app/Http/Controllers/User/WishListController.php:69` — `remove_wishlist($id)` deletes by raw ID with no check that it belongs to the current user — any user can delete others' wishlist entries. **High**

## 4. Admin panel — broken features (fatal errors)

- `app/Http/Controllers/Admin/ProductController.php` (and `Client/ProductController.php`) — `ProductOption::create(...)` called in `store()`/`update()` (lines ~106-134, ~292-320) but `App\Models\ProductOption` is never imported, so it resolves to a non-existent class in the controller's own namespace — **fatal error any time a product with options is saved.** Worse, in `update()`, existing option rows are deleted *before* this fatal, causing **data loss** (line ~290-291). **Critical**
- `app/Http/Controllers/Admin/CustomSizeController.php` — `edit()` returns the wrong view (copy-pasted from CustomImageController); `update()`/`destroy()` are stubs that touch no DB but report success; routes reference `delete`/`update_status` actions that don't exist on the controller at all → fatal errors. **Custom sizes can never actually be edited or deleted. Critical**
- `app/Http/Controllers/Admin/CustomColorController.php` — routes reference `edit`/`update`/`delete`/`update_status`, none of which exist on the controller (only `index`/`create`/`store` do). **Colors can be created but never managed afterward. Critical**
- `app/Http/Controllers/Admin/CustomImageController.php` — `update()`/`destroy()` are stubs (no DB write, no file deletion) that report false success; routes call `delete`/`update_status` which don't exist. **Critical**
- `app/Http/Controllers/Admin/WebsiteController.php:27-44, 58-76` — the file-move code for `web_icon` is commented out, but validation still accepts an `UploadedFile` object and mass-assigns it directly into `Website::create()`/`update()` — **crashes on insert whenever an icon is uploaded.** **Critical**
- `app/Http/Controllers/Admin/BlogController.php` / routes/admin.php:148 — route `admin.blog.uploadImage` points to a method that is entirely commented out — inline image upload in the blog editor fatals. **High**
- `routes/admin.php:118` — `admin.product.get.child-category` maps to `get_child_category`, but `ProductController` only defines `getSubCategory` — fatal method-not-found. **Medium**

## 5. Password handling bugs (repeated pattern, 3 places)

`Hash::make($request->password) ?? $user->password` never falls back, because `Hash::make(null)` returns a valid (non-null) hash of an empty string — the `??` can never trigger. Every "edit profile without changing password" submission **silently resets the account's password to a hash of nothing**, locking the user out.

- `app/Http/Controllers/User/Auth/ProfileController.php:45` — **Critical**
- `app/Http/Controllers/Admin/CustomerController.php:26` — unconditional, not even guarded by `??` — every customer edit wipes the password. **Critical**
- `app/Http/Controllers/Client/ClientController.php:97` — same pattern. **Critical**

**Fix:** only touch the password field when `$request->filled('password')`, e.g. `if ($request->filled('password')) { $user->password = Hash::make($request->password); }`.

Related:
- `app/Http/Controllers/User/Auth/ProfileController.php:29-30` — `email`/`phone` validated as `unique:users` without excluding the current user's own row — **every unchanged profile save fails validation.** **High**
- `app/Http/Controllers/User/Auth/ProfileController.php:64-71, 88-95` — billing/shipping address update assumes a row already exists and writes to it without a null check — **fatal error for any first-time save.** **High**
- `app/Http/Controllers/User/Auth/LoginController.php:118` — password-reset token is checked for existence but never for expiry — a leaked token is valid forever. **Medium/High**
- `app/Http/Controllers/User/Auth/RegisterController.php:57` — `redirect_to` query param is redirected to with no local-URL check — open redirect. **Medium**
- `app/Http/Controllers/Admin/Auth/LoginController.php:56` — admin phone-uniqueness check runs against the `users` table instead of `admins`. **Medium**
- `app/Http/Controllers/Admin/Auth/ProfileController.php:25` — `image` marked `required`, forcing every admin to re-upload a photo just to edit their name. **Medium**
- `app/Http/Controllers/Client/ClientController.php:68` — phone-uniqueness check on client profile update runs against `users`, not `clients`. **Medium**

## 6. Database/model mismatches — SQL errors waiting to happen

The app appears to be mid-migration to a Client → Website multi-tenancy model. The `website_id`/`client_id` columns were only ever added to the `websites` table itself — every other model below declares the column as `$fillable` or in a relationship, but **the column does not exist on that table**, so touching it throws a SQL "unknown column" error:

- `app/Models/Blog.php` (`website_id`, `client_id`)
- `app/Models/Faq.php` (`website_id`, `client_id`)
- `app/Models/FaqCategory.php` (`website_id`, `client_id`)
- `app/Models/Order.php` (`website_id` fillable + `website()` relation)
- `app/Models/Transaction.php` (`website_id`)
- `app/Models/WebsiteTemplate.php` (`website_id` fillable + `website()` relation)
- `app/Models/Category.php` (`website()` relation)
- `app/Models/Brand.php` (`website()` relation)
- `app/Models/Subscribe.php` (`website_id`)

All **High** severity — multi-tenancy scoping is effectively non-functional at the DB layer for these models today. **Fix:** either add the missing migration(s) for these columns, or remove the dead fillable entries/relations if multi-tenancy for these models was abandoned.

Other model issues:
- `app/Http/Controllers/Admin/WebsiteTemplateController.php:30, 52` — validates `website_id` with `exists:websitetemplates,id` (checks the wrong table — should be `websites`). **High**
- `app/Models/Admin.php`, `app/Models/Client.php` — `password` fillable with no `'hashed'` cast (unlike `User.php`), inconsistent safety net. **Medium**
- `app/Models/Product.php` — no `$casts` at all; `images`/`specifications` (JSON columns) and `current_price`/`previous_price` (decimals) aren't cast. Works today only because every call site manually `json_decode`s, but fragile. **Medium**
- `app/Models/OrderItem.php:31-41` — `optionValues()` returns a raw query builder, not a real relation, so it can't be eager-loaded (`with('optionValues')` would throw); only works today because it's accessed as a magic attribute. **Low**
- `app/Models/CustomFont.php` — no `$fillable`/`$guarded`, so mass assignment is blocked by default; currently unused so no live impact. **Low**
- `app/Models/ProductSize.php` — imports `HasFactory` but never applies the trait; `Model::factory()` will fail if ever used. **Low**

## 7. Stored XSS (unescaped Blade output)

- `resources/views/user/blog-details.blade.php:24` — `{!! $blog->description !!}`. Both Admin and **Client (vendor)** `BlogController::store/update` save `description` with only `'required'` validation — no sanitization. A compromised or malicious vendor account can post `<script>` in a blog body and it renders unescaped to every site visitor. **High**
- `resources/views/user/faq-category.blade.php:68` — `{!! $faq->details !!}`, same root cause (Admin and Client FaqController both accept unsanitized `details`). **Medium**

**Fix:** sanitize with an HTML purifier (e.g. `mews/purifier`) server-side on save, since CKEditor's client-side editor is trivially bypassed by posting directly to the endpoint.

Also (Low, from Admin review): `app/Http/Controllers/Admin/ChildCategoryController.php` builds `<option>` HTML by concatenating `$category->name` unescaped in `get_sub_category`/`update_sub_category` — stored XSS if a category name ever contains markup.

## 8. File upload issues

- `app/Http/Controllers/Admin/CustomImageController.php:38-44` — builds the destination filename from `$file->getClientOriginalName()` unsanitized, using raw `$file->move()` instead of the project's own `FileUploadHelper` (which uses randomized names elsewhere) — two uploads with the same original name in the same second overwrite each other. **Medium**
- `app/Http/Controllers/Client/BlogController.php:16-30` — CKEditor image-upload handler has no file-type/extension validation, moves uploads straight into `public_path('media')` with original name + timestamp (arbitrary file upload risk, e.g. `.php`). Currently not reachable — the corresponding route in `routes/client.php:157` is commented out — but the equivalent **admin** route (`routes/admin.php:148`) is live and points at a method that's commented out (see §4), so effectively dead on both sides today. **Do not re-enable either without fixing validation.** **Medium**
- `app/Http/Controllers/User/ProductEnquiryController.php:33` — catches an S3 upload exception and calls `dd(...)`, dumping raw debug output into the HTTP response on a public, unauthenticated form regardless of `APP_DEBUG`. **Medium/High**

## 9. Routing & config issues

- Nearly all destructive/state-changing admin actions (`delete`, `update_status`, `CustomerController::delete`, `SubscribeController::destroy`, etc.) are registered as **GET routes** instead of POST/DELETE. Laravel's CSRF protection only covers state-changing verbs, so these are vulnerable to CSRF via a crafted link/`<img>` tag while an admin session is active, and can be triggered accidentally by link prefetching or crawlers. **High**, cross-cutting across `routes/admin.php`.
- `routes/client.php:86-106` — `SubCategoryController`/`ChildCategoryController` routes under `/client/...` are wired to the **Admin** namespace controllers, which redirect to `admin.*` routes and render `admin.*` views gated by `auth:admin`. A client (only authenticated under the `client` guard) submitting these forms bounces into an inaccessible admin login — broken feature, and blurs the client/admin authorization boundary. **High**
- `routes/admin.php:200` / `routes/client.php:209` — `/change-payment-status//{id}` has a doubled slash typo in the route path, breaking `route()`-generated links. **Medium**
- `app/Http/Middleware/RedirectIfAuthenticated.php:22-29` — only special-cases the `admin` guard; an already-logged-in `client` falls through to the generic home redirect instead of the client dashboard (latent — currently masked because the `guest:client` middleware is commented out in `routes/client.php`). **Low/Medium**
- `config/app.php:178` — `BroadcastServiceProvider` is commented out of `providers`, yet `routes/channels.php` defines a real private channel and Pusher env vars are present in `.env.example` — broadcasting/private-channel auth silently never registers. **Medium**
- `app/Providers/AppServiceProvider.php:22-27` — reads `x-forwarded-proto` directly and calls `URL::forceScheme('https')`, running before `TrustProxies` middleware executes — trusts the header from any client, not just a configured trusted proxy. Anti-pattern, limited impact (URL generation only). **Low**
- `config/mail.php:106-107` — fallback `MAIL_FROM_ADDRESS`/name is a developer's personal Gmail address rather than a generic placeholder — will be used silently as the real "From" if the env var is ever unset in production. **Low**
- `app/Http/Controllers/Admin/ClientController.php:57` — emails the client's plaintext password in the welcome email (stored hashed in DB, but the plaintext transits email). **Medium**
- `app/Http/Controllers/Admin/PageController.php:36` — `update()` calls `$page->update($request->all())` instead of the validated array; `type` is fillable but not covered by validation, so an arbitrary value can be injected. **Medium**
- `app/Http/Controllers/Admin/ManageSiteController.php` — 7 of 8 near-identical settings-update methods (`basic_setting`, `media`, `seo`, `footer`, and the four column methods) do `ManageSite::where('key', ...)->first()` then assign/save with no null check — fatal if the row is missing; only `home_page()` was fixed to use `updateOrCreate`. **Medium/High**
- `app/Http/Controllers/Admin/OptionController.php` — `store()` restricts `input_type` to a whitelist, `update()` doesn't — type can be changed to anything after creation. **Low/Medium**
- `app/Http/Controllers/Admin/ServiceController.php` / `SliderController.php` — the "max 4 items" cap is a check-then-act race (TOCTOU); concurrent requests can exceed the cap. **Low**
- `app/services/CustomizationPreviewService.php` — dead code (never called anywhere). If ever wired up: builds a font file path from unsanitized order customization data with no whitelist/basename check (path traversal potential), and has no try/catch around font-color parsing. **Low as-is**
- `app/Mail/OrderPlacedMail.php` — unused Mailable, duplicates `OrderConfirmationMail` — the "order placed" email it implies is never actually sent. **Low**

## 10. Misc functional bugs

- `app/Http/Controllers/User/CartController.php:261-345` — `updateQuantity()` matches cart line items via `Str::startsWith($key, $productId)`, so product id `1` can match a cart key like `12-...` belonging to a different product — wrong line updated. **Low/Medium**
- `app/Http/Controllers/User/HomeController.php:546` — `blog_search()` references `$categories` in `compact()` without ever defining it — undefined variable. **Low**
- `app/Http/Controllers/Admin/ManageController.php` (`transactions_delete`) — deletes the entire parent `Order` alongside the targeted `Transaction`, silently removing sibling data if an order can have multiple transactions. **Low**

---

## Suggested fix order

1. **§1 Payments** (items 1–3, 6) — real money loss, fix immediately.
2. **§5 Password bugs** — actively locking out real users on ordinary profile edits.
3. **§2/§3 IDOR** — data integrity/security across tenants and users.
4. **§4 Admin panel fatals** — restore basic admin functionality (custom sizes/colors/images, product options).
5. **§6 DB/model mismatches** — decide whether to finish or roll back the multi-tenancy migration.
6. **§7 XSS**, **§8 uploads**, **§9 routing/config**, **§10 misc** — harden afterward.

---

## 11. Frontend / S3 UI issues (from Jul 2026 session)

| ID | Severity | Status | Issue |
|----|----------|--------|-------|
| UI-01 | High | Fixed | Home `image1` used raw path instead of `FileUploadHelper::url` |
| UI-02 | High | Fixed | Missing static assets (`icon.svg`, `section.jpg`, `image8.jpg`, `CustomerPhotos.png`) |
| UI-03 | High | Fixed | `primary_btn` invisible text / strange hover (white-on-white) |
| UI-04 | Medium | Fixed | Inconsistent button classes (`primery_btn` / `btn-primary` / `btn_black`) → standardized to `btn primary_btn` |
| UI-05 | Medium | Fixed | Blade views used `Storage::disk('s3')->url` directly |
| UI-06 | Medium | Fixed | Controllers used raw S3 upload/delete — migrated to `FileUploadHelper` |
| UI-07 | Low | Open | Related pages (contact, about, brand, etc.) still reference missing `image8.jpg` / `CustomerPhotos.png` |
| UI-08 | Medium | Open | `user-sidebar` “Remove Account” hardcodes geniusdevs.com demo URL |
