$(document).ready(function () {
    var wrpDefault = $('#wrapper-default');
    var wrpBtnAvatar = $('.wrp-btn-avatar');
    var btnChooseCoverImg = $('#btn-choose-cover-image');
    var avatar = "";
    var coverImage = "";

    $(btnChooseCoverImg).on('click', function() {
        $('#file-change-cover-image').trigger('click');
    });

    $('#file-change-cover-image').on('change', function(event) {
        coverImage = event.target.files[0];

        if(handleVaildTypeImage(coverImage.type)) {
            let src = URL.createObjectURL(coverImage);
            $('#cover-image').attr('src', src);
            wrpDefault.css({
                'display': 'unset',
            });
            btnChooseCoverImg.css({
                'display': 'none',
            });
        }else{
            event.target.value = "";
            coverImage = "";
            toastr.warning("Ảnh bìa không đúng định dạng !");
        }
    });

    $('#btn-choose-avatar').on('click', function() {
        $('#file-change-avatar').trigger('click');
    });

    $('#file-change-avatar').on('change', function(event) {
        avatar = event.target.files[0];

        if(handleVaildTypeImage(avatar.type)) {
            let src = URL.createObjectURL(avatar);
            $('#avatar').attr('src', src);
            wrpBtnAvatar.css({
                'display': 'block',
            });
        }else{
            event.target.value = "";
            avatar = "";
            toastr.warning("Ảnh không đúng định dạng !");
        }
    });

    $('.btn-cancel').on('click', function() {
        let srcImage = $('#cover-image');
        let odlImage = srcImage.data('old-image');
        srcImage.attr('src', odlImage);
        coverImage = "";

        $('#file-change-cover-image').val('');
        wrpDefault.css({
            'display': 'none',
        });
        btnChooseCoverImg.css({
            'display': 'unset',
        });
    });

    $('.btn-agree').on('click', function() {
        let srcImage = $('#cover-image');
        let _token = $('meta[name="csrf-token"]').attr('content');
        let data = new FormData();
        data.append('file', coverImage);
        data.append('_token', _token);
        $.ajax({
            type: "POST",
            url: "/profile/update-cover-image",
            data:data,
            dataType: "JSON",
            processData: false,
            contentType: false,
            cache: false,
            success: function (response) {
                srcImage.data('old-image', srcImage.attr('src'));
                $('#file-change-cover-image').val('');
                coverImage = "";
                wrpDefault.css({
                    'display': 'none',
                });
                btnChooseCoverImg.css({
                    'display': 'unset',
                });
                toastr.success("Cập nhật ảnh bìa thành công.");
            }
        });
    });

    $('.btn-agree-avatar').on('click', function() {
        let avatarImg = $('#avatar');
        let _token = $('meta[name="csrf-token"]').attr('content');
        let data = new FormData();
        data.append('_token', _token);
        data.append('file', avatar);
        $.ajax({
            type: "POST",
            url: "/profile/update-avatar",
            data: data,
            dataType: "JSON",
            processData: false,
            contentType: false,
            cache: false,
            success: function (response) {
                wrpBtnAvatar.css({
                    'display': 'none',
                });
                avatar = "";
                avatarImg.data('old-avatar', avatarImg.src);
                $('#file-change-avatar').val('');
                toastr.success("Cập nhật ảnh thành công.");
            }
        });
    });

    $('.btn-cancel-avatar').on('click', function() {
        let avatarImg = $('#avatar');
        let oldAvatar = avatarImg.data('old-avatar');
        avatarImg.attr('src', oldAvatar);
        avatar = "";
        $('#file-change-avatar').val('');
        wrpBtnAvatar.css({
            'display': 'none',
        });
    });

    // ---------- Function ------------
    function handleVaildTypeImage(file) {
        const validImageTypes = ['image/jpg', 'image/jpeg', 'image/png'];
        if(!validImageTypes.includes(file)) {
            return false;
        }
        return true;
    }
});