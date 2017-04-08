<!doctype html>
<html>
<head>
<meta charset="utf-8">
<?php include 'navbar.php'; ?>
<?php 
$username = NULL;
if(isset($_SESSION['username'])){$username = $_SESSION['username'];}
$permission_level = get_permission_level($link,get_user_id($link,$username));
$is_admin = is_admin($permission_level); 
if(isset($_POST['subscriptionsubmit'])){
	if($is_admin){
		create_subscription($link,$username,$_POST['title'],$_POST['description']);
	}else{
		echo "you are not an admin";	
	}
}

?>
<title>Create Subscription</title>
</head>

<body>
<form class="form-horizontal" action="" method="post">
<fieldset>

<!-- Form Name -->
<legend>Create Subscription</legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="title">Title</label>  
  <div class="col-md-4">
  <input id="title" name="title" type="text" placeholder="title" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Textarea -->
<div class="form-group">
  <label class="col-md-4 control-label" for="description">Description</label>
  <div class="col-md-4">                     
    <textarea class="form-control" id="description" name="description"></textarea>
  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="subscriptionsubmit"></label>
  <div class="col-md-4">
    <button id="subscriptionsubmit" name="subscriptionsubmit" class="btn btn-primary">Create</button>
  </div>
</div>

</fieldset>
</form>

</body>
<?php 



?>

</html>
