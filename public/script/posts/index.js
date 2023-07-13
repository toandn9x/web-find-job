$(document).ready(function() {
    var address = [];
    var ob_title = $("#info-name");
    var arrayImg = [];
    var count = 0;
    var code_emoji = "";
    var check_in = "";

    //Title cũ trước khi được cập nhật
    const old_title = ob_title.text();

    getAddressCheckIn();

    $(document).on('click', '.emojis', function() {
        let emojis = $(this);
        let icon = emojis.children('.icon-emoji').text();
        let name_icon = emojis.children('.name-emoji').text().toLowerCase();

        let ip_address = $('.ip-choose-address-check-in').filter(":checked");
        
        // Title cập nhật mới xong khi chọn icon
        let new_text_title = old_title + " đang " + icon + " cảm thấy " + name_icon;

        //Hủy Emoji hiện tại
        if(emojis.children('.ip-choose-emoji').is(":checked")) {

            emojis.removeClass('emojis-active');
            emojis.children('.ip-choose-emoji').prop('checked', false);
            emojis.children('.icon-check-emoji').remove();
            
            code_emoji = null;

            if(checkStatus('.ip-choose-address-check-in')) {
                ob_title.html(old_title + " đang ở " + ip_address.siblings('.name-address').text());
            }else{
                ob_title.html(old_title);
                $('#list-emojis').scrollTop(0);
            }
        
        //Chọn Emoji mới
        }else{

            emojis.addClass('emojis-active');
            emojis.siblings().removeClass('emojis-active');

            emojis.children('.ip-choose-emoji').prop('checked', true);
            emojis.siblings().children('.ip-choose-emoji').prop('checked', false);

            emojis.append('<i class="la la-check icon-check-emoji"></i>')
            emojis.siblings().children('.icon-check-emoji').remove();

            code_emoji = '&'+emojis.data('code-emoji');

            if(checkStatus('.ip-choose-address-check-in')) {
                ob_title.html(new_text_title + " tại " + ip_address.siblings('.name-address').text());
            }else{
                ob_title.html(new_text_title);
            }
        }

        chooseAction();
    });

    $(document).on('click', '.address', function() {
        let address = $(this);
        let name_address = address.children('.name-address').text();

        let ip_emoji = $('.ip-choose-emoji').filter(":checked");
        let icon_emoji = ip_emoji.siblings('.icon-emoji').text();
        let name_icon = ip_emoji.siblings('.name-emoji').text().toLowerCase();

        if(address.children('.ip-choose-address-check-in').is(":checked")) {
            address.removeClass('address-active');
            address.children('.ip-choose-address-check-in').prop('checked', false);
            address.children('.icon-check-emoji').remove();

            check_in = null;

            if(checkStatus('.ip-choose-emoji')) {
                ob_title.html(old_title + " đang " + icon_emoji + " cảm thấy " + name_icon);
            }else{
                ob_title.html(old_title);
                $('#list-address-check-in').scrollTop(0);
            }

        }else{
            address.addClass('address-active');
            address.siblings().removeClass('address-active');

            address.children('.ip-choose-address-check-in').prop('checked', true);
            address.siblings().children('.ip-choose-address-check-in').prop('checked', false);

            address.append('<i class="la la-check icon-check-emoji"></i>')
            address.siblings().children('.icon-check-emoji').remove();

            check_in = name_address;

            if(checkStatus('.ip-choose-emoji')) {
                ob_title.html(old_title + " đang " + icon_emoji + " cảm thấy " + name_icon + " tại " + name_address);
            }else{
                ob_title.html(old_title + " đang ở " + name_address);
            }
        }

        chooseAction();
    });

    $('.status').on('click', function() {
        let status = $(this);
        
        status.children('.ip-choose-status-pst').prop('checked', true);
        status.addClass('status-active').siblings().removeClass('status-active');
    });

    $('.btn-action').on('click', function() {
        let href = $(this).data('href');
        let wrapper = $(this).data('wrapper');
        let formPst = $('#frm-created-pst');
        let nameMode = $('#mode-name');

        $(href).addClass(wrapper);

        if(href == "#wrapper-emoji") {
            nameMode.text("Bạn đang cảm thấy thế nào ? ");
        }else if(href == "#wrapper-check-in") {
            nameMode.text("Tìm kiếm vị trí");
        }else {
            nameMode.text("Đối tượng của bài viết");
        }

        $('#pst-header').prepend(
            '<span id="back-form-ps">' +
                '<i class="la la-arrow-circle-left"></i>'
            + '</span>'
        );
        formPst.css({
            "display": "none",
        });

    });

    $(document).on('click', '#back-form-ps, #btn-cancel-status', function() {
        chooseAction();
    });

    // Tìm kiếm địa chỉ check in
    $('#ip-search-address').on('keyup', function() {
        let val = $(this).val();
        let arr = address[0].filter(el => el.toLowerCase().normalize("NFD").replace(/\p{Diacritic}/gu, "").includes(val.toLowerCase().normalize("NFD").replace(/\p{Diacritic}/gu, "")));

        $('#list-address-check-in').empty();
        
        $.each(arr, function(key, value) {
            $('#list-address-check-in').append(
                '<div class="address">' +
                '<input type="checkbox" name="address" class="ip-choose-address-check-in">' +
                '<span class="icon-address"> <i class="la la-map"></i> </span>' +
                '<span class="name-address">' + value + '</span>' +
                '</div>'
            )
        });
        // console.log(arr);
    });

    // Hiển thị ra các emoji từ file emojis.json
    $.getJSON("/script/json/emojis.json", function(data) {
        $.each(data, function(key, value) {
            // console.log(key);
            $('#list-emojis').append(
                '<div class="emojis" data-code-emoji="'+ key.slice(1) +'">' +
                '<input type="checkbox" name="emojis" class="ip-choose-emoji"> <span class="icon-emoji">' +
                key + '</span> ' + '<span class="name-emoji"> ' + value + '</span>' +
                '</div>'
            )

            $('#wrapper-append-emoji').append(
                '<span class="btn-append-emojis">'+ key +'</span>'
            )

        });
    });

    // Hiển thị ra các địa chỉ check in từ file address.json
    function getAddressCheckIn() {
        $.getJSON("/script/json/address.json", function(data) {
            $.each(data.address, function(key, value) {
                $('#list-address-check-in').append(
                    '<div class="address">' +
                    '<input type="checkbox" name="address" class="ip-choose-address-check-in">' +
                    '<span class="icon-address"> <i class="la la-map"></i> </span>' +
                    '<span class="name-address">' + value + '</span>' +
                    '</div>'
                )

                $('#list-address-check-in-update').append(
                    '<div class="address-update">' +
                    '<input type="checkbox" name="address" class="ip-choose-address-check-in-update">' +
                    '<span class="icon-address"> <i class="la la-map"></i> </span>' +
                    '<span class="name-address">' + value + '</span>' +
                    '</div>'
                )
            });

            address.push(data.address);
        });
    };

    // Hàm quay lại chế độ tạo mới bài viết
    function chooseAction(action = true) {
        let formPst = $('#frm-created-pst');
        formPst.css({
            "display": "block",
        });
        $('#back-form-ps').remove();
        $('#mode-name').text("Tạo bài viết ");
        $('#wrapper-emoji').removeClass('show-wrapper-emoji');
        $('#wrapper-check-in').removeClass('show-wrapper-check-in');
        $('#wrapper-status').removeClass('show-wrapper-status');

        if(action) {
            backStatus();
        }
    }

    $('#btn-choose-status').on('click', function(event) {
        event.preventDefault();

        let ip_status = $('.ip-choose-status-pst').filter(":checked");
        let icon_status = ip_status.siblings('.icon-status').children('i').attr('class');
        let name_status = ip_status.siblings('.name-status').find('span').text();

        ip_status.parent().addClass('status-choose').siblings().removeClass('status-choose');

        $('#mode').html('<i class="'+ icon_status +'"></i></i>' + name_status);

        chooseAction(false);
    });

    // DMMMMMMM
    $('#frm-created-pst').on('submit', function(e) {
        e.preventDefault();
        let title = ob_title.text();
        let status = $('.status-choose').data('status');
        let data = new FormData(this);

        data.append('title', title);
        data.append('status', status);
        data.append('emoji', code_emoji);
        data.append('check_in', check_in);

        if($('#form-area-pst').hasClass('textarea-cap')) {
            let background = $('.textarea-cap').css('background-image');
            
            let s = background.indexOf('/workwise');
            let e = background.lastIndexOf('.jpg');
            let lol = background.slice(s,e+4)
            data.append('background_post', lol);
        }

        if(arrayImg.length > 0) {
            for(let index = 0; index < arrayImg.length; index++) {
                data.append('file'+index, arrayImg[index]['file']);
            }
            data.append('totalFiles', arrayImg.length);
        }

        $.ajax({
            type: $(this).attr("method"),
            url: $(this).attr("action"),
            data: data,
            dataType: "JSON",
            processData: false,
            contentType: false,
            cache: false,
            success: function (response) {
                location.reload();
            }
        });
    });

    $('#btn-choose-bg').on('click', function() {
        $('#list-img-bg').css({
            'display': 'flex',
        });

        $(this).css({
            'display': 'none',
        });
    });

    $('#btn-back').on('click', function() {
        $('#list-img-bg').css({
            'display': 'none',
        });

        $('#btn-choose-bg').css({
            'display': 'block',
        });
    });

    $('.img-bg').on('click', function() {
        let img = $(this).data('image');
        let textarea = $('#form-area-pst');

        if(img == null) {
            textarea.removeAttr('style');
            textarea.removeClass('textarea-cap');

            $('#btn-add-images').attr('data-original-title', 'Ảnh/Video')
                                .css({
                                    "cursor": "pointer",
                                })
                                .addClass('img-action-hover btn-append-images')
                                .children('img')
                                .css({
                                    "filter": "grayscale(0%)",
                                    "pointer-events": "unset",
                                });
            $('#wrapper-area').removeClass('wrp-area');

        }else{
            textarea.addClass('textarea-cap');
            textarea.css({
                'background-image': 'url("' + img + '")',
            });

            $('#btn-add-images').attr('data-original-title', 'Không thể kết hợp mục này với những gì bạn đã thêm vào bài viết.')
                                .css({
                                    "cursor": "not-allowed",
                                })
                                .removeClass('img-action-hover btn-append-images')
                                .children('img')
                                .css({
                                    "filter": "grayscale(100%)",
                                    "pointer-events": "none",
                                });
            $('#wrapper-area').addClass('wrp-area');
        }

        $(this).addClass('bg-img-active');
        $(this).siblings().removeClass('bg-img-active');
    });

    $('#btn-show-wrp-emojis').on('click', function(event) {
        event.stopPropagation();
        $('#wrapper-append-emoji').css({
            "display": "flex",
        });
    });

    $(document).on('click', '.btn-append-emojis', function(event) {
        event.stopPropagation();
        $('#form-area-pst').val( $('#form-area-pst').val() + $(this).text() );
    });

    $('#form-area-pst').on('keyup', function() {
        let btnSubmit = $('#btn-submit-frm');

        if($(this).val().length > 0) {
            btnSubmit.removeClass('btn-disabled');
            btnSubmit.prop('disabled', false);
        }else{
            btnSubmit.addClass('btn-disabled');
            btnSubmit.prop('disabled', true);
        }
    });

    //Bắt sự kiện khi con trỏ click ra ngoài đối tượng
    $(window).click(function() {
        $('#wrapper-append-emoji').css({
            "display": "none",
        });

        $('#wrapper-append-emoji-update').css({
            "display": "none",
        });
        $('.edit-post').parents('ul').removeClass('active');
      });

    $('#btn-append-images').on('click', function() {
        $('#ipt-files').trigger('click');
    });
    
    // ------ Function ---------

    // Hàm kiểm người dùng có thêm trạng thái vào bài viết không
    // VD: emoji, địa điểm check in, .....
    //Tham số element chuyền vào là class của thẻ input trạng thái
    function checkStatus(element) {
        let count = $(element).filter(':checked').length;

        return count > 0 ? true : false;
    }

    //Hàm quay lại trạng thái đăng bài trước đó khi người dùng hủy thao tác chọn trạng thái
    function backStatus() {
        $('.status-choose').children('.ip-choose-status-pst')
                            .prop('checked', true).parent()
                            .addClass('status-active')
                            .siblings('.status')
                            .removeClass('status-active');
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
                '<div class="border-image"> <i class="la la-times-circle-o btn-delete-image"></i> '+
                    '<img src="'+ reader.result +'" title="'+ file.name +'" data-index="'+ count +'">'
                +'</div>'
            );
        }

        $('#btn-choose-bg, #list-img-bg').css({
            "visibility": "hidden",
        });

        if($('#wrp-list-img').children('.wrp-btn-cancel').length == 0) {
            $('#wrp-list-img').addClass('list-preview-img-change').prepend(
                '<div class="w-100 wrp-btn-cancel">'+
                    '<i class="la la-times-circle-o btn-cancel-image"></i>'
                +'</div>'
            );
        }
    }
      
    var uploadBtn = document.getElementById("ipt-files");
    
    uploadBtn.addEventListener('change', () => {
        var preview = $("#list-preview-image");
        Array.from(uploadBtn.files).forEach( (file) => {
            count++;
            handleFile(file, file.type, count, preview);
            arrayImg.push({
                "index": count,
                "file": file,
            });
        })
    });

    $(document).on('click', '.btn-cancel-image', function() {
        $("#list-preview-image").empty();
        $('#wrp-list-img').removeClass('list-preview-img-change');
        $(this).parent().remove();
        $('#btn-choose-bg, #list-img-bg').css({
            "visibility": "unset",
        });
        arrayImg = [];
        count = 0;
    });

    $(document).on('click', '.btn-delete-image', function() {
        let index = $(this).siblings('img').data('index');
        $(this).parent().remove();

        for(let indexOrArray = 0; indexOrArray < arrayImg.length; indexOrArray++) {
            if(arrayImg[indexOrArray]['index'] == index) {
                arrayImg.splice(indexOrArray,1);
                break;
            }
        }

        if(arrayImg.length <= 0) {
            $("#list-preview-image").empty();
            $('#wrp-list-img').removeClass('list-preview-img-change');
            $('.btn-cancel-image').parent().remove();
            arrayImg = [];
            count = 0;
        }
    });
    
});     //End ready