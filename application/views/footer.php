<a href="#myAlert" data-toggle="modal" style="float: right;margin-top:20px;margin-right:20px;margin-bottom:10px;"
   class="btn btn-danger">退出登录</a>
<div id="myAlert" class="modal hide">
    <div class="modal-header">
        <button data-dismiss="modal" class="close" type="button">x</button>
        <h3>退出登录</h3>
    </div>
    <div class="modal-body">
        <p>确认退出登录吗</p>
    </div>
    <div class="modal-footer">
        <button class="btn btn-danger" onclick="location = '<?php echo site_url('admin/privilege/logout'); ?>';
            alert('已成功退出登录');">确定
        </button>
        <a data-dismiss="modal" class="btn" href="#">取消</a>
    </div>
</div>
<script src="<?php echo base_url('application/views/js/jquery.min.js'); ?>"></script>
<script src="<?php echo base_url('application/views/js/jquery.ui.custom.js'); ?>"></script>
<script src="<?php echo base_url('application/views/js/bootstrap.min.js'); ?>"></script>
<script src="<?php echo base_url('application/views/js/jquery.uniform.js'); ?>"></script>
<script src="<?php echo base_url('application/views/js/select2.min.js'); ?>"></script>
<script src="<?php echo base_url('application/views/js/jquery.dataTables.min.js'); ?>"></script>
<script src="<?php echo base_url('application/views/js/unicorn.js'); ?>"></script>
<script src="<?php echo base_url('application/views/js/unicorn.tables.js'); ?>"></script>
</body>
</html>