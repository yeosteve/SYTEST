<html>
<head>
<title>Upload Form</title>
</head>
<body>

<?php echo $error;?>

<?php echo form_open_multipart('upload/uploadManager');?>

<input type="file" name="userfile" size="20" />

<br />
<input name="comments" type="text" />
<br />

<input type="submit" value="upload" />

</form>

</body>
</html>