<div class="col-sm-6">
    <div class="form-floating">
        <div class="custom-select-container">
            <div class="selected-option" id="fontStyleSelectedOption">
                <label>Choose your text style</label>
            </div>
            <div class="layout-dropdown-menu" id="fontStyleDropdownMenu">
                <div class="layout-dropdown-header">
                    Choose your sign layout
                    <div class="font-style-dropdown-header-close" aria-hidden="true">×</div>
                </div>
                <div class="row p-4 pb-2">
                    <div class="col-4" style="border-right: 1px solid #dee2e6; background-color:#fff;padding-top:10px">
                        <ul style="list-style-type: none;text-align: center;padding-left: 0;">
                            <li class="language-title">All</li>
                            <li class="language-title">Modern</li>
                            <li class="language-title">Traditional</li>
                            <li class="language-title">Bold</li>
                            <li class="language-title">Script</li>
                            <li class="language-title">Fun</li>
                        </ul>
                    </div>
                    <div class="col-8 font-family-listing-outer">
                        <div id="all">
                            <p class="font-option">Arial</p>
                            <p class="font-option">Bariol</p>
                            <p class="font-option">Open Sans</p>
                            <p class="font-option">Gill Sans</p>
                            <p class="font-option">Source Sans Pro</p>
                            <p class="font-option">Medio</p>
                            <p class="font-option">Trajan Pro</p>
                            <p class="font-option">Georgia</p>
                            <p class="font-option">Opulent</p>
                            <p class="font-option">Lora</p>
                            <p class="font-option">Playfair Display</p>
                            <p class="font-option">Vidaloka</p>
                            <p class="font-option">Impact</p>
                            <p class="font-option">Oswald</p>
                            <p class="font-option">VAG Rounded</p>
                            <p class="font-option">Century Gothic Bold</p>
                            <p class="font-option">Source Sans Pro Black</p>
                            <p class="font-option">Alfa Slab One</p>
                            <p class="font-option">Cookie</p>
                            <p class="font-option">Lobster</p>
                            <p class="font-option">Comic Sans</p>
                        </div>
                        <div id="modern">
                            <p class="font-option">Arial</p>
                            <p class="font-option">Bariol</p>
                            <p class="font-option">Open Sans</p>
                            <p class="font-option">Gill Sans</p>
                            <p class="font-option">Source Sans Pro</p>
                        </div>
                        <div id="traditional">
                            <p class="font-option">Medio</p>
                            <p class="font-option">Trajan Pro</p>
                            <p class="font-option">Georgia</p>
                            <p class="font-option">Opulent</p>
                            <p class="font-option">Lora</p>
                            <p class="font-option">Playfair Display</p>
                            <p class="font-option">Vidaloka</p>
                        </div>
                        <div id="bold">
                            <p class="font-option">Impact</p>
                            <p class="font-option">Oswald</p>
                            <p class="font-option">VAG Rounded</p>
                            <p class="font-option">Century Gothic Bold</p>
                            <p class="font-option">Source Sans Pro Black</p>
                            <p class="font-option">Alfa Slab One</p>
                        </div>
                        <div id="script">
                            <p class="font-option">Cookie</p>
                            <p class="font-option">Lobster</p>
                        </div>
                        <div id="fun">
                            <p class="font-option">Comic Sans</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .layout-dropdown-card {
        cursor: pointer;
    }

    .custom-select-container {
        position: relative;
        font-family: Arial, sans-serif;
    }

    .selected-option {
        background-color: transparent;
        border: 1px solid #ccc;
        padding: 12px 13px;
        cursor: pointer;
        display: flex;
        height: 50px;
        justify-content: space-between;
        align-items: center;
        border-radius: 5px;
    }

    .selected-option>label {
        position: absolute;
        top: -10px;
        background-color: #fff;
        padding: 0px 6px;
        font-size: 14px;
    }

    .dropdown-arrow {
        margin-left: 10px;
    }

    .layout-dropdown-menu {
        position: absolute;
        top: 110%;
        left: 9px;
        right: 0;
        width: 200%;
        background-color: #f2f4f6;
        border: 1px solid #ccc;
        display: none;
        z-index: 1000;
        border-radius: 5px;
    }

    .layout-dropdown-header {
        background: #12405f;
        color: #fff;
        font-size: 20px;
        font-weight: 700;
        padding: 10px;
        border-top-right-radius: 5px;
        border-top-left-radius: 5px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .font-style-dropdown-header-close {
        cursor: pointer;
        font-size: 25px;
        color: #fff;
    }

    .font-family-listing-outer {
        height: 300px;
        overflow: auto;
    }

    #all,
    #modern,
    #traditional,
    #bold,
    #script,
    #fun {
        display: none;
    }

    .language-title {
        cursor: pointer;
        font-size: 13px;
        padding: 5px 0px;
        border-radius: 5px;
    }

    .language-title:hover {
        color: #EE903B;
        border-radius: 5px;
        border: 1px solid #cccccc;
    }

    .language-title.selected {
        color: #fff;
        border-radius: 5px;
        background-color: #EE903B;
    }

    .font-family-listing-outer {
        text-align: center;
    }

    .font-family-listing-outer div p {
        border-bottom: 1px solid #dee2e6;
        padding-bottom: 5px;
    }

    .font-family-listing-outer div p:hover {
        cursor: pointer;
    }

    .font-option.selected {
        border-bottom: 2px solid #EE903B;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const selectedOption = document.getElementById('fontStyleSelectedOption');
        const dropdownMenu = document.getElementById('fontStyleDropdownMenu');
        const closeButton = document.querySelector('.font-style-dropdown-header-close');
        const languageTitles = document.querySelectorAll('.language-title');
        const fontOptionDivs = document.querySelectorAll('#all, #modern, #traditional, #bold, #script, #fun');
        const fontOptions = document.querySelectorAll('.font-option'); // Select all font options

        // Map font names to their Google Fonts counterparts
        const fontMap = {
            'Arial': 'Arial, sans-serif',
            'Bariol': 'Bariol, sans-serif',
            'Open Sans': '"Open Sans", sans-serif',
            'Gill Sans': '"Gill Sans", sans-serif',
            'Source Sans Pro': '"Source Sans Pro", sans-serif',
            'Medio': 'Medio, sans-serif',
            'Trajan Pro': '"Trajan Pro", serif',
            'Georgia': 'Georgia, serif',
            'Opulent': 'Opulent, serif',
            'Lora': '"Lora", serif',
            'Playfair Display': '"Playfair Display", serif',
            'Vidaloka': '"Vidaloka", serif',
            'Impact': 'Impact, sans-serif',
            'Oswald': '"Oswald", sans-serif',
            'VAG Rounded': '"VAG Rounded", sans-serif',
            'Century Gothic Bold': '"Century Gothic", sans-serif',
            'Source Sans Pro Black': '"Source Sans Pro Black", sans-serif',
            'Alfa Slab One': '"Alfa Slab One", serif',
            'Cookie': '"Cookie", cursive',
            'Lobster': '"Lobster", cursive',
            'Comic Sans': '"Comic Sans MS", cursive'
        };

        // Hide all font option divs initially
        fontOptionDivs.forEach(div => div.style.display = 'none');

        // Toggle dropdown menu
        selectedOption.addEventListener('click', function() {
            dropdownMenu.style.display = dropdownMenu.style.display === 'none' || dropdownMenu.style.display === '' ? 'block' : 'none';
        });

        // Close the dropdown menu when clicking the close button
        closeButton.addEventListener('click', function() {
            dropdownMenu.style.display = 'none';
        });

        // Handle language title clicks
        languageTitles.forEach(function(title) {
            title.addEventListener('click', function() {
                languageTitles.forEach(function(item) {
                    item.classList.remove('selected');
                });
                title.classList.add('selected');
                fontOptionDivs.forEach(div => div.style.display = 'none');
                const selectedId = title.innerText.toLowerCase();
                const selectedDiv = document.getElementById(selectedId);

                if (selectedDiv) {
                    selectedDiv.style.display = 'grid';
                }
            });
        });

        // Handle font option clicks
        fontOptions.forEach(function(option) {
            option.addEventListener('click', function() {
                // Remove 'selected' class from all font options
                fontOptions.forEach(function(item) {
                    item.classList.remove('selected');
                });

                // Add 'selected' class to the clicked option
                option.classList.add('selected');

                // Set the selected font family in the dropdown
                const fontFamily = option.textContent;
                selectedOption.style.fontFamily = fontMap[fontFamily] || 'Arial, sans-serif'; // Default to Arial if not found

                // Save the selected font to sessionStorage
                sessionStorage.setItem('selectedFont', fontFamily);
                selectedOption.querySelector('label').textContent = fontFamily; // Update the label
            });
        });

        // Apply the font families to each font option
        fontOptions.forEach(function(element) {
            const fontFamily = element.textContent;
            element.style.fontFamily = fontMap[fontFamily] || 'Arial, sans-serif'; // Default to Arial if not found
        });
    });
</script>