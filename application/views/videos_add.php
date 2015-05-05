<?php require_once('header.php');?>

<?php require_once('sidebar.php');?>
<script>
          KindEditor.ready(function(K) {
            var editor1 = K.create('textarea[name="videos_desc"]', {
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
				<h1>添加视频</h1>
			</div>
			<div class="container-fluid">
				<div class="row-fluid">
					<div class="span12">
						<div class="widget-box">
							<div class="widget-title">
								<span class="icon">
									<i class="icon-align-justify"></i>
								</span>
								<h5>添加视频</h5>
							</div>
							<div class="widget-content nopadding">
								<form class="form-horizontal" action="<?php echo site_url('admin/videos/insert');?>" method="post" name="theForm" enctype="multipart/form-data">
                                    <div class="control-group">
                                        <label class="control-label">视频名称：</label>
                                        <div class="controls">
                                            <input type="text" name="videos_name" id="videos_name" />
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">是否出现在首页：</label>
                                        <div class="controls">
                                           <input type="checkbox" name="is_index" value="1"/><span class="help-block">（请注意首页仅可放置1个推荐视频）</span>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">视频分享代码：</label>
                                        <div class="controls">
                                            <input type="text" name="videos_src" />
                                            <p class="help-block">请将想发布的优酷视频下方的“分享给好友”选项“通用代码”</p><p class="help-block">（如：iframe height=498 width=510 src="http://player.youku.com/1"）中的src链接，</p><p class="help-block">如：http://player.youku.com/1 复制粘贴到上面的输入框即可，请勿复制多余的代码，否则无法正常显示</p>
                                            <img src="<?php echo base_url('application/views/img/youku.png');?>" alt="" />
                                        </div>                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">详细描述：</label>
                                        <div class="controls">
                                            <textarea id="videos_desc" name="videos_desc"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <input type="submit" value="添加视频" class="btn btn-primary" />
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