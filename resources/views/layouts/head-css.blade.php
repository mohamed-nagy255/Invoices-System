        <!-- Simple bar CSS -->
        <link rel="stylesheet" href="{{ asset('assets/css/simplebar.css') }}">
        <!-- Fonts CSS -->
        <link
            href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap"
            rel="stylesheet">
        <!-- Icons CSS -->
        <link rel="stylesheet" href="{{ asset('assets/css/feather.css') }}">
        {{-- <link rel="stylesheet" href="{{ asset('assets/css/select2.css') }}"> --}}
        {{-- <link rel="stylesheet" href="{{ asset('assets/css/dropzone.css') }}"> --}}
        {{-- <link rel="stylesheet" href="{{ asset('assets/css/uppy.min.css') }}"> --}}
        {{-- <link rel="stylesheet" href="{{ asset('assets/css/jquery.steps.css') }}"> --}}
        {{-- <link rel="stylesheet" href="{{ asset('assets/css/jquery.timepicker.css') }}"> --}}
        {{-- <link rel="stylesheet" href="{{ asset('assets/css/quill.snow.css') }}"> --}}
        <!-- Date Range Picker CSS -->
        {{-- <link rel="stylesheet" href="{{ asset('assets/css/daterangepicker.css') }}"> --}}
        <!-- App CSS -->
        <link rel="stylesheet" href="{{ asset('assets/css/app-light.css') }}" id="lightTheme">
        <link rel="stylesheet" href="{{ asset('assets/css/app-dark.css') }}" id="darkTheme" disabled>
        <style>
            /* width */
            ::-webkit-scrollbar {
            width: 3px;
            }

            /* Track */
            ::-webkit-scrollbar-track {
            box-shadow: inset 0 0 5px rgba(255, 255, 255, 0); 
            border-radius: 10px;
            }
            
            /* Handle */
            ::-webkit-scrollbar-thumb {
            background: #1b68ff; 
            border-radius: 10px;
            }

            /* Handle on hover */
            ::-webkit-scrollbar-thumb:hover {
            background: #1b67ff98; 
            }
        </style>
        @yield('css')
