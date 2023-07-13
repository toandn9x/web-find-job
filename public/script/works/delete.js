$(document).ready(function () {
    $('.btn_delete_job').on('click', function(event) {
        let form = $(this).closest("form");
        event.preventDefault();
        Swal.fire({
            title: 'Xóa tin?',
            text: "Bạn có chắc muốn xóa bài tin này không! Nếu xóa bạn không thể khôi phục lại được bài tin.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Xóa',
            cancelButtonText: 'Hủy'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        })
    })
});