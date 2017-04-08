<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<?php include "functionlib.php"?>
<script src="jquery-3.1.1.js"></script>
<script src="js/bootstrap.js"></script>
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
</head>

<body>

<?php
	$username = $_SESSION['username'];
	$messages = get_inbox_messages($link,get_user_id($link,$username));
	foreach($messages as $message){
		$message_text = $message['message_text'];
		$sender_id = $message['sender_id'];
		echo' 
    
        <div class="panel panel-primary" style="display: none;" id="inbox">
            <div class="panel-heading">
                <h3 class="panel-title">'.get_username($link,$sender_id).'</h3>
  
            </div>
            <div class="panel-body">'.$message_text.'</div>
        </div>
   
	';
	}	
?>
</body>
</html>
