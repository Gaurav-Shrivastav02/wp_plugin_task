<?php
if ( !is_user_logged_in() ) {
  echo "<script type='text/javascript'>alert('Firstly loged in for access this page.'); window.location.href='login/';</script>";
}
?>

<?php
wp_logout();
wp_die();

do_action('wp_logout',$user_id);
wp_redirect('login');
exit;
?>
