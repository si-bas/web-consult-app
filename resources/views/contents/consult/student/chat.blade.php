@extends('layouts.template-default')

@include('plugins.loadingoverly')

@section('content')
<div class="content-header row">
    <div class="content-header-left col-12 mb-2 mt-1">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h5 class="content-header-title float-left pr-1 mb-0">Chat</h5>
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb p-0 mb-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('consult.student.list') }}">Konsultasi</a>
                        </li>
                        <li class="breadcrumb-item active">
                            Chat
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header border-bottom p-0">
        <div class="media m-75">
            <a class="media-left" href="JavaScript:void(0);">
                <div class="avatar mr-75">
                    <img src="{{ asset('img/user.png') }}" alt="avtar images" width="32" height="32">
                    {{-- <span class="avatar-status-online"></span> --}}
                </div>
            </a>
            <div class="media-body">
                <h6 class="media-heading mb-0 pt-25"><a href="javaScript:void(0);">{{ $consult->lecturer->full_name }}</a>
                </h6>
                <span class="text-muted font-small-3">{{ $consult->schedule->day->name }}, {{ $consult->schedule->start_time }} - {{ $consult->schedule->end_time }}</span>
            </div>
            <div class="heading-elements">
                <button type="button" class="btn btn-sm btn-light-secondary" onclick="window.location.href='{{ route('consult.student.list') }}'">Kembali</button>
            </div>
        </div>
    </div>
    <div class="card-content mt-2" id="chat-room">
        
    </div>
    <div class="form-group row align-items-center px-1" id="form-chat">
        <div class="col-12">
            <form class="d-flex align-items-center" onsubmit="chatMessagesSend();" action="javascript:void(0);">
                {{-- <input type="text" class="form-control chat-message-send mx-1" name="message" placeholder="Tuliskan disini..."> --}}
                <textarea class="form-control chat-message-send mx-1" name="message" placeholder="Tuliskan disini..." rows="2"></textarea>
                <button type="submit" class="btn btn-primary glow send d-lg-flex"><i class="bx bx-paper-plane"></i>
                    <span class="d-none d-lg-block ml-1">Send</span></button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        const form_chat = $('#form-chat');
        const chat_room = $('#chat-room');
        
        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);

        const current_chat_id = urlParams.get('id');
        let chat_skip = 5;

        const chatMessagesSend = () => {
            let message = form_chat.find('textarea[name=message]').val();

            var currentdate = new Date();
            let date = currentdate.getDate() + "/" +
                (currentdate.getMonth() + 1) + "/" +
                currentdate.getFullYear() + " @ " +
                currentdate.getHours() + ":" +
                currentdate.getMinutes();            

            $.post("{{ route('consult.student.save.messages.submit') }}", {
                _token: "{{ csrf_token() }}",
                id: current_chat_id,
                message: message
            });
            
            form_chat.find('textarea[name=message]').val('');
            scrollToBottom();
        }

        const scrollToBottom = (offset = 0) => {
            var $container = $("html,body");
            var $scrollTo = $('.first-section').first();

            $container.animate({scrollTop: $scrollTo.offset().top+offset, scrollLeft: 0},"slow");
        }

        $(function () {
            $.LoadingOverlay('show');

            $.get("{{ route('consult.student.chat.first.load') }}", {
                id: current_chat_id
            }).done(function (result) {
                chat_room.append(result);
                scrollToBottom();

                $.LoadingOverlay('hide', true);

                checkNewMessage();
            });
        });

        const showMore = (e) => {
            $.LoadingOverlay('show');

            $.get("{{ route('consult.student.get.messages.more') }}", {
                id: current_chat_id,
                skip: chat_skip
            }).done(function (result) {                
                if (result.count > 0) {
                    $(result.view).insertAfter($(e).parent());
                    chat_skip = result.skip;
                    scrollToBottom(-200);
                } else {
                    $(e).parent().remove();
                }

                $.LoadingOverlay('hide', true);
            });
        }

        const checkNewMessage = () => {
            let data = [];
            $('.chat-message').each(function (element) {
                data.push($(this).data("id"));
            });

            max_id = Math.max.apply(null, data);

            $.get("{{ route('consult.student.get.messages.new') }}", {
                id: current_chat_id,
                max_id: max_id
            }).done(function (result) {
                if (result.count > 0) {
                    $('#chat-room').append(result.view);
                    scrollToBottom();
                }

                setTimeout(
                    function () {
                        checkNewMessage();
                    }, 2000);
            });                        
        }
    </script>
@endpush