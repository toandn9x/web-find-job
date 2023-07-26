$(document).ready(function () {
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-center",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }

    var validateLogin = $('#login').validate({
        onfocusout: false,
        onkeyup: false,
        onclick: false,
        rules: {
            "email": {
                required: true,
                email: true,
            },
            "password": {
                required: true,
                minlength: 8
            },
        },
        messages: {
            "email": {
                required: "Vui lòng nhập email.",
                email: "Email không đúng định dạng.",
            },
            "password": {
                required: "Vui lòng nhập mật khẩu.",
                minlength: "Mật khẩu phải ít nhất 8 ký tự."
            },
        },

        errorPlacement: function(error, element) {
            var placement = $(element).data('error');
            if (placement) {
              $(placement).append(error)
            } else {
              error.insertAfter(element);
            }
          }
    });
    
    $('#login').on('submit', function(event) {
        event.preventDefault();

        if(!validateLogin.valid()) {
            return false;
        }else{
            $.ajax({
                method: $(this).attr('method'),
                url: $(this).attr('action'),
                data: new FormData(this),
                dataType: "JSON",
                processData: false,
                contentType: false,
                cache: false,
                success: function (response) {
                    
                    if(response.data.status == 1) {
                        toastr.error(response.data.message);
                    }else if(response.data.status == 0) {
                        window.location = "/";
                    }
                }
            });
        }
    })

    var validateRegister = $('#register').validate({
        onfocusout: false,
        onkeyup: false,
        onclick: false,
        rules: {
            "name": {
                required: true,
            },
            "email": {
                required: true,
                email: true,
            },
            "password": {
                required: true,
                minlength: 8
            },
            "repeat-password": {
                required: true,
                equalTo: "#password",
                minlength: 8
            },
            "company": {
                required: true,
            },
            "phone": {
                required: true,
                minlength: 10,
                maxlength: 11,
            },
            "address": {
                required: true,
            }
        },
        messages: {
            "name": {
                required: "Vui lòng nhập họ và tên.",
            },
            "email": {
                required: "Vui lòng nhập email.",
                email: "Email không đúng định dạng.",
            },
            "password": {
                required: "Vui lòng nhập mật khẩu.",
                minlength: "Mật khẩu phải ít nhất 8 ký tự."
            },
            "repeat-password": {
                required: "Vui lòng nhập lại mật khẩu.",
                equalTo: "Mật khẩu không trùng khớp.",
                minlength: "Mật khẩu phải ít nhất 8 ký tự."
            },
            "company": {
                required: "Vui lòng nhập tên công ty.",
            },
            "phone": {
                required: "Vui lòng nhập số điện thoại liên hệ.",
                min: "Số điện thoại phải ít nhất 10 kí tự.",
                max: "Số điện thoại nhiều nhất 11 kí tự."
            },
            "address": {
                required: "Vui lòng nhập địa chỉ."
            }
        },

        errorPlacement: function(error, element) {
            var placement = $(element).data('error');
            if (placement) {
              $(placement).append(error)
            } else {
              error.insertAfter(element);
            }
          }
    });
    $('#register').on('submit', function(event) {
        event.preventDefault();
        let phone = $('#phone').val();
        console.log(phone);
        if(!validateRegister.valid()) {
            return false;
        }
        if(typeof(phone) != 'undefined') {
            if(checkPhone(phone)) {
                $('#errPh').append('<label>Số điện thoại không đúng định dạng.</label>');
                return false;
            }
        }
        $.ajax({
            method: $(this).attr('method'),
            url: $(this).attr('action'),
            data: new FormData(this),
            dataType: "JSON",
            processData: false,
            contentType: false,
            cache: false,
            success: function (response) { 
                if(response.data.status == 1) {
                    $('#errEmR').append('<label>'+ response.data.error +'</label>');
                }else if(response.data.status == 0 ) {
                    toastr.success(response.data.message);

                    $('.form-auth')[1].reset();
                    $('#tab-1, #li-tab-1').addClass('current');
                    $('#tab-2, #li-tab-2').removeClass('current');
                }
            }
        });
    });

    var validateForgetPass = $('#forgetPassword').validate({
        onfocusout: false,
        onkeyup: false,
        onclick: false,
        rules: {
            "email": {
                required: true,
                email: true,
            },
        },
        messages: {
            "email": {
                required: "Vui lòng nhập email.",
                email: "Email không đúng định dạng.",
            },
        },

        errorPlacement: function(error, element) {
            var placement = $(element).data('error');
            if (placement) {
              $(placement).append(error)
            } else {
              error.insertAfter(element);
            }
          }
    });

    $('#forgetPassword').on('submit', function(event) {
        event.preventDefault();

        if(!validateForgetPass.valid()) {
            return false;
        }

        $('#wrp_loading').css('display', 'flex');
        $.ajax({
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            data: new FormData(this),
            dataType: "JSON",
            processData: false,
            contentType: false,
            cache: false,
            success: function (response) {
                if(response.data.status == 1) {
                    $('#errFgEmR').append('<label>'+ response.data.error +'</label>');
                }else{
                    toastr.success('Mật khẩu đã được khôi phục vui lòng kiểm tra email của bạn.');
                    $('#wrp_loading').css('display', 'none');
                    $('.form-auth')[2].reset();
                    $('#tab-1, #li-tab-1').addClass('current');
                    $('#tabForgetPass').removeClass('current');
                }
            }
        });
    })
   
    $(document).on('keyup', '.enter-input', function() {
        var element = $(this).data('error');
        $(element).children("label:first").remove();
    });

    $('.tab-current').on('click', function() {
        let iptCompany = $('#wrp-company');
        let iptPhone = $('#wrp-phone');
        let iptAddress = $('#wrp-address');
        if(!$(this).parent('li').hasClass('current')) {
            $('.form-auth')[0].reset();
            $('.form-auth')[1].reset();
            $('.error-register').children("label").remove();
            iptCompany.empty();
            iptPhone.empty();
            iptAddress.empty();
        }   
    });

    $('.checkbox-choose-role').on('change', function() {
        let ipt = $(this);
        let iptCompany = $('#wrp-company');
        let iptPhone = $('#wrp-phone');
        let iptAddress = $('#wrp-address');
        if(ipt.hasClass('employer')) {
            iptCompany.append(
                '<div class="sn-field">'+
                '<i class="la la-building"></i>'+
                '<input type="text" name="company" class="enter-input" id="company" placeholder="Tên công ty" data-error="#errCPN">'
                +'</div>'+
                '<span id="errCPN" class="error-register">&nbsp;</span>'
            )

            iptPhone.append(
                '<div class="sn-field">'+
                '<i class="la la-phone"></i>'+
                ' <input type="text" name="phone" class="enter-input" id="phone" placeholder="Số điện thoại liên hệ với công ty" data-error="#errPh">'
                +'</div>'+
                '<span id="errPh" class="error-register">&nbsp;</span>'
            )

            iptAddress.append(
                '<div class="sn-field">'+
                '<i class="la la-map-marker"></i>'+
                '<input type="text" name="address" id="address" class="enter-input" placeholder="Địa chỉ công ty" data-error="#errAddr">'
                +'</div>'+
                '<span id="errAddr" class="error-register">&nbsp;</span>'
            )
        }else{
            iptCompany.empty();
            iptPhone.empty();
            iptAddress.empty();
        }
        $('.error-register').children("label").remove();
    });

    $('#btnForgetPass').on('click', function(event) {
        event.preventDefault();

        $('#tabForgetPass').addClass('current');
        $('#tab-1, #tab-2, #li-tab-1, #li-tab-2').removeClass('current');
    })

    // Function
    function checkPhone(number) {
        let regex = /(0)[0-9]{9}/;

        if(!number.match(regex)) {
            return true;
        }
        return false;
    }
});