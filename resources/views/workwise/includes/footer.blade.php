<script type="text/javascript" src="/workwise/js/jquery.min.js"></script>
<script type="text/javascript" src="/workwise/js/popper.js"></script>
<script type="text/javascript" src="/workwise/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/workwise/js/jquery.mCustomScrollbar.js"></script>
<script type="text/javascript" src="/workwise/lib/slick/slick.min.js"></script>
<script type="text/javascript" src="/workwise/js/scrollbar.js"></script>
<script type="text/javascript" src="/workwise/js/script.js"></script>
<script src="/toastr/toastr.min.js"></script>
<script src="/lightbox/lightbox.min.js"></script>
<script src="/sweetalert2/sweetalert2.min.js"></script>
<script src="/ckeditor/ckeditor.js"></script>
<script src="/workwise/js/validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
<script src="/untils/helper.js"></script>
<script src="/swiper/swiper.js"></script>
<script>
    $(document).ready(function() {
        $('[data-bs-toggle="tooltip"]').tooltip();
        // $(window).on('scroll', function() {
        //     $('header').toggleClass('header_fixed', window.scrollY > 100);
        // })
    });
</script>
<script>
    lightbox.option({
        'albumLabel': "",
    });
</script>
@if (Session::has('success'))
    <script>
        toastr.success("{!! Session::get('success') !!}");
    </script>
@endif
