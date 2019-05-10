<section class="content-header">
    <h1>Danh sách</h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin'); ?>"><i class="fa fa-dashboard"></i> Bảng điều khiển</a></li>
        <li class="active"><a href="<?php echo site_url('address/backend/address/view'); ?>">Danh sách</a></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title pull-right">
                        <div class="btn-group">
                            <button type="button" class="btn btn-sort btn-flat" id="btnsort"><i class="fa fa-sort-alpha-asc"></i> Sắp xếp</button>

                            <a href="<?php echo site_url('address/backend/address/create'); ?>"
                               class="btn btn-default btn-flat"><i class="fa fa-plus"></i> Thêm mới</a>
                        </div>
                    </h3>
                    <div class="box-tools pull-left">
                        <form method="get" action="<?php echo site_url('address/backend/address/view'); ?>">
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
                <?php if (isset($listSupport) && is_array($listSupport) && count($listSupport)) { ?>
                    <div class="box-body table-responsive no-padding">
                        <form method="post" action="" id="fcFrom">
                            <table class="table table-hover table-bordered table-striped">
                                <tr>
                                    <th>ID</th>
                                    <th>Vị trí</th>
                                    <th>Tên chi nhánh</th>
                                    <th>Ngày tạo</th>

                                    <th class="text-center">Xuất bản</th>
                                    <!--					<th class="text-center">Hà Nội</th>-->
                                    <!--					<th class="text-center">Vinh</th>-->
                                    <th class="text-center">Thao tác</th>
                                </tr>
                                <?php foreach ($listSupport as $key => $contact) { ?>
                                    <tr>
                                        <td><?php echo $contact['id']; ?></td>
                                        <td><?php echo form_input('order['.$contact['id'].']', $contact['order'], 'class="form-control" placeholder="Vị trí" style="width:50px;"');?></td>

                                        <td><?php echo $contact['title']; ?></td>

                                        <td><?php echo $contact['created']; ?></td>
                                        <td>
                                            <a href="<?php echo site_url('address/backend/address/set/publish/' . $contact['id'] . '?redirect=' . urlencode(current_url())); ?>"
                                               title="" class="status-publish">
                                                <img
                                                    src="<?php echo ($contact['publish'] > 0) ? 'templates/backend/images/publish-check.png' : 'templates/backend/images/publish-deny.png'; ?>"
                                                    alt=""/>
                                            </a>
                                        </td>
                                        <td class="hide">
                                            <a href="<?php echo site_url('address/backend/address/set/ishome/' . $contact['id'] . '?redirect=' . urlencode(current_url())); ?>"
                                               title="" class="status-publish">
                                                <img
                                                    src="<?php echo ($contact['ishome'] > 0) ? 'templates/backend/images/publish-check.png' : 'templates/backend/images/publish-deny.png'; ?>"
                                                    alt=""/>
                                            </a>
                                        </td>
                                        <td class="hide">
                                            <a href="<?php echo site_url('address/backend/address/set/isaside/' . $contact['id'] . '?redirect=' . urlencode(current_url())); ?>"
                                               title="" class="status-publish">
                                                <img
                                                    src="<?php echo ($contact['isaside'] > 0) ? 'templates/backend/images/publish-check.png' : 'templates/backend/images/publish-deny.png'; ?>"
                                                    alt=""/>
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <a href="<?php echo site_url('address/backend/address/delete/' . $contact['id']) . '?redirect=' . urlencode(current_url()); ?>"
                                                   class="btn btn-default"><span class="fa fa-trash"></span></a>
                                                <a href="<?php echo site_url('address/backend/address/update/' . $contact['id']) . '?redirect=' . urlencode(current_url()); ?>"
                                                   class="btn btn-default"><i class="fa fa-edit"></i></a>
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
                    <?php echo isset($listPagination) ? $listPagination : ''; ?>
                </div>
            </div>
            <!-- /.box -->
        </div>
    </div>
</section><!-- /.content -->
<script type="text/javascript">
    $(document).ready(function () {
        $('#btnsort').click(function () {
            $.post('<?php echo site_url('address/ajax/address/sort')?>', $('#fcFrom').serialize(), function (data) {
                location.reload();
            })
            return false;
        })
    })
</script>