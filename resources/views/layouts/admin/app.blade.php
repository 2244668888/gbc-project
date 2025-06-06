<!DOCTYPE html>
    <?php
            $site_direction = session()->get('site_direction');
            $country=\App\Models\BusinessSetting::where('key','country')->first();
            $countryCode= strtolower($country?$country->value:'auto');
    ?>

<html dir="{{ $site_direction }}" lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="{{ $site_direction === 'rtl'?'active':'' }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Title -->
    <title>@yield('title')</title>
    <!-- Favicon -->
    @php($logo = \App\Models\BusinessSetting::where(['key' => 'icon'])->first()->value)
    <link rel="shortcut icon" href="">
    <link rel="icon" type="image/x-icon" href="{{ dynamicStorage('storage/app/public/business/' . $logo ?? '') }}">
    <!-- Font -->
    <link href="{{dynamicAsset('public/assets/admin/css/fonts.css')}}" rel="stylesheet">
    <!-- CSS Implementing Plugins -->
    <link rel="stylesheet" href="{{ dynamicAsset('public/assets/admin/css/vendor.min.css') }}">
    <link rel="stylesheet" href="{{ dynamicAsset('public/assets/admin/vendor/icon-set/style.css') }}">
    <link rel="stylesheet" href="{{ dynamicAsset('public/assets/admin/css/custom.css') }}">
    <!-- CSS Front Template -->
    <link  rel="stylesheet" href="{{dynamicAsset('/public/assets/admin/plugins/lightbox/css/lightbox.css')}}">

    <link rel="stylesheet" href="{{dynamicAsset('public/assets/admin/css/owl.min.css')}}">
    <link rel="stylesheet" href="{{ dynamicAsset('public/assets/admin/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ dynamicAsset('public/assets/admin/css/emojionearea.min.css') }}">
    <link rel="stylesheet" href="{{ dynamicAsset('public/assets/admin/css/theme.minc619.css?v=1.0') }}">
    <link rel="stylesheet" href="{{ dynamicAsset('public/assets/admin/css/style.css') }}">
    <link rel="stylesheet" href="{{dynamicAsset('public/assets/admin/intltelinput/css/intlTelInput.css')}}">
    @stack('css_or_js')
    <link rel="stylesheet" href="{{ dynamicAsset('public/assets/admin/css/toastr.css') }}">
</head>

