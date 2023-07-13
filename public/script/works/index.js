$(document).ready(function () {

    CKEDITOR.replace( 'lg_descirption' );
    CKEDITOR.replace( 'lg_request_other' );
    CKEDITOR.replace( 'lg_benefits_enjoyed' );
    CKEDITOR.replace( 'lg_job_application' );

    $(window).on('scroll', function(e) {
        var doc = document.documentElement;
        var top = (window.pageYOffset || doc.scrollTop)  - (doc.clientTop || 0);
        if(top >= 800) {
            $('#wrp-suggest').addClass('active-suggest');
        }else{
            $('#wrp-suggest').removeClass('active-suggest');
        }
    })

    $('.js-example-basic-single').select2({
        placeholder: "Chọn tối đa 1 ngành nghề",
        allowClear: true,
        "language": {
            "noResults": function () {
                return "Không tìm thấy kết quả ngành nghề: " + $('.select2-search__field').val();
            }
        },
    });

    $.getJSON("/script/json/jobs.json", function (data) {
        $.each(data.jobs, function (index, value) {
            $('.js-example-basic-single').append(
                `<option value="${value}">${value}</option>`
            )
        })
    }
    );

    $('.js-example-basic-single-city').select2({
        placeholder: "Chọn tỉnh thành làm việc",
        allowClear: true,
        "language": {
            "noResults": function () {
                return "Không tìm thấy kết quả tỉnh thành: " + $('.select2-search__field').val();
            }
        },
    });

    $.getJSON("/script/json/address.json", function (data) {
        $.each(data.address, function (index, value) {
            $('.js-example-basic-single-city').append(
                `<option value="${value}">${value}</option>`
            )
        })
    });

    $('.form_item').on('click', function() {

        $(this).siblings('.text_suggest').toggleClass('active');

        $(this).parent().siblings().children('.text_suggest').removeClass('active');
    });

    var validator = $('#formSubmit').validate({
        rules: {
            "lg_title": {
                required: true,
            },
            "lg_cate": {
                required: true,
            },
            "lg_qty": {
                required: true,
                digits: true,
                min: 1,
            },
            "lg_rank": {
                required: true,
            },
            "lg_time_work": {
                required: true,
            },
            "lg_city": {
                required: true,
            },
            "lg_addr": {
                required: true,
            },
            "new_money_min": {
                required: true,
            },
            "new_money_max": {
                required: true,
            }
        },
        messages: {
            "lg_title": {
                required: "Vui lòng tiêu đề vị trí đăng tuyển.",
            },
            "lg_cate": {
                required: "Vui lòng chọn ngành nghề.",
            },
            "lg_qty": {
                required: "Vui lòng nhập số lượng tuyển.",
                digits: "Dữ liệu phải là số nguyên.",
                min: "Số lượng tuyển phải lớn hơn 0.",
            },
            "lg_rank": {
                required: "Vui lòng chọn cấp bậc.",
            },
            "lg_time_work": {
                required: "Vui chọn hình thức làm việc.",
            },
            "lg_city": {
                required: "Vui lòng chọn tỉnh thành làm việc.",
            },
            "lg_addr": {
                required: "Vui lòng nhập địa chỉ làm việc chi tiết.",
            },
            "new_money_min": {
                required: "Vui lòng nhập mức lương phù hợp.",
            },
            "new_money_max": {
                required: "Vui lòng nhập mức lương phù hợp.",
            }
        },

        errorPlacement: function(error, element) {
            var placement = $(element).data('error');
            if (placement) {
                $(placement).text(error.text());
            } else {
                error.insertAfter(element);
            }
        }
    });

    // Form submit create work
    $('#formSubmit').on('submit', function(event) {
        let lg_descirption = CKEDITOR.instances.lg_descirption.getData().length;
        let lg_benefits_enjoyed = CKEDITOR.instances.lg_benefits_enjoyed.getData().length;
        if(!validator.valid()) {
            return false;
        }
        if(!handleValidateMoney()) {
            return false;
        }
        if(lg_descirption <= 0) {
            $('#error_lg_description').text("Vui lòng nhập mô tả công việc.");
            $('html, body').animate({
                scrollTop: ($('#error_lg_description').offset().top - 300)
            }, 500);
            return false;
        }
        if(lg_benefits_enjoyed <= 0) {
            $('#error_lg_benefits_enjoyed').text("Vui lòng nhập quyển lợi được hưởng.");
            $('html, body').animate({
                scrollTop: ($('#error_lg_benefits_enjoyed').offset().top - 300)
           }, 500);
            return false;
        }
    });
    // End form

    $('.enter_ipt').on('keyup', function() {
        $(this).siblings('.form_error').html(`&nbsp;`);
    });
    
    $('.enter_sel').on('change', function() {
        $(this).siblings('.form_error').html(`&nbsp;`);
    });

    var lg_descirption = CKEDITOR.instances.lg_descirption;
    lg_descirption.on( 'key', function( evt ){
        $('#error_lg_description').html(`&nbsp;`);
    });

    var lg_benefits_enjoyed = CKEDITOR.instances.lg_benefits_enjoyed;
    lg_benefits_enjoyed.on( 'key', function( evt ){
        $('#error_lg_benefits_enjoyed').html(`&nbsp;`);
    });

    $('#lg_money').on('change', function() {
        if($(this).val() == 2) {
            $("#new_money_type option[value='4']").remove();
            $('.wrp_new_money_kg').css('display', 'none');
        }else{
            $('#new_money_type').append(
                '<option value="4">Trong khoảng</option>'
            )
        }
    });

    $('#new_money_type').on('change', function() {
        let new_money_type = $(this);
        let wrp_new_money_min = $('.wrp_new_money_min');
        let wrp_new_money_max = $('.wrp_new_money_max');
        let wrp_new_money_kg = $('.wrp_new_money_kg');
        $('#new_money_min').val('');
        $('#new_money_max').val('');
        $('#new_money_kg').prop('disabled', true);
        if(new_money_type.val() == 1) {
            wrp_new_money_min.css('display', 'none')
            wrp_new_money_max.css('display', 'none')
            wrp_new_money_kg.css('display', 'none')
        }else if(new_money_type.val() == 2) {
            wrp_new_money_min.css('display', 'inline-block')
            wrp_new_money_max.css('display', 'none')
            wrp_new_money_kg.css('display', 'none')
        }else if(new_money_type.val() == 3) {
            wrp_new_money_min.css('display', 'inline-block')
            wrp_new_money_max.css('display', 'inline-block')
            wrp_new_money_kg.css('display', 'none')
        }else {
            wrp_new_money_min.css('display', 'none')
            wrp_new_money_max.css('display', 'none')
            wrp_new_money_kg.css('display', 'inline-block')
            $('#new_money_kg').prop('disabled', false);
        }
    });

    // Bắt sự kiện nếu nhập ký tự chữ thì sẽ ngắt sự kiện keypress
    // Chỉ được phép nhập số
    $('#new_money_min').on('keypress', function(event) {
        if (event.which < 48 || event.which > 57)
        {
            event.preventDefault();
        }
    });
    $('#new_money_min').on('keyup', function(event) {
        $('#error_lg_money').html(`&nbsp;`);
        let money = $(this).val().replaceAll('.', '');
        $(this).val(formatMoney(money));
    });

    $('#new_money_max').on('keypress', function(event) {
        if (event.which < 48 || event.which > 57)
        {
            event.preventDefault();
        }
    });
    $('#new_money_max').on('keyup', function(event) {
        $('#error_lg_money').html(`&nbsp;`);
        let money = $(this).val().replaceAll('.', '');
        $(this).val(formatMoney(money));
    });

    // --------- Function ---------------
    function handleValidateMoney() {
        let new_money_min = $('#new_money_min').val().replaceAll('.', '')
        let new_money_max = $('#new_money_max').val().replaceAll('.', '');
        let lg_money = $('#lg_money').val();
        let error_lg_money = $('#error_lg_money');
        let new_money_type = $('#new_money_type').val();
        let check = false;
        error_lg_money.empty();
        if(new_money_type == 2 || new_money_type == 3) {
            
            if(new_money_type == 3) {
                if(parseInt(new_money_min) >= parseInt(new_money_max)) {
                    error_lg_money.text('Vui lòng nhập mức lương phù hợp.');
                    check = true;
                }
            }
            if(lg_money == 1) {
                if(parseInt(new_money_min) < 50000) {
                    error_lg_money.text('Vui lòng nhập mức lương phù hợp (Tối thiểu 50.000 VNĐ)');
                    check = true;
                }
            }

            if(check) {
                $('html, body').animate({
                    scrollTop: ($('#new_money_type').offset().top - 300)
                }, 500);
                return !check;
            }
        }
        error_lg_money.html(`&nbsp;`)
        return true;
    }
});