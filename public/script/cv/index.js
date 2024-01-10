$(document).ready(function () {
    var _token = $('meta[name="csrf-token"]').attr('content');

    $('.btn-upload-cv').on('click', function () {
        $('.ipt-upload-cv')[0].click();
    });

    $('.ipt-upload-cv').on('change', function (e) {
        let file = e.target.files[0];
        // console.log(file.type);
        // return false;
        let typeFile = file.type.includes('pdf');
        let data = new FormData();
        data.append('file', file);
        data.append('_token', _token);
        if (!typeFile) {
            alert("File không đúng định dạng pdf");
        } else {
            $.ajax({
                type: "POST",
                url: "/cv/upload",
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                dataType: "JSON",
                success: function (response) {
                    if (response.code == 0) {
                        toastr.success("Cập nhật thành công.");
                        location.reload();
                    }else {
                        alert("Error Server");
                    }
                }
            });
        }
    });

    $('.sub-cv').on('click', function () {
        let id = $(this).data('id');

        $.ajax({
            type: "POST",
            url: "/cv/upload-main-cv",
            data: {
                _token: _token,
                id: id,
            },
            dataType: "json",
            success: function (response) {
                if (response.code == 0) {
                    location.reload();
                    toastr.success("Cập nhật thành công.");
                } else {
                    alert("Error Server");
                }
            }
        });
    });

    $('.button-apply').on('click', function () {
        let name = $(this).data('name');
        let idJob = $(this).data('id');

        Swal.fire({
            title: 'Ứng tuyển?',
            text: `Bạn có chắc muốn ứng tuyển vào công việc ${name} . `,
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ứng tuyển',
            cancelButtonText: 'Hủy'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "/cv/apply-job",
                    data: {
                        _token,
                        idJob
                    },
                    dataType: "json",
                    success: function (response) {
                        if (response.code == 1) {
                            toastr.success(response.message);
                        } else if (response.code == 0) {
                            toastr.success("Ứng tuyển thành công.");
                        } else {
                            Swal.fire({
                                title: 'Nhắc nhở?',
                                html: response.message + ' <a href="/cv">Tải CV</a>',
                                icon: 'info',
                            })
                        }
                    }
                });
            }
        })
    });

    $('.btn-on-find-work').on('click', function () {
        let valueJobs = $('.js-example-basic-multiple').select2("val");
        let valueAddress = $('.js-example-basic-multiple-city').select2("val");
        if (valueJobs == null) {
            alert("Vui lòng chọn ngành nghề.");
            return false;
        }
        if (valueAddress == null) {
            alert("Vui lòng chọn địa chỉ việc làm.");
            return false;
        }

        $.ajax({
            type: "POST",
            url: "/cv/find-job",
            data: {
                _token,
                jobs: JSON.stringify(valueJobs),
                address: JSON.stringify(valueAddress),
            },
            dataType: "JSON",
            success: function (response) {
                if (response.code == 0) {
                    Swal.fire({
                        text: `Đã bật trạng thái tìm việc. `,
                        icon: 'success',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $('.btn-close-modal').click();
                            $('.ipt-find').prop('checked', true);
                            $('.ipt-find').removeAttr('data-toggle');
                            $('.ipt-find').removeAttr('data-target');
                            $('.title-status-cv').text('Trạng thái tìm việc đang bật');
                        }
                    });
                }else if(response.code == 1) {
                    Swal.fire({
                        text: response.message,
                        icon: 'error',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $('.ipt-find').prop('checked', false);
                        }
                    });
                }
            }
        });
    });

    $('.btn-close-modal').on('click', function () {
        $('.ipt-find').prop('checked', false);
    });

    $('.ipt-find').on('change', function () {
        if (!$(this).is(":checked")) {
            Swal.fire({
                text: `Bạn có chắc muốn tắt trạng thái tìm việc không . `,
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Tắt',
                cancelButtonText: 'Hủy'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "get",
                        url: "/user/update-status-cv",
                        dataType: "json",
                        success: function (response) {
                            if (response.code == 0) {
                                $('.ipt-find').attr('data-toggle', 'modal');
                                $('.ipt-find').attr('data-target', '#exampleModalCenter');
                                $('.title-status-cv').text('Đã Tắt Trạng Thái Tìm Việc');
                            }
                        }
                    });
                }else if(result.isDismissed) {
                    $(this).prop('checked', true);
                }
            })
        }
    });

    $('.js-example-basic-multiple').select2({
        placeholder: "Chọn ngành nghề",
        allowClear: true,
        "language": {
            "noResults": function () {
                return "Không tìm thấy kết quả ngành nghề: " + $('.select2-search__field').val();
            }
        },
    });

    $('.js-example-basic-multiple-city').select2({
        placeholder: "Chọn tỉnh thành làm việc",
        allowClear: true,
        "language": {
            "noResults": function () {
                return "Không tìm thấy kết quả tỉnh thành: " + $('.select2-search__field').val();
            }
        },
    });

    $.getJSON("/script/json/jobs.json", function (data) {
        $.each(data.jobs, function (index, value) {
            let check = '';
            for (let index = 0; index < $('.jobs').length; index++) {
                if (value == $('.jobs').eq(index).val()) {
                    check = 'selected';
                    break;
                }
            }
            $('.js-example-basic-multiple').append(
                `<option value="${value}" ${check}>${value}</option>`
            )
        })
    });

    $.getJSON("/script/json/address.json", function (data) {
        $.each(data.address, function (index, value) {
            let check = '';
            for (let index = 0; index < $('.address').length; index++) {
                if (value == $('.address').eq(index).val()) {
                    check = 'selected';
                    break;
                }
            }
            $('.js-example-basic-multiple-city').append(
                `<option value="${value}" ${check}>${value}</option>`
            )
        })
    });
});