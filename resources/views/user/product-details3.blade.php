<section id="live_preview" class="my-5">
    <div class="container">
        <div class="row gy-4" id="prod-m" data-commercial="false" data-preview-key="ivy_way_slate"
            data-cart-url="/ajax/cart" data-upload-link="/_uploader/upload/upload">
            <div class="col-lg-6" id="prod-preview-c">
                <div id="prod-preview">
                    <!-- Display the image stored in the database -->
                    <img data-preview="" src="{{ asset('storage/' . $product->featured_image) }}"
                        alt="{{ $product->name }} live preview">
                </div>
            </div>
            <div class="col-lg-6">
                <form name="" method="" id="sylius-product-adding-to-cart" class="ui loadable form">
                    <div id="prod-options">
                        <div id="prod-p">
                            <h3>Personalise sign</h3>
                            <div class="required field">
                                <div id="sylius_add_to_cart_cartItem_textOptions">
                                    <div class="field">
                                        <div class="prod-option-c" data-mapping="sign-layout">
                                            <label for="">Sign Layout
                                                <span class="icon-help" data-toggle="tooltip" data-placement="right"
                                                    title=""
                                                    data-original-title="Choose the way your text is laid out on your sign"></span></label>
                                            <div class="prod-select-c" id="sign-layout">
                                                <div class="prod-select-box prod-select-box-layout">
                                                    Choose your sign layout
                                                </div>
                                                <div class="prod-select-popup" style="display: none;">
                                                    <div class="prod-select-header icon-close">Choose your sign layout
                                                    </div>
                                                    <div class="prod-select-main d-flex flex-wrap">
                                                        <div class="layout-option col-4 selected"
                                                            data-value="house_no_with_text_below">
                                                            <div class="layout-img" id="num-name-below">
                                                                <div class="num">#</div>
                                                                <div class="line"></div>
                                                            </div>
                                                            <div class="item-name">House No. with street name below
                                                            </div>
                                                        </div>
                                                        <div class="layout-option col-4" data-value="one_text_block">
                                                            <div class="layout-img" id="text-one">
                                                                <div class="line"></div>
                                                            </div>
                                                            <div class="item-name">One text block (e.g. House Name)
                                                            </div>
                                                        </div>
                                                        <div class="layout-option col-4" data-value="house_no_only">
                                                            <div class="layout-img" id="num-only">
                                                                <div class="num">#</div>
                                                            </div>
                                                            <div class="item-name">House No. Only</div>
                                                        </div>
                                                        <div class="layout-option col-4"
                                                            data-value="house_no_with_text_above">
                                                            <div class="layout-img" id="num-name-above">
                                                                <div class="line"></div>
                                                                <div class="num">#</div>
                                                            </div>
                                                            <div class="item-name">House No. with text above</div>
                                                        </div>
                                                        <div class="layout-option col-4"
                                                            data-value="house_no_with_text_above_below">
                                                            <div class="layout-img" id="num-name-above-below">
                                                                <div class="line"></div>
                                                                <div class="num">#</div>
                                                                <div class="line"></div>
                                                            </div>
                                                            <div class="item-name">House No. with text above &amp; below
                                                            </div>
                                                        </div>
                                                        <div class="layout-option col-4" data-value="two_text_blocks">
                                                            <div class="layout-img" id="text-two">
                                                                <div class="line"></div>
                                                                <div class="line"></div>
                                                            </div>
                                                            <div class="item-name">Two text blocks</div>
                                                        </div>
                                                    </div>
                                                    <input class="input" id="sign-layout-selection" type="hidden"
                                                        name="sylius_add_to_cart[cartItem][textOptions][sign-layout][layout]"
                                                        value="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="field">
                                        <div class="prod-option-c" data-mapping="text-style">
                                            <label for="">Text Style</label>
                                            <div class="prod-select-c" id="sign-text">
                                                <div class="prod-select-box prod-select-box-text">
                                                    Choose your text style
                                                </div>
                                                <div class="prod-select-popup" style="display: none;">
                                                    <div class="prod-select-header icon-close">Choose your text style
                                                    </div>
                                                    <div class="prod-select-main">
                                                        <ul id="text-filter-options">
                                                            <li class="active"><a href="javascript:void(0);"
                                                                    data-font="all" class="all">All</a></li>
                                                            <li><a href="javascript:void(0);" data-font="modern"
                                                                    class="modern">Modern</a></li>
                                                            <li><a href="javascript:void(0);" data-font="traditional"
                                                                    class="traditional">Traditional</a></li>
                                                            <li><a href="javascript:void(0);" data-font="bold"
                                                                    class="bold">Bold</a></li>
                                                            <li><a href="javascript:void(0);" data-font="script"
                                                                    class="script">Script</a></li>
                                                            <li><a href="javascript:void(0);" data-font="fun"
                                                                    class="fun">Fun</a></li>
                                                        </ul>
                                                        <div id="text-options-c">
                                                            <div class="text-option default-font" data-value=""
                                                                data-font="">
                                                                <span>As Pictured</span>
                                                                As Pictured
                                                            </div>
                                                            <div class="text-option modern default selected"
                                                                data-value="arial.ttf" data-font="modern">
                                                                <span>Arial</span>
                                                                <img src="{{ asset('assets/imgs/text-style/xarial.png.pagespeed.ic.BaBLePNSxo.webp') }}"
                                                                    alt="Arial">
                                                            </div>
                                                            <div class="text-option modern"
                                                                data-value="bariol_bold.otf" data-font="modern">
                                                                <span>Bariol</span>
                                                                <img src="{{ asset('assets/imgs/text-style/xbariol.png.pagespeed.ic.i71kbFR5jj.webp') }}"
                                                                    alt="Bariol">
                                                            </div>
                                                            <div class="text-option modern"
                                                                data-value="opensans-bold.ttf" data-font="modern">
                                                                <span>Open Sans</span>
                                                                <img src="{{ asset('assets/imgs/text-style/xopen-sans.png.pagespeed.ic.APjFbasMcS.webp') }}"
                                                                    alt="Open Sans">
                                                            </div>
                                                            <div class="text-option modern" data-value="gill_sans.ttf"
                                                                data-font="modern">
                                                                <span>Gill Sans</span>
                                                            </div>
                                                            <div class="text-option modern"
                                                                data-value="sourcesanspro-bold.ttf"
                                                                data-font="modern">
                                                                <span>Source Sans Pro</span>
                                                                <img src="{{ asset('assets/imgs/text-style/xsource-sans-pro.png.pagespeed.ic.EvAQrEwbWd.webp') }}"
                                                                    alt="Source Sans Pro">
                                                            </div>
                                                            <div class="text-option traditional"
                                                                data-value="medio.otf" data-font="traditional">
                                                                <span>Medio</span>
                                                                <img src="{{ asset('assets/imgs/text-style/xmedio.png.pagespeed.ic.p37PCXCtGQ.webp') }}"
                                                                    alt="Medio">
                                                            </div>
                                                            <div class="text-option traditional"
                                                                data-value="trajan_pro.otf" data-font="traditional">
                                                                <span>Trajan Pro</span>
                                                                <img src="{{ asset('assets/imgs/text-style/xtrajan_pro.png.pagespeed.ic.GFvZe-Zjg_.webp') }}"
                                                                    alt="Trajan Pro">
                                                            </div>
                                                            <div class="text-option traditional"
                                                                data-value="times_new_roman.ttf"
                                                                data-font="traditional">
                                                                <span>Times New Roman</span>
                                                                <img src="{{ asset('assets/imgs/text-style/xtimes_new_roman.png.pagespeed.ic.vv-sRIhx-T.webp') }}"
                                                                    alt="Times New Roman">
                                                            </div>
                                                            <div class="text-option traditional"
                                                                data-value="georgia.ttf" data-font="traditional">
                                                                <span>Georgia</span>
                                                                <img src="{{ asset('assets/imgs/text-style/xgeorgia.png.pagespeed.ic.QygnXLrMW4.webp') }}"
                                                                    alt="Georgia">
                                                            </div>
                                                            <div class="text-option traditional"
                                                                data-value="opulent.ttf" data-font="traditional">
                                                                <span>Opulent</span>
                                                                <img src="{{ asset('assets/imgs/text-style/xopulent.png.pagespeed.ic.h3ixEX2Ob3.webp') }}"
                                                                    alt="Opulent">
                                                            </div>
                                                            <div class="text-option traditional"
                                                                data-value="lora-regular.ttf" data-font="traditional">
                                                                <span>Lora</span>
                                                                <img src="{{ asset('assets/imgs/text-style/xlora-regular.png.pagespeed.ic.GlF6Jc83Up.webp') }}"
                                                                    alt="Lora">
                                                            </div>
                                                            <div class="text-option traditional"
                                                                data-value="playfairdisplay-regular.ttf"
                                                                data-font="traditional">
                                                                <span>Playfair Display</span>
                                                                <img src="{{ asset('assets/imgs/text-style/xplayfairdisplay-regular.png.pagespeed.ic.PyqFmpGOuw.webp') }}"
                                                                    alt="Playfair Display">
                                                            </div>
                                                            <div class="text-option traditional"
                                                                data-value="vidaloka-regular.ttf"
                                                                data-font="traditional">
                                                                <span>Vidaloka</span>
                                                                <img src="{{ asset('assets/imgs/text-style/xvidaloka-regular.png.pagespeed.ic.Dt0sJQB9Tu.webp') }}"
                                                                    alt="Vidaloka">
                                                            </div>
                                                            <div class="text-option bold" data-value="impact.ttf"
                                                                data-font="bold">
                                                                <span>Impact</span>
                                                                <img src="{{ asset('assets/imgs/text-style/ximpact.png.pagespeed.ic.usIur3q3jr.webp') }}"
                                                                    alt="Impact">
                                                            </div>
                                                            <div class="text-option bold" data-value="oswald-bold.ttf"
                                                                data-font="bold">
                                                                <span>Oswald</span>
                                                                <img src="{{ asset('assets/imgs/text-style/xoswald-bold.png.pagespeed.ic.pEHHupQb-O.webp') }}"
                                                                    alt="Oswald">
                                                            </div>
                                                            <div class="text-option bold"
                                                                data-value="vag_rounded_bold.ttf" data-font="bold">
                                                                <span>VAG Rounded</span>
                                                                <img src="{{ asset('assets/imgs/text-style/xvag_rounded_bold.png.pagespeed.ic.eHVip5rLhB.webp') }}"
                                                                    alt="VAG Rounded">
                                                            </div>
                                                            <div class="text-option bold"
                                                                data-value="century_gothic_bold.ttf" data-font="bold">
                                                                <span>Century Gothic Bold</span>
                                                                <img src="{{ asset('assets/imgs/text-style/xcentury_gothic_bold.png.pagespeed.ic.HBGsFZOwB-.webp') }}"
                                                                    alt="Century Gothic Bold">
                                                            </div>
                                                            <div class="text-option bold"
                                                                data-value="sourcesanspro-black.ttf" data-font="bold">
                                                                <span>Source Sans Pro Black</span>
                                                                <img src="{{ asset('assets/imgs/text-style/xsourcesanspro-black.png.pagespeed.ic.3sORFgWqRH.webp') }}"
                                                                    alt="Source Sans Pro Black">
                                                            </div>
                                                            <div class="text-option bold"
                                                                data-value="alfaslabone-regular.ttf" data-font="bold">
                                                                <span>Alfa Slab One</span>
                                                                <img src="{{ asset('assets/imgs/text-style/xalfaslabone-regular.png.pagespeed.ic.CAUZqFz5SG.webp') }}"
                                                                    alt="Alfa Slab One">
                                                            </div>
                                                            <div class="text-option script"
                                                                data-value="cookie-regular.ttf" data-font="script">
                                                                <span>Cookie</span>
                                                                <img src="{{ asset('assets/imgs/text-style/xcookie-regular.png.pagespeed.ic.sMxBoJHTO7.webp') }}"
                                                                    alt="Cookie">
                                                            </div>
                                                            <div class="text-option script"
                                                                data-value="lobster-regular.ttf" data-font="script">
                                                                <span>Lobster</span>
                                                                <img src="{{ asset('assets/imgs/text-style/xlobster-regular.png.pagespeed.ic.JnU-eqYduJ.webp') }}"
                                                                    alt="Lobster">
                                                            </div>
                                                            <div class="text-option fun"
                                                                data-value="comic_sans_ms.ttf" data-font="fun">
                                                                <span>Comic Sans</span>
                                                                <img src="{{ asset('assets/imgs/text-style/xcomic_sans_ms.png.pagespeed.ic.t1yyHCBI2t.webp') }}"
                                                                    alt="Comic Sans">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <input class="input" type="hidden"
                                                        name="sylius_add_to_cart[cartItem][textOptions][text-style]"
                                                        value="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
