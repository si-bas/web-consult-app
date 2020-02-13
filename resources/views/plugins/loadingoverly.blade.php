@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.6/dist/loadingoverlay.min.js"></script>

<script>
    $.LoadingOverlaySetup({
        image: "{{ asset('img/loading.gif') }}",
        imageAnimation: null,
        imageAutoResize: true,
        imageResizeFactor: 1
    });

</script>
@endpush