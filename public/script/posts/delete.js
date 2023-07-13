$(document).ready(function () {
    // alert("DELETE POST SUCCESS");
    $('.delete-post').on('click', function (event) {
        event.preventDefault();
        Swal.fire({
            title: 'Chuyển vào thùng rác?',
            text: "Các bài viết sẽ được chuyển vào thùng rác. Bạn có thể xóa bài viết này khỏi thùng rác sớm hơn hoặc khôi phục lại bài viết này bằng cách đi đến nhật ký hoạt động trong phần cài đặt.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Chuyển',
            cancelButtonText: 'Hủy'
        }).then((result) => {
            if (result.isConfirmed) {
                let deleteBtn = $(this);
                let _id = deleteBtn.data('post');
                deleteBtn.parents('.post-bar').remove();
                $.ajax({
                    type: "POST",
                    url: deleteBtn.attr('href'),
                    data: {
                        post_id: _id,
                        _token: $('meta[name="csrf-token"]').attr('content'),
                    },
                    dataType: "JSON",
                    success: function (response) {
                        location.reload();
                    }
                });
            }
        })
    });
});