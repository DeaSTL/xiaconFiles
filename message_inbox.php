<?php
	$username = $_SESSION['username'];
	$messages = get_inbox_messages($link,get_user_id($link,$username));
	foreach($messages as $message){
		$message_text = $message['message_text'];
		$sender_id = $message['sender_id'];
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
