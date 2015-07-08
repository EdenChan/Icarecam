<?php require_once('header.php'); ?>

<?php require_once('sidebar.php'); ?>
    <script>
        KindEditor.ready(function (K) {
            var editor1 = K.create('textarea[name="apps_desc"]', {
                cssPath: '<?php echo base_url('application/third_party/kindeditor/plugins/code/prettify.css');?>',
                uploadJson: '<?php echo base_url('application/third_party/kindeditor/php/upload_json.php');?>',
                fileManagerJson: '<?php echo base_url('application/third_party/kindeditor/php/file_manager_json.php');?>',
                allowFileManager: true,
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
            <h1>添加App软件</h1>
        </div>
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="span12">
                    <div class="widget-box">
                        <div class="widget-title">
								<span class="icon">
									<i class="icon-align-justify"></i>
								</span>
                            <h5>添加App软件</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <form class="form-horizontal" action="<?php echo site_url('admin/apps/insert'); ?>"
                                  method="post" name="theForm" enctype="multipart/form-data">
                                <div class="control-group">
                                    <label class="control-label">App名称：</label>

                                    <div class="controls">
                                        <input type="text" name="apps_name" id="apps_name"/>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">App简单描述：</label>

                                    <div class="controls">
                                        <textarea name="apps_brief" id="apps_brief" style="height:100px;"></textarea>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">上传App展示图片：</label>

                                    <div class="controls">
                                        <input type="file" name="apps_img"/>
                                    </div>
                                </div>
<!--                                <div class="control-group">-->
<!--                                    <label class="control-label">上传App压缩文件：</label>-->
<!---->
<!--                                    <div class="controls">-->
<!--                                        <input type="file" name="apps_file"/>-->
<!---->
<!--                                        <p class="help-block">请注意压缩文件仅支持zip/rar格式,且文件名中请勿包含中文</p>-->
<!--                                    </div>-->
<!--                                </div>-->
                                <div class="control-group">
                                    <label class="control-label">详细描述：</label>

                                    <div class="controls">
                                        <textarea id="apps_desc" name="apps_desc" value=""></textarea>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <input type="submit" value="添加App" class="btn btn-primary"/>
                                    <input type="reset" value=" 重置 " class="btn btn-primary"/>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php require_once('footer.php'); ?>