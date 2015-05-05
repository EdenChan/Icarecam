<?php require_once('header.php');?>

<?php require_once('sidebar.php');?>
<script>
          KindEditor.ready(function(K) {
            var editor1 = K.create('textarea[name="goods_desc"]', {
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
				<h1>添加摄像头</h1>
			</div>
			<div class="container-fluid">
				<div class="row-fluid">
					<div class="span12">
						<div class="widget-box">
							<div class="widget-title">
								<span class="icon">
									<i class="icon-align-justify"></i>
								</span>
								<h5>添加摄像头</h5>
							</div>
							<div class="widget-content nopadding">
								<form class="form-horizontal" action="<?php echo site_url('admin/goods/insert');?>" method="post" name="theForm" enctype="multipart/form-data">
                                    <div class="control-group">
                                        <label class="control-label">商品名称：</label>
                                        <div class="controls">
                                            <input type="text" name="goods_name" id="goods_name" />
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">商品简单描述：</label>
                                        <div class="controls">
                                            <textarea name="goods_brief" id="goods_brief" style="height:100px;"></textarea>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">本店售价：</label>
                                        <div class="controls">
                                            <input type="text" name="shop_price" id="shop_price" />
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">市场售价：</label>
                                        <div class="controls">
                                            <input type="text" name="market_price"/>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">是否出现在首页：</label>
                                        <div class="controls">
                                           <input type="checkbox" name="is_index" value="1"/><span class="help-block">（请注意首页仅可放置2个推荐商品）</span>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">上传商品图片：</label>
                                        <div class="controls">
                                            <input type="file" name="goods_img" />
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">商品参数设置：</label>
                                        <div class="controls">
                                            <textarea id="goods_params" name="goods_params" style="height:100px;" placeholder="参数1：参数值1，参数2：参数值2，参数3：参数值3"></textarea>
                                            <p class="help-block">设置商品参数时请遵循格式"参数1：参数值1，参数2：参数值2.."请去掉这里的双引号，并且格式中的：和，均为中文字符，最后一个参数不需加上逗号</p>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">详细描述：</label>
                                        <div class="controls">
                                            <textarea id="goods_desc" name="goods_desc" value="" ></textarea>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <input type="submit" value="添加商品" class="btn btn-primary" />
                                        <input type="reset" value=" 重置 "class="btn btn-primary"/>
                                    </div>
                                </form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php require_once('footer.php');?>