<?

include('config.php');
include('fungsi.php');

session_destroy();
header('Location: login.php');
?>