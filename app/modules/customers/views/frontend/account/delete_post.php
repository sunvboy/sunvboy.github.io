<script src="templates/backend/plugins/ckeditor-4.4.3/ckeditor.js"></script>
<script type="text/javascript">
	$(function(){
		$('.ckeditor-description').each(function(){
			//colorbutton,
			CKEDITOR.replace( this.id, {
				height: 250,
				extraPlugins: 'colorbutton,font,lineutils,justify,lineheight,letterspacing,youtube',
				removeButtons: '',
				entities: false,
				allowedContent: true,
				toolbarGroups: [
					{ name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
					{ name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },
					{ name: 'links' },
					{ name: 'insert' },
					{ name: 'forms' },
					{ name: 'tools' },
					{ name: 'document',	   groups: [ 'mode', 'document', 'doctools' ] },
					{ name: 'colors' },
					{ name: 'others' },
					'/',
					{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
					{ name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
					{ name: 'styles' }
				],
			});
		});
	});
</script>
<?php $DetailCatalogues = recursive($DetailCatalogues); ?>
<div id="homepage" class="page-body">
	<div class="breadcrumb">
		<div class="uk-container uk-container-center"> 
			<ul class="uk-breadcrumb">
				<li>
					<a href="<?php echo base_url(); ?>" title="<?php echo $this->lang->line('home_page') ?>">
					<i class="fa fa-home"></i> <?php echo $this->lang->line('home_page') ?></a>
				</li>
				<li class="uk-active">
					<a href="javascript: void(0)" title="Đăng tin">
					Đăng tin</a>
				</li>
			</ul>
		</div>
	</div>
	<div class="uk-container uk-container-center">
		<div class="uk-grid uk-grid-medium mb20">
			<div class="uk-width-large-2-3">
				<section class="project-create">
					<header class="panel-head">
						<div class="heading-2 mb0"><span>Xóa tin đăng</span></div>
					</header>
					<section class="panel-body">
						<?php $error = validation_errors(); echo !empty($error) ? '<div class="callout callout-danger" style="padding:10px;background:rgb(195, 94, 94);color:#fff;margin-bottom:10px;">'.$error.'</div>' : '';?>
						<form action="" method="post" accept-charset="utf-8">
							<div class="line-form mb20">
								<div class="box_title">
									<div class="uk-flex lib-grid-15 uk-flex-middle">
										<div class="label-left">
											<label>Tiều đề đăng</label>
										</div>
										<div class="label-right uk-width-1-1">
											<label class="label-label">
												<?php echo form_input('title', set_value('title', $DetailProjects['title']), 'class="uk-width-1-1 input-text"');?>
											</label>
											<?php $code = code_generator('projects'); ?>
											<?php echo form_hidden('code', set_value('code', $code), 'class="uk-width-1-1"'); ?>
										</div>
									</div>
								</div>
							</div>
							<div class="line-form mb20 bor_bor">
								<div class="box_title_2">
									<span>Thông tin chung</span>
								</div>
								<div class="content_content">
									<div class="uk-flex item-form uk-flex-middle">
										<div class="label-left bg_bg">
											<label class="label-label">Loại BĐS *</label>
										</div>
										<div class="label-right uk-width-1-1 bdl0">
											<label class="label-label">
												<div class="uk-flex uk-flex-middle pdall">
													<select class="input-text catagolies" name="catalogue[]">
														<option value="">Chọn danh mục</option>
														<?php if (isset($DetailCatalogues) && is_array($DetailCatalogues) && count($DetailCatalogues)) { ?>
															<?php foreach ($DetailCatalogues as $key => $val){ ?>
																<option <?php echo (($val['id'] == $DetailProjects['cataloguesid']) ? 'selected' : '') ?> value="<?php echo $val['id'] ?>"><?php echo $val['title'] ?></option>
																<?php if (isset($val['child']) && is_array($val['child']) && count($val['child'])) { ?>
																	<?php foreach ($val['child'] as $key => $vals){ ?>
																		<option <?php echo (($vals['id'] == $DetailProjects['cataloguesid']) ? 'selected' : '') ?> value="<?php echo $vals['id'] ?>">|----<?php echo $vals['title'] ?></option>
																	<?php } ?>
																<?php } ?>
															<?php } ?>
														<?php } ?>
													</select>
													<span> / </span>
													<div class="fillter">
														<label class="red">
															Tin thường  <input <?php echo (($DetailProjects['isaside'] == 0) ? 'checked' : '') ?> name="isaside" value="0" class="check-box" type="radio">
														</label>
													</div>
													<div class="fillter">
														<label class="red">
															Tin vip  <input <?php echo (($DetailProjects['isaside'] == 1) ? 'checked' : '') ?> name="isaside" value="1" class="check-box" type="radio">
														</label>
													</div>
												</div>
											</label>
										</div>
									</div>
								</div>
							</div>
							<div class="line-form mb20 bor_bor">
								<div class="box_title_2">
									<span>Chi tiết</span>
								</div>
								<div class="content_content">
									<div class="uk-flex item-form uk-flex-middle">
										<div class="label-left bg_bg">
											<label class="label-label">Thông tin liên hệ</label>
										</div>
										<div class="label-right uk-width-1-1 bdl0">
											<label class="label-label" style="line-height: 0;padding: 10px;">
												<?php echo form_textarea('description', set_value('description', $DetailProjects['description']), 'cols="40" rows="10" id="txtDescription" class="" placeholder="Mô tả" style="width: 100%; height: 100px; font-size: 13px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"');?>
											</label>
										</div>
									</div>
									<div class="uk-flex item-form uk-flex-middle">
										<div class="label-left bg_bg">
											<label class="label-label">Nội dung</label>
										</div>
										<div class="label-right uk-width-1-1 bdl0">
											<label class="label-label" style="line-height: 0;padding: 10px;">
												<?php echo form_textarea('content', htmlspecialchars_decode(set_value('content', $DetailProjects['content'])), 'cols="40" rows="10"  id="txtContent" class="ckeditor-description" placeholder="Nội dung" style="width: 100%; height: 350px; font-size: 13px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"');?>
											</label>
										</div>
									</div>
									<div class="uk-flex item-form uk-flex-middle">
										<div class="label-right uk-width-1-1 uk-text-center" style="width: 100%;">
											<button type="submit" name="delete" value="action" class="btn btn-info">Xóa</button>
										</div>
									</div>
								</div>
							</div>
						</form>
					</section>
				</section>
			</div>
			<div class="uk-width-large-1-3">
				<?php $this->load->view('homepage/frontend/common/customers_aside'); ?>
			</div>
		</div>
	</div>
</div>