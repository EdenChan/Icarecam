<?php require_once('header.php');?>
<?php require_once('sidebar.php');?>

		<div id="content">
			<div id="content-header">
				<h1>用户配送信息</h1>
			</div>
			<div class="container-fluid">
								<div class="row-fluid">
									<div class="span12">
										<div class="widget-box">
											<div class="widget-title">
												<span class="icon">
													<i class="icon-align-justify"></i>
												</span>
												<h5>用户配送信息</h5>
											</div>
											<div class="widget-content nopadding">
											<?php if (empty($userinfo)) :?>
											<!-- 用户配送信息为空 -->
											        <div class="message">
											            <p>该用户尚未设置个人配送信息</p>
											        </div>
											<!--用户配送信息为空 end-->
											<?php else :?>
												<table class="table table-hover">
												      <tbody>
												        <tr>
												          <td>收件人姓名</td>
												          <td><?php echo $userinfo['user_realname'];?></td>
												        </tr>
												        <tr>
												          <td>收件人详细地址</td>
												          <td><?php echo $userinfo['user_province'].$userinfo['user_city'].$userinfo['user_district'].$userinfo['user_street'];?></td>
												        </tr>
												        <tr>
												          <td>收件人联系方式</td>
												          <td><?php echo $userinfo['user_mobile'];?></td>
												        </tr>
												        <tr>
												          <td>收件人邮编</td>
												          <td><?php echo $userinfo['user_zipcode'];?></td>
												        </tr>
												      </tbody>
												</table>
											<?php endif;?>
											</div>
										</div>
									</div>
								</div>
			</div>
		</div>
<?php require_once('footer.php');?>