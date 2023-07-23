$(document).ready(function () {

    callEventChat();
    scollTopMessage();
    var _token = $('meta[name="csrf-token"]').attr('content');
    $(document).on('keypress', '#send-message', function(event) {
        if (event.keyCode == 13 && !event.shiftKey) {
            event.preventDefault();
            if($(this).val().length == 0) {
                return false;
            }
            
            let message = $(this).val();
            let user_to_id = $('#info-friend').data('id-to');

            $('.content-message').append(
                        '<li class="clearfix">' +
                            '<p class="message me">' + message + '</p>'
                        +'</li>'
            );
            scollTopMessage();
            $('#send-message').val('');

            $.ajax({
                type: "POST",
                url: "/chat/message",
                data: {
                    _token: _token,
                    user_to_id: user_to_id,
                    message: message,
                },
                success: function(response) {}
            });
        }
    });

    function callEventChat() {
        // console.log(pusher_key);
        // console.log(pusher_cluster);
        var pusher = new Pusher(pusher_key, {
            encrypted: true,
            cluster: pusher_cluster,
        });

        var channel = pusher.subscribe('channel-chat');
        channel.bind('chat', addMessage);
    }

    function addMessage(data) {
        let user_from_id = $('#info-friend').data('id-to');
        let me_id = $('#sign-out').data('id-me');

        if(me_id == data.data.user_to_id && user_from_id == data.data.user_from_id) {
            $('.content-message').append(
                '<li class="clearfix message-of-you">' +
                    '<p class="message friend">' + data.data.message + '</p>'
                +'</li>'
            );
            scollTopMessage();
        }else if(me_id == data.data.user_to_id && user_from_id != data.data.user_from_id){
            $('.bold-name-'+data.data.user_from_id).css('font-weight','bold');
            $('#dot-'+data.data.user_from_id).css('display', 'block');
        }
    }

    function scollTopMessage() {
        var elem = document.getElementsByClassName('content-message');
        elem[0].scrollTop = elem[0].scrollHeight;
    }
});

function check_data(e) {
    let wrapperMessage = $('.wrapper-message');
    let data = $(e).val();

    if (data == '') {
        $(e).removeAttr('style');
        wrapperMessage.css('height', '40px') ;
    }else{
        e.style.height = (e.scrollHeight) + 'px'
        wrapperMessage.css('height', (e.scrollHeight) + 'px') ;
    }
}