</section>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get references to the elements
        const layoutOptions = document.querySelectorAll('.layout-option');
        const textOptions = document.querySelectorAll('.text-option');
        const imagePreview = document.querySelector('#prod-preview img');
        const layoutSelectionInput = document.querySelector('#sign-layout-selection');
        const textStyleInput = document.querySelector(
            'input[name="sylius_add_to_cart[cartItem][textOptions][text-style]"]');

        // Event listener for layout options
        layoutOptions.forEach(option => {
            option.addEventListener('click', function() {
                // Remove 'selected' class from all options
                layoutOptions.forEach(opt => opt.classList.remove('selected'));
                // Add 'selected' class to the clicked option
                this.classList.add('selected');

                // Update layout selection input value
                layoutSelectionInput.value = this.getAttribute('data-value');

                // Update the image preview based on the selected layout
                updateImagePreview();
            });
        });

        // Event listener for text style options
        textOptions.forEach(option => {
            option.addEventListener('click', function() {
                // Remove 'selected' class from all options
                textOptions.forEach(opt => opt.classList.remove('selected'));
                // Add 'selected' class to the clicked option
                this.classList.add('selected');

                // Update text style input value
                textStyleInput.value = this.getAttribute('data-value');

                // Update the image preview based on the selected text style
                updateImagePreview();
            });
        });

        // Function to update the image preview
        function updateImagePreview() {
            const selectedLayout = layoutSelectionInput.value;
            const selectedTextStyle = textStyleInput.value;

            // Here you can change the image source based on selected layout and text style
            // For example, you can create a mapping of layout/text style to image URLs

            // Example mapping (you should replace these URLs with your actual images)
            const images = {
                'house_no_with_text_below': 'path/to/house_no_with_text_below.png',
                'one_text_block': 'path/to/one_text_block.png',
                'house_no_only': 'path/to/house_no_only.png',
                'house_no_with_text_above': 'path/to/house_no_with_text_above.png',
                'house_no_with_text_above_below': 'path/to/house_no_with_text_above_below.png',
                'two_text_blocks': 'path/to/two_text_blocks.png',
            };

            // Update the image source based on selected layout
            if (images[selectedLayout]) {
                imagePreview.src = images[selectedLayout];
            }

            // Optionally, you can change the text style dynamically as well
            // For example, you can apply a CSS class to the image or text element
            // based on the selected text style
            // imagePreview.className = selectedTextStyle; // Assuming you have CSS classes for text styles
        }
    });
</script>
