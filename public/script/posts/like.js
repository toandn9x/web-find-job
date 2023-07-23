$(document).ready(function () {
    var _token = $('meta[name="csrf-token"]').attr('content');

    $('.like_post').on('click', function(event) {
        event.preventDefault();
        let btn = $(this);
        let _id = btn.data('id');
        
        $.ajax({
            type: "POST",
            url: "/post/like",
            data: {
                _token: _token,
                _id: _id,
            },
            dataType: "JSON",
            success: function (response) {
                btn.toggleClass('active_like').children('.number_post_like').text(response.data.count);
            }
        });
    });

    $('.comment_post').on('click', function(event) {
        event.preventDefault();

        let _id = $(this).data('id');
        $('#id_comment').val(_id);

        $.ajax({
            type: "GET",
            url: "/post/show/"+_id,
            dataType: "JSON",
            success: function (response) {
                // console.log(response);
                let avatar = "";
                let avatarCom = "";
                let content_modal = $('#wrp_get_content_modal');
                let countImagePath = response.data.imagePath.length;

                if(response.data.user.user_info.avatar != null) {
                    avatar = response.data.user.user_info.avatar.includes('https://') ? response.data.user.user_info.avatar : "/storage/"+response.data.user.user_info.avatar;
                }else{
                    avatar = "/workwise/images/resources/user_empty.jpg"
                }
                $('#exampleModalLongTitleComment').html('Bài viết của '+response.data.user.name);
                $('#avater_user_comment').attr('src', avatar);
                $('#title_comment').html(response.data.title);
                $('#time_comment_post').text(handleFormatTime(response.data.created_at, 0));
                $('#tooltip_comment_post').attr('data-original-title', handleFormatTime(response.data.created_at, 1));
                $('#count_like_post').text(response.data.likes.length);

                //Kiểm tra xem bạn đã like bài viết chưa
                if(response.data.checkLike) {
                    $('#com_modal').addClass('active_like');
                }else{
                    $('#com_modal').removeClass('active_like');
                }

                //Hiển thị comment bài viết
                $('#count_comment_post').text(response.data.comments.length);
                $('.list_comment').empty();
                $.each(response.data.comments, function(index, val) {
                    if(val.user.user_info.avatar != null) {
                        avatarCom = val.user.user_info.avatar.includes('https://') ? val.user.user_info.avatar : "/storage/"+val.user.user_info.avatar;
                    }else{
                        avatarCom = "/workwise/images/resources/user_empty.jpg"
                    }
                    $('.list_comment').prepend(
                        '<div class="wrp_comment mb-3">'+
                            '<div class="img_user_comment">'+
                                '<img src="'+avatarCom+'">'
                            +'</div>'+
                            '<div class="wrp_content_comment">'+
                                '<p class="content_comment">'+
                                    '<span class="name_user_comment mb-1 d-block">'+val.user.name+'</span>' + val.content
                                +'</p>'+
                                '<span class="time_comment">'+ handleFormatTime(val.created_at, 1) +'</span>'
                            +'</div>'
                        +'</div>'
                    )
                });

                //Hiển thị ảnh nền bài viết và ảnh bài viết
                content_modal.empty();
                if(response.data.background_post != null) {
                    content_modal.append(
                        '<div style="background-image:url('+response.data.background_post+')" class="background-post">'+
                            response.data.content
                        +'</div>'
                    )
                }else{
                    content_modal.append(
                        '<p id="content">'+response.data.content+'</p>' +
                        '<div class="row list-image-of-post" id="list_image_modal_comment"></div>'
                    )
                    
                    if(countImagePath > 0) {
                        $('#list_image_modal_comment').empty();
                        
                        if(countImagePath == 1 || countImagePath == 2) {
                            let divideImage = parseInt(12/countImagePath);
                            $.each(response.data.imagePath, function(index, val) {
                                $('#list_image_modal_comment').append(
                                    '<div class="col-'+divideImage+' p-0">'+
                                        '<a href="'+val.path+'" data-lightbox="roadtrip-modal-'+response.data.id+'">'+
                                            '<img src="'+val.path+'" class="image-posts type-one-image-'+divideImage+'">'
                                        +'</a>'
                                    +'</div>'
                                )
                            });
                        }else if(countImagePath == 3 || countImagePath == 4) {
                            let divideImage = parseInt(12/(countImagePath-1));
                            $('#list_image_modal_comment').append(
                                '<div class="col-12 p-0">'+
                                    '<a href="'+response.data.imagePath[0].path+'" data-lightbox="roadtrip-modal-'+response.data.id+'">'+
                                        '<img src="'+response.data.imagePath[0].path+'" class="image-posts type-one-image-12">'
                                    +'</a>'
                                +'</div>'
                            )

                            for(let index = 1; index < countImagePath; index++) {
                                $('#list_image_modal_comment').append(
                                    '<div class="col-'+divideImage+' p-0">'+
                                        '<a href="'+response.data.imagePath[index].path+'" data-lightbox="roadtrip-modal-'+response.data.id+'">'+
                                            '<img src="'+response.data.imagePath[index].path+'" class="image-posts type-one-image-6">'
                                        +'</a>'
                                    +'</div>'
                                )
                            }
                        }else if(countImagePath == 5) {
                            $('#list_image_modal_comment').append(
                                '<div class="col-6 p-0" id="list_aw_1"></div>'+
                                '<div class="col-6 p-0" id="list_aw_2"></div>'
                            )
                            for(let index = 0; index < 2; index++) {
                                $('#list_aw_1').append(
                                    '<a href="'+response.data.imagePath[index].path+'" data-lightbox="roadtrip-modal-'+response.data.id+'">'+
                                        '<img src="'+response.data.imagePath[index].path+'" class="image-posts image-list1">'
                                    +'</a>'
                                )
                            }

                            for(let index = 2; index < 5; index++) {
                                $('#list_aw_2').append(
                                    '<a href="'+response.data.imagePath[index].path+'" data-lightbox="roadtrip-modal-'+response.data.id+'">'+
                                        '<img src="'+response.data.imagePath[index].path+'" class="image-posts image-list2">'
                                    +'</a>'
                                )
                            }
                        }
                    }
                    
                }
            }
        });
    });

    $('.area_comment').on('keypress', function(event) {
        let area = $(this);

        if(event.keyCode == 13 && !event.shiftKey) {
            event.preventDefault();
            if(area.val().length == 0) {
                return false;
            }
            let avatar = $('#avatar_comment').attr('src');
            let name = $('#name_comment').text();
            let _id = $('#id_comment').val();
            let content = area.val();
            let timeNow = new Date().toISOString();
            let data = new Date(timeNow);
            
            $.ajax({
                type: "POST",
                url: "/post/comment",
                data: {
                    _token: _token,
                    content: content,
                    _id: _id,
                },
                dataType: "JSON",
                success: function (response) {
                    $('.list_comment').prepend(
                        '<div class="wrp_comment mb-3">'+
                            '<div class="img_user_comment">'+
                                '<img src="'+avatar+'">'
                            +'</div>'+
                            '<div class="wrp_content_comment">'+
                                '<p class="content_comment">'+
                                    '<span class="name_user_comment mb-1 d-block">'+name+'</span>' + content
                                +'</p>'+
                                '<span class="time_comment">'+ handleFormatTime(data, 1) +'</span>'
                            +'</div>'
                        +'</div>'
                    )
        
                    area.val('');
                }
            });
        }
    })

    function handleFormatTime(data, status) {
        let dayName = ['Chủ nhật', 'Thứ Hai', 'Thứ Ba', 'Thứ Tư', 'Thứ Năm', 'Thứ Sáu', 'Thứ Bảy'];
        let time = new Date(data);
        let date = time.getDate() < 10 ? '0'+ time.getDate() :  time.getDate();
        let day = dayName[time.getDay()];
        let month = time.getMonth() + 1 < 10 ? '0'+(time.getMonth() + 1) : (time.getMonth() + 1);
        let year = time.getFullYear();
        let hour = time.getHours() < 10 ? '0'+time.getHours() : time.getHours() ;
        let minute = time.getMinutes() < 10 ? '0'+time.getMinutes() : time.getMinutes();


        if(status == 0) {
            return date + ' Tháng ' + month + ', ' +year;
        }
        return day + ', ' + date + ' Tháng ' + month + ', ' + year + ' lúc ' + hour + ':' + minute; 
    }

    $(".bd-example-modal-lg").on('hide.bs.modal', function(){
        $('#id_comment').val('');
        $('.area_comment').val('');
        $('#wrp_get_content_modal').empty();
    });
});

function check_data(e) {
    let data = $(e).val();

    if (data == '') {
        $(e).removeAttr('style');
    }else{
        e.style.height = (e.scrollHeight) + 'px'
    }
}