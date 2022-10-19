<?php
if ( !is_user_logged_in() ) {
  wp_redirect('login');
}
?>
<?php
 $user_id=get_current_user_id();
 $user_info = get_userdata($user_id);
 $fnm= $user_info->first_name;
 $lnm= $user_info->last_name;
 $image= $user_info->img_url;
 $phone= $user_info->phone;
?>
<?php
if(isset($_POST['profile_update'])){
    $fn=$_POST['F_name'];
    $ln=$_POST['L_name'];
    $phn=$_POST['phn'];

    global $wpdb;
    $user_id=get_current_user_id();
    if($_FILES['pic']['error'] == 0){
             $pic_name=$_FILES['pic']['name'];
             $tmp_loc=$_FILES['pic']['tmp_name'];
             $image= wp_upload_bits($pic_name,null,file_get_contents($tmp_loc));
             $img_url=($image['url']);
             wp_update_user( array(
                'ID' => $user_id,
                'first_name' => $fn,
                'last_name' => $ln,
                'meta_input' => array(
                    'phone' => $phn,
                    'img_url' => $img_url,
                    
           ) ));
           echo "<script type='text/javascript'>alert('Update Successfully'); window.location.href='profile/';</script>";
            //  wp_safe_redirect( 'http://localhost/wp_task/profile/' );
      }else{
        wp_update_user( array(
            'ID' => $user_id,
            'first_name' => $fn,
            'last_name' => $ln,
            'meta_input' => array(
                'phone' => $phn,
                
       ) ));
       
       echo"<script type='text/javascript'>alert('Update Successfully'); window.location.href='profile/';</script>";
              // wp_safe_redirect( 'http://localhost/wp_task/profile/' );
             
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
<body class="bg-dark">
<div class="container">
<div class="text-center border bg-light  p-5 col-6 offset-3 mt-5" style="border-radius:20px;box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;" >
<p class="h3 mb-4 bg-info text-white pt-1 pb-1">Update User Details</p>

<form  action="#" name="edituser" method="post"  enctype="multipart/form-data" >
    <!-- Profile photo -->
<img src="<?php echo $image;?>" class="rounded-circle "alt="Please upload img" height='100px' width='100px'><br>
<input type="file" name="pic" id="defaultRegisterFormLastName" class=" mt-3 ml-5 "> <br>

<!-- First name -->
<input type="text"  name="F_name" id="defaultRegisterFormFirstName" class="form-control mt-3 " placeholder="First Name" value="<?php echo $fnm;?>">
    
<!-- Last name -->
<input type="text" name="L_name" id="defaultRegisterFormLastName" class="form-control mt-3 " placeholder="Last Name" value="<?php echo $lnm;?>">

<!-- Phone number -->
<input type="text" name="phn" maxlength="10"id="defaultRegisterPhonePassword" class="form-control  mt-3 " placeholder="Phone No" value="<?php echo $phone;?>">

<!-- update button -->
<button class="btn btn-success px-2 mt-3  form-control" type="submit" name="profile_update" ">Update</button>

</form>
</div>
<script>
     $(edituser).validate({                                                                                                                                                                                                                                                                                                                                                                                                                               
        rules: {
      F_name: "required",      
      phn: {
        digits: true,
        minlength: 10,
        maxlength: 10,
      },
    },
    messages: {
      F_name: {
      required: "Please enter first name",
     },           
     phn: {
      digits: "Please enter valid phone number",
      minlength: "Phone number field accept only 10 digits",
      maxlength: "Phone number field accept only 10 digits",
     },     
    },
  

   
});
</script>
 


<?php
get_footer();
?>
