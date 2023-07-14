$(document).ready(function () {
    $('.like').on('click', function(event) {
        event.preventDefault();
        let btn = $(this);
        let _id = btn.data('id');
        let _token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            type: "POST",
            url: "/job/like",
            data: {
                _token: _token,
                _id: _id,
            },
            dataType: "JSON",
            success: function (response) {
                btn.toggleClass('active_like');
                btn.children('.count_like').text(response.data.count);
            }
        });
    });

    $('.not_auth_like').on('click', function(event) {
        event.preventDefault();
        Swal.fire({
            title: 'Đăng nhập đê',
            text: "Bạn chưa đăng nhập tài khoản để tương tác bài viết. Bạn muốn đến trang đăng nhập không ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Chuyển đến',
            cancelButtonText: 'Ở lại'
        }).then((result) => {
            if (result.isConfirmed) {
                window.open('/login', '_self');
            }
        })
    });

    $('.send_comment').on('keyup', function() {
        if($(this).val().length > 150) {
            $(this).css('height','100px');
        }else{
            $(this).css('height','40px');
        }
    });

    $('.feedback_comment').on('keyup', function() {
        if($(this).val().length > 150) {
            $(this).css('height','100px');
        }else{
            $(this).css('height','40px');
        }
    });

    $('.btn_feedback').on('click', function() {
        let btn = $(this);
        btn.parents('.kk').append(
            '<div class="mt-4">'+
                '<div class="wrp_ipt_feedback">'+
                    '<img src="/storage/avatars/backgroundBrS2rtQdqgWQnLidYfpp7P3QMitNZal5LV3nlZW5.jpg" alt="">' +
                    '<div class="wrp_ipt_comment">'+
                        '<textarea class="ipt_cm feedback_comment" placeholder="Viết bình luận của bạn"></textarea>' +
                        '<div class="wrp_icon">'+
                            '<i class="fa fa-camera-retro" aria-hidden="true"></i>' + 
                            '<i class="fa fa-paper-plane-o icon_send" aria-hidden="true"></i>'
                        +'</div>'
                    +'</div>'
                +'</div>'
            +'</div>'
        )
    });
});