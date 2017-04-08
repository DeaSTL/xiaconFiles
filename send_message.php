<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Send Message</title>

<?php include "navbar.php";?>
<?php 
if(isset($_POST['submitsend'])){
	print_r($_POST);
	$receiver_id = $_GET['receiver'];
	$sender_id = get_user_id($link,$_SESSION['username']);
	$message = $_POST['message'];
	send_message($link,$message,$sender_id,$receiver_id);
}
?>
</head>

<body>
<form class="form-horizontal" action="" method="post">
<fieldset>

<!-- Form Name -->
<legend>Send Message</legend>

<!-- Textarea -->
<div class="form-group">
  <label class="col-md-4 control-label" for="message">Message</label>
  <div class="col-md-4">                     
    <textarea class="form-control" id="message" name="message"></textarea>
  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="submitsend"></label>
  <div class="col-md-4">
    <button id="submitsend" name="submitsend" class="btn btn-primary">Send Message</button>
  </div>
</div>

</fieldset>
</form>

</body>

</html>
