$(document).ready(function () {
    var obTitle = $(".name-user-login");
    var newObTitle = $('#info-name-update');
    const oldTitle = obTitle.text();
    var arrayImgUpdate = [];
    var arrayImgChooseDelete = [];
    var countImgChoose = 0;
    var count = 0;
    var backgroundPost = $('.img-bg-update');
    var code_emoji = "";
    var check_in = "";

    getAddressCheckIn();
    // Hiển thị ra các emoji từ file emojis.json
    $.getJSON("/script/json/emojis.json", function(data) {
        $.each(data, function(key, value) {
            // console.log(key);

            $('#list-emojis-update').append(
                '<div class="emojis-update" data-code-emoji="'+ key.slice(1) +'">' +
                '<input type="checkbox" name="emojis" class="ip-choose-emoji-update"> <span class="icon-emoji">' +
                key + '</span> ' + '<span class="name-emoji"> ' + value + '</span>' +
                '</div>'
            )

            $('#wrapper-append-emoji-update').append(
                '<span class="btn-append-emojis-update">'+ key +'</span>'
            )
        });
    });

    //Close form update
    $('#close-frm-update').on('click', function(event){
        event.preventDefault();
        arrayImgUpdate = [];
        arrayImgChooseDelete = [];
        countImgChoose = 0;
        count = 0;
        code_emoji = "";
        check_in = "";
        let emoji = $('.emojis-update');
        let checkIn = $('.address-update');
        let textarea = $('#form-area-pst-update');
        $(".post-popup.job_post").removeClass("active");
        $(".wrapper").removeClass("overlay");
        $('#idPost').val('');
       
        emoji.removeClass('emojis-active-update')
            .children('.ip-choose-emoji-update')
            .prop('checked', false)
            .siblings('.icon-check-emoji').remove();

        checkIn.removeClass('address-active-update')
            .children('.ip-choose-address-check-in-update')
            .prop('checked', false)
            .siblings('.icon-check-emoji').remove();

        addBackgroundPost(null);
        chooseActionBack();
    });

    $(".edit-post").on("click", function (event) { 
        event.preventDefault();
        let _id = $(this).data('post');
        let _token = $('meta[name="csrf-token"]').attr('content');
        let textarea = $('#form-area-pst-update').empty();
        let emoji = $('.emojis-update');
        let checkIn = $('.address-update');
        let preview = $("#list-preview-image-update");
        $('#btn-choose-bg-update, #list-img-bg-update').css({
            "visibility": "unset",
        });
        let status = $('.status-update');
        preview.empty();
        $('#idPost').val(_id);
        $.ajax({
            type: "POST",
            url: "/post/edit",
            data: {
                _token: _token,
                post_id: _id,
            },
            dataType: "JSON",
            success: function (response) {
                // console.log(response);
                newObTitle.html(response.data.title);
                textarea.val(response.data.content);
                // Kiểm tra ảnh nền
                if(response.data.background_post != null) {
                    addBackgroundPost(response.data.background_post);
                    for(let index = 0; index < backgroundPost.length; index++) {
                        if(backgroundPost.eq(index).data('image') == response.data.background_post) {
                            backgroundPost.eq(index).addClass('bg-img-active');
                            backgroundPost.eq(index).siblings().removeClass('bg-img-active');
                            break;
                        }
                    }
                }

                // Kiểm tra emoji bài viết
                if(response.data.emoji != null) {
                    for(let index = 0; index < emoji.length; index++) {
                        if(emoji.eq(index).data('code-emoji') == response.data.emoji.slice(1)) {
                            emoji.eq(index).addClass('emojis-active-update');
                            emoji.eq(index).append('<i class="la la-check icon-check-emoji"></i>');
                            emoji.eq(index).children('.ip-choose-emoji-update').prop('checked', true);
                            emoji.eq(index)
                                .siblings()
                                .removeClass('emojis-active-update')
                                .children('.ip-choose-emoji-update').prop('checked', false)
                                .siblings('.icon-check-emoji').remove();
                            break;
                        }
                    }
                }

                // Kiểm tra địa chỉ check in bài viết
                if(response.data.check_in != null) {
                    for(let index = 0; index < checkIn.length; index++) {
                        if(checkIn.eq(index).children('.name-address').text() == response.data.check_in) {
                            checkIn.eq(index).addClass('address-active-update');
                            checkIn.eq(index).append('<i class="la la-check icon-check-emoji"></i>');
                            checkIn.eq(index).children('.ip-choose-address-check-in-update').prop('checked', true);
                            checkIn.eq(index)
                                    .siblings()
                                    .removeClass('address-active-update')
                                    .children('.ip-choose-address-check-in-update').prop('checked', false)
                                    .siblings('.icon-check-emoji').remove();
                            break;
                        }
                    }
                }

                //Kiểm tra trạng thái của bài viết
                for(let index = 0; index < status.length; index++) {
                    if(status.eq(index).data('status') == response.data.status) {
                        status.eq(index).children('.ip-choose-status-pst-update').prop('checked', true);
                        status.eq(index).addClass('status-active').siblings().removeClass('status-active');
                        let icon_status = status.eq(index).children('.icon-status').children('i').attr('class');
                        let name_status = status.eq(index).children('.name-status').find('span').text();

                        status.eq(index).addClass('status-choose-update').siblings().removeClass('status-choose-update');

                        $('#mode-update').html('<i class="'+ icon_status +'"></i></i>' + name_status);
                        break;
                    }
                }
                // Hiển thị các ảnh của bài viết
                if(response.data.imagePath.length != 0) {
                    countImgChoose = response.data.imagePath.length;
                    $.each(response.data.imagePath, function (indexInArray, valueOfElement) { 
                        preview.prepend(
                            '<div class="border-image"> <i class="la la-times-circle-o btn-delete-image-preview-update" data-id="'+ valueOfElement.id +'"></i> '+
                                '<img src="'+ valueOfElement.path +'">'
                            +'</div>'
                        );
                    });

                    $('#btn-choose-bg-update, #list-img-bg-update').css({
                        "visibility": "hidden",
                    });
                    console.log('Co anh');
                }
            }
        });
        $(".post-popup.job_post").addClass("active");
        $(".wrapper").addClass("overlay");
        $(this).parents('ul').removeClass('active');
    });

    //Chọn biểu cảm
    $(document).on('click', '.emojis-update', function() {
        let emojis = $(this);
        let icon = emojis.children('.icon-emoji').text();
        let name_icon = emojis.children('.name-emoji').text().toLowerCase();

        let ip_address = $('.ip-choose-address-check-in-update').filter(":checked");
        
        // Title cập nhật mới xong khi chọn icon
        let new_text_title = oldTitle + " đang " + icon + " cảm thấy " + name_icon;

        //Hủy Emoji hiện tại
        if(emojis.children('.ip-choose-emoji-update').is(":checked")) {

            emojis.removeClass('emojis-active-update');
            emojis.children('.ip-choose-emoji-update').prop('checked', false);
            emojis.children('.icon-check-emoji').remove();
            
            code_emoji = null;

            if(checkStatusUpdate('.ip-choose-address-check-in-update')) {
                newObTitle.html(oldTitle + " đang ở " + ip_address.siblings('.name-address').text());
            }else{
                newObTitle.html(oldTitle);
                $('#list-emojis-update').scrollTop(0);
            }
        
        //Chọn Emoji mới
        }else{

            emojis.addClass('emojis-active-update');
            emojis.siblings().removeClass('emojis-active-update');

            emojis.children('.ip-choose-emoji-update').prop('checked', true);
            emojis.siblings().children('.ip-choose-emoji-update').prop('checked', false);

            emojis.append('<i class="la la-check icon-check-emoji"></i>')
            emojis.siblings().children('.icon-check-emoji').remove();

            code_emoji = '&'+emojis.data('code-emoji');

            if(checkStatusUpdate('.ip-choose-address-check-in-update')) {
                newObTitle.html(new_text_title + " tại " + ip_address.siblings('.name-address').text());
            }else{
                newObTitle.html(new_text_title);
            }
        }

        chooseActionBack();
    });

    //Chọn nơi check in
    $(document).on('click', '.address-update', function() {
        let address = $(this);
        let name_address = address.children('.name-address').text();

        let ip_emoji = $('.ip-choose-emoji-update').filter(":checked");
        let icon_emoji = ip_emoji.siblings('.icon-emoji').text();
        let name_icon = ip_emoji.siblings('.name-emoji').text().toLowerCase();

        if(address.children('.ip-choose-address-check-in-update').is(":checked")) {
            address.removeClass('address-active-update');
            address.children('.ip-choose-address-check-in-update').prop('checked', false);
            address.children('.icon-check-emoji').remove();

            check_in = null;

            if(checkStatusUpdate('.ip-choose-emoji-update')) {
                newObTitle.html(oldTitle + " đang " + icon_emoji + " cảm thấy " + name_icon);
            }else{
                newObTitle.html(oldTitle);
                $('#list-address-check-in-update').scrollTop(0);
            }

        }else{
            address.addClass('address-active-update');
            address.siblings().removeClass('address-active-update');

            address.children('.ip-choose-address-check-in-update').prop('checked', true);
            address.siblings().children('.ip-choose-address-check-in-update').prop('checked', false);

            address.append('<i class="la la-check icon-check-emoji"></i>')
            address.siblings().children('.icon-check-emoji').remove();

            check_in = name_address;

            if(checkStatusUpdate('.ip-choose-emoji-update')) {
                newObTitle.html(oldTitle + " đang " + icon_emoji + " cảm thấy " + name_icon + " tại " + name_address);
            }else{
                newObTitle.html(oldTitle + " đang ở " + name_address);
            }
        }

        chooseActionBack();
    });

    $('.btn-action-update').on('click', function() {
        let href = $(this).data('href');
        let wrapper = $(this).data('wrapper');
        let formPst = $('#frm-updated-pst');
        let nameMode = $('#mode-name-update');

        $(href+'-update').addClass(wrapper);

        if(href == "#wrapper-emoji") {
            nameMode.text("Bạn đang cảm thấy thế nào ? ");
        }else if(href == "#wrapper-check-in") {
            nameMode.text("Tìm kiếm vị trí");
        }else {
            nameMode.text("Đối tượng của bài viết");
        }

        $('.pst-header-update').prepend(
            '<span id="back-form-ps-update">' +
                '<i class="la la-arrow-circle-left"></i>'
            + '</span>'
        );
        formPst.css({
            "display": "none",
        });
    });

    $('#btn-show-wrp-emojis-update').on('click', function(event) {
        event.stopPropagation();
        $('#wrapper-append-emoji-update').css({
            "display": "flex",
        });
    });

    $(document).on('click', '#back-form-ps-update, #btn-cancel-status-update', function() {
        chooseActionBack();
    });

    $('#btn-choose-bg-update').on('click', function() {
        $('#list-img-bg-update').css({
            'display': 'flex',
        });

        $(this).css({
            'display': 'none',
        });
    });

    $('#btn-back-update').on('click', function() {
        $('#list-img-bg-update').css({
            'display': 'none',
        });

        $('#btn-choose-bg-update').css({
            'display': 'block',
        });
    });

    $('.img-bg-update').on('click', function() {
        let img = $(this).data('image');
        
        addBackgroundPost(img);

        $(this).addClass('bg-img-active');
        $(this).siblings().removeClass('bg-img-active');
    });

    $('#btn-append-images-update').on('click', function() {
        $('#ipt-files-update').trigger('click');
    });

    var uploadBtnUpdate = document.getElementById("ipt-files-update");

    uploadBtnUpdate.addEventListener('change', () => {
        var preview = $("#list-preview-image-update");
        Array.from(uploadBtnUpdate.files).forEach( (file) => {
            count++;
            handleFile(file, file.type, count, preview);
            arrayImgUpdate.push({
                "index": count,
                "file": file,
            });
        })
    });

    $(document).on('click', '.btn-cancel-image-update', function() {
        $("#list-preview-image-update").empty();
        $('#wrp-list-img-update').removeClass('list-preview-img-change-update');
        $(this).parent().remove();
        $('#btn-choose-bg-update, #list-img-bg-update').css({
            "visibility": "unset",
        });
        arrayImgUpdate = [];
        count = 0;
    });

    $(document).on('click', '.btn-delete-image-update', function() {
        let index = $(this).siblings('img').data('index');
        $(this).parent().remove();
        for(let indexOrArray = 0; indexOrArray < arrayImgUpdate.length; indexOrArray++) {
            if(arrayImgUpdate[indexOrArray]['index'] == index) {
                arrayImgUpdate.splice(indexOrArray,1);
                break;
            }
        }

        if(arrayImgUpdate.length <= 0 && countImgChoose == arrayImgChooseDelete.length) {
            $("#list-preview-image-update").empty();
            $('#wrp-list-img-update').removeClass('list-preview-img-change-update');
            $('.btn-cancel-image-update').parent().remove();
            arrayImgUpdate = [];
            count = 0;
        }
    });

    $('.status-update').on('click', function() {
        let status = $(this);
        
        status.children('.ip-choose-status-pst-update').prop('checked', true);
        status.addClass('status-active').siblings().removeClass('status-active');
    });

    $('#btn-choose-status-update').on('click', function(event) {
        event.preventDefault();

        let ip_status = $('.ip-choose-status-pst-update').filter(":checked");
        let icon_status = ip_status.siblings('.icon-status').children('i').attr('class');
        let name_status = ip_status.siblings('.name-status').find('span').text();

        ip_status.parent().addClass('status-choose-update').siblings().removeClass('status-choose-update');

        $('#mode-update').html('<i class="'+ icon_status +'"></i></i>' + name_status);

        chooseActionBack(false);
    });

    $(document).on('click', '.btn-delete-image-preview-update', function() {
        let imgId = $(this).data('id');
        $(this).parent().remove();
        arrayImgChooseDelete.push(imgId);

        if(arrayImgUpdate.length <= 0 && countImgChoose == arrayImgChooseDelete.length) {
            $("#list-preview-image-update").empty();
            $('#wrp-list-img-update').removeClass('list-preview-img-change-update');
            $('.btn-cancel-image-update').parent().remove();
        }
    });
   
    //Submit Update DMMMMM
    $('#frm-updated-pst').on('submit', function(event) {
        event.preventDefault();
        let title = newObTitle.text();
        let status = $('.status-choose-update').data('status');
        let data = new FormData(this);

        data.append('title', title);
        data.append('status', status);
        data.append('emoji', code_emoji);
        data.append('check_in', check_in);

        if($('#form-area-pst-update').hasClass('textarea-cap')) {
            let background = $('.textarea-cap').css('background-image');
            
            let s = background.indexOf('/workwise');
            let e = background.lastIndexOf('.jpg');
            let result = background.slice(s,e+4)
            data.append('background_post', result);
        }

        if(arrayImgUpdate.length > 0) {
            for(let index = 0; index < arrayImgUpdate.length; index++) {
                data.append('file'+index, arrayImgUpdate[index]['file']);
            }
            data.append('totalFiles', arrayImgUpdate.length);
        }

        if(arrayImgChooseDelete.length > 0) {
            var json_arr = JSON.stringify(arrayImgChooseDelete);
            data.append('file_remove', json_arr);
        }

        $.ajax({
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            data: data,
            dataType: "JSON",
            processData: false,
            contentType:false,
            cache: false,
            success: function (response) {
                location.reload();
            }
        });
    });

    $('#form-area-pst-update').on('keyup', function() {
        console.log($(this).val());
        let btnSubmit = $('#btn-submit-frm-update');

        if($(this).val().length > 0) {
            btnSubmit.removeClass('btn-disabled');
            btnSubmit.prop('disabled', false);
        }else{
            btnSubmit.addClass('btn-disabled');
            btnSubmit.prop('disabled', true);
        }
    });

    $(document).on('click', '.btn-append-emojis-update', function(event) {
        event.stopPropagation();
        $('#form-area-pst-update').val( $('#form-area-pst-update').val() + $(this).text() );
    });

    // ------------ Function -----------------------
    function chooseActionBack(action = true) {
        let formPst = $('#frm-updated-pst');
        formPst.css({
            "display": "block",
        });
        $('#back-form-ps-update').remove();
        $('#mode-name-update').text("Chỉnh sửa bài viết ");
        $('#wrapper-emoji-update').removeClass('show-wrapper-emoji-update');
        $('#wrapper-check-in-update').removeClass('show-wrapper-check-in-update');
        $('#wrapper-status-update').removeClass('show-wrapper-status-update');

        if(action) {
            backStatusUpdate();
        }
    }

    function checkStatusUpdate(element) {
        let count = $(element).filter(':checked').length;

        return count > 0 ? true : false;
    }

    function handleFile(file, type, count, preview) {
        if(type.split("/")[0] !== "image") {
            alert("Error");
            return false;
        }
        let reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onloadend = () => {
            
            preview.prepend(
                '<div class="border-image"> <i class="la la-times-circle-o btn-delete-image-update"></i> '+
                    '<img src="'+ reader.result +'" title="'+ file.name +'" data-index="'+ count +'">'
                +'</div>'
            );
        }

        $('#btn-choose-bg-update, #list-img-bg-update').css({
            "visibility": "hidden",
        });

        if($('#wrp-list-img-update').children('.wrp-btn-cancel').length == 0) {
            $('#wrp-list-img-update').addClass('list-preview-img-change-update').prepend(
                '<div class="w-100 wrp-btn-cancel">'+
                    '<i class="la la-times-circle-o btn-cancel-image-update"></i>'
                +'</div>'
            );
        }
    }

    function backStatusUpdate() {
        $('.status-choose-update').children('.ip-choose-status-pst-update')
                            .prop('checked', true).parent()
                            .addClass('status-active')
                            .siblings('.status-update')
                            .removeClass('status-active');
    }

    function addBackgroundPost(img) {
        let textarea = $('#form-area-pst-update');

        if(img == null) {
            textarea.removeAttr('style');
            textarea.removeClass('textarea-cap');

            $('#btn-add-images-update').attr('data-original-title', 'Ảnh/Video')
                                .css({
                                    "cursor": "pointer",
                                })
                                .addClass('img-action-hover-update btn-append-images')
                                .children('img')
                                .css({
                                    "filter": "grayscale(0%)",
                                    "pointer-events": "unset",
                                });
            $('#wrapper-area-update').removeClass('wrp-area');

        }else{
            textarea.addClass('textarea-cap');
            textarea.css({
                'background-image': 'url("' + img + '")',
            });

            $('#btn-add-images-update').attr('data-original-title', 'Không thể kết hợp mục này với những gì bạn đã thêm vào bài viết.')
                                .css({
                                    "cursor": "not-allowed",
                                })
                                .removeClass('img-action-hover-update btn-append-images')
                                .children('img')
                                .css({
                                    "filter": "grayscale(100%)",
                                    "pointer-events": "none",
                                });
            $('#wrapper-area-update').addClass('wrp-area');
        }
    }

    // Hiển thị ra các địa chỉ check in từ file address.json
    function getAddressCheckIn() {
        $.getJSON("/script/json/address.json", function(data) {
            $.each(data.address, function(key, value) {
                $('#list-address-check-in-update').append(
                    '<div class="address-update">' +
                    '<input type="checkbox" name="address" class="ip-choose-address-check-in-update">' +
                    '<span class="icon-address"> <i class="la la-map"></i> </span>' +
                    '<span class="name-address">' + value + '</span>' +
                    '</div>'
                )
            });
            // address.push(data.address);
        });
    };
    // End ready
});