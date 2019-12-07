@push('links')
    <link rel="stylesheet" type="text/css" href="{{ asset('template-default/app-assets/vendors/css/tables/datatable/datatables.min.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('template-default/app-assets/vendors/js/tables/datatable/datatables.min.js') }}"></script>
    <script src="{{ asset('template-default/app-assets/vendors/js/tables/datatable/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('template-default/app-assets/vendors/js/tables/datatable/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('template-default/app-assets/vendors/js/tables/datatable/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('template-default/app-assets/vendors/js/tables/datatable/buttons.print.min.js') }}"></script>
    <script src="{{ asset('template-default/app-assets/vendors/js/tables/datatable/buttons.bootstrap.min.js') }}"></script>
    <script src="{{ asset('template-default/app-assets/vendors/js/tables/datatable/pdfmake.min.js') }}"></script>
    <script src="{{ asset('template-default/app-assets/vendors/js/tables/datatable/vfs_fonts.js') }}"></script>
    <script>
        var defaultLang = {
            processing: '<img src="https://loading.io/spinners/balls/index.circle-slack-loading-icon.gif"> Memuat data',
            paginate: {
                next: 'Selanjutnya',
                previous: 'Sebelumnya'
            },
            lengthMenu: "Menampilkan _MENU_ baris",
            search: 'Cari:',
            info: 'Menampilkan _START_ ke _END_ dari _TOTAL_ baris',
        };
    </script>    
@endpush