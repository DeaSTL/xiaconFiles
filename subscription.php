<!doctype html>
<html>
<head>
<?php include "navbar.php";?>
<meta charset="utf-8">
<title>Subscription</title>
<?php if(isset($_GET['subscription'])){
$username = NULL;
if(isset($_SESSION['username'])){ $username = $_SESSION['username'];} 
$user_id = get_user_id($link,$username);
$sub_id = $_GET['subscription'];
$sub_name = get_sub_name($link,$sub_id);
$sub_author = get_sub_author($link,$sub_id);
$subscribers = get_subscribers($link,$sub_id);
$subscriber_count = count($subscribers);
$is_subscribed = is_subscribed($link,$user_id,$sub_id);
$is_logged_in = isset($_SESSION['username']);
//var_dump($is_subscribed);


}?>

</head>

<body>
<div class="container">
	<div class="row">
		<div class="span4 well">
            <div class="row">
        		<!--<div class="span1"><a href="http://critterapp.pagodabox.com/others/admin" class="thumbnail"><img src="http://critterapp.pagodabox.com/img/user.jpg" alt=""></a></div>-->
        		<div class="span3">
        			<p><?php echo $sub_author; ?></p>
                  	<h4><strong><?php echo $sub_name; ?></strong></h4>
                    <form action="" method="post">
                    	
                    	<input class="btn btn-default" type="submit" value="Subscribe" name="subscribe" <?php if($is_subscribed or !$is_logged_in){ echo 'disabled';} ?>>
                    </form>
        			<span class=" badge badge-warning"><?php echo $subscriber_count;?> Subscribers</span> 
        		</div>
        	</div>
        </div>
	</div>
</div>
<?php 
foreach($subscribers as $sub){
	$sub = $sub[0];
	$sub = get_username($link,$sub);
print_r('<a class="btn btn-default" href="profile.php?profile='.$sub.'"><img width="30" height="30" src="'.'">'.$sub."</a>"."<br>");	
}

?>
</body>
<?php
if(!$is_subscribed){ 
	if(isset($_POST['subscribe'])){
		
		subscribe($link,$user_id,$sub_id);
	
	}
}
?>
</html>
