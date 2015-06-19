<?php require_once('header.php');?>

<?php require_once('sidebar.php');?>
<?php
    #格式转换 把参数字符串转换为参数数组
	function str2arr ($str)
	{
        $arr = explode("，",$str);
        $r = array();
        foreach ($arr as $val )
        {
            $t = explode("：",$val);
            $r[$t[0]]= $t[1];
        }
        return $r;
	}
?>
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
				<h1>摄像头编辑</h1>
			</div>
			<div class="container-fluid">
				<div class="row-fluid">
					<div class="span12">
						<div class="widget-box">
							<div class="widget-title">
								<span class="icon">
									<i class="icon-align-justify"></i>
								</span>
								<h5>摄像头编辑</h5>
							</div>
							<div class="widget-content nopadding">
								<form class="form-horizontal" action="<?php echo site_url('admin/goods/update');?>" method="post" name="theForm" enctype="multipart/form-data">
                                    <div class="control-group">
                                        <label class="control-label">商品名称：</label>
                                        <div class="controls">
                                            <input type="hidden" name="goods_id" size="30" value="<?php echo $goods['goods_id'];?>">
                                            <input type="text" name="goods_name" size="30" value="<?php echo $goods['goods_name'];?>">
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">商品简单描述：</label>
                                        <div class="controls">
                                            <textarea name="goods_brief" id="goods_brief" style="height:100px;"><?php echo $goods['goods_brief']?></textarea>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">本店售价：</label>
                                        <div class="controls">
                                            <input type="text" name="shop_price" id="shop_price" value="<?php echo $goods['shop_price'];?>" />
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">市场售价：</label>
                                        <div class="controls">
                                            <input type="text" name="market_price" value="<?php echo $goods['market_price'];?>"/>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                    <?php if($goods['is_index']==1) {?>
                                        <label class="control-label">从首页移除：</label>
                                        <div class="controls">
                                           <input type="checkbox" id="is_index" name="is_index" value="0" /><span class="help-block">（此商品现在在首页展示，选择此项可从首页的展示位置中移除）</span>
                                        </div><?php } else {?>
                                        <label class="control-label">设置在首页出现：</label>
                                        <div class="controls">
                                           <input type="checkbox" id="is_index" name="is_index" value="1" /><span class="help-block">（此商品现在并未在首页展示区，可设置此商品在首页展示，注意首页仅可出现两个展示商品）</span>
                                        </div>
                                        <?php }?>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">商品原图：</label>
                                        <div class="controls">
                                            <img src="<?php echo base_url('public/uploads/').'/'.$goods['goods_img'];?>" style="max-width:200px;max_height:200px;"/>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <div class="controls"><a href="#myAlertBan1" data-toggle="modal"
	                                           class="btn">替换商品图片</a></div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">商品参数设置：</label>
                                        <div class="controls">
                                        <textarea id="goods_params" name="goods_params" style="height:100px;"><?php echo $goods['goods_params'];?></textarea>
                                        <p class="help-block">设置商品参数时请遵循格式"参数1：参数值1，参数2：参数值2.."请去掉这里的双引号，并且格式中的：和，均为中文字符</p>
                                        <table>
                                            <?php
                                            	$params = str2arr($goods['goods_params']);
                                            	foreach ($params as $k => $v) {
                                            		echo "<tr><td>".$k."</td><td>".$v."</td></tr>";
                                            	}
                                            ?>
                                        </table>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">详细描述：</label>
                                        <div class="controls">
                                            <textarea id="goods_desc" name="goods_desc"><?php echo $goods['goods_desc'];?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <input type="submit" value="提交信息" class="btn btn-primary" />
                                        <input type="reset" value="重置" class="btn btn-primary"/>
                                    </div>
                                </form>
                                <div id="myAlertBan1" class="modal hide">
                                    <div class="modal-header">
                                        <button data-dismiss="modal" class="close" type="button">x
                                        </button>
                                        <h3>替换图片</h3>
                                    </div>
                                    <form name="theForm2" class="form-horizontal" action="<?php echo site_url('admin/goods/update_img');?>" method="post" enctype="multipart/form-data">
                                    	<div class="control-group">
                                            <label class="control-label" style="color:red;">替换商品图片：</label>
                                            <div class="controls">
                                            	<input type="hidden" name="goods_id" size="30" value="<?php echo $goods['goods_id'];?>"/>
                                                <input type="file" id="goods_img" name="goods_img" size="20" />
                                            </div>
                                        </div>
	                                    <div class="modal-footer">
	                                        <input class="btn" type="submit" value="替换图片" />
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
<?php require_once('footer.php');?>