<?php require_once('header.php');?>
<?php require_once('sidebar.php');?>

<div id="content">
	<div id="content-header">
		<h1>订单列表</h1>
	</div>
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="span12">
				<div class="widget-box">
					<div class="widget-title">
						<h5>订单列表</h5>
					</div>
					<div class="widget-content nopadding">
						<table class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>订单编号</th>
									<th>用户编号</th>
									<th>订单状态</th>
									<th>快递方式</th>
									<th>订单总额</th>
									<th>下单时间</th>
									<th>订单详情</th>
									<th>撤销订单</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($order as $v):?>
									<tr class="gradeX">
										<td><?php echo $v['order_sn'];?></td>
										<td><?php echo $v['user_id'];?></td>
										<td>
											<?php echo $v['order_status'];?>
											<a href="#myAlertBan<?php echo $v['order_id']+99999;?>" data-toggle="modal"
												>更改状态</a>
												<div id="myAlertBan<?php echo $v['order_id']+99999;?>" class="modal hide">
													<div class="modal-header">
														<button data-dismiss="modal" class="close" type="button">x
														</button>
														<h3>更改订单状态</h3>
													</div>
													<form name="theForm3" class="form-horizontal" action="<?php echo site_url('admin/order/update');?>" method="post" enctype="multipart/form-data">
														<div class="control-group">
															<label class="control-label" style="color:red;">更改订单状态</label>
															<div class="controls">
																<input type="hidden" name="order_sn" value="<?php echo $v['order_sn'];?>" size="30"/>
																<input type="text" id="order_status" name="order_status" size="20" value="<?php echo $v['order_status'];?>" />
																<span class="help-block">（订单状态请设置为“未发货”“已发货+快递单号xxxxx”和“已完成”，请勿设置其他值）</span>
															</div>
														</div>
														<div class="modal-footer">
															<input class="btn" type="submit" value="更改状态" />
															<a data-dismiss="modal" class="btn" href="#">取消</a>
														</div>
													</form>
												</div>
											</td>
											<td><?php echo $v['shipping_method'];?></td>
											<td>￥<?php echo $v['order_amount'];?></td>
											<td><?php echo $v['order_time'];?></td>
											<td>
												<a class="btn btn-primary" href="<?php echo site_url('admin/order/detail').'/'. $v['order_sn'];?>">订单详情</a>
											</td>
											<td>
												<a href="#myAlertBan<?php echo $v['order_id'];?>" data-toggle="modal"
													class="btn btn-danger">删除</a>
													<div id="myAlertBan<?php echo $v['order_id'];?>" class="modal hide">
														<div class="modal-header">
															<button data-dismiss="modal" class="close" type="button">x
															</button>
															<h3>删除</h3>
														</div>
														<div class="modal-body">
															<p>确定删除此订单信息吗</p>
														</div>
														<div class="modal-footer">
															<a href="<?php echo site_url('admin/order/delete').'/'. $v['order_sn'];?>" class="btn btn-danger">确定</a>
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