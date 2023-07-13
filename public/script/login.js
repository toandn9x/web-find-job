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

    $("form").on('submit', function (e) { 
        e.preventDefault();

        // $(this).children('#not-account')

        $.ajax({
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            data: new FormData(this),
            dataType: "JSON",
            processData: false,
            contentType: false,
            cache: false,
            success: function (response) {
                if(response.data.code == 500) {
                    toastr.error("Email hoặc mật khẩu không chính xác!","Lỗi");
                }else if(response.data.code == 200) {
                    window.location = "/";
                }else if(response.data.code == 302) {
                    window.location = "/verifiablde-email?email="+response.data.userEmail+"&token="+response.data.userToken;
                }
            }
        });
        
    });

        

    $(document).on('click', '#btn-register', function() {
        $("form").attr('action','/register');

        $("form").children("#label-email").before(
            ' <label for="username" id="label-username">Họ và tên</label>'+
            '<input type="text" name="name" placeholder="Họ và tên" id="username">'
        )

        $("form").children("#password").after(
            ' <label for="confimpassword" id="label-confimpassword">Nhập lại mật khẩu</label>'+
            '<input type="password" name="confimpassword" placeholder="Nhập lại mật khẩu" id="confimpassword">'
        )

        $("form").children("h3").text("Đăng ký tài khoản");

        $("form").children("button").text("Đăng ký");

        $("form").children(".not-account").html("Bạn đã có tài khoản ? <a role='link' aria-disabled='true' id='btn-login'>Đăng nhập</a>");
    });

    $(document).on('click', '#btn-login', function() {
        $("form").attr('action','/login');

        $("form").children("#label-username, #label-confimpassword, #username, #confimpassword").remove();

        $("form").children("h3").text("Đăng nhập");

        $("form").children("button").text("Đăng nhập");

        $("form").children(".not-account").html("Bạn chưa có tài khoản ? <a role='link' aria-disabled='true' id='btn-register'>Đăng ký</a>");
    });
});