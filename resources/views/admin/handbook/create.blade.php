@extends('admin.layouts.master')

@section('main-content')
    <main id="content" role="main" class="main">
        <!-- Content -->
        <form action="{{ route('handbook.store') }}" method="POST" id="formCreateHandBook" enctype="multipart/form-data">
            @csrf
            <div class="content container-fluid">
                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h1 class="page-header-title">Tạo mới cẩm nang</h1>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-5 col-12">
                        <h4>Ảnh</h4>
                        <div class="wrapper-img d-flex justify-content-center align-items-center position-relative" id="wrapper-ipt">
                            <div class="wrapper-icon">
                                <i class="bi bi-plus-lg"></i>
                            </div>
                            <input type="file" class="d-none" id="ipt-file" name="file">
                            <div class="wrapper-img__action">
                                <i class="bi bi-arrow-bar-up text-white me-2 action--upload"></i>
                                <i class="bi bi-trash3 action--delete"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7 col-12">
                        <div class="mb-4">
                            <label for="" class="fw-bold mb-2">Tiêu đề</label>
                            <input type="text" id="title" class="form-control" name="title" placeholder="Tiêu đề cẩm nang .....">
                            <span class="text-error">Tiêu đề không được bỏ trống.</span>
                        </div>
                        <div class="mb-4">
                            <label for="" class="fw-bold mb-2">Mô tả</label>
                            <textarea name="description" id="" cols="30" rows="10"  class="form-control"></textarea>
                        </div>
                        <div class="mb-4">
                            <input type="checkbox" name="is_hot" class="form-check-input" />
                            <span>Nổi bật</span>
                        </div>
                        <div class="mb-4">
                            <label for="" class="fw-bold">Trạng thái</label>
                            <div class="bg-input-switches mt-2">
                                <input type="checkbox" name="status" class="w-100 h-100 ip-status" checked>
                                <span class="circle"></span>
                                <span class="bg-switches"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mb-4">
                        <label for="" class="fw-bold my-2 w-100 d-flex align-items-center justify-content-between">Nội dung
                            <span class="text-error m-0 fw-normal">Nội dung không được bỏ trống.</span>
                        </label>
                        <textarea name="content" id="content_handbook" rows="10" cols="80"></textarea>
                    </div>
                    <div class="col-12 d-flex justify-content-end">
                        <button id="btn-submit-frm" class="btn btn-primary">Tạo mới</button>
                    </div>
                </div>
            </div>
        </form>
        <!-- Footer -->
        <div class="footer">
            <div class="row justify-content-between align-items-center">
                <div class="col">
                    <p class="fs-6 mb-0">&copy; WorkWise <span class="d-none d-sm-inline-block">2023
                            DNDev.</span></p>
                </div>
                <!-- End Col -->
            </div>
            <!-- End Row -->
        </div>

        <!-- End Footer -->

        <div id="liveToast" class="position-fixed toast hide" role="alert" aria-live="assertive" aria-atomic="true" style="top: 20px; right: 20px; z-index: 1000;" data-bs-delay="2000">
            <div class="toast-header">
              <div class="d-flex align-items-center">
                <div class="">
                  <h5 class="mb-0 d-flex align-items-center"> <span class="icon-error-toastr me-2"><i class="bi bi-x"></i></span> Lỗi</h5>
                </div>
              </div>
            </div>
            <div class="toast-body">
              
            </div>
          </div>
    </main>
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            CKEDITOR.replace('content_handbook');
            const liveToast = new bootstrap.Toast(document.querySelector('#liveToast'));
            var boolen = true;

            $('#wrapper-ipt').on('click', () => {
                if(boolen) {
                    clickIpt();
                }
            });
            
            $('#ipt-file').on('change', function(e) {
                let file = e.target.files[0];
                let type = file.type;
                let size = file.size;

                if(type.split("/")[0] !== "image") {
                    showToastr("Ảnh không đúng định dạng.");
                    return false;
                }
                if(size > 1000141) {
                    showToastr("Kích thước ảnh phải nhỏ hơn 1MB.");
                    return false;
                }
                let reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onloadend = () => {
                    let image = new Image();
                    image.src = reader.result
                    image.className   = "wrapper-img__src";
                    $('.wrapper-img').children('img').remove()
                    $('.wrapper-img').addClass('wrapper-img-active').prepend(image);
                    boolen = false;
                }
            });

            $('.action--upload').on('click', function() {
                $('#ipt-file')[0].click();
            });

            $('.action--delete').on('click', function() {
                $('#wrapper-img__src').removeAttr('src');
                $('.wrapper-img').removeClass('wrapper-img-active').children('img').remove();
                $('#ipt-file').val('');
                setTimeout(() => {
                    boolen = true;
                }, 1000);
            });

            $("#btn-submit-frm").on('click', function(e) {
                e.preventDefault();
               
                if(isValid()) {
                    $('#formCreateHandBook').submit();
                }
            });

            function showToastr(text) {
                $('.toast-body').text(text);
                liveToast.show();
            }

            function clickIpt() {
                $('#ipt-file')[0].click();
            }

            function isValid() {
                let title = $('#title');
                let content = CKEDITOR.instances.content_handbook.getData().length;
                let error = $('.text-error');


                if(title.val() == "" || title.length == 0) {
                    error.eq(0).css('display','inline-block');
                    return false;
                }

                if(content == 0) {
                    error.eq(1).css('display','inline-block');
                    return false;
                }

                return true;
            }

            $('#title').on('keyup', function() {
                $('.text-error').eq(0).css('display','none');
            });
            CKEDITOR.instances.content_handbook.on( 'key', function( evt ){
                $('.text-error').eq(1).css('display','none');
            });
        });
    </script>
@endsection