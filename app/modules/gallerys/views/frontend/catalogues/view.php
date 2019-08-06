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

<div id="section_location" class="">
    <div class="block-top">
        <div class="container">
            <ul class="page-category">
                <li class="active"><a href="#" onclick="return false;"><?php echo $DetailCatalogues['title'] ?></a></li>
            </ul>
            <div id="divContent" class="editor-content"></div>
            <div id="album_container" class="">

                <?php if (isset($gallerysList) && is_array($gallerysList) && count($gallerysList)) { ?>
                <?php $i = 0; foreach ($gallerysList as $keyp => $val) { $i++;?>
                <?php
                $title = $val['title'];
                $href = rewrite_url($val['canonical'], $val['slug'], $val['id'], 'gallerys');
                $image = getthumb($val['images'], FALSE);

                ?>
                <div class="album-item grid album-utilities _album_6" >

                    <div class="bg"
                         style="background-image: url(<?php echo $image ?>)"></div>
                    <a title="<?php echo $title ?>" href="<?php echo $href ?>"
                       class="fancybox item-hover fancy-photo" rel="fancy-album-utilities"><span class="title"><?php echo $title ?></span></a>
                </div>
                    <?php } ?>
                <?php } ?>
            </div>
        </div>
    </div>
</div>