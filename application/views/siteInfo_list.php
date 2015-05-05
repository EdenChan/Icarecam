<?php require_once('header.php');?>
<?php require_once('sidebar.php');?>

		<div id="content">
			<div id="content-header">
				<h1>站点信息列表</h1>
			</div>
			<div class="container-fluid">
				<div class="row-fluid">
					<div class="span12">
						<div class="widget-box">
							<div class="widget-title">
								<h5>站点信息列表</h5>
							</div>
							<div class="widget-content nopadding">
								<table class="table table-bordered table-striped">
									<thead>
									<tr>
									<th>名称</th>
									<th>编辑信息</th>
									</tr>
									</thead>
									<tbody>
									<?php foreach($siteInfo as $v):?>
									<tr class="gradeX">
									<td><?php echo $v['siteInfo_name'];?></td>
									<td><a href="<?php echo site_url('admin/siteInfo/edit').'/'. $v['siteInfo_id'];?>" class="btn btn-primary">编辑</a></td>
									</tr>
									<?php endforeach;?>
									</tbody>
									</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php require_once('footer.php');?>