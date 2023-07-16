$(document).ready(function () {
    var _token = $('meta[name="csrf-token"]').attr('content');
    var user_login_id = $('#user_login_id').val();
    var avatar = $('#avatar_user_login').attr('src');
    var name = $('#name_user_login').text();

    $('.like').on('click', function(event) {
        event.preventDefault();
        let btn = $(this);
        let _id = btn.data('id');
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

    $('.com').on('click', function(event) {
        event.preventDefault;
        let _id = $(this).data('id');
        let avatar = "";
        let count = 0;
        $('#idJob').val(_id);
        $('.middle').empty();
        $.ajax({
            type: "GET",
            url: "/comment/show/"+_id,
            dataType: "JSON",
            success: function (response) {
                $.each(response.data, function(key, val) {
                    if(val.user.user_info.avatar.includes('https://')) {
                        avatar = val.user.user_info.avatar;
                    }else {
                        avatar = "/storage/"+val.user.user_info.avatar;
                    }
                    if(val.parent_id == 0) {
                        count++;
                        if(val.user_id == user_login_id) {
                            $('.middle').append(
                                '<div class="mt-3 kk">'+
                                    '<div class="wrp_comment">'+
                                        '<div class="wrp_avatar">'+
                                            '<img src="'+avatar+'" width="50" height="50">'
                                        +'</div>' +
                                        '<div class="wrp_content_comment">'+
                                            '<p class="content_comment">'+
                                                '<span class="name d-block mb-2">'+val.user.name+'</span>' + 
                                                    val.content.replaceAll(" ", "&nbsp;").replace(/\r\n|\r|\n/g, "<br />")
                                            +'</p>' +
                                            '<div class="interact mt-3 ml-2">'+
                                                '<span class="btn_feedback btn_interact" data-id="'+val.id+'">Phản hồi</span> \u00A0 | \u00A0 <span class="btn_interact btn_delete_comment_parent" data-id="'+val.id+'">Xóa</span> \u00A0 | \u00A0 <span class="time_comment">'+handleFormatDate(val.created_at)+'</span>'
                                            +'</div>'
                                        +'</div>'
                                    +'</div>' +
                                    '<div class="feedback"></div>' +
                                    '<div class="wrp_comment_feedback"></div>'
                                +'</div>'
                            )
                        }else {
                            if(user_login_id != undefined) {
                                $('.middle').append(
                                    '<div class="mt-3 kk">'+
                                        '<div class="wrp_comment">'+
                                            '<div class="wrp_avatar">'+
                                                '<img src="'+avatar+'" width="50" height="50">'
                                            +'</div>' +
                                            '<div class="wrp_content_comment">'+
                                                '<p class="content_comment">'+
                                                    '<span class="name d-block mb-2">'+val.user.name+'</span>' + 
                                                        val.content.replaceAll(" ", "&nbsp;").replace(/\r\n|\r|\n/g, "<br />")
                                                +'</p>' +
                                                '<div class="interact mt-3 ml-2">'+
                                                    '<span class="btn_feedback btn_interact" data-id="'+val.id+'">Phản hồi</span> \u00A0 | \u00A0 <span class="time_comment">'+handleFormatDate(val.created_at)+'</span>'
                                                +'</div>'
                                            +'</div>'
                                        +'</div>' +
                                        '<div class="feedback"></div>' +
                                        '<div class="wrp_comment_feedback"></div>'
                                    +'</div>'
                                )
                            }else{
                                $('.middle').append(
                                    '<div class="mt-3 kk">'+
                                        '<div class="wrp_comment">'+
                                            '<div class="wrp_avatar">'+
                                                '<img src="'+avatar+'" width="50" height="50">'
                                            +'</div>' +
                                            '<div class="wrp_content_comment">'+
                                                '<p class="content_comment">'+
                                                    '<span class="name d-block mb-2">'+val.user.name+'</span>' + 
                                                        val.content.replaceAll(" ", "&nbsp;").replace(/\r\n|\r|\n/g, "<br />")
                                                +'</p>' +
                                                '<div class="interact mt-3 ml-2">'+
                                                    '<span class="time_comment">'+handleFormatDate(val.created_at)+'</span>'
                                                +'</div>'
                                            +'</div>'
                                        +'</div>' +
                                        '<div class="feedback"></div>' +
                                        '<div class="wrp_comment_feedback"></div>'
                                    +'</div>'
                                )
                            }
                            
                        }

                        //Hiển thị ra các bình luận phản hồi
                        $.each(response.data, function(keyChild, valChild) {
                            
                            if(valChild.user.user_info.avatar.includes('https://')) {
                                avatar = valChild.user.user_info.avatar;
                            }else {
                                avatar = "/storage/"+valChild.user.user_info.avatar;
                            }
                            
                            if(valChild.parent_id == val.id) {
                                if(user_login_id != undefined && user_login_id == valChild.user_id) {
                                    $('.wrp_comment_feedback').eq(count-1).append(
                                        '<div class="wrp_comment comment_feedback mt-3">'+
                                            '<div class="wrp_avatar">'+
                                                '<img src="'+avatar+'" alt="" width="50" height="50">' +
                                            '</div>' +
                                            '<div class="wrp_content_comment">'+
                                                '<p class="content_comment">'+
                                                    '<span class="name d-block mb-2">'+
                                                        valChild.user.name
                                                    +'</span>' +
                                                        valChild.content.replaceAll(" ", "&nbsp;").replace(/\r\n|\r|\n/g, "<br />")
                                                +'</p>' +
                                                '<div class="interact mt-3 ml-2">'+
                                                    '<span class="btn_interact btn_delete_comment_feedback" data-id="'+valChild.id+'"> Xóa </span> \u00A0 | \u00A0 <span class="time_comment">'+handleFormatDate(valChild.created_at)+'</span>'
                                                +'</div>' +
                                            '</div>' +
                                        '</div>'
                                    )
                                }else{
                                    $('.wrp_comment_feedback').eq(count-1).append(
                                        '<div class="wrp_comment comment_feedback mt-3">'+
                                            '<div class="wrp_avatar">'+
                                                '<img src="'+avatar+'" alt="" width="50" height="50">' +
                                            '</div>' +
                                            '<div class="wrp_content_comment">'+
                                                '<p class="content_comment">'+
                                                    '<span class="name d-block mb-2">'+
                                                        valChild.user.name
                                                    +'</span>' +
                                                        valChild.content.replaceAll(" ", "&nbsp;").replace(/\r\n|\r|\n/g, "<br />")
                                                +'</p>' +
                                                '<div class="interact mt-3 ml-2">'+
                                                    '<span class="time_comment">'+handleFormatDate(valChild.created_at)+'</span>'
                                                +'</div>' +
                                            '</div>' +
                                        '</div>'
                                    )
                                }
                                
                            }
                        });
                    }
                });
            }
        });
    })

    $('.send_comment').on('keypress', function(event) {
        let content = $(this).val();

        if(content.length > 150) {
            $(this).css('height','100px');
        }else{
            $(this).css('height','40px');
        }

        //Bình luận bài tin
        if(event.keyCode === 13 && !event.shiftKey) {
            event.preventDefault();
            
            if(content.length <= 0) {
                alert('Vui lòng nhập nội dung bình luận');
                return false;
            }

            $('.send_comment').val('');
            $.ajax({
                type: "POST",
                url: "/comment/store",
                data: {
                    _token: _token,
                    content: content,
                    _id: $('#idJob').val(),
                },
                dataType: "JSON",
                success: function (response) {
                    $('.middle').prepend(
                        '<div class="mt-3 kk">'+
                            '<div class="wrp_comment">'+
                                '<div class="wrp_avatar">'+
                                    '<img src="'+avatar+'" width="50" height="50">'
                                +'</div>' +
                                '<div class="wrp_content_comment">'+
                                    '<p class="content_comment">'+
                                        '<span class="name d-block mb-2">'+name+'</span>' + 
                                        content.replaceAll(" ", "&nbsp;").replace(/\r\n|\r|\n/g, "<br />")
                                    +'</p>' +
                                    '<div class="interact mt-3 ml-2">'+
                                        '<span class="btn_feedback btn_interact" data-id="'+response.data+'">Phản hồi</span> \u00A0 | \u00A0 <span class="btn_interact btn_delete_comment_parent" data-id="'+response.data+'">Xóa</span> \u00A0 | \u00A0 <span class="time_comment">Vừa xong</span>'
                                    +'</div>'
                                +'</div>'
                            +'</div>' +
                            '<div class="feedback"></div>' +
                            '<div class="wrp_comment_feedback"></div>'
                        +'</div>'
                    )
                }
            });
           
        }
    });

    //Phản hồi bình luận
    $(document).on('keypress', '.feedback_comment', function(event) {
        let content = $(this).val()
        let parent_id = $(this).data('id');
        let area = $(this);
        if(content.length > 150) {
            $(this).css('height','100px');
        }else{
            $(this).css('height','40px');
        }

        // '\u00A0': Ký tự space = &nbsp;
        if(event.keyCode === 13 && !event.shiftKey) {
            event.preventDefault();
            
            if(content.length <= 0) {
                alert('Vui lòng nhập nội dung bình luận');
                return false;
            }
            $.ajax({
                type: "POST",
                url: "/comment/store",
                data: {
                    _token: _token,
                    content: content,
                    _id: $('#idJob').val(),
                    parent_id: parent_id,
                },
                dataType: "JSON",
                success: function (response) {
                    area.parents('.feedback')
                    .siblings('.wrp_comment_feedback')
                    .prepend(
                        '<div class="wrp_comment comment_feedback mt-3">'+
                            '<div class="wrp_avatar">'+
                                '<img src="'+avatar+'" alt="" width="50" height="50">' +
                            '</div>' +
                            '<div class="wrp_content_comment">'+
                                '<p class="content_comment">'+
                                    '<span class="name d-block mb-2">'+
                                        name
                                    +'</span>' +
                                    content.replaceAll(" ", "&nbsp;").replace(/\r\n|\r|\n/g, "<br />")
                                +'</p>' +
                                '<div class="interact mt-3 ml-2">'+
                                    '<span class="btn_interact btn_delete_comment_feedback" data-id="'+response.data+'"> Xóa </span> \u00A0 | \u00A0 <span class="time_comment">Vừa xong</span>'
                                +'</div>' +
                            '</div>' +
                        '</div>'
                    )
                    area.parents('.feedback').empty();
                }
            });
            
        }
    });

    $(document).on('click', '.btn_feedback', function() {
        let btn = $(this);
        let _id = btn.data('id');
        btn.parents('.kk').children('.feedback').empty().append(
            '<div class="mt-4">'+
                '<div class="wrp_ipt_feedback">'+
                    '<img src="'+avatar+'" alt="">' +
                    '<div class="wrp_ipt_comment">'+
                        '<textarea class="ipt_cm feedback_comment" placeholder="Viết bình luận của bạn" data-id="'+_id+'"></textarea>' +
                        '<div class="wrp_icon">'+
                            '<i class="fa fa-paper-plane-o icon_send" aria-hidden="true"></i>'
                        +'</div>'
                    +'</div>'
                +'</div>'
            +'</div>'
        );
    });

    //Xóa bình luận cha
    $(document).on('click', '.btn_delete_comment_parent', function() {
        let btn = $(this);
        let _id = btn.data('id');
        
        if(window.confirm("Bạn có chắc muốn xóa bình luận này?")) {
            $.ajax({
                type: "POST",
                url: "/comment/destroy",
                data: {
                    _id: _id,
                    _token: _token,
                },
                dataType: "JSON",
                success: function (response) {
                    btn.parents('.kk').remove();
                }
            });
        }
    });

    //Xóa bình luận con
    $(document).on('click', '.btn_delete_comment_feedback', function() {
        let btn = $(this);
        let _id = btn.data('id');
        if(window.confirm("Bạn có chắc muốn xóa bình luận này?")) {
            $.ajax({
                type: "POST",
                url: "/comment/destroy",
                data: {
                    _id: _id,
                    _token: _token,
                },
                dataType: "JSON",
                success: function (response) {
                    btn.parents('.comment_feedback').remove();
                }
            });
        }
    })

    $("#exampleModalCenter").on('hide.bs.modal', function(){
        $('.send_comment').val('');
        $('.middle').empty();
        $('#idJob').val('');
    });

    //------- Function -------------
    function handleFormatDate(timeData) {
        let time = new Date(timeData);

        let date = time.getDate();
        let month = time.getMonth() + 1;
        let year = time.getFullYear();

        let hour = time.getHours();
        let minute = time.getMinutes();

        return hour+':'+minute+' | '+date+'-'+month+'-'+year;
    }
});