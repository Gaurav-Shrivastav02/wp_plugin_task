<?php
if ( is_user_logged_in() ) {
  wp_redirect('profile');
}
?>
<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
   if(isset($_POST['sent'])){
    $em=$_POST['email'];
    global $wpdb;
    $email_exist= $wpdb->get_var("SELECT `ID` FROM `wp_users` WHERE `user_email`='$em' ");
    if($email_exist == 0){
      echo "<script type='text/javascript'>alert('Email not Exist'); window.location.href='reset/';</script>";
  
       }else{
        $otp=rand(1000,9999);
        $user_name=get_userdata( $email_exist)->first_name;
        $email = "";
        $body ="<p>Hello  $user_name,</p> <br> <p>Your reset password OTP : $otp</p>" ;
        $to = $em;
        $subject = "Password reset";
        $headers = 'From: '. $email . "\r\n" ;
              
        $headers='Content-Type: text/html; charset=UTF-8';
        $sent = wp_mail($to, $subject, $body, $headers);
        if($sent) {
          update_user_meta(  $email_exist,'otp', $otp );
       echo "<script type='text/javascript'>alert('OTP sent to the mail.'); window.location.href='forget ?id=$email_exist';</script>";

      //  $redirect = add_query_arg( 'id', $email_exist, 'forget' );
      //   wp_redirect(  $redirect );

            }//message sent!
    else   {
      echo "<script type='text/javascript'>alert('Server Down. Please try again.'); window.location.href='reset/';</script>";
        // wp_safe_redirect( 'login' );

         }//m

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
</head>
<body class="bg-dark ">
    <div class="container text-center">
<!-- C:\xampp\htdocs\wp_demo\wp-content\plugins\my_plugin\templates\connect.php -->
<form class="  col-6 bg-light offset-3 mt-5  p-5 " action="#" name="login" method="post" style="border-radius:20px;box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;">
<p class="h3 mb-4 bg-info text-white pt-1 pb-1">Forgot Password</p>  
<div class="form-group mt-4 ">
    <label for="exampleInputEmail1" class="h6">Enter your Email for send password reset OTP.</label>
    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
  </div>
  <button type="submit" name="sent" class="btn btn-primary mt-2 mb-3  ">Sent OTP</button>
  
</form>
</div>
<?php
get_footer();
?>
<script>
     $(login).validate({
        rules: {
      email: {
        required: true,
        email: true
      },      
    },
    messages: {                
     email: {
      required: "Please enter email address",
      email: "Please enter a valid email address.",
     },
    },
});
</script>
