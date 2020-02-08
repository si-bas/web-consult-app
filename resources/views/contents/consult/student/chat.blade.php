@extends('layouts.template-default')

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
    <div class="card-content" id="chat-room">
        @if ($consult->messages()->exists())
            @foreach ($consult->messages as $item)
            <hr>
            <div class="card-header user-profile-header pt-0 pb-0">
                <div class="avatar mr-50 align-top">
                    <img src="{{ asset('img/user.png') }}" alt="avtar images" width="32" height="32">
                </div>
                <div class="d-inline-block mt-25">
                    <h6 class="mb-0 text-bold-500 font-small-3">{{ $item->user->name == Auth::user()->name ? 'Anda' : $item->user->name }}</h6>
                    <p class="text-muted"><small>{{ $item->timestamp }}</small></p>
                </div>
            </div>
            <div class="card-body py-0">
                <p>{{ $item->message }}</p>
            </div>
            @endforeach
        @else 
        <div class="text-center mt-3 mb-3" id="empty">
            <span class="font-medium-1">Belum ada Chat.</span>
        </div>
        @endif
    </div>
    
    <hr>
    <div class="form-group row align-items-center px-1" id="form-chat">
        <div class="col-12">
            <form class="d-flex align-items-center" onsubmit="chatMessagesSend();" action="javascript:void(0);">
                <input type="text" class="form-control chat-message-send mx-1" name="message" placeholder="Tuliskan disini...">
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

        const chatMessagesSend = () => {
            chat_room.find('#empty').remove();

            let message = form_chat.find('input[name=message]').val();

            var currentdate = new Date();
            let date = currentdate.getDate() + "/" +
                (currentdate.getMonth() + 1) + "/" +
                currentdate.getFullYear() + " @ " +
                currentdate.getHours() + ":" +
                currentdate.getMinutes();

            let html = `<hr>
                <div class="card-header user-profile-header pt-0 pb-0">
                    <div class="avatar mr-50 align-top">
                        <img src="{{ asset('img/user.png') }}" alt="avtar images" width="32" height="32">
                    </div>
                    <div class="d-inline-block mt-25">
                        <h6 class="mb-0 text-bold-500 font-small-3">Anda</h6>
                        <p class="text-muted"><small>${date}</small></p>
                    </div>
                </div>
                <div class="card-body py-0">
                    <p>${message}</p>
                </div>`;
            
            chat_room.append(html);

            $.post("{{ route('consult.student.save.messages.submit') }}", {
                _token: "{{ csrf_token() }}",
                id: current_chat_id,
                message: message
            });
        }

        $(function () {
            $('html,body').animate({scrollTop: document.body.scrollHeight},"slow");
        });
    </script>
@endpush