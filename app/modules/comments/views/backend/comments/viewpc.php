<section class="content-header">
    <h1>Danh sách Comments</h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin'); ?>"><i class="fa fa-dashboard"></i> Bảng điều khiển</a></li>
        <li class="active"><a href="<?php echo site_url('comments/backend/comments/viewPC'); ?>">Comments</a></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <!--	<h3 class="box-title pull-right">
				<div class="btn-group">
					<a href="<?php echo site_url('comments/backend/comments/create'); ?>" class="btn btn-default btn-flat"><i class="fa fa-plus"></i> Thêm mới</a>
				</div>
			</h3>-->
                    <div class="box-tools pull-left">
                        <form method="get" action="<?php echo site_url('comments/backend/comments/viewPC'); ?>">
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
                <?php echo show_flashdata();
                $array = array(
                    'products' => 'Bài giảng',
                    'articles' => 'Bài viết',
                    'gallerys' => 'Hình Ảnh',
                    'videos' => 'Video',
                );
                ?>
                <?php if (isset($listComment) && is_array($listComment) && count($listComment)) { ?>
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover table-bordered table-striped">
                            <tr>
                                <th>ID</th>
                                <th>Họ tên / Email</th>
                                <th>Cấp</th>
                                <th style="text-align:center;">Link</th>
                                <th style="width:460px;">Nội dung</th>
                                <th style="text-align:center; width: 100px;">Module</th>
                                <th style="text-align:center;">Ngày tạo</th>
                                <th style="text-align:center;">Trạng thái</th>
                                <th class="text-center">Thao tác</th>
                            </tr>
                            <?php foreach($listComment as $key => $comment){ ?>
				<?php 
					$module = $comment['module'];
					$moduleid = $comment['moduleid'];
					$object = $this->Autoload_Model->_get_where(array(
						'select' => 'id, title, slug, canonical',
						'table' => $module,
						'where' => array('publish' => 1,'trash' => 0,'id' => $moduleid),
						'limit' => 1,
					));
					$title = $object['title'];
					// $href = rewrite_url($object['canonical'], $object['slug'], $object['id'], $module);
					$href = site_url('learning/lecture-'.$comment['pageid'].'');

					$customers = $this->Autoload_Model->_get_where(array(
						'select' => 'id, fullname, email',
						'table' => 'customers',
						'where' => array('publish' => 1,'trash' => 0,'id' => $comment['customersid']),
						'limit' => 1,
					));
				?>
				<tr>
					<td><?php echo $comment['id'];?></td>
					<td class=""><?php echo $comment['fullname']; ?><br/><?php echo $comment['email'];?> </td></td>
					<td><?php echo ((!empty($comment['parentid'])) ? 'Cấp 2 (Trả lời)' : 'Cấp 1(Bình luận)') ?></td>
					<td style="text-align:center;"><a target="_blank" href="<?php echo $href; ?>" title="<?php echo $title; ?>"><?php echo $title ?> <i class="fa fa-link"></i></a></td>
					<td><?php echo cutnchar(strip_tags($comment['message']), 300);?></td>
					<td style="text-align:center;"><?php echo $array[$comment['module']]; ?></td>
					<td style="text-align:center;"><?php echo gettime($comment['created'], 'd/m/Y');?></td>
					<td>
						<a href="<?php echo site_url('comments/backend/comments/set/publish/'.$comment['id'].'?redirect='.urlencode(current_url())); ?>" title="" class="status-publish">
							<img src="<?php echo ($comment['publish'] > 0)? 'templates/backend/images/publish-check.png':'templates/backend/images/publish-deny.png'; ?>" alt="" />
						</a>
					</td>
					<td class="text-center">
						<div class="btn-group" style="min-width: 80px;">
							<a href="<?php echo site_url('comments/backend/comments/deletePC/'.$comment['id']).'?redirect='.urlencode(current_url());?>" class="btn btn-default"><span class="fa fa-trash"></span></a>
							<a href="<?php echo site_url('comments/backend/comments/update/'.$comment['id']).'?redirect='.urlencode(current_url());?>" class="btn btn-default"><i class="fa fa-edit"></i></a>
						</div>
					 </td>
					<?php if(isset($comment['post']) && is_array($comment['post']) && count($comment['post'])){ ?>
                        <?php foreach($comment['post'] as $keys=>$comments){?>
                        <tr>
                            <td><?php echo $comments['id'];?></td>
                            <td class="">|----------<?php echo $comments['fullname']; ?><br/><?php echo $comments['email'];?> </td></td>
                            <td><?php echo ((!empty($comments['parentid'])) ? 'Cấp 2 (Trả lời)' : 'Cấp 1(Bình luận)') ?></td>
                            <td style="text-align:center;"><a target="_blank" href="<?php echo $href; ?>" title="<?php echo $title; ?>"><?php echo $title ?> <i class="fa fa-link"></i></a></td>
                            <td><?php echo cutnchar(strip_tags($comments['message']), 300);?></td>
                            <td style="text-align:center;"><?php echo $array[$comments['module']]; ?></td>
                            <td style="text-align:center;"><?php echo gettime($comments['created'], 'd/m/Y');?></td>
                            <td>
                                <a href="<?php echo site_url('comments/backend/comments/set/publish/'.$comments['id'].'?redirect='.urlencode(current_url())); ?>" title="" class="status-publish">
                                    <img src="<?php echo ($comments['publish'] > 0)? 'templates/backend/images/publish-check.png':'templates/backend/images/publish-deny.png'; ?>" alt="" />
                                </a>
                            </td>
                            <td class="text-center">
                                <div class="btn-group" style="min-width: 80px;">
                                    <a href="<?php echo site_url('comments/backend/comments/deletePC/'.$comments['id']).'?redirect='.urlencode(current_url());?>" class="btn btn-default"><span class="fa fa-trash"></span></a>
                                    <a href="<?php echo site_url('comments/backend/comments/update/'.$comments['id']).'?redirect='.urlencode(current_url());?>" class="btn btn-default"><i class="fa fa-edit"></i></a>
                                </div>
                             </td>
                        </tr>
                        <?php }?>
				    <?php }?>

				</tr>

				<?php } ?>
                        </table>
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
<style>
    .red {
        color: #ff0000;
    }
</style>