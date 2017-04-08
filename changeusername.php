<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Change Username</title>
<?php include "navbar.php"?>
</head>

<body>
<form class="form-horizontal" action="" method="post">
<fieldset>

<!-- Form Name -->
<legend>Change Username</legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="newusername">New Username</label>  
  <div class="col-md-4">
  <input id="newusername" name="newusername" type="text" placeholder="username" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="submitchange"></label>
  <div class="col-md-4">
    <button id="submitchange" name="submitchange" class="btn btn-primary">Change</button>
  </div>
</div>

</fieldset>
</form>
</body>
</html>
<?php 
if(isset($_POST['submitchange'])){
	print "<pre>";
	print_r($_POST);
	print "</pre>";
	if(check_username($link,$_POST['newusername'])){
		print_r("Username Is already taken");	
	}else{
		change_username($link,$_SESSION['username'],$_POST['newusername']);
	}
}


?>