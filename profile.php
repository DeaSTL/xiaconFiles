<!doctype html>
<html>

<head>
<link rel="stylesheet" type="text/css" href="css/profile.css">

<?php include "navbar.php"; ?>
<?php $link = new mysqli('localhost','id1043442_xiacon','fra8w+f+at#=TaspEfrexeGACh+!ATrU','id1043442_main');
$sel_user = $_GET['profile'];
$sel_user_id = get_user_id($link,$sel_user);
$sel_user_permission_level = get_permission_level($link,$sel_user_id);
$sel_user_is_admin = is_admin($sel_user_permission_level);
$visitor_user = NULL; 
if(isset($_SESSION['username'])){$visitor_user = $_SESSION['username'];}
$permission_level = get_permission_level($link,get_user_id($link,$visitor_user)) or 0;
$is_admin = is_admin($permission_level);
$subscriptions = get_subscriptions($link,get_user_id($link,$sel_user));
$followers = get_followers($link,$sel_user_id);
$following = get_following($link,$sel_user_id);
 
$picture_dir = $link->query("SELECT `picture_dir` FROM `user_att` WHERE `username`='$sel_user'");
$picture_dir = $picture_dir->fetch_array()['picture_dir'];

if(isset($_GET['follow'])){
	$user = $_GET['profile'];
	$follower = $_SESSION['username'];
	$user = get_user_id($link,$user);
	$follower = get_user_id($link,$follower);
	
	if(!check_follow($link,$user,$follower)){
		follow_user($link,$user,$follower);	
	}else{
		print_r("You already follow this person");	
	}
		
}


?>
<script src="js/profile.js"></script>
</head>
<body>
<div class="container-fluid">
    <div class="card hovercard">
        <div class="card-background">
            <img class="card-bkimg" alt="" src="<?php echo $picture_dir;?>">
            <!-- http://lorempixel.com/850/280/people/9/ -->
        </div>
        <div class="useravatar">
            <a href="profile.php?<?php if(isset($_SESSION['username'])){echo 'profile='.$sel_user.'&follow=true';}else{echo 'profile='.$sel_user;}?>"><img alt="" src="<?php echo $picture_dir;?>" width="100" height="100"></a>
        </div>
        <div class="card-info"> <span class="card-title" style="background-color:#F7F7F7;"><?php if(isset($_GET['profile'])){echo $_GET['profile'];}?></span>
        <?php if($sel_user_is_admin){ echo '<a href="" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-user"></span> Admin</a>';}?>
        </div>
        <div></div>
         
    </div>
    <div class="btn-group" role="group" align="center">
    	
      
      <?php
	  if(isset($visitor_user)){
		  echo '<a class="btn btn-secondary" href="send_message.php?receiver='.get_user_id($link,$sel_user).'">Send Message <span class="glyphicon glyphicon-envelope"></span></a>';
		  if($sel_user == $visitor_user){
			echo '
		  <a class="btn btn-secondary" href="view_messages.php">View Messages <span class="glyphicon glyphicon-envelope"></span></a>';
			 if($is_admin){
				 echo '
				<a class="btn btn-danger" href="create_subscription.php">Create Subscription <span class="glyphicon glyphicon-plus"></span></a>';			
					
			 }
		  }
	  }
	   ?>
       
    </div>
    <div class="btn-pref btn-group btn-group-justified btn-group-lg" role="group" aria-label="...">
        <div class="btn-group" role="group">
            <button type="button" id="stars" class="btn btn-primary" href="#tab1" data-toggle="tab"><span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                <div class="hidden-xs">Subscriptions <?php echo count($subscriptions)?></div>
            </button>
        </div>
        <div class="btn-group" role="group">
            <button type="button" id="favorites" class="btn btn-default" href="#tab2" data-toggle="tab"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                <div class="hidden-xs">Followers <?php echo count($followers)?></div>
            </button>
        </div>
        <div class="btn-group" role="group">
            <button type="button" id="following" class="btn btn-default" href="#tab3" data-toggle="tab"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                <div class="hidden-xs">Following <?php echo count($following)?></div>
            </button>
        </div>
    </div>

        <div class="well">
      <div class="tab-content">
        <div class="tab-pane fade in active" id="tab1">
          <h3>All Subscriptions</h3>
          <?php 
		  	if($subscriptions == NULL){
				echo '<a>No subscriptions yet.</a>';
			}else{
			
			foreach($subscriptions as $s){
				
				$s = $s[0];
				
				echo '<a class="btn btn-default" href="'.'subscription.php?subscription='.($s).'">'.get_sub_name($link,$s).'</a><br>';
			}
				//print_r(get_username($link,$f[0])."<br>");
			} 
		  ?>
        </div>
        <div class="tab-pane fade in" id="tab2">
          <h3>Followers</h3>
          <?php 
		  	foreach($followers as $f){
				echo '<a class="btn btn-default" href="'.'profile.php?profile='.get_username($link,$f[0]).'">'.get_username($link,$f[0]).'</a><br>';
				//print_r(get_username($link,$f[0])."<br>");
			} 
		  ?>
        </div>
        <div class="tab-pane fade in" id="tab3">
          <h3>Following</h3>
          <?php
		   
		    
		  	foreach($following as $f){
				echo '<a class="btn btn-default" href="'.'profile.php?profile='.get_username($link,$f[0]).'">'.get_username($link,$f[0]).'</a><br>';
				//print_r(get_username($link,$f[0])."<br>");
			} 
		  ?>
        </div>
      </div>
    </div>
    
    </div>
</body>
</html>
