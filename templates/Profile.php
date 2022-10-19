
<?php
if ( !is_user_logged_in() ) {
  echo "<script type='text/javascript'>alert('Firstly loged in for access this page.'); window.location.href='login/';</script>";
}
?>
<?php
 $user_id=get_current_user_id();
 $user_info = get_userdata($user_id);
 $fn= $user_info->first_name;
 $ln= $user_info->last_name;
 $em= $user_info->user_email;
 $img= $user_info->img_url;
 $phn= $user_info->phone;
?>
<?php
if(isset($_POST['logout'])){
  
  
  wp_logout();
  wp_die();

do_action('wp_logout',$user_id);
}
?>


<?php
get_header();
?>
<html lang="en">
<head>


  <style>
    .main{
        
    }
  .container {
    padding: 20px 120px;
   
    
  }
  .xtz{
    padding: 0px 0px 10px;

  }
 
  
   .bg-1 {
    
    background: #2d2d30;
    color: #bdbdbd;
  }
 
  .bg-1 p {font-style: italic;}
  li{
    color: #000;
  }
  .cir{
    border-radius:50%;
  }


</style>

<div class="main mt-3">
<div class="bg-1" >
  <div class="container">
 
    <h3 class="text-center text-primary font-weight-bold">PROFILE DETAIL</h3>
    <p class="text-center h4">Hii <strong class="font-weight-bold text-primary h3"> <?php echo  $fn;?></strong>, welcome to your profile page .<br> Here below find your profile details!</p>
    
    <div class="text-center xtz">
    <span class="rounded">
      <img src="<?php echo $img;?>" class="cir text-center" style="width:160px;height:170px;" alt="link not work">
      </span>
    </div>
    <ul class="list-group">
      <!-- <li class="list-group-item">You have loged in into system on <?php date_default_timezone_set('Asia/Kolkata'); echo date('d-m-y h:i:s');?></li> -->
      <li class="list-group-item">Name:- <?php echo "$fn"." ".$ln;?></li>
      <li class="list-group-item"> Email Id:- <?php echo $em ;?></li>
      <li class="list-group-item">Phone No :- <?php echo $phn;?></li>
      <li class="list-group-item">
      <form method= "post"  action="#" >
      <button type="submit" name="logout" class="btn btn-primary">Logout</button>
      <a class="btn btn-primary" href="update/" role="button">Edit Profile</a>
      <!-- <a class="btn btn-primary" href="http://localhost/wp_demo/profile/changepassword/" role="button">Reset-Password</a> -->
      </form>

</li> 

    </ul>
  </div>
</div>



</div>





<?php
get_footer();
?>


