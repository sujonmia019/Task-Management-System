<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - {{ config('app.name') }}</title>
    {{-- Datatable --}}
    <link rel="stylesheet" href="{{ asset('/') }}css/dataTables.bootstrap5.css" >
    <link rel="stylesheet" href="{{ asset('/') }}css/responsive.bootstrap5.css">
    <link rel="stylesheet" href="{{ asset('/') }}css/daterangepicker.css" />
    <link rel="stylesheet" href="{{ asset('/') }}css/all.min.css">
    <link rel="stylesheet" href="{{ asset('/') }}css/flatpickr.min.css">
    <link rel="stylesheet" href="{{ asset('/') }}css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('/') }}css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('/') }}css/style.css">
    <style>
         small {
            font-size: 13px;
        }

        input::placeholder {
            font-size: 13px;
            font-weight: 400;
        }
        input:-ms-input-placeholder {
            font-size: 13px;
            font-weight: 400;
        }
        input::-ms-input-placeholder {
            font-size: 13px;
            font-weight: 400;
        }
        input::-webkit-input-placeholder {
            font-size: 13px;
            font-weight: 400;
        }
        input::-moz-placeholder {
            font-size: 13px;
            font-weight: 400;
        }
        input:-moz-placeholder {
            font-size: 13px;
            font-weight: 400;
        }
        label{
            font-size: 13px;
            color: #000000;
            font-weight: 400;
        }
        .required::after{
            content: '*';
            color: red;
        }
    </style>
    @stack('styles')
</head>
<body>
    {{-- Header --}}
    @include('include.header')

    {{-- Main Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('include.footer')


    <script src="{{ asset('/') }}js/jquery.min.js"></script>
    <script src="{{ asset('/') }}js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('/') }}js/flatpickr.min.js"></script>
    <script src="{{ asset('/') }}js/select2.min.js"></script>
    <script src="{{ asset('/') }}js/dataTables.js"></script>
    <script src="{{ asset('/') }}js/dataTables.bootstrap5.js"></script>
    <script src="{{ asset('/') }}js/dataTables.responsive.js"></script>
    <script src="{{ asset('/') }}js/responsive.bootstrap5.js"></script>
    <script src="{{ asset('/') }}js/moment.min.js"></script>
    <script src="{{ asset('/') }}js/daterangepicker.min.js"></script>

    <script>
        var _token = "{{ csrf_token() }}";

        $(".datetime").flatpickr({
            enableTime: true,
            noCalendar: false,
            time_24hr: true,
        });

    </script>
    @stack('scripts')
</body>
</html>
