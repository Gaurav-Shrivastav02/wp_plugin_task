

<?php
if(isset($_POST['Update_pass'])){
  global $wpdb;
     $pass = $wpdb->escape(trim($_POST['pass']));

     $user_id=get_current_user_id();
    wp_set_password( $pass, $user_id );
    echo "<script type='text/javascript'>alert('Password change sussessfully.'); window.location.href='login/';</script>";
   exit;

  }


?>



<?php get_header();?>

    
    <style>
        .error{
            color:red;
    </style>


    <div class='container text-center'>

    
<form class='col-6  bg-light  mt-5 offset-3 p-5 ' action='#' name='editpassword' method='post'  style='border-radius:20px;box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;'>
<p class='h3 mb-4 bg-info text-white pt-1 pb-1'>Update Password</p> 

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
      pass: {
        required: true,
        minlength: 2,
      },
      cpass: {
        required: true,
        minlength: 2,
        equalTo: '#pass',
      },
});
</script>
</div>
         
<?php get_footer();?>
