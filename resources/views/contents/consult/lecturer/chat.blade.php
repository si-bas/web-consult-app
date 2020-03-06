@extends('layouts.template-default')

@include('plugins.loadingoverly')
@include('plugins.sweetalert')

@push('styles')
    <style>
        .modal-body {
            position: relative;
            flex: 1 1 auto;
            padding: 1.3rem 1.3rem;
        }
    </style>
@endpush

@section('content')
<div class="content-header row">
    <div class="content-header-left col-12 mb-2 mt-1">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h5 class="content-header-title float-left pr-1 mb-0">Percakapan</h5>
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb p-0 mb-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('consult.lecturer.list') }}">Konsultasi</a>
                        </li>
                        <li class="breadcrumb-item active">
                            Percakapan
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="alert alert-primary alert-dismissible mb-2" role="alert" style="margin-bottom: 10px !important;">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
    <div class="d-flex align-items-center">
        <i class="bx bx-error-circle"></i>
        <span>
            Klik pada nama Mahasiswa untuk melihat hasil kuis dan melakukan aksi.
        </span>
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
                <h6 class="media-heading mb-0 pt-25"><a href="javaScript:void(0);" onclick="showAction()">
                    @if ($consult->is_meeting)
                    {{ $consult->student->full_name }}
                    @else 
                    Mahasiswa #{{ $consult->student->id }}
                    @endif
                </a>
                </h6>
                <span class="text-muted font-small-3">{{ $consult->schedule->day->name }}, {{ $consult->schedule->start_time }} - {{ $consult->schedule->end_time }}</span>
            </div>
            <div class="heading-elements">
                <button type="button" class="btn btn-sm btn-light-secondary" onclick="window.location.href='{{ route('consult.lecturer.list') }}'">Kembali</button>
            </div>
        </div>
    </div>
    <div class="card-content mt-2" id="chat-room">
        
    </div>
    <div class="form-group row align-items-center px-1" id="form-chat">
        <div class="col-12">
            <form class="d-flex align-items-center" onsubmit="chatMessagesSend();" action="javascript:void(0);">
                {{-- <input type="text" class="form-control chat-message-send mx-1" name="message" placeholder="Tuliskan disini..."> --}}
                <textarea class="form-control chat-message-send mx-1" name="message" placeholder="Tuliskan disini..." rows="2" {{ $consult->is_meeting ? 'disabled' : '' }}></textarea>
                <button type="submit" class="btn btn-primary glow send d-lg-flex" {{ $consult->is_meeting ? 'disabled' : '' }}><i class="bx bx-paper-plane"></i>
                    <span class="d-none d-lg-block ml-1">Send</span></button>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="student-action" tabindex="-1" role="dialog" aria-labelledby="studentDetail" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h5 class="modal-title white">Kuis & Aksi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="bx bx-x"></i>
                </button>
            </div>
            <div class="modal-body">
                @foreach ($quizzes as $item)
                    {!! $item->result_html !!}
                @endforeach
            </div>
            <div class="modal-footer">                
                <button type="button" class="btn btn-light-primary mr-3" onclick="showConfirm()">
                    Tandai selesai
                </button>
                <button type="button" class="btn btn-light-secondary" data-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                </button>
            </div>
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

            // let html = `
            //     <div class="card-header user-profile-header pt-0 pb-0">
            //         <div class="avatar mr-50 align-top">
            //             <img src="{{ asset('img/user.png') }}" alt="avtar images" width="32" height="32">
            //         </div>
            //         <div class="d-inline-block mt-25">
            //             <h6 class="mb-0 text-bold-500 font-small-3">Anda</h6>
            //             <p class="text-muted"><small>${date}</small></p>
            //         </div>
            //     </div>
            //     <div class="card-body py-0">
            //         <p>${message}</p>
            //     </div>
            //     <hr>`;
            
            // chat_room.append(html);

            $.post("{{ route('consult.lecturer.save.messages.submit') }}", {
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

            $.get("{{ route('consult.lecturer.chat.first.load') }}", {
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

            $.get("{{ route('consult.lecturer.get.messages.more') }}", {
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

            $.get("{{ route('consult.lecturer.get.messages.new') }}", {
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

        const modal_action = $('#student-action');

        const showAction = () => {
            modal_action.modal('show');
        }

        const showConfirm = () => {
            Swal.fire({
                title: 'Anda Yakin?',
                text: "Menandai konsultasi mahasiswa ini sebagai selesai",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, selesai!',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.value) {
                    window.location = "{{ route('consult.lecturer.done', ['id' => $consult->id]) }}";
                }
            })
        }
    </script>
@endpush