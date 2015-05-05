<?php require_once('header.php');?>
<?php require_once('sidebar.php');?>

		<div id="content">
			<div id="content-header">
				<h1>视频列表</h1>
			</div>
			<div class="container-fluid">
				<div class="row-fluid">
					<div class="span12">
						<div class="widget-box">
							<div class="widget-title">
								<h5>视频列表</h5>
							</div>
							<div class="widget-content nopadding">
								<table class="table table-bordered table-striped">
									<thead>
									<tr>
									<th>视频编号</th>
									<th>视频名称</th>
									<th>首页展示</th>
									<th>编辑视频</th>
									<th>删除视频</th>
									</tr>
									</thead>
									<tbody>
									<?php foreach($videos as $v):?>
									<tr class="gradeX">
									<td><?php echo $v['videos_id'];?></td>
									<td><?php echo $v['videos_name'];?></td>
									<td><?php echo $v['is_index'];?></td>
									<td><a href="<?php echo site_url('admin/videos/edit').'/'. $v['videos_id'];?>" class="btn btn-primary">编辑</a></td>
									<td>
	                                        <a href="#myAlertBan<?php echo $v['videos_id'];?>" data-toggle="modal"
	                                           class="btn btn-danger">删除</a>
	                                        <div id="myAlertBan<?php echo $v['videos_id'];?>" class="modal hide">
	                                            <div class="modal-header">
	                                                <button data-dismiss="modal" class="close" type="button">x
	                                                </button>
	                                                <h3>删除</h3>
	                                            </div>
	                                            <div class="modal-body">
	                                                <p>确定删除此视频信息吗</p>
	                                            </div>
	                                            <div class="modal-footer">
	                                                <a href="<?php echo site_url('admin/videos/delete').'/'. $v['videos_id'];?>" class="btn btn-danger">确定</a>
	                                                <a data-dismiss="modal" class="btn" href="#">取消</a>
	                                            </div>
	                                        </div>
	                                </td>
									</tr>
									<?php endforeach;?>
									</tbody>
									</table>
							</div>
						</div>
					</div>
					<p class="help-block">("首页展示"中1表示在首页出现，0表示未出现)</p>
					<?php echo $pageinfo;?>
				</div>
			</div>
		</div>
<?php require_once('footer.php');?>