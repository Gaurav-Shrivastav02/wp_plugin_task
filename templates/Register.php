<?php
if ( is_user_logged_in() ) {
  wp_redirect('profile');
}
?>

<?php 
if(isset($_POST['submit'])){
  $fn=$_POST['F_name'];
  $ln=$_POST['L_name'];
  $user=$_POST['user'];
  $em=$_POST['email'];
  $pass=$_POST['pass'];
  $phn=$_POST['phn'];
  if($_FILES['pic']['error'] == 0){
    $pic_name=$_FILES['pic']['name'];
    $tmp_loc=$_FILES['pic']['tmp_name'];
    $image= wp_upload_bits($pic_name,null,file_get_contents($tmp_loc));
    $img_url=($image['url']);
  }
  else{
    $img_url="http://localhost/wp_task/wp-content/uploads/2022/10/no-profile-img.jpg";
  }

//   move_uploaded_file($tmp_loc,$folder);
  global $wpdb;
  $email_exist= $wpdb->get_var("SELECT `ID` FROM `wp_users` WHERE `user_email`='$em' OR `user_login`='$user' ");
  if($email_exist>0){
   echo "<script type='text/javascript'>alert('User Already Exist'); window.location.href='register/';</script>";
   exit;
  }else{
    $user_data = array(
      'first_name' => $fn,
      'last_name' => $ln,
      'user_login' => $user,
      'user_email' => $em,
      'user_pass' =>'',
      'meta_input' => array(
        'phone' => $phn,
        'img_url' => $img_url,
      )
      );
      $user_id = wp_insert_user( $user_data );

      if ( ! is_wp_error( $user_id ) ) {
        wp_set_password( $pass, $user_id );
        echo "<script type='text/javascript'>alert('User Resister Successfully.'); window.location.href='register/';</script>";
        exit;
    }else{
       echo "<script type='text/javascript'>alert('User not Resister.Please Retry.'); window.location.href='register/';</script>";
       exit;
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

<div class="container ">


<form class="text-center border bg-white  p-5 mt-5" action="#" method="post" name="register" enctype="multipart/form-data" style="border-radius:20px;box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;">

<p class="h3 mb-4 bg-info text-white pt-1 pb-1">Register User</p>

<div class="form-row mb-3">
    <div class="col">
        <!-- First name -->
        <input type="text"  name="F_name" id="defaultRegisterFormFirstName" class="form-control" placeholder="First name">
    </div>
    <div class="col">
        <!-- Last name -->
        <input type="text" name="L_name" id="defaultRegisterFormLastName" class="form-control" placeholder="Last name">
    </div>
</div>
<!-- Username -->
<input type="text" name="user" id="user" class="form-control " placeholder="Username">

<!-- E-mail -->
<input type="email" name="email" id="defaultRegisterFormEmail" class="form-control mt-3 " placeholder="E-mail">

<!-- Password -->
<input type="password" name="pass" id="pass" class="form-control mt-3" placeholder="Password" >

<input type="password"  name="cpass"  id="cpass" class="form-control mt-3" placeholder="Confirm Password" >

<!-- Phone number -->
<input type="text" name="phn"  maxlength="10" class="form-control mt-3 " placeholder="Phone number">

<!-- Prodile pic -->
<input type="file" name="pic"  class="form-control mt-3" >

<!-- Sign up button -->
<button class="btn btn-success  px-5 mt-4" type="submit" name="submit">Register</button>
<p class="mt-2">If you a already registered.<a href="login" class="text-primary h5 p-2">LOGIN</a></p>

</form>
<!-- Default form register -->
<?php
get_footer();
?>

<script>
     $(register).validate({
        rules: {
      F_name: "required",
      user:"required",
      email:{
        required: true,
        email: true
      },      
      phn: {
        digits: true,
        minlength: 10,
        maxlength: 10,
      },
      pass: {
        required: true,
        minlength: 2,
      },
      cpass: {
        required: true,
        minlength: 2,
        equalTo: "#pass",
      }
    },
    messages: {
      F_name: {
      required: "Please enter first name.",
     },           
     phn: {
      digits: "Please enter valid phone number.",
      minlength: "Phone number field accept only 10 digits.",
      maxlength: "Phone number field accept only 10 digits.",
     },     
     email: {
      required: "Please enter email address.",
      email: "Please enter a valid email address.",
     },
    },
  

   
});
</script>
 
</body>
</html>

<?php











