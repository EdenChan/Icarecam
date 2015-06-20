<?php require_once('header.php'); ?>
<?php require_once('sidebar.php'); ?>

    <div id="content">
        <div id="content-header">
            <h1>软件列表</h1>
        </div>
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="span12">
                    <div class="widget-box">
                        <div class="widget-title">
                            <h5>软件列表</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>软件编号</th>
                                    <th>软件名称</th>
                                    <th>软件图片</th>
                                    <th>编辑软件</th>
                                    <th>删除软件</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($apps as $v): ?>
                                    <tr class="gradeX">
                                        <td><?php echo $v['apps_id']; ?></td>
                                        <td><?php echo $v['apps_name']; ?></td>
                                        <td><img src="<?php echo base_url('public/uploads/') . '/' . $v['apps_img']; ?>"
                                                 style="max-height:50px;"/></td>
                                        <td><a href="<?php echo site_url('admin/apps/edit') . '/' . $v['apps_id']; ?>"
                                               class="btn btn-primary">编辑</a></td>
                                        <td>
                                            <a href="#myAlertBan<?php echo $v['apps_id']; ?>" data-toggle="modal"
                                               class="btn btn-danger">删除</a>

                                            <div id="myAlertBan<?php echo $v['apps_id']; ?>" class="modal hide">
                                                <div class="modal-header">
                                                    <button data-dismiss="modal" class="close" type="button">x
                                                    </button>
                                                    <h3>删除</h3>
                                                </div>
                                                <div class="modal-body">
                                                    <p>确定删除此软件信息吗</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="<?php echo site_url('admin/apps/delete') . '/' . $v['apps_id']; ?>"
                                                       class="btn btn-danger">确定</a>
                                                    <a data-dismiss="modal" class="btn" href="#">取消</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <?php echo $pageinfo; ?>
            </div>
        </div>
    </div>
<?php require_once('footer.php'); ?>