<!DOCTYPE html>
<html>
{{-- File Header.blade --}}
@include('workwise.includes.header')
<body>
    <div class="wrapper">
        {{-- File Navbar.blade --}}
        @include('workwise.includes.navbar')

        {{-- Main Content --}}
        @yield('main-content')
    </div>
    <footer class="p-3">
        <div class="footy-sec mn no-margin">
            <div class="container d-flex justify-content-center align-items-lg-center">
                <img class="fl-rgt" src="/workwise/images/logo2.png" alt>
                <p>&copy; Copyright 2023. Được phát triển bởi DNDev</p>
            </div>
        </div>
    </footer>
    <div id="wrapper-notification" class="wrapper-notification-class">
        <div id="notification-flex" class="d-flex align-items-center h-100">
            <img src="" alt="" id="avatar-notification">
            <div class="px-1">
                <h3 id="name-sender-notification"></h3>
                <p class="mb-0" id="content-notification">
                </p>
                <span class="time-sender-notification">Vài giây trước</span>
            </div>
           
        </div>
    </div>
    {{-- File Footer --}}
    @include('workwise.includes.footer')
    @yield('script')
    @if(Auth::check())
    <script>
        $(document).ready(function () {
            callSendNotification();
            

            function callSendNotification() {
                let pusher_key = '{{ env("PUSHER_APP_KEY") }}';
                let pusher_cluster = '{{ env("PUSHER_APP_CLUSTER") }}';
                let me_id = '{{ Auth::user()->id }}';

                var pusher = new Pusher(pusher_key, {
                    encrypted: true,
                    cluster: pusher_cluster,
                });

                var channel = pusher.subscribe('channel-notification-'+me_id);
                channel.bind('send-notification', showNotification);
            }

            function showNotification(data) {

                let notificationWrapper = $('.wrapper-notification-class');
                let notificationContent = $('#content-notification');
                let notificationAvatar = $('#avatar-notification');
                let notificationNameSender = $('#name-sender-notification');
                let notificationNumber = $('#number-notification');
                let notificationList = $('.nott-list');

                notificationWrapper.css('opacity', '1');
                notificationContent.text(data.data.content);
                notificationNameSender.text(data.data.name_sender);
                notificationAvatar.attr('src', data.data.image_sender);

                notificationNumber.text( parseInt(notificationNumber.text()) + 1 );
                notificationList.prepend(
                    `<a href="${data.data.path_route}">
                        <div class="notfication-detail px-2 mb-3">
                            <div class="noty-user-img">
                                <img src="${data.data.image_sender}" class="img-notifi">
                            </div>
                            <div class="notification-info">
                                <h3 class="name-notify">
                                    ${data.data.name_sender}
                                </h3>
                                <p class="text-notifi">
                                    ${data.data.content}
                                </p>
                                <span class="dot-notify"></span>
                                <p class="time-notify">Vài giây trước</p>
                            </div>
                        </div>
                    </a>`
                )

                setTimeout(() => {
                    notificationWrapper.css('opacity', '0');
                    notificationContent.text('');
                    notificationNameSender.text('');
                    notificationAvatar.attr('src', '');
                }, 5000);
            }
        });
    </script>
    @endif
</body>

</html>
