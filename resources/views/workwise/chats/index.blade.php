<!DOCTYPE html>
<html lang="en">
@include('workwise.includes.header', ['title' => 'Chat WorkWise - Nhắn tin trực tiếp'])
<link rel="stylesheet" href="/workwise/css/chat/style.css">

<body>
    <div class="container-fluid">
        <div class="container">
            <div class="row chat-app">
                <div class="col-lg-4 col-12 order-lg-1 order-2 col-list-user">
                    <div class="search">
                        <i class="fa fa-search icon-search"></i>
                        <input type="text" placeholder="Tìm kiếm bạn bè...." class="input-search">
                    </div>
                    <div class="list-users">
                        <div class="aa">
                            @foreach (Auth::user()->friends as $friend)
                                <a href="{{ route('chat.index', $friend->id) }}" class="bold-name-{{ $friend->id }} {{ $friend->pivot->status == 1 ? 'bold-active' : '' }}" data-id-to="{{ $friend->id }}">
                                    <div class="info-user btn-info-user">
                                        <img src="{{ $friend->userInfo->CheckEmptyImage() }}"
                                            alt="" class="info-image-friend">
                                        <div class="status-active status-active-dot">
                                            <span class="name-friend">
                                                {!! $friend->name !!}
                                                <span class="name-company d-block">{!! $friend->company ? $friend->company->name : '' !!}</span>
                                            </span>
                                            
                                            <span class="dot {{ $friend->pivot->status == 1 ? 'dot-active' : '' }}" id="dot-{{ $friend->id }}"></span>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                    <div class="info-me">
                        <div class="status-active status-active-me">
                            <img src="{{ Auth::user()->userInfo->CheckEmptyImage() }}" alt=""
                                class="info-image-friend">
                            <span class="font-weight-bold name-me">{!! Auth::user()->name !!}</span>
                        </div>
                        <div class="log-out">
                            <a href="{{ route("logout") }}">
                                <i class="fa fa-sign-out" id="sign-out" aria-hidden="true"
                                    data-id-me="{{ Auth::user()->id }}"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @if(Auth::user()->id !== $data['user']->id)
                    <div class="col-lg-8 col-12 order-lg-2 order-1 col-info-user">
                        <div class="col-12 wrapper-user">
                            <div class="info-user" id="info-friend" data-id-to="{{ $data['user']->id }}">
                                <img src="{{ $data['user']->userInfo->CheckEmptyImage() }}" alt=""
                                    class="info-image-friend">
                                <div class="status-active ">
                                    <span class="font-weight-bold info-name-friend">
                                        {!! $data['user']->name !!}
                                        <span class="name-company d-block">{!! $data['user']->company ? $data['user']->company->name : '' !!}</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 wrapper-content-message">
                            <ul class="content-message">
                                @foreach ($data['messages'] as $message)
                                    @if($message->user_from_id == Auth::user()->id && $message->user_to_id == $data['user']->id)
                                        <span class="time-chat">{{ date('H:m, d-m-Y'), strtotime($message->created_at) }}</span>
                                        <li class="clearfix">
                                            <p class="message me">
                                                {{ $message->message }}
                                            </p>
                                        </li>
                                    @elseif ($message->user_to_id == Auth::user()->id && $message->user_from_id == $data['user']->id)
                                        <span class="time-chat">{{ date('H:m, d-m-Y'), strtotime($message->created_at) }}</span>
                                        <li class="clearfix message-of-you">
                                            <p class="message friend">
                                                {{ $message->message }}
                                            </p>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                        <div class="col-12 d-flex justify-center align-items-center wrapper-message">
                            <i class="fa fa-paper-plane icon-send" aria-hidden="true"></i>
                            <textarea id="send-message" class="input-message" placeholder="Nhập tin nhắn" oninput="check_data(this)"></textarea>
                        </div>
                    </div>
                @else
                    <div class="col-lg-8 col-12 order-lg-8 order-1 col-empty-message">
                        <h5>Hãy chọn một đoạn chat hoặc bắt đầu cuộc trò chuyện mới</h5>
                    </div>
                @endif
            </div>
        </div>
    </div>

    @include('workwise.includes.footer')
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <script>
        var pusher_key = '{{ env('PUSHER_APP_KEY') }}';
        var pusher_cluster = '{{ env('PUSHER_APP_CLUSTER') }}';
    </script>
    <script src="{{ asset('script/chats/index.js') }}"></script>
</body>

</html>
