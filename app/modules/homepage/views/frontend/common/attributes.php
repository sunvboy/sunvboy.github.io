<ul class="nav navbar-nav navbar-right">
    <?php

    $danhmuchome = $this->FrontendProductsCatalogues_Model->ReadByCondition(array(
        'select' => 'id, title, slug, canonical, albums, images, lft, rgt,attributes', 'where'
        => array('trash' => 0, 'publish' => 1, 'ishome' => 1, 'parentid' => 0, 'alanguage' => '' . $this->fc_lang . ''),
        'limit' => 5, 'order_by' => 'order asc, id desc'));
    $attributes_catalgoues = $this->FrontendAttributesCatalogues_Model->ReadByFieldArr(array('publish' => 1, 'trash' => 0));

    if (isset($attributes_catalgoues) && is_array($attributes_catalgoues) && count($attributes_catalgoues)) {
        foreach ($attributes_catalgoues as $key => $val) {
            $attributes_catalgoues[$key]['attributes'] = $this->FrontendAttributes_Model->_get_where(array(
                'select' => 'id, title',
                'table' => 'attributes',
                'where' => array('publish' => 1, 'trash' => 0, 'cataloguesid' => $val['id']),
            ), TRUE);
        }
    }
    //echo "<pre>";var_dump($attributes_catalgoues);die();

    ?>
    <?php if (isset($danhmuchome) && is_array($danhmuchome) && count($danhmuchome)): ?>
        <?php foreach ($danhmuchome as $key => $val) { ?>
            <?php
            $title = $val['title'];
            $href = rewrite_url($val['canonical'], $val['slug'], $val['id'], 'products_catalogues');
            $attributes_decode = json_decode($val['attributes'], TRUE);

            ?>
            <li class="dropdown">
                <a href="<?php echo $href ?>"><?php echo $title ?></a>
                <!--thuocj tính-->
                <?php if (isset($attributes_catalgoues) && is_array($attributes_catalgoues) && count($attributes_catalgoues)) { ?>

                    <ul class="dropdown-menu">
                        <?php foreach ($attributes_catalgoues as $keyAttrGroup => $valAttrGroup) { ?>
                            <?php if (!is_array($attributes_decode['attribute_catalogue']) && count($attributes_decode['attribute_catalogue']) == 0) continue; ?>
                            <?php if (in_array($valAttrGroup['id'], $attributes_decode['attribute_catalogue']) == FALSE) continue; ?>
                            <li><a href="" onclick="return false;"
                                   title="<?php echo $valAttrGroup['title']; ?>"><?php echo $valAttrGroup['title']; ?></a>
                                <?php if (isset($valAttrGroup['attributes']) && is_array($valAttrGroup['attributes']) && count($valAttrGroup['attributes'])) { ?>
                                    <ul class="ul-drop-2">
                                        <?php foreach ($valAttrGroup['attributes'] as $keyAttr => $valAttr) { ?>
                                            <?php
                                            if (isset($attributes_decode['attribute'][$valAttrGroup['keyword']]) && in_array($valAttr['id'], $attributes_decode['attribute'][$valAttrGroup['keyword']]) == false) continue;
                                            $hrefAttr = slug($val['title']) . '-' . slug($valAttrGroup['title']) . '-' . slug($valAttr['title']) . '-pc' . $val['id'] . 'at' . $valAttr['id'] . '' . '.html';
                                            ?>
                                            <li>
                                                <a href="<?php echo $hrefAttr; ?>"><?php echo $valAttr['title']; ?></a>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                <?php } ?>
                            </li>
                        <?php } ?>

                    </ul>
                <?php } ?>
                <!--end thuộc tính-->
            </li>
        <?php } ?>
    <?php endif; ?>

    <li class="dropdown hotline-top">
        <a href="#">
            <span>HOTLINE:</span>
            <span><?php echo $this->fcSystem['contact_phone'] ?></span>
        </a>
    </li>
</ul>
