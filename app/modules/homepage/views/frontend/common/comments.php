<div class="form-details">

    <div class="error uk-alert"></div>
    <form id="rateform" action="<?php echo site_url('comments/ajax/comments/addcomment'); ?>" method="post"
          class="uk-form form">
        <span>Bình luận</span>
        <textarea rows="6" name="message" id="rate-content"></textarea>

        <div class="list-input">
            <div class="input-lable">
                <label>Họ và tên <span>*</span></label>
                <input type="text" name="fullname" id="rate-name">
            </div>
            <div class="input-lable">
                <label>Email <span>*</span></label>
                <input type="text" name="phone" id="rate-phone">
            </div>
        </div>
        <button type="submit">Phản Hồi</button>

    </form>
    <div class="entry-comments" id="comments">
        <ul class="comment-list">
        </ul>

    </div>

</div>


<style>
    .comment-list li.depth-1 {
        padding: 0px 20px !important;
        background-color: #f5f5f5;
        border-right: 0;
        margin-top: 10px;
        width: 100%;
        float: left;
        list-style-type: none;
    }

    .comment-header {
        font-size: 15px;
    }
    .entry-comments .comment-author {
        width: 48px;
        float: left;
        margin: 0 16px 5px 0;
    }
    .comment-author-link,.comment-time-link{
        background-color: inherit;
        color: #ff5722;
        font-weight: 400;
        text-decoration: none;
        word-wrap: break-word;
    }

    .comment-content {
        clear: both;
        word-wrap: break-word;
    }

    .comment-content p {
        font-size: 16px;
    }

    .comment-reply a {
        background-color: #ff5722;
        color: #fff;
        cursor: pointer;
        display: inline-block;
        padding: 5px 10px;
        font-size: 20px;
        float: right;
    }
    .comment-meta{
        margin-top: 20px;
    }
    .comment-list li li {
        padding: 32px;
        padding-top: 0px !important;
    }
    .comment-author img{
        border-radius: 50%;
    }
    p {
        margin-top: 0;
        margin-bottom: 10px;
    }
    .form-details .button {
        background-color: #ff5722;
        border: 0;
        color: #fff !important;
        cursor: pointer;
        font-family: sans-serif;
        padding: 13px 20px;
        white-space: normal;
        width: auto;
        text-transform: uppercase;
        font-size: 14px;
        font-weight: bold;
        margin-top: 20px;
    }
</style>


<script type="text/javascript">
    $(function () {
        $('.error').hide();
        var module = '<?php echo $module ?>';
        var moduleid = '<?php echo $moduleid ?>';
        listComment(module, moduleid, $('.comment-list').attr('data-page'));

        var uri = $('#rateform').attr('action');
        $('#rateform').on('submit', function () {
            var postData = $(this).serializeArray();
            var fullname = $('#rate-name').val();
            var phone = $('#rate-phone').val();
            var contents = $('#rate-content').val();
            $.post(uri, {
                    post: postData,
                    module: module,
                    moduleid: moduleid,
                    fullname: fullname,
                    contents: contents,
                    phone: phone
                },
                function (data) {
                    var json = JSON.parse(data);
                    $('.error').show();
                    if (fullname == '') {
                        $('#rate-name').addClass('required');
                    }
                    if (phone == '') {
                        $('#rate-name').addClass('required');
                    }
                    if (contents == '') {
                        $('#rate-content').addClass('required');
                    }
                    if (json.error.length) {
                        $('.error').removeClass('alert alert-success').addClass('alert alert-danger');
                        $('.error').html('').html(json.error);
                    } else {
                        $('.error').removeClass('alert alert-danger').addClass('alert alert-success');
                        $('.error').html('').html('Gửi bình luận thành công!.');
                        $('#rateform').trigger("reset");
                        setTimeout(function () {
                            window.location.href = '<?php echo $canonical ?>';
                        }, 3000);
                    }
                });
            return false;
        });
        $(document).on('click', '.ajax-pagination .uk-pagination li a', function () {
            var page = $(this).attr('data-ci-pagination-page');
            listComment(module, moduleid, page);
            return false;
        });
    });
    function listComment(module, moduleid, page) {
        var uri = '<?php echo site_url('comments/ajax/comments/listComment'); ?>';
        $.post(uri, {
                module: module, moduleid: moduleid, page: page
            },
            function (data) {
                var json = JSON.parse(data);
                $('.comment-list').html(json.html);
            });
    }
    $(document).on('click', '.item-reply', function () {
        $('.reply-comment').html('');
        var id = $(this).attr('data-id');
        var item = '<div class="error_comm uk-alert"></div>' +
            '<span class="phanhop">Phản hồi</span><textarea rows="6" id="content_comm" class="txt-reply-comm"></textarea>' +
            '<input name="parentid" id="parentid" value="' + id + '" type="hidden">' +
            '<div class="list-input"><div class="input-lable"><label>Email <span>*</span></label><input class="info-contact-comm" id="email_comm" placeholder="Email" type="text"></div>' +
            '<div class="input-lable"><label>Họ và tên <span>*</span></label><input class="info-contact-comm" id="name_comm" placeholder="Họ và tên bạn" type="text"></div>' +
            '<a class="button send-comment" title="Bấm vào đây để gửi bình luận">Phản hồi</a></div>';
        $(this).parent().next().append(item);
        $('.error_comm').hide();
        return false;
    });




    $(document).on('click', '.send-comment', function () {
        var module = '<?php echo $module ?>';
        var moduleid = '<?php echo $moduleid ?>';
        var parentid = $('#parentid').val();
        var contents = $('#content_comm').val();
        var email = $('#email_comm').val();
        var fullname = $('#name_comm').val();
        var uri = 'comments/ajax/comments/addcomment';
        $(this).html('Đang xử lý');
        $.post(uri, {
                module: module,
                moduleid: moduleid,
                fullname: fullname,
                email: email,
                contents: contents,
                parentid: parentid
            },
            function (data) {
                var json = JSON.parse(data);
                $('.error_comm').show();
                if (fullname == '') {
                    $('#review-info').show();
                    $('#name_comm').addClass('required');
                }
                if (email == '') {
                    $('#review-info').show();
                    $('#email_comm').addClass('required');
                }
                if (contents == '') {
                    $('#content_comm').addClass('required');
                }
                if (json.error.length) {
                    $('.error_comm').removeClass('alert alert-success').addClass('alert alert-danger');
                    $('.error_comm').html('').html(json.error);
                } else {
                    $('.error_comm').removeClass('alert alert-danger').addClass('alert alert-success');
                    $('.error_comm').html('').html('Gửi phản hồi thành công!.');
                    setTimeout(function () {
                        window.location.href = '<?php echo $canonical ?>';
                    }, 3000);
                }
            });
        return false;
    });
</script>
