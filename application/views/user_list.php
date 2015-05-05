<?php require_once('header.php');?>
<?php require_once('sidebar.php');?>

		<div id="content">
			<div id="content-header">
				<h1>用户列表</h1>
			</div>
			<div class="container-fluid">
				<div class="row-fluid">
					<div class="span12">
						<div class="widget-box">
							<div class="widget-title">
								<h5>用户列表</h5>
							</div>
							<div class="widget-content nopadding">
								<table class="table table-bordered table-striped">
									<thead>
									<tr>
									<th>用户编号</th>
									<th>用户名称</th>
									<th>用户邮箱</th>
									<th>用户配送信息</th>
									<th>删除用户</th>
									</tr>
									</thead>
									<tbody>
									<?php foreach($user as $v):?>
									<tr class="gradeX">
									<td><?php echo $v['user_id'];?></td>
									<td><?php echo $v['user_name'];?></td>
									<td><?php echo $v['email'];?></td>
									<td><a href="<?php echo site_url('admin/user/detail').'/'. $v['user_id'];?>" class="btn btn-primary">用户配送信息</a></td>
									<td>
                                        <a href="#myAlertBan<?php echo $v['user_id'];?>" data-toggle="modal"
                                           class="btn btn-danger">删除</a>
                                        <div id="myAlertBan<?php echo $v['user_id'];?>" class="modal hide">
                                            <div class="modal-header">
                                                <button data-dismiss="modal" class="close" type="button">x
                                                </button>
                                                <h3>删除</h3>
                                            </div>
                                            <div class="modal-body">
                                                <p>确定删除此用户信息吗</p>
                                            </div>
                                            <div class="modal-footer">
                                                <a href="<?php echo site_url('admin/user/delete').'/'. $v['user_id'];?>" class="btn btn-danger">确定</a>
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
					<?php echo $pageinfo;?>
				</div>
			</div>
		</div>
<?php require_once('footer.php');?>