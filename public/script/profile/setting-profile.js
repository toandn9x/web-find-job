$(document).ready(function () {
    handleGetAllYears();
    var _token = $('meta[name="csrf-token"]').attr('content');
    var validateChangePassword = $('#change-password').validate({
        onfocusout: false,
        onkeyup: false,
        onclick: false,
        rules: {
            "old-password": {
                required: true,
            },
            "password": {
                required: true,
                minlength: 8
            },
            "repeat-password": {
                required: true,
                equalTo: "#password",
                minlength: 8

            }
        },
        messages: {
            "old-password": {
                required: "Vui lòng nhập mật khẩu cũ.",
            },
            "password": {
                required: "Vui lòng nhập mật khẩu mới.",
                minlength: "Mật khẩu phải ít nhất 8 ký tự."
            },
            "repeat-password": {
                required: "Vui lòng nhập lại mật khẩu.",
                equalTo: "Mật khẩu không trùng khớp.",
                minlength: "Mật khẩu phải ít nhất 8 ký tự."
            }
        },

        errorPlacement: function(error, element) {
            var placement = $(element).data('error');
            console.log(element);
            if (placement) {
              $(placement).append(error)
            } else {
              error.insertAfter(element);
            }
          }
    });

    $('#change-password').on('submit', function(event) {
        event.preventDefault();
        if(!validateChangePassword.valid()) {
            return false;
        }else{
            $.ajax({
                type: $(this).attr('method'),
                url: $(this).attr('action'),
                data: new FormData(this),
                dataType: "JSON",
                processData: false,
                contentType: false,
                cache: false,
                success: function (response) {
                    if(response.code == 1) {
                        $('#errOpC').append(
                            '<label>'+response.message+'</label>'
                        )
                    }else{
                        toastr.success('Thay đổi mật khẩu thành công.');
                        $('.enter-input').val('');
                    }
                }
            });
        }
    });

    $('.enter-input').on('keyup', function() {
        var element = $(this).data('error');
        $(element).children("label:first").remove();

    });

    $('.btn-add-ipt-link').on('click', function() {
        $('.ipt-links').append(
            '<input type="text" class="form-control mt-2 ipt-add-link ipt-append-link" name="links[]" placeholder="Đường dẫn trang web">'
        );
    });

    $('.btn-cancel-add-links').on('click', function() {
        $('.ipt-links').children('.ipt-append-link').remove();
        $.map($('.ipt-add-link'), function(element) {
            element.value = element.getAttribute('data-value-old');
        });
        $('.wrp-add-link, .wrp-get-links').css({
            'display': 'block',
        });
        $('.wrp-ipt-add-link').css({
            'display': 'none',
        });
    });

    $('.wrp-add-link').on('click', function() {
        $(this).css({
            'display': 'none',
        }).siblings('.wrp-get-links').css({
            'display': 'none',
        });
        
        $('.wrp-ipt-add-link').css({
            'display': 'block',
        });
    });

    //Btn chỉnh sửa thông tin cơ bản
    $('.btn-edit').on('click', function() {
        let btn = $(this);
        if(btn.data('info-base') == "edit-date") {
            checkDateOfUser()
        }

        btn.css({
            'display': 'none',
        }).siblings('.hidden-update').css({
            'display': 'none',
        }).siblings('.ipt-edit').css({
            'display': 'block',
        });
    });

    //Btn hủy thay đổi
    $('.btn-cancel-update').on('click', function() {
        let btn = $(this);
        let data = btn.data('info-base');
        let iptAddress = $('#address');
        let iptNickName = $('#nick-name');
        let iptPhone = $('#phone');

        if(data == "edit-address") {
            iptAddress.val(iptAddress.data('val-old'));
        }else if(data == "edit-gender") {
            let textGender = $('.gender-info').text();
            let options = $('#select-gender').find('option');
            $.map(options ,function(option) {
                if(option.text.trim() == textGender.trim()) {
                    option.selected = true;
                }
            });
        }else if(data == "edit-date") {
            let selectYear = $('#years');
            let selectMonth = $('#months');
            let selectDate = $('#dates');

            selectDate.empty();
            selectYear.find('option:not(:empty)').first().prop('selected',true);
            selectMonth.find('option:not(:empty)').first().prop('selected',true);
            selectMonth.css({
                'visibility': 'hidden',
            });
            selectDate.css({
                'visibility': 'hidden',
            });
        }else if(data == "edit-nick-name") {
            iptNickName.val(iptNickName.data('val-old'));
        }else if(data == "edit-phone") {
            iptPhone.val(iptPhone.data('val-old'));
            $('.error-phone').empty();
        }

        btn.parents('.ipt-edit').css({
            'display': 'none',
        }).siblings('.hidden-update').css({
            'display': 'flex',
        });
    });

    //Btn đồng ý thay đổi
    $('.btn-access-update').on('click', function() {
        let btn = $(this);
        let data = btn.data('info-base');
        let dataAjax = new FormData();
        let address = $('#address').val();
        let gender = $('#select-gender').val();
        let nickName = $('#nick-name').val();
        let date = $('#dates').val();
        let month = $('#months').val();
        let year = $('#years').val();
        let birthday = date +'-'+month+'-'+year;
        let phone = $('#phone').val();

        dataAjax.append('_token', _token);

        if(data == "edit-address") {
            handleUpdateAddress();
            dataAjax.append('address', address);
        }else if(data == "edit-gender") {
            handleUpdateGender();
            btn.prop('disabled', true);
            dataAjax.append('gender', gender);
        }else if(data == "edit-date") {
            handleUpdateDate();
            btn.prop('disabled', true);
            dataAjax.append('birthday', birthday);
        }else if(data == "edit-nick-name") {
            handleUpdateNickName();
            dataAjax.append('nick_name', nickName);
        }else if(data == "edit-phone") {
            if(handleCheckPhone(phone)) {
                return false;
            }
            handleUpdatePhone();
            dataAjax.append('phone', phone);
        }

        btn.parents('.ipt-edit').css({
            'display': 'none',
        }).siblings('.hidden-update').css({
            'display': 'flex',
        });

        $.ajax({
            type: "POST",
            url: "/setting-profile/update",
            data: dataAjax,
            dataType: "JSON",
            processData: false,
            contentType: false,
            cache: false,
            success: function (response) {
                toastr.success('Cập nhật thành công.');
            }
        });
    });

    $('#select-gender').on('change', function() {
        let select = $(this);
       
        let infoGender = $('.gender-info');
        let btn = $('.btn-update-gender');
        if(select.find('option:selected').text().trim() != infoGender.text().trim()) {
            btn.prop('disabled', false);
        }else{
            btn.prop('disabled', true);
        }
    });

    $('#years').on('change', function() {
        let selectYear = $(this);
        let selectMonth = $('#months');
        let selectDate = $('#dates');
        let btn = $('.btn-update-date');
        if(selectYear.val() != "null") {
            selectMonth.css({
                'visibility': 'unset',
            });
            if(selectMonth.val() != "null") {
                handleGetDates(selectYear.val(), selectMonth.val());
            }
            if(selectYear.val() != "null" && selectMonth.val() != "null") {
                btn.prop('disabled', false);
            }

        }else{
            selectMonth.css({
                'visibility': 'hidden',
            });
            selectDate.css({
                'visibility': 'hidden',
            });
            selectMonth.find('option:not(:empty)').first().prop('selected',true);
            selectDate.empty();
            btn.prop('disabled', true);
        }
    });

    $('#months').on('change', function() {
        let month = $(this).val();
        let selectDate = $('#dates');
        let year = $('#years').val();
        let btn = $('.btn-update-date');

        if(month != "null") {
            selectDate.css({
                'visibility': 'unset',
            });

            if(year != "null" && month != "null") {
                btn.prop('disabled', false);
            }
        }else{
            selectDate.css({
                'visibility': 'hidden',
            });
            btn.prop('disabled', true);
        }

        handleGetDates(year, month);
    });

    $('#dates').on('change', function() {
        let selectYear = $('#years').val();
        let selectMonth = $('#month').val();
        let btn = $('.btn-update-date');

        if(selectYear != "null" && selectMonth != "null") {
            btn.prop('disabled', false);
        }else{
            btn.prop('disabled', true);
        }
    });

    $('#phone').on('keyup', function() {
        $('.error-phone').empty();
        if($(this).val().length <= 0) {
            $('.btn-update-phone').prop('disabled', true);
        }else{
            $('.btn-update-phone').prop('disabled', false);
        }
    });


    //Ham update duong dan lien ket ca nhan
    $('.btn-access-add-link').on('click', function() {
        let input = $("input[name='links[]']");
        let links = [];
        let check = true;
        let data = new FormData();
        let iptLink = $('.ipt-links');
        let wrpGetLinks = $('.wrp-get-links');

        for(let index = 0; index < input.length; index++) {
            if(input.eq(index).val() != "") {
                if(!validURL(input.eq(index).val())) {
                    check = false;
                    links = [];
                    alert('URL bạn đã cung cấp không hợp lệ. Vui lòng nhập đúng URL và thử lại.')
                    break;
                }
                check = true;
                links.push(input.eq(index).val());
            }
        }

        if(check) {
            data.append('_token', _token);
            data.append('links', JSON.stringify(links));
            $.ajax({
                type: "POST",
                url: "/setting-profile/update",
                data: data,
                dataType: "JSON",
                processData: false,
                contentType: false,
                cache: false,
                success: function (response) {
                    toastr.success('Cập nhật thành công.');
                    iptLink.empty();
                    wrpGetLinks.empty();
                    $.each(links, function(index, value) {
                        iptLink.append(
                            '<div class="info-links d-flex align-items-center">'+
                                `<input type="text" class="form-control mt-2 ipt-add-link" name="links[]" placeholder="Đường dẫn trang web" value="${value}" data-value-old="${value}">`
                            +'</div>'
                        )

                        wrpGetLinks.append(
                            '<div class="info-links d-flex align-items-center mt-2">'+
                            '<img width="24" height="24" src="/workwise/images/icons/Tfkd21nE_8j.png" alt="">' +
                            `<p class="info"> <a href="${value}" target="_blank" class="href-url-link">${value}</a> <span>Trang web</span> </p>`
                            +'</div>'
                        )
                    });
                    $('.wrp-add-link, .wrp-get-links').css({
                        'display': 'block',
                    });
                    $('.wrp-ipt-add-link').css({
                        'display': 'none',
                    });
                }
            });
        }
    });

    // ------Function-----------
    function handleUpdateAddress() {
        let iptAddress = $('#address');
        let textAddress = $('.address-contact-info');
        if(iptAddress.val() == "") {
            textAddress.text("Đang cập nhật");
        }else {
            textAddress.text(iptAddress.val());
        }
        iptAddress.data('val-old', iptAddress.val());
    }

    function handleUpdateGender() {
        let select = $('#select-gender').find('option:selected');
        let infoGender = $('.gender-info');
        let iconGender = $('.img-icon-gender');

        infoGender.text(select.text());
        iconGender.attr('src', select.data('img-gender'));
    }

    function handleUpdateDate() {
        let selectYear = $('#years');
        let selectMonth = $('#months');
        let selectDate = $('#dates');

        $('#year').text(selectYear.val());
        $('#month').text(selectMonth.val());
        $('#date').text(selectDate.val());

        selectDate.empty();
        selectYear.find('option:not(:empty)').first().prop('selected',true);
        selectMonth.find('option:not(:empty)').first().prop('selected',true);
        selectMonth.css({
            'visibility': 'hidden',
        });
        selectDate.css({
            'visibility': 'hidden',
        });
    }

    function handleUpdateNickName() {
        let iptNickName = $('#nick-name');
        let textNickName = $('.nick-name-info');
        if(iptNickName.val() == "") {
            textNickName.text("Đang cập nhật");
        }else {
            textNickName.text(iptNickName.val());
        }
        iptNickName.data('val-old', iptNickName.val());
    }

    function handleGetDates(year, month) {
        let selectDate = $('#dates');

        let firstDay = new Date(year, month-1, 1);
        let lastDay = new Date(year, month, 0);
        selectDate.empty();
        for(let i = firstDay.getDate(); i <= lastDay.getDate(); i++) {
            selectDate.append(
                '<option value="'+i+'">'+ i +'</option>'
            )
        }
    }

    function handleGetAllYears() {
        let firstYear = 1900;
        let nowYear = new Date().getFullYear();
        let selectYear = $('#years');

        for (let i = firstYear; i <= nowYear; i++) {
            selectYear.append(
                `<option value="${i}">${i}</option>`
            )
        }
    }
    //Hàm kiểm tra người dùng có thông tin ngày sinh chưa
    //Rồi so sánh ngày sinh với các cột năm,tháng,ngày tương ứng
    function checkDateOfUser() {
        let selectYear = $('#years');
        let selectMonth = $('#months');
        let selectDate = $('#dates');
        let year = $('#year').text();
        let month = $('#month').text();
        let date = $('#date').text();

        if(year != "" && month != "" && date != "") {
            handleGetDates(year, month);
            selectMonth.css({
                'visibility': 'unset',
            });
            selectDate.css({
                'visibility': 'unset',
            });
            $.map(selectYear.find('option') ,function(option) {
                if(option.value.trim() == year.trim()) {
                    option.selected = true;
                }
            });
            $.map(selectMonth.find('option') ,function(option) {
                if(option.value.trim() == month.trim()) {
                    option.selected = true;
                }
            });
            $.map(selectDate.find('option') ,function(option) {
                if(option.value.trim() == date.trim()) {
                    option.selected = true;
                }
            });
        }
    }

    function handleUpdatePhone() {
        let iptPhone = $('#phone');
        $('.phone-info').text(iptPhone.val());
        iptPhone.data('val-old', iptPhone.val());
    }

    //Hàm kiểm tra định dạng link URL
    function validURL(str) {
        var pattern = new RegExp('^(https?:\\/\\/)?'+ // protocol
          '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}|'+ // domain name
          '((\\d{1,3}\\.){3}\\d{1,3}))'+ // OR ip (v4) address
          '(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*'+ // port and path
          '(\\?[;&a-z\\d%_.~+=-]*)?'+ // query string
          '(\\#[-a-z\\d_]*)?$','i'); // fragment locator
        return !!pattern.test(str);
    }

    function handleCheckPhone(phone) {
        let regex = /(0)[0-9]{9}/;
        let errorPh = $('.error-phone');
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