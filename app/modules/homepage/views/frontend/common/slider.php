<script type="text/javascript">
    $(document).ready(function () {
        slideShow();
    });
    function slideShow() {
        $('#slider a').css({opacity: 0.0});
        $('.caption a').css({opacity: 1.0});
        $('#slider a:first').css({opacity: 1.0});
        $('#slider .caption').css({opacity: 0.5});
        $('#slider .caption').css({width: $('#slider a').find('img').css('width')});
        $('#slider .content').html($('#slider a:first').find('img').attr('rel')).animate({opacity: 1.0}, 400);
        setInterval('slider()', 6000);
    }
    function slider() {
        var current = ($('#slider a.show') ? $('#slider a.show') : $('#slider a:first'));
        var next = ((current.next().length) ? ((current.next().hasClass('caption')) ? $('#slider a:first') : current.next()) : $('#slider a:first'));
        var caption = next.find('img').attr('rel');
        next.css({opacity: 0.0}).addClass('show').animate({opacity: 1.0}, 1000);
        current.animate({opacity: 0.0}, 1000).removeClass('show');
        $('#slider .caption').animate({opacity: 0.0}, {
            queue: false,
            duration: 0
        }).animate({height: '1px'}, {queue: true, duration: 300});
        $('#slider .caption').animate({opacity: 0.5}, 100).animate({height: '60px'}, 500);
        $('#slider .content').html(caption);
    }</script>
<!--slide-->
    <?php $slide = $this->FrontendSlides_Model->Read('index-slide', $this->fc_lang); ?>
    <?php if (isset($slide) && is_array($slide) && count($slide)) { ?>
    <div class="sli-sho-ico">
        <div id="slider">
            <?php foreach ($slide as $key => $val) { ?>
                <a href="<?php echo $val['url']; ?>" title="<?php echo $val['title']; ?>"><img alt="<?php echo $val['title']; ?>" src="<?php echo $val['image']; ?>" width="1210" height="320"/></a>
            <?php } ?>
        </div>
    </div>
<?php } ?>