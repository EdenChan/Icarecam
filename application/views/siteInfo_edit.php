<?php require_once('header.php');?>

<?php require_once('sidebar.php');?>
<script>
          KindEditor.ready(function(K) {
            var editor1 = K.create('textarea[name="siteInfo_desc"]', {
                cssPath : '<?php echo base_url('application/third_party/kindeditor/plugins/code/prettify.css');?>',
                uploadJson : '<?php echo base_url('application/third_party/kindeditor/php/upload_json.php');?>',
                fileManagerJson : '<?php echo base_url('application/third_party/kindeditor/php/file_manager_json.php');?>',
                allowFileManager : true,
                autoHeightMode: true, //自动高度模式开启
                afterCreate: function () {
                    this.loadPlugin('autoheight');
                }
            });
            prettyPrint();
          });
</script>
		<div id="content">
			<div id="content-header">
				<h1>编辑站点信息</h1>
			</div>
			<div class="container-fluid">
				<div class="row-fluid">
					<div class="span12">
						<div class="widget-box">
							<div class="widget-title">
								<span class="icon">
									<i class="icon-align-justify"></i>
								</span>
								<h5>编辑站点信息</h5>
							</div>
							<div class="widget-content nopadding">
								<form class="form-horizontal" action="<?php echo site_url('admin/siteInfo/update');?>" method="post" name="theForm" enctype="multipart/form-data">
                                    <div class="control-group">
                                        <label class="control-label">信息名称：</label>
                                        <div class="controls">
                                            <input type="hidden" name="siteInfo_id" size="30" value="<?php echo $siteInfo['siteInfo_id'];?>"/>
                                            <?php echo $siteInfo['siteInfo_name'];?>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">信息内容：</label>
                                        <div class="controls">
                                            <textarea id="siteInfo_desc" name="siteInfo_desc"><?php echo $siteInfo['siteInfo_desc'];?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <input type="submit" value="更新站点信息" class="btn btn-primary" />
                                        <input type="reset" value=" 重置 " class="btn btn-primary"/>
                                    </div>
                                </form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php require_once('footer.php');?>