<section class="content-header">
    <h1>Thêm sản phẩm mới</h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin'); ?>"><i class="fa fa-dashboard"></i> Bảng điều khiển</a></li>
        <li><a href="<?php echo site_url('products/backend/products/view'); ?>">sản phẩm</a></li>
        <li class="active"><a href="<?php echo site_url('products/backend/products/create'); ?>">Thêm sản phẩm mới</a>
        </li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <form class="hidden-form" style="display:none;" id="cat-form" method="post" action="">
            <input type="text" value="" id="str"/>
        </form>
        <form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
            <div class="col-md-9">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab-info" data-toggle="tab">Thông tin cơ bản</a></li>
                        <li class=""><a href="#tab-album" data-toggle="tab">Album</a></li>
<!--                        <li class=""><a href="#tab-tour" data-toggle="tab">Tour info </a></li>-->
                        <li class=""><a href="#tab-rooms" data-toggle="tab">Voucher </a></li>
                        <!--                                                <li><a href="#tab-album-list" data-toggle="tab">Album thư viện ảnh</a></li>-->
                        <!--                                                <li><a href="#tab-album-list3" data-toggle="tab">Feature</a></li>-->
<!--                        <li><a href="#tab-album-list4" data-toggle="tab">Thông tin</a></li>-->
                    </ul>
                    <div class="tab-content">
                        <div class="box-body">
                            <?php $error = validation_errors();
                            echo !empty($error) ? '<div class="callout callout-danger">' . $error . '</div>' : ''; ?>
                        </div>
                        <!-- /.box-body -->
                        <div class="tab-pane active" id="tab-info">
                            <div class="box-body">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label tp-text-left">Tên sản phẩm</label>

                                    <div class="col-sm-8">
                                        <?php echo form_input('title', set_value('title', $DetailProducts['title']), 'class="form-control form-static-link" placeholder="sản phẩm"'); ?>
                                    </div>
                                    <div class="col-sm-2"><span class="btn btn-primary create-static-links">Tạo liên kết tĩnh</span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label tp-text-left">Liên kết</label>
                                    <label class="col-sm-3 control-label tp-text-left"><?php echo base_url(); ?></label>

                                    <div class="col-sm-5">
                                        <?php echo form_input('canonical', set_value('canonical', $DetailProducts['canonical']), 'class="form-control canonical" placeholder="Liên kết"'); ?>
                                        <?php echo form_hidden('canonical_original', $DetailProducts['canonical']); ?>
                                    </div>
                                    <div class="col-sm-2" style="line-height: 34px;font-weight: 600;">.html</div>
                                </div>

                                <div class="form-group hide">
                                    <label class="col-sm-2 control-label tp-text-left">Chủ đề</label>

                                    <div class="col-sm-10">
                                        <?php echo form_dropdown('tagsid[]', $this->BackendTags_Model->Dropdown(), (isset($tagsid) ? $tagsid : NULL), 'class="form-control select2" multiple="multiple" style="width: 100%;" id="tagsid"'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label tp-text-left">Tiêu đề SEO</label>

                                    <div class="col-sm-10">
                                        <?php echo form_input('meta_title', set_value('meta_title', $DetailProducts['meta_title']), 'class="form-control" placeholder="Tiêu đề SEO"'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label tp-text-left">Từ khóa SEO</label>

                                    <div class="col-sm-10">
                                        <?php echo form_input('meta_keyword', set_value('meta_keyword', $DetailProducts['meta_keyword']), 'class="form-control" placeholder="Từ khóa SEO"'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label tp-text-left">Mô tả SEO</label>

                                    <div class="col-sm-10">
                                        <?php echo form_textarea('meta_description', set_value('meta_description', $DetailProducts['meta_description']), 'class="form-control" placeholder="Mô tả SEO" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"'); ?>
                                    </div>
                                </div>
                                <div class="attribute-list">
                                    <?php if (isset($attr) && is_array($attr) && count($attr)) { ?>
                                        <?php if (isset($attribute_catalogues) && is_array($attribute_catalogues) && count($attribute_catalogues)) { ?>
                                            <?php foreach ($attribute_catalogues as $key => $val) { ?>
                                                <?php if (in_array($val['id'], $cat_checked['attribute_catalogue']) == FALSE) continue; ?>
                                                <div class="form-group">
                                                    <label
                                                        class="col-sm-2 control-label tp-text-left"><?php echo $val['title']; ?></label>

                                                    <div class="col-sm-10">
                                                        <div class="checkbox">
                                                            <?php if (isset($val['attributes']) && is_array($val['attributes']) && count($val['attributes'])) { ?>
                                                                <?php foreach ($val['attributes'] as $keyAttr => $valAttr) { ?>
                                                                    <?php
                                                                    if (isset($cat_checked['attribute'][$val['keyword']]) && in_array($valAttr['id'], $cat_checked['attribute'][$val['keyword']]) == false) continue;
                                                                    ?>
                                                                    <label class="tpInputLabel" style="width: 168px;">
                                                                        <input name="attr[<?php echo $valAttr['id'] ?>]"
                                                                               type="checkbox"
                                                                               class="tpInputCheckbox" <?php echo((isset($attr) && in_array($valAttr['id'], $attr)) ? 'checked' : '') ?>
                                                                               value="<?php echo $valAttr['id'] ?>"/>
                                                                        <span><?php echo $valAttr['title']; ?></span>
                                                                    </label>
                                                                <?php } ?>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        <?php } ?>
                                    <?php } else { ?>
                                        <?php if (isset($attribute_catalogues) && is_array($attribute_catalogues) && count($attribute_catalogues)) { ?>
                                            <?php if (isset($_static_cat_checked['attribute_catalogue']) && is_array($_static_cat_checked['attribute_catalogue']) && count($_static_cat_checked['attribute_catalogue'])) { ?>
                                                <?php foreach ($attribute_catalogues as $key => $val) { ?>
                                                    <?php if (in_array($val['id'], $_static_cat_checked['attribute_catalogue']) == FALSE) continue; ?>
                                                    <div class="form-group">
                                                        <label
                                                            class="col-sm-2 control-label tp-text-left"><?php echo $val['title']; ?></label>

                                                        <div class="col-sm-10">
                                                            <div class="checkbox">
                                                                <?php if (isset($val['attributes']) && is_array($val['attributes']) && count($val['attributes'])) { ?>
                                                                    <?php foreach ($val['attributes'] as $keyAttr => $valAttr) { ?>
                                                                        <?php
                                                                        if (isset($_static_cat_checked['attribute'][$val['keyword']]) && in_array($valAttr['id'], $_static_cat_checked['attribute'][$val['keyword']]) == false) continue;
                                                                        ?>
                                                                        <label class="tpInputLabel"
                                                                               style="width: 168px;">
                                                                            <input
                                                                                name="attr[<?php echo $valAttr['id'] ?>]"
                                                                                type="checkbox"
                                                                                class="tpInputCheckbox" <?php echo((in_array($valAttr['id'], $attribute_checked)) ? 'checked' : ''); ?>
                                                                                value="<?php echo $valAttr['id'] ?>"/>
                                                                            <span><?php echo $valAttr['title']; ?></span>
                                                                        </label>
                                                                    <?php } ?>
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            <?php }
                                        } ?>
                                    <?php } ?>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label tp-text-left">Mô tả</label>

                                    <div class="col-sm-10">
                                        <?php echo form_textarea('description', htmlspecialchars_decode(set_value('description', $DetailProducts['description'])), 'id="txtDescription" class="ckeditor-description" placeholder="Mô tả" style="width: 100%; height: 150px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"'); ?>
                                    </div>
                                </div>



                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.tab-pane -->

                        <div class="tab-pane" id="tab-rooms">
                            <div class="box-body">




                                <div class="form-group">
                                    <label class="col-sm-2 control-label tp-text-left">Giới thiệu</label>

                                    <div class="col-sm-10">
                                        <?php echo form_input('content', set_value('content', $DetailProducts['content']), 'class="form-control" placeholder="Giới thiệu"'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label tp-text-left">Thời gian<br>(8/16/2019 15:00:00)<br>(tháng/ngày/năm 15:00:00)</label>

                                    <div class="col-sm-10">
                                        <?php echo form_input('content1', set_value('content1', $DetailProducts['content1']), 'class="form-control" placeholder="(8/16/2019 15:00:00)"'); ?>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label tp-text-left">Mô tả</label>

                                    <div class="col-sm-10">
                                        <?php echo form_textarea('content2', htmlspecialchars_decode(set_value('content2', $DetailProducts['content2'])), 'id="txtDescriptionc2" class="ckeditor-description" placeholder="Mô tả" style="width: 100%; height: 150px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label tp-text-left">Thông tin chi tiết</label>

                                    <div class="col-sm-10">
                                        <?php echo form_textarea('content3', htmlspecialchars_decode(set_value('content3', $DetailProducts['content3'])), 'id="txtDescription3" class="ckeditor-description" placeholder="Description" style="width: 100%; height: 150px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"'); ?>
                                    </div>
                                </div>
                                <div class="form-group hide">
                                    <label class="col-sm-2 control-label tp-text-left">Chi tiết phòng</label>

                                    <div class="col-sm-10">
                                        <?php echo form_textarea('content4', htmlspecialchars_decode(set_value('content4', $DetailProducts['content4'])), 'id="txtDescription4" class="ckeditor-description" placeholder="Mặt bằng" style="width: 100%; height: 150px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"'); ?>
                                    </div>
                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <div class="tab-pane" id="tab-tour">
                            <div class="box-body">



                                <div class="form-group">
                                    <label class="col-sm-2 control-label tp-text-left">Prices</label>

                                    <div class="col-sm-10">
                                        <?php echo form_textarea('price_sale', htmlspecialchars_decode(set_value('price_sale', $DetailProducts['price_sale'])), 'id="txtDescriptionri2" class="ckeditor-description" placeholder="Giá bán" style="width: 100%; height: 150px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"'); ?>
                                    </div>
                                </div>

                            </div>
                            <!-- /.box-body -->
                        </div>


                        <div class="tab-pane" id="tab-album">
                            <div class="form-group hide">
                                <label class="col-sm-2 control-label tp-text-left">Links ảnh phân cách</label>

                                <div class="col-sm-12">
                                    <?php echo form_input('code', set_value('code', $DetailProducts['code']), 'class="form-control" placeholder="vd: /uploads/images/products/360/aima-jeek/xe-may-dien-aima-jeek-"'); ?>
                                </div>
                            </div>
                            <div class="box-body">
                                <div class="form-group" id="fromSlide">
                                    <?php
                                    $slide = $this->input->post('album');
                                    $album = '';
                                    if (isset($slide) && is_array($slide) && count($slide)) {
                                        foreach ($slide['images'] as $key => $val) {
                                            $album[$key]['images'] = $val;
                                            $album[$key]['title'] = $slide['title'][$key];
                                            $album[$key]['description'] = $slide['description'][$key];
                                        }
                                    } else {
                                        $album = json_decode($DetailProducts['albums'], TRUE);
                                    }
                                    ?>
                                    <?php if (isset($album) && is_array($album) && count($album)) { ?>
                                        <?php foreach ($album as $key => $val) {
                                            if (empty($album[$key]['images'])) continue; ?>
                                            <div class="col-sm-3 slideItem">
                                                <div class="thumb"><img src="<?php echo $album[$key]['images']; ?>"
                                                                        class="img-thumbnail img-responsive"/></div>
                                                <input type="hidden" name="album[images][]"
                                                       value="<?php echo $album[$key]['images']; ?>"/>
                                                <input type="text" name="album[title][]"
                                                       value="<?php echo $album[$key]['title']; ?>"
                                                       class="form-control title" placeholder="Tên ảnh"/>
                                                <textarea name="album[description][]" cols="40" rows="10"
                                                          class="form-control description"
                                                          placeholder="Mô tả ảnh"><?php echo $album[$key]['description']; ?></textarea>
                                                <button type="button"
                                                        class="btn btnRemove remove1 btn-danger pull-right">Xóa bỏ
                                                </button>
                                            </div>
                                        <?php } ?>
                                        <div class="col-sm-3 slideItem">
                                            <button type="button" class="btn btnAddItem add1 pull-left">+</button>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.tab-pane -->

                        <div class="tab-pane" id="tab-album-list">
                            <div class="box-body">
                                <div class="form-group" id="fromSlidelist">
                                    <?php
                                    $slidelist = $this->input->post('albumlist');
                                    $albumlist = '';
                                    if (isset($slidelist) && is_array($slidelist) && count($slidelist)) {
                                        foreach ($slidelist['images'] as $key => $val) {
                                            $albumlist[$key]['images'] = $val;
                                            $albumlist[$key]['title'] = $slidelist['title'][$key];
                                            $albumlist[$key]['description'] = $slidelist['description'][$key];
                                        }
                                    } else {
                                        $albumlist = json_decode($DetailProducts['album'], TRUE);
                                    }
                                    ?>
                                    <?php if (isset($albumlist) && is_array($albumlist) && count($albumlist)) { ?>
                                        <?php foreach ($albumlist as $key => $val) {
                                            if (empty($albumlist[$key]['images'])) continue; ?>
                                            <div class="col-sm-3 slideItem">
                                                <div class="thumb"><img src="<?php echo $albumlist[$key]['images']; ?>"
                                                                        class="img-thumbnail img-responsive"/></div>
                                                <input type="hidden" name="albumlist[images][]"
                                                       value="<?php echo $albumlist[$key]['images']; ?>"/>
                                                <input type="text" name="albumlist[title][]"
                                                       value="<?php echo $albumlist[$key]['title']; ?>"
                                                       class="form-control title" placeholder="Tên ảnh"/>
                                                <textarea name="albumlist[description][]" cols="40" rows="10"
                                                          class="form-control description"
                                                          placeholder="Mô tả ảnh"><?php echo $albumlist[$key]['description']; ?></textarea>
                                                <button type="button"
                                                        class="btn btnRemove remove2 btn-danger pull-right">Xóa bỏ
                                                </button>
                                            </div>
                                        <?php } ?>
                                        <div class="col-sm-3 slideItem">
                                            <button type="button" class="btn btnAddItem add2 pull-left">+</button>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.tab-pane -->


                        <div class="tab-pane" id="tab-album-list3">
                            <div class="box-body">
                                <div class="form-group" id="fromSlidelist3">
                                    <?php
                                    $slidelist3 = $this->input->post('albumlist3');
                                    $albumlist3 = '';
                                    if (isset($slidelist3) && is_array($slidelist3) && count($slidelist3)) {
                                        foreach ($slidelist3['images'] as $key => $val) {
                                            $albumlist3[$key]['images'] = $val;
                                            $albumlist3[$key]['title'] = $slidelist3['title'][$key];
                                            $albumlist3[$key]['description'] = $slidelist3['description'][$key];
                                        }
                                    } else {
                                        $albumlist3 = json_decode($DetailProducts['album3'], TRUE);
                                    }
                                    ?>
                                    <?php if (isset($albumlist3) && is_array($albumlist3) && count($albumlist3)) { ?>
                                        <?php foreach ($albumlist3 as $key => $val) {
                                            if (empty($albumlist3[$key]['images'])) continue; ?>
                                            <div class="col-sm-3 slideItem">
                                                <div class="thumb"><img src="<?php echo $albumlist3[$key]['images']; ?>"
                                                                        class="img-thumbnail img-responsive"/></div>
                                                <input type="hidden" name="albumlist3[images][]"
                                                       value="<?php echo $albumlist3[$key]['images']; ?>"/>
                                                <input type="text" name="albumlist3[title][]"
                                                       value="<?php echo $albumlist3[$key]['title']; ?>"
                                                       class="form-control title" placeholder="Tên"/>
                                                <textarea name="albumlist3[description][]" cols="40" rows="10"
                                                          class="form-control description"
                                                          placeholder="Mô tả"><?php echo $albumlist3[$key]['description']; ?></textarea>
                                                <button type="button"
                                                        class="btn btnRemove remove3 btn-danger pull-right">Xóa bỏ
                                                </button>
                                            </div>
                                        <?php } ?>
                                        <div class="col-sm-3 slideItem">
                                            <button type="button" class="btn btnAddItem add3 pull-left">+</button>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>


                        <div class="tab-pane" id="tab-album-list4">
                            <div class="box-body">
                                <div class="form-group" id="fromSlidelist4">
                                    <?php
                                    $slidelist4 = $this->input->post('albumlist4');
                                    $albumlist4 = '';
                                    if (isset($slidelist4) && is_array($slidelist4) && count($slidelist4)) {
                                        foreach ($slidelist4['title'] as $key => $val) {
                                            $albumlist4[$key]['images'] = $val;
                                            $albumlist4[$key]['title'] = $slidelist4['title'][$key];
                                            $albumlist4[$key]['description'] = $slidelist4['description'][$key];
                                            $albumlist4[$key]['content1'] = $slidelist4['content1'][$key];
                                            $albumlist4[$key]['content2'] = $slidelist4['content2'][$key];
                                        }
                                    } else {
                                        $albumlist4 = json_decode($DetailProducts['album4'], TRUE);
                                    }
                                    ?>
                                    <?php if (isset($albumlist4) && is_array($albumlist4) && count($albumlist4)) { ?>
                                        <?php foreach ($albumlist4 as $key => $val) {
                                            if (empty($albumlist4[$key]['title'])) continue; ?>
                                            <div class="col-sm-12 slideItem">
                                                <div class="thumb hide"><img
                                                        src="<?php echo $albumlist4[$key]['images']; ?>"
                                                        class="img-thumbnail img-responsive"/></div>
                                                <input type="hidden" name="albumlist4[images][]"
                                                       value="<?php echo $albumlist4[$key]['images']; ?>"/>
                                                <input type="text" name="albumlist4[title][]"
                                                       value="<?php echo $albumlist4[$key]['title']; ?>"
                                                       class="form-control title" placeholder="Tên"/>
                                                <textarea name="albumlist4[description][]" cols="40" rows="10"
                                                          class="form-control description hide"
                                                          placeholder="Mô tả"><?php echo $albumlist4[$key]['description']; ?></textarea>
                                                <input name="albumlist4[content1][]"
                                                       value="<?php echo $albumlist4[$key]['content1']; ?>"
                                                       class="form-control content1 hide"
                                                       placeholder="Mô tả 1">
                                                <input name="albumlist4[content2][]"
                                                       value="<?php echo $albumlist4[$key]['content2']; ?>"
                                                       class="form-control content2 hide"
                                                       placeholder="Mô tả 2">
                                                <button type="button"
                                                        class="btn btnRemove remove4 btn-danger pull-right">Xóa bỏ
                                                </button>
                                            </div>
                                        <?php } ?>
                                        <div class="col-sm-3 slideItem">
                                            <button type="button" class="btn btnAddItem add4 pull-left">+</button>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>


                        <!-- /.tab-content -->
                        <div class="box-footer">
                            <button type="reset" class="btn btn-default">Làm lại</button>
                            <button type="submit" name="update" value="action" class="btn btn-info pull-right">Cập nhật
                            </button>
                        </div>
                        <!-- /.box-footer -->

                    </div>
                    <!-- nav-tabs-custom -->
                </div>
            </div>
            <!-- /.col -->
            <div class="col-md-3">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab-info" data-toggle="tab">Nâng cao</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab-seo">
                            <div class="form-group">
                                <label class="col-sm-12 control-label tp-text-left">Ảnh đại diện</label>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <div class="avatar" style="margin-bottom: 10px;cursor: pointer;"><img
                                            src="<?php echo (!empty($DetailProducts['images'])) ? $DetailProducts['images'] : 'templates/not-found.png'; ?>"
                                            class="img-thumbnail" alt=""
                                            style="width: 100%;border-radius: 0;object-fit: scale-down;height: 200px;"/>
                                    </div>
                                    <?php echo form_input('images', set_value('images', $DetailProducts['images']), 'class="form-control"  placeholder="Ảnh đại diện" onclick="openKCFinder(this)" '); ?>
                                </div>
                            </div>
                            <div class="form-group hide">
                                <label class="col-sm-12 control-label tp-text-left">Upload file psd</label>
                            </div>

                            <div class="form-group hide">
                                <div class="col-sm-12">
                                    <input type="file" name="upload" class="form-control input-sm"
                                           value="<?php echo $DetailProducts['file'] ?>" placeholder=""/>
                                    <span>File: <?php echo $DetailProducts['file'] ?></span>

                                </div>
                            </div>


                            <div class="form-group">

                                <label class="col-sm-12 control-label tp-text-left">Giá gốc</label>
                                <div class="col-sm-12">
                                    <?php echo form_input('price', set_value('price', str_replace(',', '.', number_format($DetailProducts['price']))), 'class="form-control price" placeholder="Giá tiền"'); ?>
                                </div>

                            </div>
                            <div class="form-group">


                                <label class="col-sm-12 control-label tp-text-left">Giá bán</label>

                                <div class="col-sm-12">
                                    <?php echo form_input('saleoff', set_value('saleoff', str_replace(',', '.', number_format($DetailProducts['saleoff']))), 'class="form-control price-saleoff" placeholder="Giá tiền sau khuyến mãi"'); ?>
                                </div>
                            </div>


                            <div class="form-group hide">
                                <label class="col-sm-12 control-label tp-text-left">Adults</label>

                                <div class="col-sm-12">
                                    <?php echo form_input('adults', set_value('adults',$DetailProducts['adults']), 'class="form-control" placeholder="Adults"'); ?>
                                </div>
                            </div>
                            <div class="form-group hide">
                                <label class="col-sm-12 control-label tp-text-left">Children</label>

                                <div class="col-sm-12">
                                    <?php echo form_input('children', set_value('children',$DetailProducts['children']), 'class="form-control" placeholder="Children"'); ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-12 control-label tp-text-left">Breadcrumb / Danh mục cha</label>
                            </div>
                            <?php $dropdown = $this->nestedsetbie->Dropdown(); ?>
                            <?php if (isset($dropdown) && is_array($dropdown) && count($dropdown)) { ?>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <div class="uk-scrollable-box">
                                            <ul class="uk-list tp-list-catalogue">
                                                <?php foreach ($dropdown as $key => $val) {
                                                    if ($key == 0) continue; ?>
                                                    <li>
                                                        <label for="" class="catalogueid">
                                                            <?php echo form_radio('cataloguesid', $key, set_radio('cataloguesid', $key, FALSE), (isset($DetailProducts['cataloguesid']) && $DetailProducts['cataloguesid'] == $key) ? 'checked="checked" class="check-box"' : 'class="check-box"'); ?>
                                                        </label>
                                                        <label for="" class="catalogue">
                                                            <?php echo form_checkbox('catalogue[]', $key, set_checkbox('catalogue[]', $key, FALSE), (isset($catalogue) && count($catalogue) && is_array($catalogue) && in_array($key, $catalogue)) ? 'checked="checked"' : ''); ?>
                                                            <?php echo $val; ?>
                                                        </label>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="form-group">
                                <label class="col-sm-12 control-label tp-text-left">Xuất bản</label>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <?php echo form_dropdown('publish', $this->configbie->data('publish'), set_value('publish', $DetailProducts['publish']), 'class="form-control" style="width: 100%;"'); ?>
                                </div>
                            </div>

                            <div class="hide">
                                <div class="form-group">
                                    <label class="col-sm-12 control-label tp-text-left">Tình trạng</label>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <?php echo form_dropdown('highlight', $this->configbie->data('highlight'), set_value('highlight', $DetailProducts['highlight']), 'class="form-control" style="width: 100%;"'); ?>
                                    </div>
                                </div>
                                <div class="form-group hide">
                                    <label class="col-sm-12 control-label tp-text-left">Trang chủ</label>
                                </div>
                                <div class="form-group hide">
                                    <div class="col-sm-12">
                                        <?php echo form_dropdown('ishome', $this->configbie->data('ishome'), set_value('ishome', $DetailProducts['ishome']), 'class="form-control" style="width: 100%;"'); ?>
                                    </div>
                                </div>
                                <div class="form-group hide">
                                    <label class="col-sm-12 control-label tp-text-left">Aside</label>
                                </div>
                                <div class="form-group hide">
                                    <div class="col-sm-12">
                                        <?php echo form_dropdown('isaside', $this->configbie->data('isaside'), set_value('isaside', $DetailProducts['isaside']), 'class="form-control" style="width: 100%;"'); ?>
                                    </div>
                                </div>
                                <div class="form-group hide">
                                    <label class="col-sm-12 control-label tp-text-left">Sản phẩm mới</label>
                                </div>
                                <div class="form-group hide">
                                    <div class="col-sm-12">
                                        <?php echo form_dropdown('isfooter', $this->configbie->data('isfooter'), set_value('isfooter', $DetailProducts['isfooter']), 'class="form-control" style="width: 100%;"'); ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-12 control-label tp-text-left">Bán chạy</label>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <?php echo form_dropdown('psale', $this->configbie->data('psale'), set_value('psale', $DetailProducts['psale']), 'class="form-control" style="width: 100%;"'); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-12 control-label tp-text-left">Vị trí</label>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <?php echo form_input('order', set_value('order', $DetailProducts['order']), 'class="form-control" placeholder="Vị trí"'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
            </div>
            <!-- nav-tabs-custom -->
    </div>
    <!-- /.col -->
    </form>
    </div> <!-- /.row -->
</section><!-- /.content -->
<script type="text/javascript">
    $(document).on('click', '.img-thumbnail', function () {
        openKCFinderAlbum($(this));
    });

    $(document).ready(function () {
        var time;
        $('.price, .price-saleoff').on('keyup', function (event) {
            var price = $(this).val();
            var _this = $(this);
            var url = 'products' + '/ajax/' + 'products' + '/convert_commas_price';
            clearTimeout(time);
            time = setTimeout(function () {
                $.post(url, {price: price}, function (data) {
                    _this.val(data);
                });
            }, 300);
        });

        $('.check-box').change(function () {
            var str = '';
            $('.check-box').each(function () {
                if ($(this).val() != 0 && $(this).prop('checked') == true) {
                    str = str + $(this).val() + '-';
                }
            });
            if (str.length > 0) {
                str = str.substr(0, str.length - 1);
                $('#str').val(str);
            } else {
                $('#str').val('');
            }
            $('#cat-form').trigger('submit');
        });

        $('#cat-form').on('submit', function () {
            var postData = $('#str').val();
            var formURL = 'products/ajax/products/attributes';
            $.post(formURL, {
                    post: postData,
                },
                function (data) {
                    $('.attribute-list').html(data);
                });
            return false;
        });

    });

</script>
<script type="text/javascript">
    $(window).load(function () {
        var item;
        item = '<div class="col-sm-3 slideItem">';
        item = item + '<div class="thumb"><img src="templates/backend/images/not-found.png" class="img-thumbnail img-responsive"/></div>';
        item = item + '<input type="hidden" name="album[images][]" value="" />';
        item = item + '<input type="text" name="album[title][]" value="" class="form-control title" placeholder="Tên ảnh"/>';
        item = item + '<textarea name="album[description][]" cols="40" rows="10" class="form-control description" placeholder="Mô tả ảnh"></textarea>';
        item = item + '<button type="button" class="btn btnRemove remove1 btn-danger pull-right">Xóa bỏ</button>';
        item = item + '</div>';
        item = item + '<div class="col-sm-3 slideItem"><button type="button" class="btn btnAddItem add1 pull-left">+</button></div>';
        if ($('#fromSlide').html().trim() == '') {
            $('#fromSlide').append(item);
        }


        /* Thêm phần tử tiếp theo */
        $(document).on('click', '.btnAddItem.add1', function () {
            $('.btnAddItem.add1').parent().remove();
            $('#fromSlide').append(item);
        });

        /* Xóa phần tử */
        $(document).on('click', '.btnRemove.remove1', function () {
            $(this).parent().remove();
        });

    });
</script>

<script type="text/javascript">
    $(window).load(function () {
        var item;
        item = '<div class="col-sm-3 slideItem">';
        item = item + '<div class="thumb"><img src="templates/backend/images/not-found.png" class="img-thumbnail img-responsive"/></div>';
        item = item + '<input type="hidden" name="albumlist[images][]" value="" />';
        item = item + '<input type="text" name="albumlist[title][]" value="" class="form-control title" placeholder="Tên ảnh"/>';
        item = item + '<textarea name="albumlist[description][]" cols="40" rows="10" class="form-control description" placeholder="Mô tả ảnh"></textarea>';
        item = item + '<button type="button" class="btn btnRemove remove2 btn-danger pull-right">Xóa bỏ</button>';
        item = item + '</div>';
        item = item + '<div class="col-sm-3 slideItem"><button type="button" class="btn btnAddItem add2 pull-left">+</button></div>';
        if ($('#fromSlidelist').html().trim() == '') {
            $('#fromSlidelist').append(item);
        }
        /* Thêm phần tử đầu tiên */
        $(document).on('click', '.btnAddFrist', function () {
            $('#fromSlidelist').html(item);
        });

        /* Thêm phần tử tiếp theo */
        $(document).on('click', '.btnAddItem.add2', function () {
            $('.btnAddItem.add2').parent().remove();
            $('#fromSlidelist').append(item);
        });

        /* Xóa phần tử */
        $(document).on('click', '.btnRemove.remove2', function () {
            $(this).parent().remove();
        });

        /* Xóa phần tử */
        $(document).on('click', '.img-thumbnail', function () {
            openKCFinderAlbum($(this));
        });
    });
</script>


<script type="text/javascript">
    $(window).load(function () {
        var item;
        item = '<div class="col-sm-3 slideItem">';
        item = item + '<div class="thumb"><img src="templates/backend/images/not-found.png" class="img-thumbnail img-responsive"/></div>';
        item = item + '<input type="hidden" name="albumlist3[images][]" value="" />';
        item = item + '<input type="text" name="albumlist3[title][]" value="" class="form-control title" placeholder="Tên"/>';
        item = item + '<textarea name="albumlist3[description][]" cols="40" rows="10" class="form-control description" placeholder="Mô tả"></textarea>';
        item = item + '<button type="button" class="btn btnRemove remove3 btn-danger pull-right">Xóa bỏ</button>';
        item = item + '</div>';
        item = item + '<div class="col-sm-3 slideItem"><button type="button" class="btn btnAddItem add3 pull-left">+</button></div>';
        if ($('#fromSlidelist3').html().trim() == '') {
            $('#fromSlidelist3').append(item);
        }
        /* Thêm phần tử đầu tiên */
        $(document).on('click', '.btnAddFrist3', function () {
            $('#fromSlidelist3').html(item);
        });

        /* Thêm phần tử tiếp theo */
        $(document).on('click', '.btnAddItem.add3', function () {
            $('.btnAddItem.add3').parent().remove();
            $('#fromSlidelist3').append(item);
        });

        /* Xóa phần tử */
        $(document).on('click', '.btnRemove.remove3', function () {
            $(this).parent().remove();
        });

        /* Xóa phần tử */
        $(document).on('click', '.img-thumbnail', function () {
            openKCFinderAlbum($(this));
        });
    });
</script>


<script type="text/javascript">
    $(window).load(function () {
        var item;
        item = '<div class="col-sm-12 slideItem">';
        item = item + '<div class="thumb hide"><img src="templates/backend/images/not-found.png" class="img-thumbnail img-responsive"/></div>';
        item = item + '<input type="hidden" name="albumlist4[images][]" value="" />';
        item = item + '<input type="text" name="albumlist4[title][]" value="" class="form-control title" placeholder="Tên"/>';
        item = item + '<input name="albumlist4[description][]" class="form-control description hide" placeholder="Mô tả 1">';
        item = item + '<input name="albumlist4[content1][]" class="form-control content1 hide" placeholder="Mô tả 2">';
        item = item + '<input name="albumlist4[content2][]" class="form-control content2 hide" placeholder="Mô tả 3">';
        item = item + '<button type="button" class="btn btnRemove remove4 btn-danger pull-right">Xóa bỏ</button>';
        item = item + '</div>';
        item = item + '<div class="col-sm-3 slideItem"><button type="button" class="btn btnAddItem add4 pull-left">+</button></div>';
        if ($('#fromSlidelist4').html().trim() == '') {
            $('#fromSlidelist4').append(item);
        }
        /* Thêm phần tử đầu tiên */
        $(document).on('click', '.btnAddFrist4', function () {
            $('#fromSlidelist4').html(item);
        });

        /* Thêm phần tử tiếp theo */
        $(document).on('click', '.btnAddItem.add4', function () {
            $('.btnAddItem.add4').parent().remove();
            $('#fromSlidelist4').append(item);
        });

        /* Xóa phần tử */
        $(document).on('click', '.btnRemove.remove4', function () {
            $(this).parent().remove();
        });

        /* Xóa phần tử */
        $(document).on('click', '.img-thumbnail', function () {
            openKCFinderAlbum($(this));
        });
    });
</script>
<style>
    .slideItem{
        height: auto;
    }
</style>