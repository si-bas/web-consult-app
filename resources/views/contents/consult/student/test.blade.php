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
                            <h6 class="px-2 pt-0 pb-25 mb-0">KONSULTASI</h6>
                            <ul class="chat-sidebar-list">
                                <li>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar m-0 mr-50"><img src="{{ asset('img/user.png') }}" height="36" width="36" alt="sidebar user image">
                                            <span class="avatar-status-online"></span>
                                        </div>
                                        <div class="chat-sidebar-name">
                                            <h6 class="mb-0">Contoh 2 Dosen</h6><span class="text-muted">Keperawatan - D4</span>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <h6 class="px-2 pt-2 pb-25 mb-0">DOSEN</h6>
                            <ul class="chat-sidebar-list">
                                <li>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar m-0 mr-50"><img src="{{ asset('img/user.png') }}" height="36" width="36" alt="sidebar user image">
                                            <span class="avatar-status-online"></span>
                                        </div>
                                        <div class="chat-sidebar-name">
                                            <h6 class="mb-0">Contoh 1 Dosen</h6><span class="text-muted">Keperawatan - D3</span>
                                        </div>
                                    </div>
                                </li>
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
                                <h4 class="d-none d-lg-block py-50 text-bold-500">Pilih Dosen untuk memulai konsultasi</h4>
                                <button class="btn btn-light-primary chat-start-text chat-sidebar-toggle d-block d-lg-none py-50 px-1">Mulai Konsultasi</button>
                            </div>
                            <div class="chat-area d-none">
                                {{-- <div class="chat-header">
                                    <header class="d-flex justify-content-between align-items-center border-bottom px-1 py-75">
                                        <div class="d-flex align-items-center">
                                            <div class="chat-sidebar-toggle d-block d-lg-none mr-1"><i class="bx bx-menu font-large-1 cursor-pointer"></i>
                                            </div>
                                            <div class="avatar chat-profile-toggle m-0 mr-1">
                                                <img src="{{ asset('img/user.png') }}" alt="avatar" height="36" width="36" />
                                                <span class="avatar-status-busy"></span>
                                            </div>
                                            <h6 class="mb-0">Elizabeth Elliott</h6>
                                        </div>
                                        <div class="chat-header-icons">
                                            <span class="chat-icon-favorite">
                                                <i class="bx bx-star font-medium-5 cursor-pointer"></i>
                                            </span>
                                            <span class="dropdown">
                                                <i class="bx bx-dots-vertical-rounded font-medium-4 ml-25 cursor-pointer dropdown-toggle nav-hide-arrow cursor-pointer" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu">
                                                </i>
                                                <span class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item" href="JavaScript:void(0);"><i class="bx bx-pin mr-25"></i> Pin to top</a>
                                                    <a class="dropdown-item" href="JavaScript:void(0);"><i class="bx bx-trash mr-25"></i> Delete chat</a>
                                                    <a class="dropdown-item" href="JavaScript:void(0);"><i class="bx bx-block mr-25"></i> Block</a>
                                                </span>
                                            </span>
                                        </div>
                                    </header>
                                </div>
                                <!-- chat card start -->
                                <div class="card chat-wrapper shadow-none">
                                    <div class="card-content">
                                        <div class="card-body chat-container">
                                            <div class="chat-content">
                                                <div class="chat">
                                                    <div class="chat-avatar">
                                                        <a class="avatar m-0">
                                                            <img src="{{ asset('template-default/app-assets/images/portrait/small/avatar-s-11.jpg') }}" alt="avatar" height="36" width="36" />
                                                        </a>
                                                    </div>
                                                    <div class="chat-body">
                                                        <div class="chat-message">
                                                            <p>How can we help? We're here for you! 😄</p>
                                                            <span class="chat-time">7:45 AM</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="chat chat-left">
                                                    <div class="chat-avatar">
                                                        <a class="avatar m-0">
                                                            <img src="{{ asset('template-default/app-assets/images/portrait/small/avatar-s-26.jpg') }}" alt="avatar" height="36" width="36" />
                                                        </a>
                                                    </div>
                                                    <div class="chat-body">
                                                        <div class="chat-message">
                                                            <p>Hey John, I am looking for the best admin template.</p>
                                                            <p>Could you please help me to find it out? 🤔</p>
                                                            <span class="chat-time">7:50 AM</span>
                                                        </div>
                                                        <div class="chat-message">
                                                            <p>It should be Bootstrap 4 🤩 compatible.</p>
                                                            <span class="chat-time">7:58 AM</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="badge badge-pill badge-light-secondary my-1">Yesterday</div>
                                                <div class="chat">
                                                    <div class="chat-avatar">
                                                        <a class="avatar m-0">
                                                            <img src="{{ asset('template-default/app-assets/images/portrait/small/avatar-s-11.jpg') }}" alt="avatar" height="36" width="36" />
                                                        </a>
                                                    </div>
                                                    <div class="chat-body">
                                                        <div class="chat-message">
                                                            <p>Absolutely!</p>
                                                            <span class="chat-time">8:00 AM</span>
                                                        </div>
                                                        <div class="chat-message">
                                                            <p>Stack admin is the responsive bootstrap 4 admin template.</p>
                                                            <span class="chat-time">8:01 AM</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="chat chat-left">
                                                    <div class="chat-avatar">
                                                        <a class="avatar m-0">
                                                            <img src="{{ asset('template-default/app-assets/images/portrait/small/avatar-s-26.jpg') }}" alt="avatar" height="36" width="36" />
                                                        </a>
                                                    </div>
                                                    <div class="chat-body">
                                                        <div class="chat-message">
                                                            <p>Looks clean and fresh UI. 😃</p>
                                                            <span class="chat-time">10:12 AM</span>
                                                        </div>
                                                        <div class="chat-message">
                                                            <p>It's perfect for my next project.</p>
                                                            <span class="chat-time">10:15 AM</span>
                                                        </div>
                                                        <div class="chat-message">
                                                            <p>How can I purchase 🤑 it?</p>
                                                            <span class="chat-time">10:18 AM</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="chat">
                                                    <div class="chat-avatar">
                                                        <a class="avatar m-0">
                                                            <img src="{{ asset('template-default/app-assets/images/portrait/small/avatar-s-11.jpg') }}" alt="avatar" height="36" width="36" />
                                                        </a>
                                                    </div>
                                                    <div class="chat-body">
                                                        <div class="chat-message">
                                                            <p>Thanks 🤝 , from ThemeForest.</p>
                                                            <span class="chat-time">10:20 AM</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="chat chat-left">
                                                    <div class="chat-avatar">
                                                        <a class="avatar m-0">
                                                            <img src="{{ asset('template-default/app-assets/images/portrait/small/avatar-s-26.jpg') }}" alt="avatar" height="36" width="36" />
                                                        </a>
                                                    </div>
                                                    <div class="chat-body">
                                                        <div class="chat-message">
                                                            <p>I will purchase it for sure. 👍</p>
                                                            <span class="chat-time">3:32 PM</span>
                                                        </div>
                                                        <div class="chat-message">
                                                            <p>Thanks.</p>
                                                            <span class="chat-time">3:33 PM</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="chat">
                                                    <div class="chat-avatar">
                                                        <a class="avatar m-0">
                                                            <img src="{{ asset('template-default/app-assets/images/portrait/small/avatar-s-11.jpg') }}" alt="avatar" height="36" width="36" />
                                                        </a>
                                                    </div>
                                                    <div class="chat-body">
                                                        <div class="chat-message">
                                                            <p>Great, Feel free to get in touch on</p>
                                                            <span class="chat-time">3:34 AM</span>
                                                        </div>
                                                        <div class="chat-message">
                                                            <p>https://pixinvent.ticksy.com/</p>
                                                            <span class="chat-time">3:35 AM</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer chat-footer border-top px-2 pt-1 pb-0 mb-1">
                                        <form class="d-flex align-items-center" onsubmit="chatMessagesSend();" action="javascript:void(0);">
                                            <i class="bx bx-face cursor-pointer"></i>
                                            <i class="bx bx-paperclip ml-1 cursor-pointer"></i>
                                            <input type="text" class="form-control chat-message-send mx-1" placeholder="Type your message here...">
                                            <button type="submit" class="btn btn-primary glow send d-lg-flex"><i class="bx bx-paper-plane"></i>
                                                <span class="d-none d-lg-block ml-1">Send</span></button>
                                        </form>
                                    </div>
                                </div>
                                <!-- chat card ends --> --}}
                            </div>
                        </section>
                        <!-- app chat window ends -->
                        <!-- app chat profile right sidebar start -->
                        <section class="chat-profile">
                            <header class="chat-profile-header text-center border-bottom">
                                <span class="chat-profile-close">
                                    <i class="bx bx-x"></i>
                                </span>
                                <div class="my-2">
                                    <div class="avatar">
                                        <img src="{{ asset('template-default/app-assets/images/portrait/small/avatar-s-26.jpg') }}" alt="chat avatar" height="100" width="100">
                                    </div>
                                    <h5 class="app-chat-user-name mb-0">Elizabeth Elliott</h5>
                                    <span>Devloper</span>
                                </div>
                            </header>
                            <div class="chat-profile-content p-2">
                                <h6 class="mt-1">ABOUT</h6>
                                <p>It is a long established fact that a reader will be distracted by the readable content.</p>
                                <h6 class="mt-2">PERSONAL INFORMATION</h6>
                                <ul class="list-unstyled">
                                    <li class="mb-25">email@gmail.com</li>
                                    <li>+1(789) 950-7654</li>
                                </ul>
                            </div>
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

        $(document).ready(function () {
        "use strict";
        // menu user list perfect scrollbar initialization
        if (chatSidebarListWrapper.length > 0) {
            var menu_user_list = new PerfectScrollbar(".chat-sidebar-list-wrapper");
        }
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
        // Add class active on click of Chat users list
        $(".chat-sidebar-list-wrapper ul li").on("click", function () {
            if ($(".chat-sidebar-list-wrapper ul li").hasClass("active")) {
            $(".chat-sidebar-list-wrapper ul li").removeClass("active");
            }
            $(this).addClass("active");
            if ($(".chat-sidebar-list-wrapper ul li").hasClass("active")) {
            chatStart.addClass("d-none");
            chatArea.removeClass("d-none");
            }
            else {
            chatStart.removeClass("d-none");
            chatArea.addClass("d-none");
            }
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
        // autoscroll to bottom of Chat area
        $(".chat-sidebar-list li").on("click", function () {
            chatContainer.animate({ scrollTop: chatContainer[0].scrollHeight }, 400)
        });

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
            }
            else {
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
        });
        // Add message to chat
        function chatMessagesSend(source) {
        var message = chatMessageSend.val();
        if (message != "") {
            var html = '<div class="chat-message">' + "<p>" + message + "</p>" + "<div class=" + "chat-time" + ">3:35 AM</div></div>";
            $(".chat-wrapper .chat:last-child .chat-body").append(html);
            chatMessageSend.val("");
            chatContainer.scrollTop($(".chat-container > .chat-content").height());
        }
        }
    </script>
    <script src="{{ asset('js/helper.js') }}"></script>
    <!-- END: Page JS-->

</body>
<!-- END: Body-->

</html>