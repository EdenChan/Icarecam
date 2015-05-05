<?php require_once('header.php');?>

	<meta http-equiv="Refresh" content ="<?php echo $wait;?> ;url=<?php echo $url;?>"/>
	<div class="row-fluid">
		<div class="span12">
			<div class="alert alert-info">
				<?php echo $message;?>
				<br>
				<?php echo $wait;?> 秒之后跳转
			</div>
		</div>
	</div>

        <script src="<?php echo base_url('application/views/js/jquery.min.js');?>"></script>
        <script src="<?php echo base_url('application/views/js/jquery.ui.custom.js');?>"></script>
        <script src="<?php echo base_url('application/views/js/bootstrap.min.js');?>"></script>
        <script src="<?php echo base_url('application/views/js/jquery.uniform.js');?>"></script>
        <script src="<?php echo base_url('application/views/js/unicorn.js');?>"></script>
	</body>
</html>