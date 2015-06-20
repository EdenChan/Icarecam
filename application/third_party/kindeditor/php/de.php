<?php
$htmlData = '';
if (!empty($_POST['content1'])) {
    if (get_magic_quotes_gpc()) {
        $htmlData = stripslashes($_POST['content1']);
    } else {
        $htmlData = $_POST['content1'];
    }
}
?>
<html>
<style type="text/css">
    img {
        max-height: 400px;
    }
</style>
<body>
<?php echo $htmlData; ?>
</body>
</html>
