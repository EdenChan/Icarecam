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
            <h1>软件编辑</h1>
        </div>
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="span12">
                    <div class="widget-box">
                        <div class="widget-title">
								<span class="icon">
									<i class="icon-align-justify"></i>
								</span>
                            <h5>软件编辑</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <form class="form-horizontal" action="<?php echo site_url('admin/apps/update'); ?>"
                                  method="post" name="theForm" enctype="multipart/form-data">
                                <div class="control-group">
                                    <label class="control-label">软件名称：</label>

                                    <div class="controls">
                                        <input type="hidden" name="apps_id" size="30"
                                               value="<?php echo $apps['apps_id']; ?>">
                                        <input type="text" name="apps_name" size="30"
                                               value="<?php echo $apps['apps_name']; ?>">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">App简单描述：</label>

                                    <div class="controls">
                                        <textarea name="apps_brief" id="apps_brief"
                                                  style="height:100px;"><?php echo $apps['apps_brief']; ?></textarea>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">软件原图：</label>

                                    <div class="controls">
                                        <img src="<?php echo base_url('public/uploads/') . '/' . $apps['apps_img']; ?>"
                                             style="max-width:200px;max_height:200px;"/>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <div class="controls"><a href="#myAlertBan1" data-toggle="modal"
                                                             class="btn">替换软件图片</a></div>
                                </div>
<!--                                <div class="control-group">-->
<!--                                    <label class="control-label">软件原文件：</label>-->
<!---->
<!--                                    <div class="controls">-->
<!--                                        <a href="--><?php //echo base_url('public/uploads/') . '/' . $apps['apps_file']; ?><!--">文件下载</a>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                                <div class="control-group">-->
<!--                                    <div class="controls"><a href="#myAlertBan2" data-toggle="modal"-->
<!--                                                             class="btn">替换软件文件</a></div>-->
<!--                                </div>-->
                                <div class="control-group">
                                    <label class="control-label">详细描述：</label>

                                    <div class="controls">
                                        <textarea id="apps_desc"
                                                  name="apps_desc"><?php echo $apps['apps_desc']; ?></textarea>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <input type="submit" value="提交信息" class="btn btn-primary"/>
                                    <input type="reset" value="重置" class="btn btn-primary"/>
                                </div>
                            </form>
                            <div id="myAlertBan1" class="modal hide">
                                <div class="modal-header">
                                    <button data-dismiss="modal" class="close" type="button">x
                                    </button>
                                    <h3>替换图片</h3>
                                </div>
                                <form name="theForm2" class="form-horizontal"
                                      action="<?php echo site_url('admin/apps/update_img'); ?>" method="post"
                                      enctype="multipart/form-data">
                                    <div class="control-group">
                                        <label class="control-label" style="color:red;">替换软件图片：</label>

                                        <div class="controls">
                                            <input type="hidden" name="apps_id" size="30"
                                                   value="<?php echo $apps['apps_id']; ?>"/>
                                            <input type="file" id="apps_img" name="apps_img" size="20"/>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <input class="btn" type="submit" value="替换图片"/>
                                        <a data-dismiss="modal" class="btn" href="#">取消</a>
                                    </div>
                                </form>
                            </div>
                            <div id="myAlertBan2" class="modal hide">
                                <div class="modal-header">
                                    <button data-dismiss="modal" class="close" type="button">x
                                    </button>
                                    <h3>替换文件</h3>
                                </div>
                                <form name="theForm3" class="form-horizontal"
                                      action="<?php echo site_url('admin/apps/update_file'); ?>" method="post"
                                      enctype="multipart/form-data">
                                    <div class="control-group">
                                        <label class="control-label" style="color:red;">替换软件文件：</label>

                                        <div class="controls">
                                            <input type="hidden" name="apps_id" size="30"
                                                   value="<?php echo $apps['apps_id']; ?>"/>
                                            <input type="file" id="apps_file" name="apps_file" size="20"/>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <input class="btn" type="submit" value="替换文件"/>
                                        <a data-dismiss="modal" class="btn" href="#">取消</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php require_once('footer.php'); ?>