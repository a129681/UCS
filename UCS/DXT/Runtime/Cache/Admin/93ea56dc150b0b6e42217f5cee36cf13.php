<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<form method="post" action="<?php echo U('Admin/Excel/index');?>" enctype="multipart/form-data">
    <h3>导入Excel表：</h3><input type="file" name="file_stu" />
    <input type="submit" value="导入" />
</form>
</body>
</html>