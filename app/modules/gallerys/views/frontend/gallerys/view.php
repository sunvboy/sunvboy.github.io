<div class="page-banner"
     style="background:url(<?php echo $this->fcSystem['banner_banner2'] ?>) no-repeat center center;background-size: cover;  ">
    <div class="container">

        <div class="row gutter-0">
            <div class="col-sm-6 col-sm-offset-3">
                <h1 class="banner-title"><?php echo $DetailCatalogues['title'] ?></h1>

                <div class="banner-description">
                    <p>
                        <span style="\&quot;color:" rgb(255,="" 255,="" 255);="" font-family:="" myriadpro,=""
                              sans-serif;="" font-size:="" 22px;="" text-align:="" center;="" background-color:=""
                              rgb(204,="" 204,=""
                              204);\"=""><?php echo strip_tags($DetailCatalogues['description']) ?></span></p>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $(".fancybox").fancybox();
    })
</script>
<style type="text/css">
    .page-category li a:hover {
        color: white
    }
</style>
<div id="section_location" class="">
    <div class="block-top">
        <div class="container">
            <ul class="page-category">
                <li class="active"><a href="#" onclick="return false;"><?php echo $DetailGallerys['title'] ?></a></li>
            </ul>
            <div id="divContent" class="editor-content"></div>
            <div id="album_container" class="">

                <?php $albums = json_decode($DetailGallerys['albums'], TRUE); ?>
                <?php if(isset($albums) && is_array($albums) && count($albums)){ ?>
                    <?php foreach($albums as $key => $val){ ?>

                <div class="album-item grid album-utilities _album_6" data-category="_album_6">

                    <div class="bg"
                         style="background-image: url(<?php echo $val['images'] ?>)"></div>
                    <a title="" href="<?php echo $val['images'] ?>"
                       class="fancybox item-hover fancy-photo" rel="fancy-album-utilities"><span class="title"><?php echo $DetailGallerys['title'] ?></span></a>
                </div>
                <?php } ?>
                <?php } ?>
                <div class="preloader" style="opacity: 0; display: none;"><i class="fa fa-cog fa-spin"
                                                                             style="display: none;"></i></div>
                <div class="preloader" style="opacity: 0; display: none;"><i class="fa fa-cog fa-spin"
                                                                             style="display: none;"></i></div>
            </div>
        </div>
    </div>
</div>