<?php
if ( is_user_logged_in() ) {
  wp_redirect('profile');
}
?>
<?php
global $user_ID;
global $wbdb;
if(!$user_ID){
 if(isset($_POST['Login'])){
  $em=$_POST['user'];
  $pass=$wpdb->escape($_POST['pass']);
  $email_exist= $wpdb->get_var("SELECT `ID` FROM `wp_users` WHERE `user_login`='$em' ");
  if($email_exist==0){
    echo "<script type='text/javascript'>alert('User not Exist'); window.location.href='login/';</script>";
    exit;
  }
  else{
    $user_data = array();
    $user_data['user_login'] = $em;
    $user_data['user_password'] = $pass;
  //  $user_data['remember'] = $remember;
    $user = wp_signon( $user_data, true );

   if ( !is_wp_error($user) ) {
    echo "<script type='text/javascript'>alert('Login Successfully'); window.location.href='profile/';</script>";
   
    // wp_redirect('http://localhost/wp_task/profile/');
   } else {
 
    echo "<script type='text/javascript'>alert('Password wrong'); window.location.href='login/';</script>";
    exit;
   
   
  }
}
}

}

?>




<?php
get_header();
?>

    <style>
        .error{
            color:red;
        }
    </style>


    <div class="container text-center ">
    
<form class=" bg-white  mt-5  p-5 " action="#" name="login" method="post" style="border-radius:20px;box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;">
<p class="h3 mb-4 bg-info text-white pt-1 pb-1">LOGIN</p>  
<div class="form-group mt-4 ">
    <label for="exampleInputEmail1" class="h6">User Name</label>
    <input type="text" name="user" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="User Name">
  </div>
  <div class="form-group mt-3" >
    <label for="exampleInputPassword1"class="h6">Password</label>
    <input type="password" name="pass" class="form-control" id="exampleInputPassword1" placeholder="Password" >
  </div>
  <button type="submit" name="Login" class="btn btn-primary mt-2 mb-3  ">Login</button>
  
  <p class="mt-1 ">Not a member?<a href="register" class="text-primary h5 p-2">Register</a></p>
  <p class="">Forget Password?<a href="reset" class="text-primary  p-2">Click Here</a></p>
</form>



</div>
<?php
get_footer();
?>
<script>
     $(login).validate({
        rules: {
      user:"required" ,    
      pass: {
        required: true,
      },
    },
   
  

   
});
</script>

