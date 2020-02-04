<div class="chat-header">
    <header class="d-flex justify-content-between align-items-center border-bottom px-1 py-75">
        <div class="d-flex align-items-center">
            <div class="chat-sidebar-toggle d-block d-lg-none mr-1"><i class="bx bx-menu font-large-1 cursor-pointer"></i>
            </div>
            <div class="avatar chat-profile-toggle m-0 mr-1">
                <img src="{{ asset('img/user.png') }}" alt="avatar" height="36" width="36" />
                <span class="avatar-status-online"></span>
            </div>
            <h6 class="mb-0">{{ $consult->lecturer->full_name }}</h6>
        </div>
        <div class="chat-header-icons">
            <span class="chat-icon-favorite">
                <i class="bx bx-star font-medium-5 cursor-pointer"></i>
            </span>
            <span class="dropdown">
                <i class="bx bx-dots-vertical-rounded font-medium-4 ml-25 cursor-pointer dropdown-toggle nav-hide-arrow cursor-pointer" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu">
                </i>
                <span class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="JavaScript:void(0);"><i class="bx bx-trash mr-25"></i> Hapus Konsultasi</a>
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
                @php
                    $last_user_id = 0;
                @endphp
                @foreach ($consult->messages as $i => $item)
                {{-- @if ($last_user_id != $item->user_id) --}}
                    <div class="chat {{ Auth::user()->id != $item->user_id ? 'chat-left' : '' }}">
                        <div class="chat-avatar">
                            <a class="avatar m-0">
                                <img src="{{ asset('img/user.png') }}" alt="avatar" height="36" width="36" />
                            </a>
                        </div>
                        <div class="chat-body">
                {{-- @endif --}}
                            <div class="chat-message">
                                <p>{{ $item->message }}</p>
                                <span class="chat-time">{{ $item->timestamp }}</span>
                            </div>
                {{-- @if ($last_user_id != $item->user_id) --}}
                        </div>
                    </div>
                {{-- @endif --}}

                @php
                    $last_user_id = $item->user_id;
                @endphp
                @endforeach

                {{-- <div class="badge badge-pill badge-light-secondary my-1">Yesterday</div> --}}
                
            </div>
        </div>
    </div>
    <div class="card-footer chat-footer border-top px-2 pt-1 pb-0 mb-1">
        <form class="d-flex align-items-center" onsubmit="chatMessagesSend();" action="javascript:void(0);">
            {{-- <i class="bx bx-face cursor-pointer"></i>
            <i class="bx bx-paperclip ml-1 cursor-pointer"></i> --}}
            <input type="text" class="form-control chat-message-send mx-1" placeholder="Type your message here...">
            <button type="submit" class="btn btn-primary glow send d-lg-flex"><i class="bx bx-paper-plane"></i>
                <span class="d-none d-lg-block ml-1">Send</span></button>
        </form>
    </div>
</div>
<!-- chat card ends -->