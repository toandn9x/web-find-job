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

    $('#form-check-verifiable-email').on('submit', function(e) {
        e.preventDefault();
        
        $.ajax({
            type: $(this).attr("method"),
            url: $(this).attr('action'),
            data: new FormData(this),
            dataType: "JSON",
            processData: false,
            contentType: false,
            cache: false,
            success: function (response) {
                if(response.data.code == 500) {
                    toastr.error(response.data.message);
                }else if(response.data.code == 200) {
                    window.location = "/";
                }
            }
        });
    });

    $("#btn-send-agian-mail").on('click', function() {
        // alert("HELLO WORLD");
        $.ajax({
            type: "GET",
            url: "/send-again-email",
            dataType: "JSON",
            success: function (response) {
                
            }
        });
    })
});