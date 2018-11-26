<?php 
include 'session.php';
//déconnecte puis détruit!
session_unset();
session_destroy();
/*unset($_SESSION["count"]);*/
header('Location: index.php');
exit(0);

 ?>