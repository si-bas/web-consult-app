<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>{{ config('app.name') }}</title>
    
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,600%7CIBM+Plex+Sans:300,400,500,600,700" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('template-default/app-assets/vendors/css/vendors.min.css') }}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('template-default/app-assets/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template-default/app-assets/css/bootstrap-extended.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template-default/app-assets/css/colors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template-default/app-assets/css/components.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template-default/app-assets/css/themes/dark-layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template-default/app-assets/css/themes/semi-dark-layout.css') }}">
    <!-- END: Theme CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('template-default/app-assets/css/core/menu/menu-types/vertical-menu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template-default/app-assets/css/pages/app-chat.css') }}">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('template-default/assets/css/style.css') }}">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern semi-dark-layout content-left-sidebar chat-application navbar-sticky footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="content-left-sidebar" data-layout="semi-dark-layout" onload="startTime()">

    <!-- BEGIN: Header-->
    @include('layouts.template-default.header')
    <!-- END: Header-->


    <!-- BEGIN: Main Menu-->
    @include('layouts.template-default.menu')
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-area-wrapper">
            <div class="sidebar-left">
                <div class="sidebar">
                    <!-- app chat user profile left sidebar start -->
                    <div class="chat-user-profile">
                        <header class="chat-user-profile-header text-center border-bottom">
                            <span class="chat-profile-close">
                                <i class="bx bx-x"></i>
                            </span>
                            <div class="my-2">
                                <div class="avatar">
                                    <img src="{{ asset('img/user.png') }}" alt="user_avatar" height="100" width="100">
                                </div>
                                <h5 class="mb-0">{{ $user->student->full_name }}</h5>
                                <span>Mahasiswa</span>
                            </div>
                        </header>
                        <div class="chat-user-profile-content">
                            <div class="chat-user-profile-scroll">
                                <h6>INFROMASI PERSONAL</h6>
                                <ul class="list-unstyled mb-2">
                                    <li class="mb-25">{{ $user->email }}</li>
                                    <li class="mb-25">{{ $user->student->student_id_number }}</li>
                                    <li>{{ $user->student->major->faculty->name }} / {{ $user->student->major->name }} / {{ $user->student->profile->classroom }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- app chat user profile left sidebar ends -->
                    <!-- app chat sidebar start -->
                    <div class="chat-sidebar card">
                        <span class="chat-sidebar-close">
                            <i class="bx bx-x"></i>
                        </span>
                        <div class="chat-sidebar-search">
                            <div class="d-flex align-items-center">
                                <div class="chat-sidebar-profile-toggle">
                                    <div class="avatar">
                                        <img src="{{ asset('img/user.png') }}" alt="user_avatar" height="36" width="36">
                                    </div>
                                </div>
                                <fieldset class="form-group position-relative has-icon-left mx-75 mb-0">
                                    <input type="text" class="form-control round" id="chat-search" placeholder="Search">
                                    <div class="form-control-position">
                                        <i class="bx bx-search-alt text-dark"></i>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                        <div class="chat-sidebar-list-wrapper pt-2">
                            <div class="d-flex align-items-center" style="padding: 0.8rem 1.5rem;" >
                                <a href="{{ route('consult.student.data.lecturer') }}" class="btn btn-primary mr-1 mb-1">
                                    <i class="bx bx-chat"></i> Mulai Konsultasi
                                </a>
                            </div>
                            <h6 class="px-2 pt-1 pb-25 mb-0">KONSULTASI</h6>
                            <ul class="chat-sidebar-list">
                                @foreach ($consults->where('is_done', false) as $item)
                                <li id="consult-{{ $item->id }}" data-id="{{ $item->id }}">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar m-0 mr-50"><img src="{{ asset('img/user.png') }}" height="36" width="36" alt="sidebar user image">
                                            <span class="avatar-status-online"></span>
                                        </div>
                                        <div class="chat-sidebar-name">
                                            <h6 class="mb-0">{{ $item->lecturer->full_name }}</h6><span class="text-muted">{{ $item->schedule->day->name }}, {{ $item->schedule->start_time }} - {{ $item->schedule->end_time }}</span>
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                            <h6 class="px-2 pt-2 pb-25 mb-0">KONSULTASI - SELESAI</h6>
                            <ul class="chat-sidebar-list">
                                
                            </ul>
                        </div>
                    </div>
                    <!-- app chat sidebar ends -->
                </div>
            </div>
            <div class="content-right">
                <div class="content-overlay"></div>
                <div class="content-wrapper">
                    <div class="content-header row">
                    </div>
                    <div class="content-body">
                        <!-- app chat overlay -->
                        <div class="chat-overlay"></div>
                        <!-- app chat window start -->
                        <section class="chat-window-wrapper">
                            <div class="chat-start">
                                <span class="bx bx-message chat-sidebar-toggle chat-start-icon font-large-3 p-3 mb-1"></span>
                                <h4 class="d-none d-lg-block py-50 text-bold-500">Mulai konsultasi</h4>
                                <button class="btn btn-light-primary chat-start-text chat-sidebar-toggle d-block d-lg-none py-50 px-1">Mulai Konsultasi</button>
                            </div>
                            <div class="chat-area d-none">
                                
                            </div>
                        </section>
                        <!-- app chat window ends -->
                        <!-- app chat profile right sidebar start -->
                        <section class="chat-profile">
                            
                        </section>
                        <!-- app chat profile right sidebar ends -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Content-->

    <!-- demo chat-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

   <!-- BEGIN: Footer-->
   @include('layouts.template-default.footer')
   <!-- END: Footer-->

   <script>
       const APP_URL = "{{ url('/') }}";
   </script>


    <!-- BEGIN: Vendor JS-->
    <script src="{{ asset('template-default/app-assets/vendors/js/vendors.min.js') }}"></script>
    <script src="{{ asset('template-default/app-assets/fonts/LivIconsEvo/js/LivIconsEvo.tools.js') }}"></script>
    <script src="{{ asset('template-default/app-assets/fonts/LivIconsEvo/js/LivIconsEvo.defaults.js') }}"></script>
    <script src="{{ asset('template-default/app-assets/fonts/LivIconsEvo/js/LivIconsEvo.min.js') }}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('template-default/app-assets/js/scripts/configs/vertical-menu-dark.js') }}"></script>
    <script src="{{ asset('template-default/app-assets/js/core/app-menu.js') }}"></script>
    <script src="{{ asset('template-default/app-assets/js/core/app.js') }}"></script>
    <script src="{{ asset('template-default/app-assets/js/scripts/components.js') }}"></script>
    <script src="{{ asset('template-default/app-assets/js/scripts/footer.js') }}"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script>
        var chatSidebarListWrapper = $(".chat-sidebar-list-wrapper"),
            chatOverlay = $(".chat-overlay"),
            chatContainer = $(".chat-container"),
            chatSidebarProfileToggle = $(".chat-sidebar-profile-toggle"),
            chatProfileToggle = $(".chat-profile-toggle"),
            chatSidebarClose = $(".chat-sidebar-close"),
            chatProfile = $(".chat-profile"),
            chatUserProfile = $(".chat-user-profile"),
            chatProfileClose = $(".chat-profile-close"),
            chatSidebar = $(".chat-sidebar"),
            chatArea = $(".chat-area"),
            chatStart = $(".chat-start"),
            chatSidebarToggle = $(".chat-sidebar-toggle"),
            chatMessageSend = $(".chat-message-send");

        var current_chat_id;

        $(document).ready(function () {
            "use strict";

            // menu user list perfect scrollbar initialization
            if (chatSidebarListWrapper.length > 0) {
                var menu_user_list = new PerfectScrollbar(".chat-sidebar-list-wrapper");
            }
            
            // Add class active on click of Chat users list
            $(".chat-sidebar-list-wrapper ul li").on("click", function () {
                if ($(".chat-sidebar-list-wrapper ul li").hasClass("active")) {
                    $(".chat-sidebar-list-wrapper ul li").removeClass("active");
                }

                var element_li = this;

                $.get("{{ route('consult.student.get.messages') }}", {
                    id: $(this).data('id')
                }).done(function (result) {
                    current_chat_id = $(element_li).data('id');

                    chatArea.html(result);

                    chatOverlay = $(".chat-overlay");
                    chatContainer = $(".chat-container");
                    chatSidebarProfileToggle = $(".chat-sidebar-profile-toggle");
                    chatProfileToggle = $(".chat-profile-toggle");
                    chatSidebarClose = $(".chat-sidebar-close");
                    chatProfile = $(".chat-profile");
                    chatUserProfile = $(".chat-user-profile");
                    chatProfileClose = $(".chat-profile-close");
                    chatSidebar = $(".chat-sidebar");
                    chatArea = $(".chat-area");
                    chatStart = $(".chat-start");
                    chatSidebarToggle = $(".chat-sidebar-toggle");
                    chatMessageSend = $(".chat-message-send");

                    defineChat();

                    $(element_li).addClass("active");
                    if ($(".chat-sidebar-list-wrapper ul li").hasClass("active")) {
                        chatStart.addClass("d-none");
                        chatArea.removeClass("d-none");
                    } else {
                        chatStart.removeClass("d-none");
                        chatArea.addClass("d-none");
                    }

                    // autoscroll to bottom of Chat area
                    chatContainer.animate({
                        scrollTop: chatContainer[0].scrollHeight
                    }, 400);
                });
            });

            var queryDict = {}
            location.search.substr(1).split("&").forEach(function (item) {
                $('#'+item.replace(/=/g, "-")).click()
            });
        });
        // Add message to chat
        function chatMessagesSend(source) {
            var currentdate = new Date();
            var date = currentdate.getDate() + "/" +
                (currentdate.getMonth() + 1) + "/" +
                currentdate.getFullYear() + " @ " +
                currentdate.getHours() + ":" +
                currentdate.getMinutes();
            
            var datetime = currentdate.getFullYear() + "-" + (currentdate.getMonth() + 1) + "-" + currentdate.getDate() + " " + currentdate.getHours() + ":" + currentdate.getMinutes() + ":" + currentdate.getSeconds();

            var message = chatMessageSend.val();
            if (message != "") {
                var html = '<div class="chat-message">' + "<p>"  + message + "</p>" + "<div class=" + "chat-time" + ">"+date+"</div></div>";
                // if ($(".chat-wrapper .chat:last-child").hasClass('chat-left') || $('.chat').length == 0) {
                    var new_chat = `<div class="chat">
                                            <div class="chat-avatar">
                                                <a class="avatar m-0">
                                                    <img src="{{ asset('img/user.png') }}" alt="avatar" height="36" width="36">
                                                </a>
                                            </div>
                                            <div class="chat-body">
                                                ${html}
                                            </div>
                                    </div>`;
                    $(".chat-wrapper .chat-content").append(new_chat);
                // } else {
                //     $(".chat-wrapper .chat:last-child .chat-body").append(html);                    
                // }

                chatMessageSend.val("");
                chatContainer.scrollTop($(".chat-container > .chat-content").height());
            }

            $.post("{{ route('consult.student.save.messages.submit') }}", {
                _token: "{{ csrf_token() }}",
                id: current_chat_id,
                message: message,
                created_at: datetime
            });
        }

        function defineChat() {
            // user profile sidebar perfect scrollbar initialization
            if ($(".chat-user-profile-scroll").length > 0) {
                var profile_sidebar_scroll = new PerfectScrollbar(".chat-user-profile-scroll");
            }
            // chat area perfect scrollbar initialization
            if (chatContainer.length > 0) {
                var chat_user_user = new PerfectScrollbar(".chat-container");
            }
            if ($(".chat-profile-content").length > 0) {
                var chat_profile_content = new PerfectScrollbar(".chat-profile-content");
            }
            // user profile sidebar toggle
            chatSidebarProfileToggle.on("click", function () {
                chatUserProfile.addClass("show");
                chatOverlay.addClass("show");
            });
            // user profile sidebar toggle
            chatProfileToggle.on("click", function () {
                chatProfile.addClass("show");
                chatOverlay.addClass("show");
            });
            // on profile close icon click
            chatProfileClose.on("click", function () {
                chatUserProfile.removeClass("show");
                chatProfile.removeClass("show");
                if (!chatSidebar.hasClass("show")) {
                    chatOverlay.removeClass("show");
                }
            });
            // On chat menu sidebar close icon click
            chatSidebarClose.on("click", function () {
                chatSidebar.removeClass("show");
                chatOverlay.removeClass("show");
            });
            // on overlay click
            chatOverlay.on("click", function () {
                chatSidebar.removeClass("show");
                chatOverlay.removeClass("show");
                chatUserProfile.removeClass("show");
                chatProfile.removeClass("show");
            });

            // app chat favorite star click
            $(".chat-icon-favorite i").on("click", function (e) {
                $(this).parent(".chat-icon-favorite").toggleClass("warning");
                $(this).toggleClass("bxs-star bx-star");
                e.stopPropagation();
            });
            // menu toggle till medium screen
            if ($(window).width() < 992) {
                chatSidebarToggle.on("click", function () {
                    chatSidebar.addClass("show");
                    chatOverlay.addClass("show");
                });
            }

            // click on main menu toggle will remove sidebars & overlays
            $(".menu-toggle").click(function () {
                chatSidebar.removeClass("show");
                chatOverlay.removeClass("show");
                chatUserProfile.removeClass("show");
                chatProfile.removeClass("show");
            });

            // chat search filter
            $("#chat-search").on("keyup", function () {
                var value = $(this).val().toLowerCase();
                if (value != "") {
                    $(".chat-sidebar-list-wrapper .chat-sidebar-list li").filter(function () {
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                    });
                } else {
                    // if search filter box is empty
                    $(".chat-sidebar-list-wrapper .chat-sidebar-list li").show();
                }
            });
            // window resize
            $(window).on("resize", function () {
                // remove show classes from overlay when resize, if size is > 992
                if ($(window).width() > 992) {
                    if (chatOverlay.hasClass("show")) {
                        chatOverlay.removeClass("show");
                    }
                }
                // menu toggle on resize till medium screen
                if ($(window).width() < 992) {
                    chatSidebarToggle.on("click", function () {
                        chatSidebar.addClass("show");
                        chatOverlay.addClass("show");
                    });
                }
                // disable on click overlay when resize from medium to large
                if ($(window).width() > 992) {
                    chatSidebarToggle.on("click", function () {
                        chatOverlay.removeClass("show");
                    });
                }
            });

        }
    </script>
    <script src="{{ asset('js/helper.js') }}"></script>
    <!-- END: Page JS-->

</body>
<!-- END: Body-->

</html>