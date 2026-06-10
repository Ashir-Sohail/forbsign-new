<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>@yield('title') | Forbsigns ( Online bazaar )</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" type="image/x-icon"
        href="https://geniusdevs.com/codecanyon/omnimart40/assets/images/1629651232pre.png" />

    <script src="https://geniusdevs.com/codecanyon/omnimart40/assets/back/js/plugin/webfont/webfont.min.js"></script>
    <script id="setFont" data-src="https://geniusdevs.com/codecanyon/omnimart40/assets/back/css/fonts.css"
        src="https://geniusdevs.com/codecanyon/omnimart40/assets/back/js/plugin/webfont/setfont.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/back/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/back/css/azzara.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/back/css/tagify.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/back/css/editor.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/back/css/bootstrap-iconpicker.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/back/css/magnific-popup.css') }}">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/back/css/custom.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="wrapper">

        @include('includes.admin_two.admin_two-header')

        <!-- Sidebar -->
        @include('includes.admin_two.admin_two-sidebar')

        <!-- End Sidebar -->

        <div class="main-panel">
            @yield('content')
        </div>

    </div>

    <script>
        var mainbs = {
            "is_announcement": "1",
            "announcement_delay": "1.00",
            "overlay": null
        };
    </script>
    <!--   Core JS Files   -->
    <script src="{{ asset('assets/back/js/jquery.3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/back/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/back/js/bootstrap.min.js') }}"></script>

    <!-- jQuery UI -->
    <script src="{{ asset('assets/back/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('assets/back/js/jquery.ui.touch-punch.min.js') }}"></script>

    <!-- jQuery Scrollbar -->
    <script src="{{ asset('assets/back/js/jquery.scrollbar.min.js') }}"></script>

    <!-- Moment JS -->
    <script src="{{ asset('assets/back/js/moment.min.js') }}"></script>

    <!-- Datatables -->
    <script src="{{ asset('assets/back/js/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/back/js/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Bootstrap Notify -->
    <script src="{{ asset('assets/back/js/bootstrap-notify.min.js') }}"></script>

    <!-- Chartjs -->
    <script src="{{ asset('assets/back/js/chart.min.js') }}"></script>

    <!-- Editor -->
    <script src="{{ asset('assets/back/js/editor.js') }}"></script>
    <script src="{{ asset('assets/back/js/bootstrap-datetimepicker.min.js') }}"></script>

    <!-- Tagify -->
    <script src="{{ asset('assets/back/js/tagify.js') }}"></script>

    <!-- JS Color -->
    <script src="{{ asset('assets/back/js/jscolor.js') }}"></script>

    <!-- Magnific Popup -->
    <script src="{{ asset('assets/back/js/jquery.magnific-popup.min.js') }}"></script>

    <!-- Sortable -->
    <script src="{{ asset('assets/back/js/sortable.js') }}"></script>

    <!-- Icon Picker -->
    <script src="{{ asset('assets/back/js/bootstrap-iconpicker.bundle.min.js') }}"></script>

    <!-- Azzara JS -->
    <script src="{{ asset('assets/back/js/ready.min.js') }}"></script>

    <script src="{{ asset('assets/back/js/custom.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <!-- Load CKEditor -->
    <script src="https://cdn.ckeditor.com/4.22.1/standard-all/ckeditor.js"></script>



    <script>
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
    </script>
    <script>
        $(document).on('click', '.edit-option-value', function() {
            // Get data from the button
            let id = $(this).data('id');
            let nameEn = $(this).data('name-en');
            let nameAr = $(this).data('name-ar');
            let serial = $(this).data('serial');
            let image = $(this).data('image');
            console.log(id, nameEn, nameAr, serial, image);
            // Set data in modal fields
            $('#option-id').val(id);
            $('#option-name-en').val(nameEn);
            $('#option-name-ar').val(nameAr);
            $('#option-serial').val(serial);
            $('#image-preview').attr('src', image);
        });
        $('#exampleModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Button that triggered the modal

            // Extract info from data-* attributes
            var id = button.data('id');
            var nameEn = button.data('name-en');
            var nameAr = button.data('name-ar');
            var serial = button.data('serial');
            var image = button.data('image');

            // Update the modal fields
            var modal = $(this);
            modal.find('#option-id').val(id);
            modal.find('#option-name-en').val(nameEn);
            modal.find('#option-name-ar').val(nameAr);
            modal.find('#option-serial').val(serial);
            modal.find('#image-preview').attr('src', image);
        });
        $('#save-option-value').click(function() {
            const id = $('#option-id').val();
            const nameEn = $('#option-name-en').val();
            const nameAr = $('#option-name-ar').val();
            const serial = $('#option-serial').val();

            $.ajax({
                url: '/admin/option-value/update/' + id,
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    option_name_en: nameEn,
                    option_name_ar: nameAr,
                    serial: serial
                },
                success: function(response) {
                    toastr.success('Updated successfully!');
                    location.reload(); // or update the row dynamically
                },
                error: function(xhr) {
                    alert('Update failed');
                }
            });
        });
    </script>


    <!-- Bind meta title to URL -->
    <script>
        function bindMetaTitleToUrl(metaTitleSelector, metaUrlSelector) {
            // console.log('bindMetaTitleToUrl called');
            let manualEdit = false;

            $(metaUrlSelector).on('input', function() {
                manualEdit = true; // User started manual editing, stop auto-updating
            });

            $(metaTitleSelector).on('input', function() {
                if (manualEdit) return; // Don't override manual edits
                let text = $(this).val();

                // Convert to slug: lower case, replace spaces with dashes, remove special chars
                let slug = text.toLowerCase()
                    .trim()
                    .replace(/[^a-z0-9\s-]/g, '') // remove invalid chars
                    .replace(/\s+/g, '-') // replace spaces with dash
                    .replace(/-+/g, '-'); // collapse multiple dashes

                $(metaUrlSelector).val(slug);
            });
        }

        $(document).ready(function() {
            bindMetaTitleToUrl('#meta_title', '#meta_url');
        });
    </script>

    @if (session()->has('success'))
        <script>
            toastr["success"]("{{ session('success') }}")
        </script>
    @elseif (session()->has('error'))
        <script>
            toastr["error"]("{{ session('error') }}")
        </script>
    @endif
    @yield('scripts')
    @yield('footer')
</body>

</html>
