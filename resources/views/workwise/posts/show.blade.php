{{-- Modal bình luận bài viết --}}
<div class="modal fade show bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content modal-comment-content">
            <div class="modal-comment-header">
                <h5 class="modal-title" id="exampleModalLongTitleComment">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-comment-body">
                <div class="comment-header-body">
                    <div class="post_topbar">
                        <div class="usy-dt">
                            <img src="" id="avater_user_comment" class="avatar-user-post" alt>
                            <div class="usy-name">
                                <h3 class="fw-bold" id="title_comment">Bạn đang cảm thấy vui vẻ</h3>
                                <span class="created-post" id="tooltip_comment_post" data-bs-toggle="tooltip"
                                    data-placement="bottom" title="">
                                    <img src="/workwise/images/clock.png" alt> <span id="time_comment_post"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="comment-middle-body">
                    <div class="job_descp">
                        <div class="wrp-get-content" id="wrp_get_content_modal">
                        </div>
                    </div>
                </div>
                <div class="job-status-bar mb-4">
                    <ul class="like-com">
                        <li><a href="#" class="com" id="com_modal">
                                <i class="fas fa-heart"></i>
                                Yêu thích <span class="number_post_like" id="count_like_post"></span></a>
                        </li>
                        <li><a href="#" class="com" aria-disabled="true" tabindex="-1"><i
                                    class="fas fa-comment-alt"></i>
                                Bình luận <span class="number_post_like" id="count_comment_post"></span></a></li>
                    </ul>
                </div>
                <div class="list_comment">
                </div>

            </div>
            <div class="modal-comment-footer">
                <div class="wrp_footer_comment">
                    <img src="{{ Auth::user()->userInfo->CheckEmptyImage() }}" class="avatar-user-post"
                        id="avatar_comment" alt>
                    <span class="d-none" id="name_comment">{{ Auth::user()->name }}</span>
                    <input type="hidden" class="d-none" id="id_comment" value="">
                    <textarea name="" class="area_comment" placeholder="Viết bình luận của bạn...." oninput="check_data(this)"></textarea>
                </div>
            </div>
        </div>
    </div>
</div>
