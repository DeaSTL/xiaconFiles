<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>View Messages</title>
<?php include "navbar.php"?>

</head>
<body>
<div class="container-fluid">

<a class="btn btn-default"><h2 id="inbox_header">Inbox <span class="glyphicon glyphicon-chevron-down"></span></h2></a>
<a class="btn btn-default"><h2 id="sent_header">Sent <span class="glyphicon glyphicon-chevron-down"></span></h2></a>
<?php
	$username = $_SESSION['username'];
	$messages = get_inbox_messages($link,get_user_id($link,$username));

	foreach(array_reverse($messages) as $message){
		$message_text = $message[1];
		$sender_id = $message[0];
		echo' 
    
        <div class="panel panel-primary" style="max-width:60%; display: none;" id="inbox">
            <div class="panel-heading">
                <h3 class="panel-title">'.get_username($link,$sender_id).'</h3>
  
            </div>
            <div class="panel-body">'.$message_text.'</div>
        </div>
   
	';
	}	
?>


<?php
	$username = $_SESSION['username'];
	$messages = get_sent_messages($link,get_user_id($link,$username));
	foreach(array_reverse($messages) as $message){
		$message_text = $message[1];
		$sender_id = $message[0];
		echo' 
   
        <div class="panel panel-primary" style="max-width:60%; display:none;" id="sent">
            <div class="panel-heading" style="background-color:#60ce5c;">
                <h3 class="panel-title">'.get_username($link,$sender_id).'</h3>
  
            </div>
            <div class="panel-body">'.$message_text.'</div>
        </div>
   
	';
	}
	
?>
</div>
</div>
</div>
</body>
<script>
	
	$(document).ready(function(e) {
        $('#inbox_header').on('click', function(){
			$('[id=inbox]').toggle(500);
			
		})
		 $('#sent_header').on('click', function(){
			$('[id=sent]').toggle(500);
		
			
					
		})
    });
</script>
</html>
