<?php session_start();?>
<?php if(isset($_GET['logout'])){ $_SESSION['username'] = NULL; session_destroy(); }
$link = new mysqli('localhost','id1043442_xiacon','fra8w+f+at#=TaspEfrexeGACh+!ATrU','id1043442_main');
if(isset($_SESSION['username'])){$username = $_SESSION['username'];}
?>
<?php 

function check_username($link,$user){
	$search = $link->query("SELECT * FROM `user_att` WHERE `username`='$user'");
	$search = $search->fetch_array();
	
	if(isset($search)){
		return true;	
	}else{
		return false;	
	}
}
function add_user_database($link,$username,$email,$password,$gender){
	$password = password_hash($password,PASSWORD_BCRYPT);
	$link->query("INSERT INTO `user_att` (`username`,`password`,`email`,`gender`) VALUES('$username','$password','$email','$gender')");		
}


function register_user($link,$username,$email,$password,$gender){
	if(!check_username($link,$username)){
		add_user_database($link,$username,$email,$password,$gender);
	}else{
		print_r("User already exist");	
	}	
}

function user_login($link,$username,$password){
	$find_user = $link->query("SELECT * FROM `user_att` WHERE `username`='$username'");
	$find_user = $find_user->fetch_array();
	if($find_user == NULL){
		echo "username was not found";
		return false;
	}else{
		$passwordInput = $password;
		$password = $find_user['password'];
		$passwordVer = password_verify($passwordInput,$password);
		if($passwordVer){
			return true;
		}else{
			print_r("password was incorrect");
		}	
	}	
}
function get_user_id($link,$username){
	$username = $link->real_escape_string($username);
	$id = $link->query("SELECT `id` FROM `user_att` WHERE `username`='$username'");
	$id = $id->fetch_array();
	return $id[0]; 
}
function get_username($link,$id){
	$username = $link->query("SELECT `username` FROM `user_att` WHERE `id`='$id'");
	$username = $username->fetch_array();
	return $username[0]; 
}
function get_permission_level($link,$user_id){
	$permission_level = $link->query("SELECT `permission_level` FROM `user_att` WHERE `id`='$user_id'");
	$permission_level = $permission_level->fetch_array();
	return $permission_level[0];	
}
function is_admin($permission_level){
	if($permission_level > 7){
		return true;
	}else{
		return false;	
	}
}
function check_follow($link,$user,$follower){

	
	$check = $link->query("SELECT * FROM `followers` WHERE `user_id`='$user' and `follower_id`='$follower'");
	$check = $check->fetch_array();
	if($check == NULL){
		return false;
	}else{
		return true;
	}
}
function follow_user($link,$user_id,$follower_id){	
	$link->query("INSERT INTO `followers` (`user_id`,`follower_id`) VALUES('$user_id','$follower_id')");
}
function get_followers($link,$user_id){
	
	$followers = $link->query("SELECT `follower_id` FROM `followers` WHERE `user_id`='$user_id'");
	return $followers->fetch_all();	
}
function get_following($link,$user_id){
	
	$following = $link->query("SELECT `user_id` FROM `followers` WHERE `follower_id`='$user_id'");
	return $following->fetch_all();
}
function get_sub_name($link,$sub_id){
	$sub_name = $link->query("SELECT `title` FROM `subscriptions` WHERE `id`='$sub_id'");
	$sub_name = $sub_name->fetch_array();
	return $sub_name[0];
}
function  get_sub_author($link,$sub_id){
	$sub_author = $link->query("SELECT `author` FROM `subscriptions` WHERE `id`='$sub_id'");
	$sub_author = $sub_author->fetch_array();
	return $sub_author[0];  	
}
function subscribe($link,$user_id,$sub_id){
	$link->query("INSERT INTO `sub_trans` (`user_id`,`sub_id`) VALUES('$user_id','$sub_id')");	
}
function get_subscriptions($link,$user_id){
	$subscriptions = $link->query("SELECT `sub_id` FROM `sub_trans` WHERE `user_id`='$user_id'");
	$subscriptions = $subscriptions->fetch_all();
	return $subscriptions;	
}
function get_subscribers($link,$sub_id){
	$subscribers = $link->query("SELECT `user_id` FROM `sub_trans` WHERE `sub_id`='$sub_id'");
	$subscribers = $subscribers->fetch_all();
	return $subscribers;		
}
function is_subscribed($link,$user_id,$sub_id){
	$check = $link->query("SELECT * FROM `sub_trans` WHERE `sub_id`='$sub_id' and `user_id`='$user_id'");
	$check = $check->fetch_array();
	if($check == NULL){
		return false;	
	}else{
		return true;
	}
}
function change_username($link,$current_username,$new_username){
	$new_username = $link->real_escape_string($new_username);
	$check = $link->query("UPDATE `user_att` SET `username`='$new_username' WHERE `username`='$current_username'");
	
	$_SESSION['username'] = $new_username;
	if($check == NULL){
		return false;	
	}else{
		return true;
	}
}
function send_message($link,$message_text,$sender_id,$receiver_id){
	$message_text = $link->real_escape_string($message_text);
	$link->query("INSERT INTO `messages` (`message_text`,`sender_id`,`receiver_id`) VALUES('$message_text','$sender_id','$receiver_id')");
}

function get_inbox_messages($link,$user_id){
	$messages = $link->query("SELECT `sender_id`,`message_text` FROM `messages` WHERE `receiver_id`='$user_id'");
	$messages = $messages->fetch_all(); 
	return $messages; 
}
function get_sent_messages($link,$user_id){
	$messages = $link->query("SELECT `receiver_id`,`message_text` FROM `messages` WHERE `sender_id`='$user_id'"); 
	$messages = $messages->fetch_all();
	return $messages; 	
}
function create_subscription($link,$author,$title,$description){
	$author = $link->real_escape_string($author);
	$title = $link->real_escape_string($title);
	$description = $link->real_escape_string($description);
	$link->query("INSERT INTO `subscriptions` (`author`,`title`,`description`) VALUES('$author','$title','$description')");
}
?>
