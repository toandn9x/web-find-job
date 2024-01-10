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
        let me_id = $('#sign-out').data('id-me');

        var pusher = new Pusher(pusher_key, {
            encrypted: true,
            cluster: pusher_cluster,
        });

        var channel = pusher.subscribe('channel-chat-'+me_id);
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
        if(elem[0]) {
            elem[0].scrollTop = elem[0].scrollHeight;
        }
    }

    $('.input-search').on('keyup', function() {
        // console.log($(this).val());
        let q = $(this).val();
        $.ajax({
            type: "GET",
            url: "/chat/search?q="+q,
            dataType: "JSON",
            success: function (response) {
                $('.aa').empty();
                $.each(response.data, function(index, val) {
                    let company = "";
                    let avatar = "";
                    
                    if(val.company != null) {
                        company = val.company.name;
                    }

                    if(val.user_info.avatar != null) {
                        avatar = avatar = val.user_info.avatar.includes('https://') ? val.user_info.avatar : "/storage/"+val.user_info.avatar;
                    }else {
                        avatar = "/workwise/images/resources/user_empty.jpg";
                    }

                    $('.aa').append(
                        '<a href="/chat/user/'+val.id+'" class="bold-name-'+val.id+' data-id-to="'+val.id+'">'+
                            '<div class="info-user btn-info-user">'+
                                '<img src="'+avatar+'" class="info-image-friend">'+
                                '<div class="status-active status-active-dot">'+
                                    '<span class="name-friend">'+
                                        val.name+
                                        '<span class="name-company d-block">'+company+'</span>'
                                    +'</span>'+
                                    '<span class="dot" id="dot-'+val.id+'"></span>'
                                +'</div>'
                            +'</div>'
                        +'</a>'
                    )
                });
            }
        });
    });
});
//End ready
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