<body class="footer-offset">

    @if(env('APP_MODE')=='demo')
    <div id="direction-toggle" class="direction-toggle">
        <i class="tio-settings"></i>
        <span></span>
    </div>
    @endif
    <div id="pre--loader" class="pre--loader">
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div id="loading" class="initial-hidden">
                    <div class="loading--1">
                        <img width="200" src="{{ dynamicAsset('public/assets/admin/img/loader.gif') }}">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Builder -->
    @include('layouts.admin.partials._front-settings')
    <!-- End Builder -->

    <!-- JS Preview mode only -->
    @include('layouts.admin.partials._header')
    @include('layouts.admin.partials._sidebar')
    <!-- END ONLY DEV -->

    <main id="content" role="main" class="main pointer-event">
        <!-- Content -->
        @yield('content')
        <!-- End Content -->

        <!-- Footer -->
        @include('layouts.admin.partials._footer')
        <!-- End Footer -->

        <div class="modal fade" id="popup-modal">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div  class="text-center">
                                    <h2 class="color-8a8a8a">
                                        <i class="tio-shopping-cart-outlined"></i> {{translate('messages.You_have_new_order_Check_Please.')}}
                                    </h2>
                                    <hr>
                                    <button class="btn btn-primary check-order">{{translate('messages.Ok_let_me_check')}}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="popup-modal-msg">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="text-center">
                                    <h2 class="color-8a8a8a">
                                        <i class="tio-messages"></i> {{ translate('messages.message_description') }}
                                    </h2>
                                    <hr>
                                    <button
                                        class="btn btn-primary check-message">{{ translate('messages.Ok_let_me_check') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="toggle-modal">
            <div class="modal-dialog status-warning-modal">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true" class="tio-clear"></span>
                        </button>
                    </div>
                    <div class="modal-body pb-5 pt-0">
                        <div class="max-349 mx-auto mb-20">
                            <div>
                                <div class="text-center">
                                    <img id="toggle-image" alt="" class="mb-20">
                                    <h5 class="modal-title" id="toggle-title"></h5>
                                </div>
                                <div class="text-center" id="toggle-message">
                                </div>
                            </div>
                            <div class="btn--container justify-content-center">
                                <button type="button" id="toggle-ok-button" class="btn btn--primary min-w-120 confirm-Toggle" data-dismiss="modal">{{translate('Ok')}}</button>
                                <button id="reset_btn" type="reset" class="btn btn--cancel min-w-120" data-dismiss="modal">
                                    {{translate("Cancel")}}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="toggle-status-modal">
            <div class="modal-dialog status-warning-modal">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true" class="tio-clear"></span>
                        </button>
                    </div>
                    <div class="modal-body pb-5 pt-0">
                        <div class="max-349 mx-auto mb-20">
                            <div>
                                <div class="text-center">
                                    <img id="toggle-status-image" alt="" class="mb-20">
                                    <h5 class="modal-title" id="toggle-status-title"></h5>
                                </div>
                                <div class="text-center" id="toggle-status-message">
                                </div>
                            </div>
                            <div class="btn--container justify-content-center">
                                <button type="button" id="toggle-status-ok-button" class="btn btn--primary min-w-120 confirm-Status-Toggle" data-dismiss="modal">{{translate('Ok')}}</button>
                                <button id="reset_btn" type="reset" class="btn btn--cancel min-w-120" data-dismiss="modal">
                                    {{translate("Cancel")}}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div class="modal fade" id="new-dynamic-submit-model">
            <div class="modal-dialog modal-dialog-centered status-warning-modal">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true" class="tio-clear"></span>
                        </button>
                    </div>
                    <div class="modal-body pb-5 pt-0">
                        <div class="max-349 mx-auto mb-20">
                            <div>
                                <div class="text-center">
                                    <img id="image-src" class="mb-20">
                                    <h5 class="modal-title" id="toggle-title"></h5>
                                </div>
                                <div class="text-center" id="toggle-message">
                                    <h3 id="modal-title"></h3>
                                    <div id="modal-text"></div>
                                </div>

                                </div>
                                <div class="mb-4 d-none" id="note-data">
                                    <textarea class="form-control" placeholder="{{ translate('your_note_here') }}" id="get-text-note" cols="5" ></textarea>
                                </div>
                            <div class="btn--container justify-content-center">
                                <div id="hide-buttons">
                                    <button data-dismiss="modal" id="cancel_btn_text" class="btn btn-outline-secondary min-w-120" >{{translate("Not_Now")}}</button> &nbsp;
                                    <button type="button" id="new-dynamic-ok-button" class="btn btn-outline-danger confirm-model min-w-120">{{translate('Yes')}}</button>
                                </div>

                                <button data-dismiss="modal"  type="button" id="new-dynamic-ok-button-show" class="btn btn--primary  d-none min-w-120">{{translate('Okay')}}</button>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </main>
    <!-- ========== END MAIN CONTENT ========== -->

   <!-- ========== END SECONDARY CONTENTS ========== -->
   <script src="{{ dynamicAsset('public/assets/admin/js/custom.js') }}"></script>
   <!-- JS Implementing Plugins -->
   <!-- The core Firebase JS SDK is always required and must be listed first -->
    <script src="{{dynamicAsset('public/assets/admin/js/jquery.min.js')}}"></script>

    <script>
            "use strict";
    setTimeout(hide_loader, 1000);
    function hide_loader(){
        $('#pre--loader').removeClass("pre--loader");;
    }

    </script>
    <script src="{{dynamicAsset('public/assets/admin/js/firebase.min.js')}}"></script>

   @stack('script')
   <!-- JS Front -->
   <script src="{{ dynamicAsset('public/assets/admin/vendor/hs-navbar-vertical-aside/hs-navbar-vertical-aside-mini-cache.js') }}"></script>
   <script src="{{ dynamicAsset('public/assets/admin/js/vendor.min.js') }}"></script>
   <script src="{{ dynamicAsset('public/assets/admin/js/theme.min.js') }}"></script>
   <script src="{{ dynamicAsset('public/assets/admin/js/sweet_alert.js') }}"></script>
   <script src="{{ dynamicAsset('public/assets/admin/js/toastr.js') }}"></script>
   <script src="{{dynamicAsset('public/assets/admin/js/owl.min.js')}}"></script>
   <script src="{{dynamicAsset('public/assets/admin/intltelinput/js/intlTelInput.min.js')}}"></script>

    <script src="{{ dynamicAsset('/public/assets/admin/plugins/lightbox/js/lightbox.min.js')}}"></script>

   <script>
    "use strict";

       $('.blinkings').on('mouseover', ()=> $('.blinkings').removeClass('active'))
       $('.blinkings').addClass('open-shadow')
       setTimeout(() => {
           $('.blinkings').removeClass('active')
       }, 10000);
       setTimeout(() => {
           $('.blinkings').removeClass('open-shadow')
       }, 5000);

       $(function(){
           var owl = $('.single-item-slider');
           owl.owlCarousel({
               autoplay: false,
               items:1,
               onInitialized  : counter,
               onTranslated : counter,
               autoHeight: true,
               dots: true,
               rtl: {{ $site_direction == 'rtl'  ?  "true"  : "false"}}
           });

           function counter(event) {
               var element   = event.target;         // DOM element, in this example .owl-carousel
                   var items     = event.item.count;     // Number of items
                   var item      = event.item.index + 1;     // Position of the current item

               // it loop is true then reset counter from 1
               if(item > items) {
                   item = item - items
               }
               $('.slide-counter').html(+item+"/"+items)
           }
       });
   </script>
    {!! Toastr::message() !!}

    @if ($errors->any())
        <script>
            "use strict";
            @foreach ($errors->all() as $error)
                toastr.error('{{ translate($error) }}', Error, {
                    CloseButton: true,
                    ProgressBar: true
                });
            @endforeach
        </script>
    @endif

    <script>
"use strict";
        $(document).on('ready', function(){
            $(".direction-toggle").on("click", function () {
                if($('html').hasClass('active')){
                    $('html').removeClass('active')
                    setDirection(1);
                }else {
                    setDirection(0);
                    $('html').addClass('active')
                }
            });
            if ($('html').attr('dir') == "rtl") {
                $(".direction-toggle").find('span').text('Toggle LTR')
            } else {
                $(".direction-toggle").find('span').text('Toggle RTL')
            }

            function setDirection(status) {
                if (status === 1) {
                    $("html").attr('dir', 'ltr');
                    $(".direction-toggle").find('span').text('Toggle RTL')
                } else {
                    $("html").attr('dir', 'rtl');
                    $(".direction-toggle").find('span').text('Toggle LTR')
                }
                $.get({
                        url: '{{ route('admin.business-settings.site_direction') }}',
                        dataType: 'json',
                        data: {
                            status: status,
                        },
                        success: function() {
                        },

                    });
                }
            });


        $(document).on('ready', function() {

            if (window.localStorage.getItem('hs-builder-popover') === null) {
                $('#builderPopover').popover('show')
                    .on('shown.bs.popover', function() {
                        $('.popover').last().addClass('popover-dark')
                    });

                $(document).on('click', '#closeBuilderPopover', function() {
                    window.localStorage.setItem('hs-builder-popover', true);
                    $('#builderPopover').popover('dispose');
                });
            } else {
                $('#builderPopover').on('show.bs.popover', function() {
                    return false
                });
            }

            // BUILDER TOGGLE INVOKER
            // =======================================================
            $('.js-navbar-vertical-aside-toggle-invoker').click(function() {
                $('.js-navbar-vertical-aside-toggle-invoker i').tooltip('hide');
            });


            // INITIALIZATION OF NAVBAR VERTICAL NAVIGATION
            // =======================================================
            var sidebar = $('.js-navbar-vertical-aside').hsSideNav();


            // INITIALIZATION OF TOOLTIP IN NAVBAR VERTICAL MENU
            // =======================================================
            $('.js-nav-tooltip-link').tooltip({
                boundary: 'window'
            })

            $(".js-nav-tooltip-link").on("show.bs.tooltip", function(e) {
                if (!$("body").hasClass("navbar-vertical-aside-mini-mode")) {
                    return false;
                }
            });


            // INITIALIZATION OF UNFOLD
            // =======================================================
            $('.js-hs-unfold-invoker').each(function() {
                var unfold = new HSUnfold($(this)).init();
            });


            // INITIALIZATION OF FORM SEARCH
            // =======================================================
            $('.js-form-search').each(function() {
                new HSFormSearch($(this)).init()
            });


            // INITIALIZATION OF SELECT2
            // =======================================================
            $('.js-select2-custom').each(function() {
                var select2 = $.HSCore.components.HSSelect2.init($(this));
            });


            // INITIALIZATION OF DATERANGEPICKER
            // =======================================================
            $('.js-daterangepicker').daterangepicker();

            $('.js-daterangepicker-times').daterangepicker({
                timePicker: true,
                startDate: moment().startOf('hour'),
                endDate: moment().startOf('hour').add(32, 'hour'),
                locale: {
                    format: 'M/DD hh:mm A'
                }
            });

            var start = moment();
            var end = moment();

            function cb(start, end) {
                $('#js-daterangepicker-predefined .js-daterangepicker-predefined-preview').html(start.format(
                    'MMM D') + ' - ' + end.format('MMM D, YYYY'));
            }

            $('#js-daterangepicker-predefined').daterangepicker({
                startDate: start,
                endDate: end,
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                        'month').endOf('month')]
                }
            }, cb);

            cb(start, end);


            // INITIALIZATION OF CLIPBOARD
            // =======================================================
            $('.js-clipboard').each(function() {
                var clipboard = $.HSCore.components.HSClipboard.init(this);
            });
        });
    </script>

    @stack('script_2')
    <script>
        "use strict";
        let baseUrl = '{{ url('/') }}';
    </script>
    <script src="{{dynamicAsset('public/assets/admin/js/view-pages/common.js')}}"></script>
    <audio id="myAudio">
        <source src="{{ dynamicAsset('public/assets/admin/sound/notification.mp3') }}" type="audio/mpeg">
    </audio>

    <script>
        "use strict";
        var audio = document.getElementById("myAudio");

        function playAudio() {
            audio.play();
        }

        function pauseAudio() {
            audio.pause();
        }

        $('.route-alert').on('click',function () {
            let route = $(this).data('url')
            let message = $(this).data('message')
            let title = $(this).data('title')
            let processing = $(this).data('processing')
            route_alert(route, message, title, processing);
        })
        function route_alert(route, message, title = "{{ translate('messages.are_you_sure') }}", processing = false) {
            if (processing) {
                Swal.fire({
                    title: title,
                    type: 'warning',
                    showCancelButton: true,
                    cancelButtonColor: 'default',
                    confirmButtonColor: '#FC6A57',
                    cancelButtonText: "{{ translate('messages.Cancel') }}",
                    confirmButtonText: "{{ translate('messages.Submit') }}",
                    inputPlaceholder: "{{ translate('messages.Enter_processing_time') }}",
                    input: 'text',
                    html: message + '<br/>' + '<label>{{ translate('messages.Enter_Processing_time_in_minutes') }}</label>',
                    inputValue: processing,
                    preConfirm: (processing_time) => {
                        location.href = route + '&processing_time=' + processing_time;
                    },
                    allowOutsideClick: () => !Swal.isLoading()
                })
            } else {
                Swal.fire({
                    title: title,
                    text: message,
                    type: 'warning',
                    showCancelButton: true,
                    cancelButtonColor: 'default',
                    confirmButtonColor: '#FC6A57',
                    cancelButtonText: '{{ translate('messages.No') }}',
                    confirmButtonText: '{{ translate('messages.Yes') }}',
                    reverseButtons: true
                }).then((result) => {
                    if (result.value) {
                        location.href = route;
                    }
                })

            }

        }

        $('.form-alert').on('click',function (){
            let id = $(this).data('id')
            let message = $(this).data('message')
            Swal.fire({
                title: '{{ translate('messages.Are you sure?') }}',
                text: message,
                type: 'warning',
                showCancelButton: true,
                cancelButtonColor: 'default',
                confirmButtonColor: '#FC6A57',
                cancelButtonText: '{{ translate('messages.no') }}',
                confirmButtonText: '{{ translate('messages.Yes') }}',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    $('#'+id).submit()
                }
            })
        })

        @php($fcm_credentials = \App\CentralLogics\Helpers::get_business_settings('fcm_credentials'))
        var firebaseConfig = {
            apiKey: "{{isset($fcm_credentials['apiKey']) ? $fcm_credentials['apiKey'] : ''}}",
            authDomain: "{{isset($fcm_credentials['authDomain']) ? $fcm_credentials['authDomain'] : ''}}",
            projectId: "{{isset($fcm_credentials['projectId']) ? $fcm_credentials['projectId'] : ''}}",
            storageBucket: "{{isset($fcm_credentials['storageBucket']) ? $fcm_credentials['storageBucket'] : ''}}",
            messagingSenderId: "{{isset($fcm_credentials['messagingSenderId']) ? $fcm_credentials['messagingSenderId'] : ''}}",
            appId: "{{isset($fcm_credentials['appId']) ? $fcm_credentials['appId'] : ''}}",
            measurementId: "{{isset($fcm_credentials['measurementId']) ? $fcm_credentials['measurementId'] : ''}}"
        };
        firebase.initializeApp(firebaseConfig);
        const messaging = firebase.messaging();

        function startFCM() {
            messaging
                .requestPermission()
                .then(function() {
                    return messaging.getToken();
                })
                .then(function(token) {
                    // console.log('FCM Token:', token);
                    // Send the token to your backend to subscribe to topic
                    subscribeTokenToBackend(token, 'admin_message');
                }).catch(function(error) {
                console.error('Error getting permission or token:', error);
            });
        }

        function subscribeTokenToBackend(token, topic) {
            fetch('{{url('/')}}/subscribeToTopic', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ token: token, topic: topic })
            }).then(response => {
                if (response.status < 200 || response.status >= 400) {
                    return response.text().then(text => {
                        throw new Error(`Error subscribing to topic: ${response.status} - ${text}`);
                    });
                }
                console.log(`Subscribed to "${topic}"`);
            }).catch(error => {
                console.error('Subscription error:', error);
            });
        }

        {{--function startFCM() {--}}

        {{--    messaging--}}
        {{--        .requestPermission()--}}
        {{--        .then(function() {--}}
        {{--            return messaging.getToken()--}}
        {{--        })--}}
        {{--        .then(function(response) {--}}
        {{--            subscribeTokenToTopic(response, 'admin_message');--}}
        {{--            console.log('subscribed');--}}
        {{--        }).catch(function(error) {--}}
        {{--            console.log(error);--}}
        {{--        });--}}
        {{--}--}}
        {{--@php($key = \App\Models\BusinessSetting::where('key', 'push_notification_key')->first())--}}

        {{--function subscribeTokenToTopic(token, topic) {--}}
        {{--    fetch('https://iid.googleapis.com/iid/v1/' + token + '/rel/topics/' + topic, {--}}
        {{--        method: 'POST',--}}
        {{--        headers: new Headers({--}}
        {{--            'Authorization': 'key={{ $key ? $key->value : '' }}'--}}
        {{--        })--}}
        {{--    }).then(response => {--}}
        {{--        if (response.status < 200 || response.status >= 400) {--}}
        {{--            throw 'Error subscribing to topic: ' + response.status + ' - ' + response.text();--}}
        {{--        }--}}
        {{--        console.log('Subscribed to "' + topic + '"');--}}
        {{--    }).catch(error => {--}}
        {{--        console.error(error);--}}
        {{--    })--}}
        {{--}--}}

        function getUrlParameter(sParam) {
            var sPageURL = window.location.search.substring(1);
            var sURLVariables = sPageURL.split('&');
            for (var i = 0; i < sURLVariables.length; i++) {
                var sParameterName = sURLVariables[i].split('=');
                if (sParameterName[0] == sParam) {
                    return sParameterName[1];
                }
            }
        }

        function conversationList() {
            var tab = getUrlParameter('tab');
            console.log(tab)
            $.ajax({
                    url: "{{ route('admin.message.list') }}"+ '?tab=' + tab,
                    success: function(data) {
                        $('#conversation-list').empty();
                        $("#conversation-list").append(data.html);
                        var user_id = getUrlParameter('user');
                    $('.customer-list').removeClass('conv-active');
                    $('#customer-' + user_id).addClass('conv-active');
                    }
                })
        }

        function conversationView() {
            var conversation_id = getUrlParameter('conversation');
            var user_id = getUrlParameter('user');
            var url= '{{url('/')}}/admin/message/view/'+conversation_id+'/' + user_id;
            $.ajax({
                url: url,
                success: function(data) {
                    $('#view-conversation').html(data.view);
                }
            })
        }

        function vendorConversationView() {
            var conversation_id = getUrlParameter('conversation');
            var user_id = getUrlParameter('user');
            var url= '{{url('/')}}/admin/restaurant/message/'+conversation_id+'/' + user_id;
            $.ajax({
                url: url,
                success: function(data) {
                    $('#vendor-view-conversation').html(data.view);
                }
            })
        }

        function dmConversationView() {
            var conversation_id = getUrlParameter('conversation');
            var user_id = getUrlParameter('user');
            var url= '{{url('/')}}/admin/delivery-man/message/'+conversation_id+'/' + user_id;
            $.ajax({
                url: url,
                success: function(data) {
                    $('#dm-view-conversation').html(data.view);
                }
            })
        }
    @php($order_notification_type = \App\Models\BusinessSetting::where('key', 'order_notification_type')->first())
    @php($order_notification_type = $order_notification_type ? $order_notification_type->value : 'firebase')
        var new_order_type='restaurant_order';
        messaging.onMessage(function(payload) {
            console.log(payload.data);
            if(payload.data.order_id && payload.data.type == "order_request"){
                @php($admin_order_notification = \App\Models\BusinessSetting::where('key', 'admin_order_notification')->first())
                @php($admin_order_notification = $admin_order_notification ? $admin_order_notification->value : 0)
                @if (\App\CentralLogics\Helpers::module_permission_check('order') && $admin_order_notification && $order_notification_type == 'firebase')
                new_order_type = payload.data.order_type
                playAudio();
                $('#popup-modal').appendTo("body").modal('show');
                @endif

            }else if(payload.data.type == 'message'){
                var conversation_id = getUrlParameter('conversation');
                var user_id = getUrlParameter('user');
                var url= '{{url('/')}}/admin/message/view/'+conversation_id+'/' + user_id;
                console.log(url);
                $.ajax({
                    url: url,
                    success: function(data) {
                        $('#view-conversation').html(data.view);
                    }
                })
                toastr.success('{{ translate('New_message_arrived') }}', {
                    CloseButton: true,
                    ProgressBar: true
                });

                if($('#conversation-list').scrollTop() == 0){
                    conversationList();
                }
            }
        });

        @if(\App\CentralLogics\Helpers::module_permission_check('order') && $order_notification_type == 'manual')
            @php($admin_order_notification=\App\Models\BusinessSetting::where('key','admin_order_notification')->first())
            @php($admin_order_notification=$admin_order_notification?$admin_order_notification->value:0)
                @if($admin_order_notification)
                setInterval(function () {
                    $.get({
                        url: '{{route('admin.get-restaurant-data')}}',
                        dataType: 'json',
                        success: function (response) {
                            let data = response.data;
                            new_order_type = data.type;
                            if (data.new_order > 0) {
                                playAudio();
                                $('#popup-modal').appendTo("body").modal('show');
                            }
                        },
                    });
                }, 10000);
                @endif
        @endif

        startFCM();
        conversationList();

        if(getUrlParameter('conversation')){
            conversationView();
            vendorConversationView();
            dmConversationView();
        }

        $(document).on('click', '.call-demo', function () {
            @if(env('APP_MODE') =='demo')
            toastr.info('{{ translate('Update option is disabled for demo!') }}', {
                CloseButton: true,
                ProgressBar: true
            });
            @endif
        });
        $(document).on('click', '.check-order', function () {
            location.href = '{{ route('admin.order.list', ['status' => 'all']) }}';
        });
        $(document).on('click', '.check-message', function () {
            var tab = getUrlParameter('tab');
            location.href = '{{ route('admin.message.list') }}'+ '?tab=' + tab;
        });

        if (/MSIE \d|Trident.*rv:/.test(navigator.userAgent)) document.write(
            '<script src="{{ dynamicAsset('public/assets/admin') }}/vendor/babel-polyfill/polyfill.min.js"><\/script>');

        $(window).on('load', ()=> $('.pre--loader').fadeOut(600))

        $('.log-out').on('click',function (){
                Swal.fire({
                title: '{{ translate('Do_You_Want_To_Sign_Out_?')}}',
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonColor: '#FC6A57',
                cancelButtonColor: '#363636',
                confirmButtonText: `{{ translate('yes')}}`,
                cancelButtonText: `{{ translate('cancel')}}`,
                }).then((result) => {
                if (result.value) {
                location.href='{{route('logout')}}';
                } else{
                Swal.fire('{{ translate('messages.canceled') }}', '', 'info')
                }
                })
            });


            const inputs = document.querySelectorAll('input[type="tel"]');
            inputs.forEach(input => {
                window.intlTelInput(input, {
                    initialCountry: "{{$countryCode}}",
                    utilsScript: "{{ dynamicAsset('public/assets/admin/intltelinput/js/utils.js') }}",
                    autoInsertDialCode: true,
                    nationalMode: false,
                    formatOnDisplay: false,
                    strictMode: true,
                    // allowDropdown: false,
                    @if (\App\Models\BusinessSetting::where('key', 'country_picker_status')->first()->value  != 1)
                    onlyCountries: ["{{$countryCode}}"],
                    @endif
                });
            });


            function keepNumbersAndPlus(inputString) {
                let regex = /[0-9+]/g;
                let filteredString = inputString.match(regex);
            return filteredString ? filteredString.join('') : '';
            }

            $(document).on('keyup', 'input[type="tel"]', function () {
                $(this).val(keepNumbersAndPlus($(this).val()));
                });



    </script>

</body>

</html>
