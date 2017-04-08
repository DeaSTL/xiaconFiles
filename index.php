




<html>
<head>

<?php include "navbar.php"?>

</head>
<?php
$link = new mysqli('localhost','id1043442_xiacon','fra8w+f+at#=TaspEfrexeGACh+!ATrU','id1043442_main');
$users = $link->query("SELECT `username`,`picture_dir` FROM `user_att`");
$users = $users->fetch_all();


$subscriptions = $link->query("SELECT * FROM `subscriptions`");
$subscriptions = $subscriptions->fetch_all();

//var_dump($_SERVER);
echo "<h3>All Users<h3>";
$tmp = 0;
foreach($users as $user){
	if($tmp++ > 20){
		break;
		}
	print_r('<a class="btn btn-default" href="profile.php?profile='.$user[0].'"><img width="30" height="30" src="'.$user[1].'">'.$user[0]."</a>"."<br>");
}
echo "<h3>All Subscriptions</h3>";
foreach($subscriptions as $s){
	print_r('
  <div class="panel panel-default">
  	<div class="panel-heading"><a href="subscription.php?subscription='.$s[0].'"><h4>'.$s[1].'</h4></a>
	
	</div>
    <div class="panel-body">'.$s[2].'</div>
  </div>');
		
}




?>




</html>