$(document).ready(function () {
    $('#home-banner').owlCarousel({
        loop: true,
        margin: 0,
        nav: true,
        navText: [
            `<svg width="48" height="51" viewBox="0 0 48 51" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M24 46.2169C34.752 46.2169 43.5 37.1032 43.5 25.9017C43.5 14.7002 34.752 5.58652 24 5.58652C13.248 5.58652 4.5 14.7002 4.5 25.9017C4.5 37.1032 13.248 46.2168 24 46.2169ZM24 8.71193C33.098 8.71193 40.5 16.4234 40.5 25.9017C40.5 35.38 33.098 43.0914 24 43.0914C14.902 43.0914 7.5 35.38 7.5 25.9017C7.5 16.4234 14.902 8.71193 24 8.71193ZM18.9399 27.0081C18.3539 26.3976 18.3539 25.4078 18.9399 24.7973L24.9399 18.5465C25.2319 18.2423 25.616 18.0882 26 18.0882C26.384 18.0882 26.7681 18.2402 27.0601 18.5465C27.6461 19.157 27.6461 20.1468 27.0601 20.7573L22.12 25.9037L27.0601 31.0502C27.6461 31.6607 27.6461 32.6505 27.0601 33.2609C26.4741 33.8714 25.524 33.8714 24.938 33.2609L18.9399 27.0081Z" fill="white"/>
            </svg>`, // Left arrow
            `<svg width="48" height="51" viewBox="0 0 48 51" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M24 5.58655C13.248 5.58655 4.5 14.7002 4.5 25.9017C4.5 37.1032 13.248 46.2169 24 46.2169C34.752 46.2169 43.5 37.1032 43.5 25.9017C43.5 14.7002 34.752 5.58655 24 5.58655ZM24 43.0915C14.902 43.0915 7.5 35.38 7.5 25.9017C7.5 16.4234 14.902 8.71196 24 8.71196C33.098 8.71196 40.5 16.4234 40.5 25.9017C40.5 35.38 33.098 43.0915 24 43.0915ZM29.0601 24.7953C29.6461 25.4058 29.6461 26.3956 29.0601 27.0061L23.0601 33.2569C22.7681 33.5611 22.384 33.7152 22 33.7152C21.616 33.7152 21.2319 33.5632 20.9399 33.2569C20.3539 32.6464 20.3539 31.6566 20.9399 31.0461L25.88 25.8997L20.9399 20.7532C20.3539 20.1427 20.3539 19.153 20.9399 18.5425C21.5259 17.932 22.476 17.932 23.062 18.5425L29.0601 24.7953Z" fill="white"/>
            </svg>            
            `  // Right arrow
        ],
        dots: false,
        autoplayHoverPause: true,
        responsive: {
            0: {
                items: 1,
                autoplay: true,
                nav: false,
            },
            767: {
                items: 1,
                autoplay: true,
                nav: false,
            },
            1000: {
                items: 1
            }
        }
    });

    // Handle service clicks to move slider
    $('.nav-option').on('click', function(e) {
        e.preventDefault();
        
        var serviceIndex = $(this).data('service-index');
        var totalSliders = $('#home-banner .item').length;
        
        // Map service index to slider index (assuming 1:1 mapping)
        var sliderIndex = serviceIndex % totalSliders;
        
        $('.nav-option').removeClass('active');
        $(this).addClass('active');
        
        // Move slider to corresponding position
        $('#home-banner').trigger('to.owl.carousel', [sliderIndex, 300]);
    });

    $('#slate-banner').owlCarousel({
        loop: true,
        margin: 12,
        nav: true,
        navText: [
            `<svg width="48" height="51" viewBox="0 0 48 51" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M24 46.2169C34.752 46.2169 43.5 37.1032 43.5 25.9017C43.5 14.7002 34.752 5.58652 24 5.58652C13.248 5.58652 4.5 14.7002 4.5 25.9017C4.5 37.1032 13.248 46.2168 24 46.2169ZM24 8.71193C33.098 8.71193 40.5 16.4234 40.5 25.9017C40.5 35.38 33.098 43.0914 24 43.0914C14.902 43.0914 7.5 35.38 7.5 25.9017C7.5 16.4234 14.902 8.71193 24 8.71193ZM18.9399 27.0081C18.3539 26.3976 18.3539 25.4078 18.9399 24.7973L24.9399 18.5465C25.2319 18.2423 25.616 18.0882 26 18.0882C26.384 18.0882 26.7681 18.2402 27.0601 18.5465C27.6461 19.157 27.6461 20.1468 27.0601 20.7573L22.12 25.9037L27.0601 31.0502C27.6461 31.6607 27.6461 32.6505 27.0601 33.2609C26.4741 33.8714 25.524 33.8714 24.938 33.2609L18.9399 27.0081Z" fill="#A6A3A3"/>
            </svg>`,
            `<svg width="48" height="51" viewBox="0 0 48 51" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M24 5.58655C13.248 5.58655 4.5 14.7002 4.5 25.9017C4.5 37.1032 13.248 46.2169 24 46.2169C34.752 46.2169 43.5 37.1032 43.5 25.9017C43.5 14.7002 34.752 5.58655 24 5.58655ZM24 43.0915C14.902 43.0915 7.5 35.38 7.5 25.9017C7.5 16.4234 14.902 8.71196 24 8.71196C33.098 8.71196 40.5 16.4234 40.5 25.9017C40.5 35.38 33.098 43.0915 24 43.0915ZM29.0601 24.7953C29.6461 25.4058 29.6461 26.3956 29.0601 27.0061L23.0601 33.2569C22.7681 33.5611 22.384 33.7152 22 33.7152C21.616 33.7152 21.2319 33.5632 20.9399 33.2569C20.3539 32.6464 20.3539 31.6566 20.9399 31.0461L25.88 25.8997L20.9399 20.7532C20.3539 20.1427 20.3539 19.153 20.9399 18.5425C21.5259 17.932 22.476 17.932 23.062 18.5425L29.0601 24.7953Z" fill="#A6A3A3"/>
            </svg>            
            `
        ],
        dots: false,
        autoplayHoverPause: true,
        autoplay: true,
        responsive: {
            0: {
                items: 1,
                nav: false,
            },
            674: {
                items: 1,
                nav: false,
            },
            767: {
                items: 2,
                nav: false,
            },
            991: {
                items: 3,
                nav: false,

            },
            1250: {
                items: 4
            }
        }
    });

    // input type range 
    function initializeRangeSlider(rangeContainer) {
        const fromSlider = rangeContainer.querySelector('#fromSlider');
        const toSlider = rangeContainer.querySelector('#toSlider');
        const fromInput = rangeContainer.querySelector('#fromInput');
        const toInput = rangeContainer.querySelector('#toInput');

        function updateSliderFromInput() {
            fromSlider.value = fromInput.value;
            toSlider.value = toInput.value;
        }

        function updateInputFromSlider() {
            fromInput.value = fromSlider.value;
            toInput.value = toSlider.value;
        }

        function fillSlider(from, to, sliderColor, rangeColor, controlSlider) {
            const rangeDistance = to.max - to.min;
            const fromPosition = from.value - to.min;
            const toPosition = to.value - to.min;
            controlSlider.style.background = `linear-gradient(
                to right,
                ${sliderColor} 0%,
                ${sliderColor} ${(fromPosition) / (rangeDistance) * 100}%,
                ${rangeColor} ${((fromPosition) / (rangeDistance)) * 100}%,
                ${rangeColor} ${(toPosition) / (rangeDistance) * 100}%, 
                ${sliderColor} ${(toPosition) / (rangeDistance) * 100}%, 
                ${sliderColor} 100%)`;
        }

        function setToggleAccessible(currentTarget) {
            if (Number(currentTarget.value) <= 0) {
                toSlider.style.zIndex = 2;
            } else {
                toSlider.style.zIndex = 0;
            }
        }

        function controlFromSlider(fromSlider, toSlider, fromInput) {
            const from = parseInt(fromSlider.value);
            const to = parseInt(toSlider.value);
            fillSlider(fromSlider, toSlider, '#C6C6C6', '#EE903B', toSlider);
            if (from > to) {
                fromSlider.value = to;
                fromInput.value = to;
            } else {
                fromInput.value = from;
            }
        }

        function controlToSlider(fromSlider, toSlider, toInput) {
            const from = parseInt(fromSlider.value);
            const to = parseInt(toSlider.value);
            fillSlider(fromSlider, toSlider, '#C6C6C6', '#EE903B', toSlider);
            setToggleAccessible(toSlider);
            if (from <= to) {
                toSlider.value = to;
                toInput.value = to;
            } else {
                toInput.value = from;
                toSlider.value = from;
            }
        }

        function controlFromInput(fromSlider, fromInput, toInput, controlSlider) {
            const from = parseInt(fromInput.value);
            const to = parseInt(toInput.value);
            fillSlider(fromInput, toInput, '#C6C6C6', '#EE903B', controlSlider);
            if (from > to) {
                fromSlider.value = to;
                fromInput.value = to;
            } else {
                fromSlider.value = from;
            }
        }

        function controlToInput(toSlider, fromInput, toInput, controlSlider) {
            const from = parseInt(fromInput.value);
            const to = parseInt(toInput.value);
            fillSlider(fromInput, toInput, '#C6C6C6', '#EE903B', controlSlider);
            setToggleAccessible(toInput);
            if (from <= to) {
                toSlider.value = to;
                toInput.value = to;
            } else {
                toInput.value = from;
            }
        }

        fromSlider.addEventListener('input', () => controlFromSlider(fromSlider, toSlider, fromInput));
        toSlider.addEventListener('input', () => controlToSlider(fromSlider, toSlider, toInput));
        fromInput.addEventListener('input', () => controlFromInput(fromSlider, fromInput, toInput, toSlider));
        toInput.addEventListener('input', () => controlToInput(toSlider, fromInput, toInput, toSlider));

        fillSlider(fromSlider, toSlider, '#C6C6C6', '#EE903B', toSlider);
        setToggleAccessible(toSlider);
    }
    document.querySelectorAll('.range_container').forEach(container => {
        initializeRangeSlider(container);
    });
    // input type range 
    // input number plus and minus
    $('.minus').click(function () {
        var $input = $(this).parent().find('input');
        var count = parseInt($input.val()) - 1;
        count = count < 1 ? 1 : count;
        $input.val(count);
        $input.change();
        return false;
    });
    $('.plus').click(function () {
        var $input = $(this).parent().find('input');
        $input.val(parseInt($input.val()) + 1);
        $input.change();
        return false;
    });
    // input number plus and minus

    $('#proimg_slider').owlCarousel({
        loop: true,
        margin: 20,
        nav: true,
        navText: [
            `<svg style="transform: rotate(180deg);" width="11" height="20" viewBox="0 0 11 20" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M10.2798 10.2818L1.27981 19.2818C1.13381 19.4278 0.941779 19.5017 0.749779 19.5017C0.557779 19.5017 0.36575 19.4288 0.21975 19.2818C-0.07325 18.9888 -0.07325 18.5137 0.21975 18.2207L8.68978 9.75076L0.21975 1.28079C-0.07325 0.987785 -0.07325 0.51275 0.21975 0.21975C0.51275 -0.07325 0.987785 -0.07325 1.28079 0.21975L10.2808 9.21975C10.5728 9.51375 10.5728 9.98876 10.2798 10.2818Z" fill="#41416E"/>
            </svg>`,
            `<svg width="11" height="20" viewBox="0 0 11 20" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M10.2798 10.2818L1.27981 19.2818C1.13381 19.4278 0.941779 19.5017 0.749779 19.5017C0.557779 19.5017 0.36575 19.4288 0.21975 19.2818C-0.07325 18.9888 -0.07325 18.5137 0.21975 18.2207L8.68978 9.75076L0.21975 1.28079C-0.07325 0.987785 -0.07325 0.51275 0.21975 0.21975C0.51275 -0.07325 0.987785 -0.07325 1.28079 0.21975L10.2808 9.21975C10.5728 9.51375 10.5728 9.98876 10.2798 10.2818Z" fill="#41416E"/>
            </svg>`
        ],
        dots: false,
        autoplayHoverPause: true,
        responsive: {
            474: {
                items: 2,
                nav: false,
                autoplay: true,
            },
            767: {
                items: 3,
                autoplay: true,
            },
            991: {
                items: 3,

            },
            1250: {
                items: 4
            }
        }
    });
});