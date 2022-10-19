<?php
if ( is_user_logged_in() ) {
  wp_redirect('profile');
}
?>
<?php
if(!isset($_GET['id'])){
  wp_redirect('reset');
}
?>


<?php
if(isset($_GET['id'])){
  $user_id=$_GET['id'];
}
?>



<?php
if(isset($_POST['Update_pass'])){
  global $wpdb;
     $otp=$_POST['otp'];
     $pass = $wpdb->escape(trim($_POST['pass']));
     $id=$_POST['id'];
     $db_otp=get_userdata($id)->otp;

    if( $otp == $db_otp)
    {

    wp_set_password( $pass, $id );
    update_user_meta(  $id,'otp', NULL );
    echo "<script type='text/javascript'>alert('Password change sussessfully.'); window.location.href='login/';</script>";
    // wp_safe_redirect( 'login' );

  }else{
    echo "<script type='text/javascript'>alert('OTP not matched.'); window.location.href='forget? id= $user_id';</script>";
  }
    }

?>

<?php get_header();?>

 
    <style>
        .error{
            color:red;
    </style>
</head>
<body class='bg-dark'>
    <div class='container text-center'>

    
<form class='col-6  bg-light  mt-5 offset-3 p-5 ' action='#' name='editpassword' method='post'  style='border-radius:20px;box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;'>
<p class='h3 mb-4 bg-info text-white pt-1 pb-1'>Change Password</p> 
<div class='form-group mt-4 '>
    <label for='exampleInputEmail1' class='h6'>OTP</label>
    <input type='text' name='otp' maxlength='4' id='otp' class='form-control' id='exampleInputEmail1' aria-describedby='emailHelp' placeholder='OTP'>
  </div> 
<div class='form-group mt-3 '>
    <label for='exampleInputEmail1' class='h6'>New Password</label>
    <input type='password' name='pass' id='pass' class='form-control' id='exampleInputEmail1' aria-describedby='emailHelp' placeholder='New Password'>
  </div>
  <div class='form-group mt-3' >
    <label for='exampleInputPassword1'class='h6'>Confirm Password</label>
    <input type='password' name='cpass' class='form-control' id='exampleInputPassword1' placeholder='Enter Again' >
    <input type='hidden' name='id' value='<?php echo $user_id ?>'>
  </div>
  <button type='submit' name='Update_pass' class='btn btn-primary mt-2 mb-3  '>Change Password</button>
 
</form>

<script>
     $(editpassword).validate({
      rules: {  
        otp:{
        required: true,
        digits: true,
        minlength: 4,
        maxlength: 4,
      },
      pass: {
        required: true,
        minlength: 2,
      },
      cpass: {
        required: true,
        minlength: 2,
        equalTo: '#pass',
      },
    },
    messages: {
      otp: {
      required: "Please enter OTP.",
      digits: "Please enter valid OTP.",
      minlength: "Please enter Exact OTP.",
      maxlength: "Please enter Exact OTP",
     },
    }
});
</script>
</div>

         
<?php get_footer();?>

