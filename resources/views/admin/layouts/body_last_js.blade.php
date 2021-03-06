<script src="{{ asset('backend/js/vendors.min.js')}}"></script>
<script src="{{ asset('assets/icons/feather-icons/feather.min.js')}}"></script>
<script src="{{ asset('assets/vendor_components/easypiechart/dist/jquery.easypiechart.js')}}"></script>
<script src="{{ asset('assets/vendor_components/apexcharts-bundle/irregular-data-series.js')}}"></script>
<script src="{{ asset('assets/vendor_components/apexcharts-bundle/dist/apexcharts.js')}}"></script>

<!-- Sunny Admin App -->
<script src="{{ asset('backend/js/template.js')}}"></script>
<script src="{{ asset('backend/js/pages/dashboard.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<!-- Include a polyfill for ES6 Promises (optional) for IE11 and Android browser -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    @if(Session::has('message'))
        var type = "{{ Session::get('alert-type','info') }}"
        switch(type){
            case 'info':
            toastr.info(" {{ Session::get('message') }} ");
            break;

            case 'success':
            toastr.success(" {{ Session::get('message') }} ");
            break;

            case 'warning':
            toastr.warning(" {{ Session::get('message') }} ");
            break;

            case 'error':
            toastr.error(" {{ Session::get('message') }} ");
            break;
        }
    @endif
</script>
