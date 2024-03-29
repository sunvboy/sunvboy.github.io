<section class="content-header">
    <h1>Sản phẩm</h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin'); ?>"><i class="fa fa-dashboard"></i> Bảng điều khiển</a></li>
        <li class="active"><a href="<?php echo site_url('products/backend/products/view'); ?>">Sản phẩm</a></li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title pull-right">
                        <div class="btn-group add-sort">
                            <?php /* <button type="button" class="btn btn-sort btn-flat" id="btnsort"><i class="fa fa-sort-alpha-asc"></i> Sắp xếp</button> */ ?>
                            <a href="<?php echo site_url('products/backend/products/create'); ?>"
                               class="btn btn-add  btn-flat"><i class="fa fa-plus"></i> Thêm Sản phẩm</a>


                        </div>
                    </h3>
                    <h3 class="box-title pull-right hide">
                        <div class="btn-group add-sort">


                            <!--import excel-->
                            <form method="post" id="import_form" enctype="multipart/form-data">
                                <input type="file" name="file" id="file" required accept=".xls, .xlsx" /></p>
                                <input type="submit" name="import" value="Import" class="btn btn-info" />
                            </form>
                            <!--end import excel-->


                        </div>
                    </h3>
                    <div class="box-tools pull-left">
                        <span class="gcheckAction pull-left btn btn-default" data-module="products"><i class="fa fa-trash"></i></span>
                        <span class="gcheckActionCopy pull-left btn btn-default" data-module="products"><i class="fa fa-edit"></i></span>
                        <script>
                            $('.gcheckActionCopy').click(function(){
                                var modules = $(this).attr('data-module');
                                var id_checked = []; // Láº¥y id báº£n ghi
                                $('.checkbox-item:checked').each(function() {
                                    id_checked.push($(this).val());
                                });
                                var formURL = 'products/ajax/products/copy';
                                $.post(formURL, {
                                        post: id_checked,module:modules},
                                    function(data){
                                        $('#alertModal').modal('toggle');
                                        var json = JSON.parse(data);
                                        if(json.error == false){
                                            $('.message-alert').html(json.message);

                                        }else{
                                            $('.message-alert').html(json.message);
                                        }
                                        window.setTimeout('location.reload()', 2000); //Reloads after three seconds
                                    });
                                return false;
                            });
                        </script>
                        <form class="pull-left" method="get"
                              action="<?php echo site_url('products/backend/products/view'); ?>">
                            <div class="pull-left" style="width: 200px;margin-right:8px;">
                                <?php echo form_dropdown('cataloguesid', $this->nestedsetbie->dropdown(), set_value('cataloguesid', $this->input->get('cataloguesid')), 'class="form-control"'); ?>
                            </div>
                            <div class="input-group filter-box pull-left hide">
                                <?php
                                $filter[''] = '[Filter]';
                                if (is_array($this->action) && count($this->action)) {
                                    foreach ($this->action as $key => $val) {
                                        $filter[$val] = array(
                                            $key => $val,
                                            'un' . $key => 'Không ' . strtolower($val),
                                        );
                                    }
                                }
                                ?>
                                <?php echo form_dropdown('filter', $filter, $this->input->get('filter'), 'class="form-control filter"'); ?>
                            </div>
                            <div class="input-group pull-left" style="width: 250px;">
                                <input type="text" name="keyword"
                                       value="<?php echo htmlspecialchars($this->input->get('keyword')); ?>"
                                       class="form-control" placeholder="Search">

                                <div class="input-group-btn">
                                    <button type="submit" value="action" class="btn btn-default"><i
                                            class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.box-header -->
                <?php echo show_flashdata(); ?>
                <?php if (isset($Listproducts) && is_array($Listproducts) && count($Listproducts)) { ?>
                    <div class="box-body table-responsive no-padding">
                        <form method="post" action="" id="fcFrom">
                            <table class="table" id="diagnosis-list">
                                <tr>
                                    <th class="width-checkbox uk-text-center">
                                        <div class="gcheckContainer">
                                            <div class="gcheck" id="#gcheck">
                                                <div class="check">
                                                    <input type="checkbox" id="checkbox-all"/>
                                                    <label for="checkbox-all" class="labelCheckAll"></label>
                                                </div>
                                                <span class="arrow"></span>
                                            </div>
                                            <div class="gcheckDropdown">
                                                <div class="gcheck-item" data-check="checkall">Tất cả</div>
                                                <div class="gcheck-item" data-check="uncheckall">Bỏ chọn tất cả</div>
                                            </div>
                                        </div>
                                    </th>
                                    <th>Tiêu đề</th>
                                    <th>Lượt xem</th>
                                    <th>Vị trí</th>
                                    <th>Xuất bản</th>



                                    <th class="text-right">Thao tác</th>
                                </tr>
                                <?php foreach ($Listproducts as $key => $item) { ?>
                                    <?php
                                    $image = getthumb($item['images']);
                                    $description = cutnchar(strip_tags($item['description']), 250);
                                    $catalogue = json_decode($item['catalogues'], TRUE);
                                    $_catalogue_list = $this->BackendProductsCatalogues_Model->_get_where(array(
                                        'select' => 'id, title, slug, canonical',
                                        'table' => 'products_catalogues',
                                        'where' => array('trash' => 0),
                                        'where_in' => $catalogue,
                                        'where_in_field' => 'id',
                                    ), TRUE);
                                    $href = rewrite_url($item['canonical'], $item['slug'], $item['id'], 'products');

                                    ?>
                                    <tr>
                                        <td class="uk-text-center">
                                            <?php echo form_checkbox('checkbox[]', $item['id'], FALSE, 'class="checkbox-item"'); ?>
                                            <label for="" class="label-checkboxitem"></label>
                                        </td>
                                        <td style="width:650px;">
                                            <article class="article-view-1">
                                                <div class="col-sm-2 thumb">
                                                    <div class="tp-cover"><img src="<?php echo $image; ?>"
                                                                               alt="<?php echo $item['title']; ?>"/>
                                                    </div>
                                                </div>
                                                <div class="col-sm-10">
                                                    <div class="title">
                                                        <a style="color:#333;" href="<?php echo $href; ?>"
                                                           target="_blank"
                                                           title="<?php echo $item['title']; ?>"><?php echo $item['title']; ?></a>
                                                        <a href="<?php echo $href ?>" title="Lấy địa chỉ liên kết"
                                                           onclick="prompt('Lấy địa chỉ liên kết','<?php echo $href ?>'); return false;"><img
                                                                border="0" src="templates/backend/images/link.png"></a>
                                                    </div>
                                                    <div class="description"><?php echo $description; ?></div>
                                                    <div class="meta">
                                                        <span class="user-create"><i class="fa fa-user"></i> <a
                                                                href="<?php echo site_url('products/backend/products/view?userid=' . $item['userid_created'] . '') ?>"
                                                                title=""><?php echo $item['fullname']; ?></a></span>
                                                        <span class="time-create"><i
                                                                class="fa fa-calendar"></i> <?php echo gettime($item['created']); ?></span>
                                                        <span><i class="fa fa-clock-o"></i> <time class="timeago"
                                                                                                  datetime="<?php echo $item['created']; ?>"></time></span>
                                                    </div>
                                                    <?php if (isset($_catalogue_list) && is_array($_catalogue_list) && count($_catalogue_list)){ ?>
                                                    <div class="catalogue">
                                                        <?php if (!empty($item['fullname_update'])) { ?>
                                                            <span class="user-create"><i class="fa fa-user"></i> <a
                                                                    href="<?php echo site_url('products/backend/products/view?userid=' . $item['userid_updated'] . '') ?>"
                                                                    title=""><?php echo $item['fullname_update']; ?></a></span>
                                                        <?php } ?>
                                                        <?php foreach ($_catalogue_list as $keyCat => $valCat) { ?>
                                                            <span><i class="fa fa-folder-open"></i> <a
                                                                    href="<?php echo site_url('products/backend/products/view?cataloguesid=' . $valCat['id'] . ''); ?>"
                                                                    title=""><?php echo $valCat['title']; ?></a></span>
                                                        <?php }
                                                        } ?>
                                                    </div>
                                                </div>
                                            </article>
                                        </td>
                                        <td><?php echo $item['viewed']; ?></td>
                                        <td><?php echo form_input('order[' . $item['id'] . ']', $item['order'], 'data-module="products" data-id="' . $item['id'] . '"  class="form-control sort-order" placeholder="Vị trí" style="width:65px;"'); ?></td>
                                        <td>
                                            <a href="<?php echo site_url('products/backend/products/set/publish/' . $item['id'] . '?redirect=' . urlencode(current_url())); ?>"
                                               title="" class="status-publish">
                                                <img
                                                    src="<?php echo ($item['publish'] > 0) ? 'templates/backend/images/publish-check.png' : 'templates/backend/images/publish-deny.png'; ?>"
                                                    alt=""/>
                                            </a>
                                        </td>


                                        <td class="text-right">
                                            <div class="btn-group">
                                                <a href="<?php echo site_url('products/backend/products/delete/' . $item['id']) . '?redirect=' . urlencode(current_url()); ?>"
                                                   class="btn btn-default"><span class="fa fa-trash"></span></a>
                                                <a href="<?php echo site_url('products/backend/products/update/' . $item['id']) . '?redirect=' . urlencode(current_url()); ?>"
                                                   class="btn btn-default"><i class="fa fa-edit"></i></a>
                                                <a href="<?php echo site_url('products/backend/products/read/' . $item['id']) . '?redirect=' . urlencode(current_url()); ?>"
                                                   class="btn btn-default"><i class="fa fa-eye"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </table>
                        </form>
                    </div><!-- /.box-body -->
                <?php } else { ?>
                    <div class="box-body">
                        <div class="callout callout-danger">Không có dữ liệu</div>
                    </div><!-- /.box-body -->
                <?php } ?>
                <div class="box-footer clearfix">
                    <?php echo isset($ListPagination) ? $ListPagination : ''; ?>
                </div>
            </div>
            <!-- /.box -->
        </div>
    </div>
</section><!-- /.content -->
<div class="backend-loader"></div>
<script type="text/javascript">
    $(document).ready(function () {
        $('#btnsort').click(function () {
            $.post('<?php echo site_url('products/ajax/products/sort')?>', $('#fcFrom').serialize(), function (data) {
                location.reload();
            })
            return false;
        })
    })
</script>

<script>
    $(document).ready(function(){

//        load_data();
//
//        function load_data()
//        {
//            $.ajax({
//                url:"<?php //echo base_url(); ?>//excel_import/fetch",
//                method:"POST",
//                success:function(data){
//                    $('#customer_data').html(data);
//                }
//            })
//        }

        $('#import_form').on('submit', function(event){
            event.preventDefault();
            $.ajax({
                url:"<?php echo base_url(); ?>products/backend/products/import",
                method:"POST",
                data:new FormData(this),
                contentType:false,
                cache:false,
                processData:false,
                success:function(data){
                    $('#file').val('');
//                    load_data();
                    alert(data);
                }
            })
        });

    });
</script>
