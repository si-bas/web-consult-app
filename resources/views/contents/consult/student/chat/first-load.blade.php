@if ($consult->messages()->exists())
    <div class="text-center mb-2">
        <a href="javascript:;" onclick="showMore(this)">selengkapnya. . .</a>
    </div>
    @foreach ($consult->messages->sortBy('created_at') as $key => $item)
        <div class="card-header user-profile-header pt-0 pb-0">
            <div class="avatar mr-50 align-top">
                <img src="{{ asset('img/user.png') }}" alt="avtar images" width="32" height="32">
            </div>
            <div class="d-inline-block mt-25">
                <h6 class="mb-0 text-bold-500 font-small-3" style="{{ $item->user->id == Auth::user()->id ? 'color:#5a8dee;' : '' }}">{{ $item->user->id == Auth::user()->id ? 'Anda' : $item->user->name }}</h6>
                <p class="text-muted"><small>{{ $item->timestamp }}</small></p>
            </div>
        </div>
        <div class="card-body py-0">
            <p>{{ $item->message }}</p>
        </div>
        <hr class="{{ $key == 0 ? 'first-section' : '' }}">
    @endforeach
@else 
    <div class="text-center mt-3 mb-3" id="empty">
        <span class="font-medium-1">Belum ada Chat.</span>
    </div>
    <hr class="first-section">
@endif