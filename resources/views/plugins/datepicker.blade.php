@push('links')
    <link rel="stylesheet" type="text/css" href="{{ asset('template-default/app-assets/vendors/css/pickers/pickadate/pickadate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template-default/app-assets/vendors/css/pickers/daterange/daterangepicker.css') }}">
@endpush

@push('src-scripts')
    <script src="{{ asset('template-default/app-assets/vendors/js/pickers/pickadate/picker.js') }}"></script>
    <script src="{{ asset('template-default/app-assets/vendors/js/pickers/pickadate/picker.date.js') }}"></script>
    <script src="{{ asset('template-default/app-assets/vendors/js/pickers/pickadate/picker.time.js') }}"></script>
    <script src="{{ asset('template-default/app-assets/vendors/js/pickers/pickadate/legacy.js') }}"></script>
    <script src="{{ asset('template-default/app-assets/vendors/js/pickers/daterange/moment.min.js') }}"></script>
    <script src="{{ asset('template-default/app-assets/vendors/js/pickers/daterange/daterangepicker.js') }}"></script>
@endpush