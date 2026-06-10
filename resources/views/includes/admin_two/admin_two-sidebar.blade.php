<div class="sidebar">
    @php
        $settings = \App\Models\ManageSite::where('key', 'media')->first();
        $setting_value = $settings ? json_decode($settings->value) : null;
    @endphp

    <div class="sidebar-background"></div>
    <div class="sidebar-wrapper scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="info">
                    <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                        <span>
                            Admin Two
                            {{-- <span class="user-level">Administrator</span> --}}
                        </span>
                    </a>
                </div>
            </div>

            <ul class="nav">

                <li class="nav-item">
                    <a href="{{ route('client.dashboard') }}">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                {{-- i have added this --}}

                <li class="nav-item">
                    <a data-toggle="collapse" href="#items">
                        <i class="fab fa-product-hunt"></i>
                        <p>Manage Catalogs</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="items">
                        <ul class="nav nav-collapse">
                            <li>
                                <a class="sub-link" href="{{ route('client.brand.index') }}">
                                    <span class="sub-item">Brands</span>
                                </a>
                            </li>
                            <li>
                                <a class="sub-link" href="{{ route('client.product.create') }}">
                                    <span class="sub-item">Add Product</span>
                                </a>
                            </li>
                            <li>
                                <a class="sub-link" href="{{ route('client.product.index') }}">
                                    <span class="sub-item">All Products</span>
                                </a>
                            </li>
                            <li>
                                <a class="sub-link" href="{{ route('client.category.index') }}">
                                    <span class="sub-item">Categories</span>
                                </a>
                            </li>
                            <li>
                                <a class="sub-link" href="{{ route('client.option.index') }}">
                                    <span class="sub-item">Options</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                {{-- <li class="nav-item">
                    <a data-toggle="collapse" href="#items-CD">
                        <i class="fas fa-pencil-ruler"></i>	
                        <p>Customize Design</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="items-CD">
                        <ul class="nav nav-collapse">
                            <li>
                                <a class="sub-link" href="{{ route('admin.custom_image.index') }}">
                                    <span class="sub-item">Background Images</span>
                                </a>
                            </li>
                            <li>
                                <a class="sub-link" href="{{ route('admin.product.create') }}">
                                    <span class="sub-item">Fonts</span>
                                </a>
                            </li>
                            <li>
                                <a class="sub-link" href="{{ route('admin.custom_size.index') }}">
                                    <span class="sub-item">Size At Widest Points</span>
                                </a>
                            </li>
                            <li>
                                <a class="sub-link" href="{{ route('admin.custom_color.index') }}">
                                    <span class="sub-item">Color</span>
                                </a>
                            </li>
                         
                        </ul>
                    </div>
                </li> --}}




                <li class="nav-item ">
                    <a data-toggle="collapse" href="#order">
                        <i class="fab fa-first-order"></i>
                        <p>Manage Orders </p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="order">
                        <ul class="nav nav-collapse">
                            <li class="">
                                <a class="sub-link" href="{{ route('client.all.order') }}">
                                    <span class="sub-item">All Orders</span>
                                </a>
                            </li>
                            <li class="">
                                <a class="sub-link" href="{{ route('client.pending.order') }}">
                                    <span class="sub-item">Pending Orders</span>
                                </a>
                            </li>
                            <li class="">
                                <a class="sub-link" href="{{ route('client.processing.order') }}">
                                    <span class="sub-item">Processing Orders</span>
                                </a>
                            </li>
                            <li class="">
                                <a class="sub-link" href="{{ route('client.progress.order') }}">
                                    <span class="sub-item">Progress Orders</span>
                                </a>
                            </li>

                            <li class="">
                                <a class="sub-link" href="{{ route('client.delivered.order') }}">
                                    <span class="sub-item">Delivered Orders</span>
                                </a>
                            </li>
                            <li class="">
                                <a class="sub-link" href="{{ route('client.canceled.order') }}">
                                    <span class="sub-item">Canceled Orders</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                {{-- <li class="nav-item">
                    <a href="{{ route('admin.product-enquiries') }}">
                        <i class="fas fa-question-circle"></i>
                        <p>Product Enquiry</p>
                    </a>
                </li>--}}

                <li class="nav-item">
                    <a href="{{ route('client.transactions') }}">
                        <i class="fas fa-random"></i>
                        <p>Transactions</p>
                    </a>
                </li> 


                <li class="nav-item">
                    <a href="{{ route('client.subscribers') }}">
                        <i class="fas fa-users"></i>
                        <p>Subscriber</p>
                    </a>
                </li>
                {{-- <li class="nav-item">
                    <a href="{{ route('admin.customer') }}">
                        <i class="fas fa-users"></i>
                        <p>Customer List</p>
                    </a>
                </li> --}}

                {{-- <li class="nav-item">
                    <a data-toggle="collapse" href="#content">
                        <i class="fas fa-tasks"></i>
                        <p>Manage Site</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="content">
                        <ul class="nav nav-collapse">
                            <li>
                                <a class="sub-link" href="{{ route('admin.manage-site.index') }}">
                                    <span class="sub-item">General Settings</span>
                                </a>
                            </li>
                            <li>
                                <a class="sub-link" href="{{ route('admin.slider.index') }}">
                                    <span class="sub-item">Sliders</span>
                                </a>
                            </li>

                            <li>
                                <a class="sub-link" href="{{ route('admin.service.index') }}">
                                    <span class="sub-item">Services</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li> --}}

                <li class="nav-item">
                    <a data-toggle="collapse" href="#faqs">
                        <i class="fas fa-question-circle"></i>
                        <p>Manage Faqs</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="faqs">
                        <ul class="nav nav-collapse">
                            <li>
                                <a class="sub-link" href="{{ route('client.faq-category.index') }}">
                                    <span class="sub-item">Categories</span>
                                </a>
                            </li>
                            <li>
                                <a class="sub-link" href="{{ route('client.faq.index') }}">
                                    <span class="sub-item">Faqs</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a data-toggle="collapse" href="#post">
                        <i class="fas fa-rss-square"></i>
                        <p>Manage Blogs</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="post">
                        <ul class="nav nav-collapse">
                            <li>
                                <a class="sub-link" href="{{ route('client.blog.index') }}">
                                    <span class="sub-item">Blogs</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a href="{{ route('client.website.index') }}">
                        <i class="fas fa-globe"></i>
                        <p>Websites</p>
                    </a>
                </li>

                {{-- <li class="nav-item">
                    <a href="{{ route('admin.pages') }}">
                        <i class="fab fa-product-hunt"></i>
                        <p>Pages</p>
                    </a>
                </li> --}}

                {{-- <li class="nav-item">
                    <a href="{{ route('admin.client.index') }}">
                        <i class="fas fa-users"></i>
                        <p>Clients</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.email.index') }}">
                        <i class="fas fa-envelope"></i>
                        <p>Email Template</p>
                    </a>
                </li> --}}

                {{-- Preferences --}}
                {{-- <li class="nav-item ">
                    <a data-toggle="collapse" href="#preferences">
                        <i class="fas fa-cog"></i>
                        <p>Preferences </p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="preferences">
                        <ul class="nav nav-collapse">
                            <li class="">
                                <a class="sub-link" href="{{ route('admin.home.preferences') }}">
                                    <span class="sub-item">Home Preferences</span>
                                </a>
                            </li>
                            <li class="">
                                <a class="sub-link" href="{{ route('admin.about.preferences') }}">
                                    <span class="sub-item">About Preferences</span>
                                </a>
                            </li>
                            <li class="">
                                <a class="sub-link" href="{{ route('admin.service.preferences') }}">
                                    <span class="sub-item">Service Preferences</span>
                                </a>
                            </li>
                            <li class="">
                                <a class="sub-link" href="{{ route('admin.store.preferences') }}">
                                    <span class="sub-item">Store Preferences</span>
                                </a>
                            </li>
                            <li class="">
                                <a class="sub-link" href="{{ route('admin.contact.preferences') }}">
                                    <span class="sub-item">Contact Preferences</span>
                                </a>
                            </li>
                            <li class="">
                                <a class="sub-link" href="{{ route('admin.categories.preferences') }}">
                                    <span class="sub-item">Categories Preferences</span>
                                </a>
                            </li>
                            <li class="">
                                <a class="sub-link" href="{{ route('admin.brands.preferences') }}">
                                    <span class="sub-item">Brands Preferences</span>
                                </a>
                            </li>

                            <li class="">
                                <a class="sub-link" href="{{ route('admin.cart.preferences') }}">
                                    <span class="sub-item">Cart Preferences</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.website.index') }}">
                        <i class="fas fa-globe"></i>
                        <p>Websites</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.website-template.index') }}">
                        <i class="fas fa-globe"></i>
                        <p>Website Template</p>
                    </a>
                </li> --}}
            </ul>
        </div>
    </div>
</div>
