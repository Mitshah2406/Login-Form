<?php
require 'includes/header.php'
?>
<?php
require 'includes/db.php';
$showErr = false;
$login =false;
session_start();  
if($_SERVER['REQUEST_METHOD']=="POST"){
    
    $username = $_POST['username'];
    $password = $_POST['password'];
    $check = "SELECT * FROM `user1` WHERE `username` = '$username'";
    $check_query = mysqli_query($conn,$check);
    $Exists = mysqli_num_rows($check_query);
    if($Exists ==1){
        while($res = mysqli_fetch_assoc($check_query)){
        
$dbPass  = $res['password'];
        if(password_verify($password,$dbPass)){
                    $login =true;
                    $_SESSION['isLoggedIn'] = true;
                    $_SESSION['username'] = $username;
                    
                    
                    header('location: welcome.php');
                  }else{
                    $showErr = "Password Incorrect";
                  }
                }
              }else{
                $showErr = "Username Doesn't Exist!!!";
              }
            }
            
            
           
            if($login){
              echo  "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
  <strong>Sorry!</strong> You are logged in
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
  </div>";
}
if($showErr){
  echo  "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
  <strong>Sorry!</strong> ".$showErr."
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
  </div>";
}
?>


<h1 class="container-sm mt-3">LOGIN FORM</h1>
<form action="/login form/login.php" class="container-sm mt-3"method="POST">
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">username</label>
      <input type="text" class="form-control" id="exampleInputEmail1" name="username" aria-describedby="emailHelp">
    </div>
    <div class="mb-3">
      <label for="exampleInputPassword1" class="form-label">Password</label>
      <input type="password" class="form-control" name="password" id="exampleInputPassword1">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
  <?php
require 'includes/footer.php'
?>