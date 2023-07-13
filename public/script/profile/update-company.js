$(document).ready(function () {
    var iptChooseLogo = $('#ipt-choose-logo');
    var logo = "";
    var _token = $('meta[name="csrf-token"]').attr('content');

    CKEDITOR.replace( 'editor1' );

    $('.img-logo-company').on('click', function() {
        iptChooseLogo[0].click();
    });

    iptChooseLogo.on('change', (event) => {
        logo = event.target.files[0];

        if(handleVaildTypeImage(logo.type)) {
            let src = URL.createObjectURL(logo);
            $('#logo-company').attr('src', src);
           
        }else{
            event.target.value = "";
            logo = "";
            toastr.warning("Ảnh không đúng định dạng !");
        }

        $('.wrp-btn-update-logo').css({
            'display': 'block',
        });
    });

    $('.btn-cancel-update-logo').on('click', () => {
        let imgLogo = $('#logo-company');
        imgLogo.attr('src', imgLogo.data('old'));
        iptChooseLogo.val('');
        logo = ""
        $('.wrp-btn-update-logo').css({
            'display': 'none',
        });
    });

    $('.btn-access-update-logo').on('click', () => {
        const id = $('#idCompany').val();
        let imgLogo = $('#logo-company');
        let data = new FormData();
        data.append('file', logo);
        data.append('id', id);
        data.append('_token', _token);

        $.ajax({
            type: "POST",
            url: "/company/update-image",
            data: data,
            dataType: "JSON",
            processData: false,
            contentType: false,
            cache: false,
            success: function (response) {
                imgLogo.data('old', imgLogo.attr('src'));
                $('.wrp-btn-update-logo').css({
                    'display': 'none',
                });
                toastr.success("Cập nhật thành công.");
            }
        });
    });

    $('.btn-cancel-update-company').on('click', function() {
        let btn = $(this);
        let data = btn.data('info-base');
        let iptPhone = $('#phone-company');
        let iptName = $('#name-company');
        let iptAddress = $('#address-company');

        if(data == "edit-phone") {
            iptPhone.val(iptPhone.data('val-old'));
            $('.error-phone-company').empty();
            btn.siblings('.btn-access-update-company').prop('disabled', false);
        }else if(data == "edit-name") {
            iptName.val(iptName.data('val-old'));
            btn.siblings('.btn-access-update-company').prop('disabled', false);
        }else if(data == "edit-address") {
            iptAddress.val(iptAddress.data('val-old'));
            btn.siblings('.btn-access-update-company').prop('disabled', false);
        }

        btn.parents('.ipt-edit').css({
            'display': 'none',
        }).siblings('.hidden-update').css({
            'display': 'flex',
        });
    });

    $('#name-company').on('keyup', function() {
        if($(this).val().length <= 0) {
            $('.btn-update-name-company').prop('disabled', true);
        }else{
            $('.btn-update-name-company').prop('disabled', false);
        }
    });

    $('#address-company').on('keyup', function() {
        if($(this).val().length <= 0) {
            $('.btn-update-address-company').prop('disabled', true);
        }else{
            $('.btn-update-address-company').prop('disabled', false);
        }
    });

    $('#phone-company').on('keyup', function() {
        if($(this).val().length <= 0) {
            $('.btn-update-phone-company').prop('disabled', true);
        }else{
            $('.btn-update-phone-company').prop('disabled', false);
        }
    });

    $('.btn-access-update-company').on('click', function() {
        let btn = $(this);
        let data = btn.data('info-base');
        const idCompnay = $('#idCompany').val();
        let introduce = CKEDITOR.instances.editor1.getData().length > 0 ? CKEDITOR.instances.editor1.getData() : null;
        let name = $('#name-company').val();
        let phone = $('#phone-company').val();
        let address = $('#address-company').val();

        let dataAjax = new FormData();
        dataAjax.append('_token', _token);
        dataAjax.append('id', idCompnay);
         
        if(data == "edit-name") {
            handleUpdateName();
            dataAjax.append('name', name);
        }else if(data == "edit-address") {
            handleUpdateAddress();
            dataAjax.append('address', address);
        }else if(data == "edit-phone") {
            if(handleCheckPhoneCompany(phone)) {
                return false;
            }
            handleUpdatePhone();
            dataAjax.append('phone', phone);
        }else if(data == "edit-introduce") {
            handleUpdateIntroduce();
            dataAjax.append('introduce', introduce);
            $('.btn-edit-introduce').css({
                'display': 'block',
            });
            $('.content-introduce').css({
                'display': 'block',
            });
            $('.wrp-edit-intro').css({
                'display': 'none',
            });
        }

        btn.parents('.ipt-edit').css({
            'display': 'none',
        }).siblings('.hidden-update').css({
            'display': 'flex',
        });

        $.ajax({
            type: "POST",
            url: "/company/update",
            data: dataAjax,
            dataType: "JSON",
            processData: false,
            contentType: false,
            cache: false,
            success: function (response) {
                toastr.success("Cập nhật thành công.");
            }
        });
    });

    $('.btn-edit-introduce').on('click', function() {
        let btn = $(this);

        btn.css({
            'display': 'none',
        });
        $('.content-introduce').css({
            'display': 'none',
        });
        $('.wrp-edit-intro').css({
            'display': 'block',
        });
    });

    $('.btn-cancel-update-intro').on('click', function() {
        let textArea = $('#editor1');

        CKEDITOR.instances.editor1.setData(textArea.data('val-old'));

        $('.btn-edit-introduce').css({
            'display': 'block',
        });
        $('.content-introduce').css({
            'display': 'block',
        });
        $('.wrp-edit-intro').css({
            'display': 'none',
        });
    });
    
    $('#phone-company').on('keyup', function() {
        $('.error-phone-company').empty();
        if($(this).val().length <= 0) {
            $('.btn-update-phone-company').prop('disabled', true);
        }else{
            $('.btn-update-phone-company').prop('disabled', false);
        }
    });

    // ---------- Function ------------
    function handleVaildTypeImage(file) {
        const validImageTypes = ['image/jpg', 'image/jpeg', 'image/png'];
        if(!validImageTypes.includes(file)) {
            return false;
        }
        return true;
    }

    function handleUpdateName() {
        let iptName = $('#name-company');
        let textNameCompany = $('.name-company-info');

        textNameCompany.text(iptName.val());
        iptName.data('val-old', iptName.val());
    }

    function handleUpdateAddress() {
        let iptAddress = $('#address-company');
        let textAddressCompany = $('.address-company-info');

        textAddressCompany.text(iptAddress.val());
        iptAddress.data('val-old', iptAddress.val());
    }

    function handleUpdatePhone() {
        let iptPhone = $('#phone-company');
        let textPhoneCompany = $('.phone-company-info');

        textPhoneCompany.text(iptPhone.val());
        iptPhone.data('val-old', iptPhone.val());
    }

    function handleUpdateIntroduce() {
        let data = CKEDITOR.instances.editor1.getData();

        $('#editor1').data('val-old', data);
        if(data.length <= 0) {
            $('.content-introduce').html('<p>Đang cập nhật....</p>');
        }else{
            $('.content-introduce').html(data);
        }
    }

    function handleCheckPhoneCompany(phone) {
        let regex = /(0)[0-9]{9}/;
        let errorPh = $('.error-phone-company');
        if(!phone.match(regex)) {
            errorPh.text('Số điện thoại không đúng định dạng.');
            return true;
        }else if(phone.length < 10 || phone.length > 11) {
            errorPh.text('Số điện thoại không đúng định dạng.');
            return true;
        }
        return false;
    }
});