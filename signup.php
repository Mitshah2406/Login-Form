<?php

$error_flash = false;
$success_flash = false;
$exists = false;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require 'includes/db.php';
    $username = $_POST["username"];
    $password = $_POST["password"];
    $hashPass = password_hash($password,PASSWORD_BCRYPT);
    $check_query = "SELECT * FROM `user1`";
    $check = mysqli_query($conn,$check_query);
    while($select_res = mysqli_fetch_assoc($check)){
      $fetchUsername = $select_res['username'];
      if($fetchUsername == $username){
        $exists = true;
        break;
      }else{
        $exists = false;
      }
    }
    if($exists==false){

      $sql= "INSERT INTO `user1` (`username`, `password`, `date`) VALUES ('$username', '$hashPass', current_timestamp())";
      $result = mysqli_query($conn, $sql);
      if ($result) {
        $error_flash = false;
        $success_flash = true;
      } else {
        $success_flash = false;
        $error_flash = true;
      }
    }
}

?>
<?php
require 'includes/header.php';



if($exists){
  echo  "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
  <strong>Sorry!</strong> The entered username already exists
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
  </div>";
}
else if($success_flash){
      echo  '<div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Success!</strong> Registered Successfully.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
  }
else if($error_flash){      
      echo  '<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Sorry!</strong> Registration unsucessfull..'.mysqli_error($conn).'
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
  }
  ?>
<div class="container-sm mt-5">
  <form class=" g-3" action="/login form/signup.php" method="post">
  <div class="form-floating mb-3">
  <input type="text" class="form-control" name ="username" id="floatingInput" placeholder="abc123">
  <label for="floatingInput">Username</label>
</div>
<div class="form-floating">
  <input type="password" class="form-control" name ="password" id="floatingPassword" placeholder="Password">
  <label for="floatingPassword">Password</label>
</div>
<div class="col-12 mt-4">
    <button type="submit" class="btn btn-primary">Sign in</button>
  </div>
  </form>
</div>

<?php
require 'includes/footer.php'
?>