<?php require_once('header.php');?>
    <style>
        textarea{
            width: auto !important;
        }
    </style>
<?php require_once('sidebar.php');?>

    <div id="content">
        <div id="content-header">
            <h1>首页信息设置</h1>
        </div>
        <div class="container-fluid">
            <form action="<?php echo site_url('admin/indexInfo/update');?>" method="post" name="theForm" enctype="multipart/form-data"">
            <div class="row-fluid">
                <div class="span6">
                    <div class="widget-box">
                        <div class="widget-title">
								<span class="icon">
									<i class="icon-th-list"></i>
								</span>
                            <h5>首页简介</h5>
                        </div>
                        <div class="widget-content">
                            <textarea name="index_brief_desc" id="index_brief_desc" cols="50" rows="10"><?php echo $index_brief['indexInfo_desc'];?></textarea>
                            <input type="hidden" name="index_brief_id" value="<?php echo $index_brief['indexInfo_id'];?>"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row-fluid">
                <?php for($i=1;$i<5;$i++) {
                    $index_slide_url = 'index_slide_'.$i.'_url';
                    $index_slide_url_true = $$index_slide_url;
                    ?>
                <div class="span3">
                    <div class="widget-box">
                        <div class="widget-title">
								<span class="icon">
									<i class="icon-th-list"></i>
								</span>
                            <h5>首页幻灯片<?php echo $i;?></h5>
                        </div>
                        <div class="widget-content">
                            <div class="control-group">
                                <label class="control-label">幻灯片<?php echo $i;?>：</label>
                                <div class="controls">
                                    <input type="file" name="index_slide_<?php echo $i;?>" />
                                    <span class="help-block">支持jpg和png格式，图片大小请勿超过7mb</span>
                                </div>
                            </div>
                            <?php if(file_exists('public/uploads/index_slide_'.$i.'.jpg')) {?>
                            <div class="index_slide_<?php echo $i;?>">
                                当前图片：<br/><a href="<?php echo $index_slide_url_true['indexInfo_desc'];?>"><img style="max-width: 150px;" src="<?php echo base_url('public/uploads/') . '/' . 'index_slide_'.$i.'.jpg'; ?>"></a>
                                <br/><a href="<?php echo site_url('admin/indexInfo/delImg/'.$i);?>">删除</a>
                            </div>
                            <?php }?>
                            <br/>
                            <div class="control-group">
                                <label class="control-label">幻灯片<?php echo $i;?>外链：</label>
                                <div class="controls">
                                    <input name="index_slide_<?php echo $i;?>_url" id="<?php echo $index_slide_url_true['indexInfo_id'];?>" value="<?php echo $index_slide_url_true['indexInfo_desc'];?>" placeholder="http://"/>
                                    <span class="help-block">外链开头请加上http:// 否则无法保证正确链接</span>
                                    <input type="hidden" name="index_slide_<?php echo $i;?>_url_id" value="<?php echo $index_slide_url_true['indexInfo_id'];?>"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php }?>
            </div>
            <div class="row-fluid">
                <div class="span6">
                    <div class="widget-box">
                        <div class="widget-title">
								<span class="icon">
									<i class="icon-th-list"></i>
								</span>
                            <h5>首页slogan</h5>
                        </div>
                        <div class="widget-content">
                            <div class="control-group">
                                <label class="control-label">首页slogan文字：</label>
                                <div class="controls">
                                    <input name="index_slogan_desc" id="index_slogan_desc" value="<?php echo $index_slogan['indexInfo_desc'];?>"/>
                                    <input type="hidden" name="index_slogan_id" value="<?php echo $index_slogan['indexInfo_id'];?>"/>
                                </div>
                            </div>
                            <br/>
                            <div class="control-group">
                                <label class="control-label">首页slogan图片：</label>
                                <div class="controls">
                                    <input type="file" name="index_slogan_bg" />
                                </div>
                            </div>
                            <div class="index_slogan_bg">
                                当前图片：<br/><img style="max-width: 150px;" src="<?php echo base_url('public/uploads/') . '/' . 'index_slogan_bg.jpg'; ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row-fluid">
                <div class="span4">
                    <div class="widget-box">
                        <div class="widget-title">
								<span class="icon">
									<i class="icon-th-list"></i>
								</span>
                            <h5>首页优势1</h5>
                        </div>
                        <div class="widget-content">
                            <textarea name="index_merit_1_desc" id="index_merit_1_desc" cols="50" rows="10"><?php echo $index_merit_1['indexInfo_desc'];?></textarea>
                            <input type="hidden" name="index_merit_1_id" value="<?php echo $index_merit_1['indexInfo_id'];?>"/>
                        </div>
                    </div>
                </div>
                <div class="span4">
                    <div class="widget-box">
                        <div class="widget-title">
								<span class="icon">
									<i class="icon-th-list"></i>
								</span>
                            <h5>首页优势2</h5>
                        </div>
                        <div class="widget-content">
                            <textarea name="index_merit_2_desc" id="index_merit_2_desc" cols="50" rows="10"><?php echo $index_merit_2['indexInfo_desc'];?></textarea>
                            <input type="hidden" name="index_merit_2_id" value="<?php echo $index_merit_2['indexInfo_id'];?>"/>
                        </div>
                    </div>
                </div>
                <div class="span4">
                    <div class="widget-box">
                        <div class="widget-title">
								<span class="icon">
									<i class="icon-th-list"></i>
								</span>
                            <h5>首页优势3</h5>
                        </div>
                        <div class="widget-content">
                            <textarea name="index_merit_3_desc" id="index_merit_3_desc" cols="50" rows="10"><?php echo $index_merit_3['indexInfo_desc'];?></textarea>
                            <input type="hidden" name="index_merit_3_id" value="<?php echo $index_merit_3['indexInfo_id'];?>"/>
                        </div>
                    </div>
                </div>
            </div>
            <input class="btn btn-primary" type="submit" value="提交更新"/>
            </form>
        </div>
    </div>
<?php require_once('footer.php');?>