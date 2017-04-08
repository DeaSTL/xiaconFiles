<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Link Your Image</title>
<?php include "navbar.php"?>
</head>

<body>
<form class="form-horizontal" action="" method="post">
<fieldset>

<!-- Form Name -->
<legend>Choose a link</legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">Link</label>  
  <div class="col-md-4">
  <input id="textinput" name="imagelink" type="text" placeholder="image link" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="submit"></label>
  <div class="col-md-4">
    <button type="submit" name="picturesubmit" class="btn btn-primary">Set</button>
  </div>
</div>

</fieldset>
</form>
</body>
<?php 
	$link = new mysqli('localhost','id1043442_xiacon','fra8w+f+at#=TaspEfrexeGACh+!ATrU','id1043442_main');
	if(isset($_POST['picturesubmit'])){
		
		$pictureInput = $_POST['imagelink'];
		$lusername = $_SESSION['username'];
		$link->query("UPDATE `user_att` SET `picture_dir`='$pictureInput' WHERE `username`='$lusername'");
	}
?>

</html>
