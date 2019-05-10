<main>
    <div class="breadcrumb_pc">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li><a href="<?php echo base_url() ?>">Trang chủ</a></li>
                        <li><a href="javascript:void();">Hỏi đáp</a></li>
                    </ul>
                </div>

            </div>

        </div>

    </div>
    <div class="clearfix-20"></div>
    <section id="news">
        <div class="container">
            <div class="row">


                <div class="col-md-9 col-xs-12 col-sm-8">


                    <h1 style="font-size: 20px;"><b>Hỏi đáp</b></h1>


                    <section id="order" style="background: transparent;padding: 20px 0px">
                        <div class="order_form row" id="border">
                            <form method="post" action="mailsubricreguiyeucau.html" id="sform_chtg">
                                <div class="col-md-12">
                                    <div class="error uk-alert"></div>
                                </div>
                                <div class="col-md-6 col-xs-12 col-sm-6">

                                    <input type="text" placeholder="Họ và tên (Bắt buộc)" class="fullname"
                                           name="fullname">

                                </div>
                                <div class="col-md-6 col-xs-12 col-sm-6">

                                    <input type="text" placeholder="Email" name="email" class="email">

                                </div>
                                <div class="clearfix-10"></div>
                                <div class="col-md-6 col-xs-12 col-sm-6">

                                    <input type="text" placeholder="Số điện thoại (Bắt buộc)" name="phone"
                                           class="phone">

                                </div>
                                <div class="col-md-6 col-xs-12 col-sm-6">

                                    <input type="text" placeholder="Tiêu đề câu hỏi (Bắt buộc)" name="title"
                                           class="title">

                                </div>
                                <div class="clearfix-10"></div>
                                <div class="col-md-12 col-xs-12 col-sm-12">

                                    <textarea placeholder="Chi tiết câu hỏi (Bắt buộc)" name="message"
                                              class="message"></textarea>

                                </div>
                                <div class="col-md-12 col-sm-12 col-sm-12 text-center">
                                    <input type="hidden" name="publish" value="0">
                                    <input type="hidden" name="type" value="0">

                                    <button type="submit" class="fitqa-submit-question">Gửi câu hỏi</button>

                                </div>

                            </form>

                        </div>

                    </section>
                    <div class="clearfix-20"></div>

                    <h1 style="font-size: 20px;color: #0057af"><b>CÂU HỎI THƯỜNG GẶP</b></h1>

                    <div class="clearfix-10"></div>
                    <div class="box_hoidaptl" id="list-items">
                        <input type="hidden" value="1" id="page_items">
                    </div>
                </div>
                <?php $this->load->view('homepage/frontend/common/aside'); ?>
            </div>
        </div>
    </section>
</main>
<div id="load"></div>
<script>
    function pagi_items(page, order){
        $.post('<?php echo site_url("homepage/home/load_items");?>', {page: page, order:order}, function(data){
            var json = JSON.parse(data);
            $('#list-items').html('').html(json.html);
            $('#page_items').attr('value', json.page);
        });
        return false;
    }

    $(document).ready(function(){
        pagi_items(1, 'desc');
        $(document).on('click','#ajax-pagination li a',function(){
            var page = $(this).attr('data-ci-pagination-page');
            pagi_items(page);
            return false;
        });

    });
</script>


<script type="text/javascript" charset="utf-8">
    $(document).ready(function () {
        $('#sform_chtg .error').hide();
        var uri = $('#sform_chtg').attr('action');
        $('#sform_chtg').on('submit', function () {
            var postData = $(this).serializeArray();
            $.post(uri, {
                    post: postData,
                    fullname: $('#sform_chtg .fullname').val(),
                    phone: $('#sform_chtg .phone').val(),
                    title: $('#sform_chtg .title').val(),
                    message: $('#sform_chtg .message').val()
                },
                function (data) {
                    var json = JSON.parse(data);
                    $('#sform_chtg .error').show();
                    if (json.error.length) {
                        $('#sform_chtg .error').removeClass('alert alert-success').addClass('alert alert-danger');
                        $('#sform_chtg .error').html('').html(json.error);
                    } else {
                        $('#sform_chtg .error').removeClass('alert alert-danger').addClass('alert alert-success');
                        $('#sform_chtg .error').html('').html('Gửi câu hỏi thành công!.');
                        $('#sform_chtg').trigger("reset");
                        setTimeout(function () {
                            location.reload();
                        }, 8000);
                    }
                });
            return false;
        });
    });
</script>