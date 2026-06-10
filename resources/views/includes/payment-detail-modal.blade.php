<div class="modal-body">
    <div class="card-body">
        <div class="card-wrapper"></div>
        <form role="form" action="{{ route('user.checkout.stripe') }}" method="post"
            class="require-validation" data-cc-on-file="false"
            data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" id="payment-form">
            @csrf
            <!-- Card Number Field -->
            <div class="form-group col-sm-12">
                <label for="card-number">Card Number</label>
                <input class="form-control card-number" type="tel" name="card"
                    id="card-number" placeholder="Card Number" required=""
                    pattern="[0-9\s]{13,19}" maxlength="19">
            </div>

            <input type="hidden" name="payment_method" value="Stripe">

            <!-- Expiration Month Field -->
            <div class="form-group col-sm-6">
                <label for="card-expiry-month">Expiration Month</label>
                <input class="form-control card-expiry-month" type="text" name="month"
                    id="card-expiry-month" placeholder="MM" required=""
                    maxlength="2" pattern="0[1-9]|1[0-2]">
            </div>

            <!-- Expiration Year Field -->
            <div class="form-group col-sm-6">
                <label for="card-expiry-year">Expiration Year</label>
                <input class="form-control card-expiry-year" type="text" name="year"
                    id="card-expiry-year" placeholder="YY" required=""
                    maxlength="2" pattern="[0-9]{2}">
            </div>

            <!-- CVV Field -->
            <div class="form-group col-sm-12">
                <label for="card-cvc">CVV</label>
                <input class="form-control card-cvc" type="tel" name="cvc"
                    id="card-cvc" placeholder="CVV" required=""
                    maxlength="4" pattern="[0-9]{3,4}">
            </div>

            <p class="p-3">Stripe is the faster &amp; safer way to send money. Make an online payment via Stripe.</p>

            <div class="modal-footer">
                <button class="btn btn-primary btn-sm" type="button"
                    data-bs-dismiss="modal"><span>Cancel</span></button>
                <button style="z-index: 1;" class="btn btn-primary btn-sm" type="submit"><span>Checkout With Stripe</span></button>
            </div>
        </form>
    </div>
</div>