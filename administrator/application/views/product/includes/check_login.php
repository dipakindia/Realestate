<?php 
if($_SESSION['event_user_login']==''){
echo '<script>window.location="login.php"</script>';
exit();
}
?>