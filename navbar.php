<!doctype html>
<html>



<meta name="theme-color" content="#000000">

<meta name="viewport" content="width=device-width, user-scalable=no">

<head>

<meta charset="utf-8">
<title>Xiacon</title>
<script src="jquery-3.1.1.js"></script>
<script src="js/bootstrap.js"></script>
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">

<link rel="stylesheet" type="text/css" href="navbar.css">
<link rel="stylesheet" type="text/css" href="navbar-custom.css">

<?php include "functionlib.php"?>
<?php




if(isset($_POST['submit'])){
	

	if(isset($_POST['email'])){
		//print_r("registration <br>");
		$username = $_POST['username'];
		$password = $_POST['password'];
		$email = $_POST['email'];
		$gender = $_POST['gender'];
		$username = strip_tags($username);
		
		register_user($link,$username,$email,$password,$gender);
	}else{
		if(isset($_POST['username'])){$username = $_POST['username'];}
		if(isset($_POST['password'])){$password = $_POST['password'];}
		//print_r("sign in <br>");
		if(user_login($link,$username,$password)){
			//echo "Successfully logged in";
			$_SESSION['username'] = $username;
			//print_r($_SESSION); 	
		}else{
			
		}		
	}	
}
?>
</head>

    <nav class="navbar navbar-custom" role="navigation">
  <!-- Brand and toggle get grouped for better mobile display -->
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="index.php">Xiacon</a>
  </div>

  <!-- Collect the nav links, forms, and other content for toggling -->
  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav" >
      
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="#">Action</a></li>
      
        </ul>
      </li>
    </ul>
    
    <ul class="nav navbar-nav navbar-right">
    <?php
	if(!isset($_SESSION['username'])){
	echo' 
      <li><a href="" data-toggle="modal" data-target="#loginModal">Login</a></li>
      <li><a href="" data-toggle="modal" data-target="#registerModal">Register</a></li>
	  ';
	}
     ?>
	  <?php 
	  if(isset($_SESSION['username'])){
	  	echo '<li class="dropdown">';
	  }else{
		echo '<li class="dropdown" hidden>';  
	  }
	  ?>
      
          
            <?php if(isset($_SESSION['username'])){echo '<a href="#" class="dropdown-toggle" data-toggle="dropdown">'. $_SESSION['username'].'<b class="caret"></b>';}?></a>
            <ul class="dropdown-menu">
              <li><a href="index.php?logout=1">Logout</a></li>
              <li><a href="setpicture.php">Set Picture</a></li>
              <li><a href="profile.php?profile=<?php if(isset($_SESSION['username'])){ echo $_SESSION['username'];};?>">Profile</a></li>
              <li><a href="changeusername.php">Change Username</a></li>
            </ul> 
          </li>
      </div>
      
    </ul>
  </div><!-- /.navbar-collapse -->
</nav>

<div class="modal fade bd-example-modal-lg" role="dialog" id="loginModal">
  <div class="modal-dialog">
    
    <div class="modal-content">
		<div class="modal-header">
         	 <h3>Login</h3> 
         </div>
         <div class="modal-body">
         	<form class="form-horizontal" method="post" action="">
            	<fieldset>
                    
                    <!-- Form Name -->
                    
                    
                    <!-- Text input-->
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="username">Username</label>  
                      <div class="col-md-4">
                      <input id="username" name="username" type="text" placeholder="username" class="form-control input-md" required="">
                        
                      </div>
                    </div>
                    
                    <!-- Password input-->
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="password">Password</label>
                      <div class="col-md-4">
                        <input id="password" name="password" type="password" placeholder="password" class="form-control input-md" required="">
                        
                      </div>
                    </div>
                    
                    <!-- Button -->
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="submit"></label>
                      <div class="col-md-4">
                        <button id="submit" name="submit" class="btn btn-primary">Login</button>
                      </div>
                    </div>
                    
                </fieldset>
            </form>  
         </div>
         <div class="modal-footer">
         	  
         </div>
       
       </div>
    </div>
</div>
<div class="modal fade bd-example-modal-lg" role="dialog" id="registerModal">
  <div class="modal-dialog">
    
    <div class="modal-content">
		<div class="modal-header">
         	 <h3>Registration</h3> 
         </div>
         <div class="modal-body">
         	<form class="form-horizontal" method="post" action="">
            	<fieldset>
                    
                    <!-- Text input-->
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="username">Username</label>  
                      <div class="col-md-4">
                      <input id="username" name="username" type="text" placeholder="username" class="form-control input-md" required="">
                        
                      </div>
                    </div>
                    
                    <!-- Text input-->
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="email">Email</label>  
                      <div class="col-md-4">
                      <input id="email" name="email" type="text" placeholder="email" class="form-control input-md" required="">
                        
                      </div>
                    </div>
                    
                    <!-- Password input-->
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="password">Password</label>
                      <div class="col-md-4">
                        <input id="password" name="password" type="password" placeholder="password" class="form-control input-md" required="">
                        
                      </div>
                    </div>
                    
                    <!-- Select Basic -->
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="gender">Select your gender</label>
                      <div class="col-md-4">
                        <select id="gender" name="gender" class="form-control">
                          <option value="m">Male</option>
                          <option value="f">Female</option>
                          <option value="o">Other</option>
                        </select>
                      </div>
                    </div>
                    
                    <!-- Button -->
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="submit"></label>
                      <div class="col-md-4">
                        <button id="submit" name="submit" class="btn btn-primary">Register</button>
                      </div>
                    </div>
                    
                </fieldset>
            </form>  
         </div>
         <div class="modal-footer">
         	  
         </div>
       
       </div>
    </div>
</div>


	<script type="text/javascript">
		
	</script>

</html>
