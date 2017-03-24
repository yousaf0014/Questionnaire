<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Questionnaire Test') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" media="screen" href="{{asset('css/bootstrap_admin.min.css?v=1')}}" />
    <link rel="stylesheet" media="screen" href="{{asset('css/admin_style.css?v=1')}}" />
    <link rel="stylesheet" media="screen" href="{{asset('css/jquery-ui.css?v=1')}}" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    @yield('css')

    <script type="text/javascript" src="{{asset('js/jquery-1.10.2.min.js?v=1')}}"></script>
    <script type="text/javascript" src="{{asset('js/common.js?v=1')}}"></script>
    <script type="text/javascript" src="{{asset('js/jquery.bootstrap.min.js?v=1')}}"></script>

    <!-- Scripts -->
    <script>
        window.Laravel = "{{url('/home')}}"; 
    </script>
</head>
    <body>
        <meta name="_token" content="{!! csrf_token() !!}"/>
        <div class="clearfix"></div>
            <div id="container">
                <div id="header">            
                    @include('layouts.admin.header')
                </div>

                @if (Route::has('login'))
                    <div class="clearfix"></div>
                    <div id="top_nav">                
                        @include('layouts.admin.topnav')
                    </div>
                @endif


                <div class="clearfix"></div>
                <div id="content">
                    @include('layouts.admin.flashmessage')
                    @yield('content');
                </div>
                <div class="clearfix"></div>
                <div id="footer">
                    @include('layouts.admin.footer')
                </div>
            </div>            
        </div>
        @yield('scripts')
        <script type="text/javascript">
            
            hideModal = function(selector) {
                jQuery(selector).modal('hide');
            }
            jQuery("body").on("hidden.bs.modal", ".modal", function() {
                $(this).removeData("bs.modal");
            });
            jQuery(document).ajaxStart(function() {
                jQuery("#overlay").fadeIn();
            }).ajaxStop(function() {
                jQuery("#overlay").fadeOut();
            });
        </script>    
            
    </body>
</html>