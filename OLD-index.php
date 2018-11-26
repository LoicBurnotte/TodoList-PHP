<?php 
/* SI PROBLEME DE HEADER à cause de la version PHP : 
if(version_compare(PHP_VERSION, '5.4.0', '>=')){
	ob_start(null, 0, PHP_OUTPUT_HANDLER_STDFLAGS ^ PHP_OUTPUT_HANDLER_REMOVABLE);
}else{
	ob_start(null, 0, false);
}*/
/*if(!isset($_SESSION)){ session_start(); }*/
include 'session.php';
include 'fonctions.php';
include 'database.php';
 ?>

<?php 
include 'head.php';
include 'menu.php';
/*include 'login.php';*/

if (isset($_GET["section"])){
	switch ($_GET["section"]) {
		case 'todo':
			include("todo.php");
			break;
		case 'starttask':
			include("starttask.php");
			break;
		case 'taskinprogress':
			include("taskinprogress.php");
			break;
		case 'endtask':
			include("endtask.php");
			break;
		case 'addtask':
			include("addtask.php");
			break;
		case 'logout':
			include("logout.php");
			break;
		case 'login':
			include("login.php");
			break;
		case 'index':
			include("index.php");
			break;
		case 'register':
			include("register.php");
			break;
		default:
			include("notfound.php");
			break;
	}

}elseif(isset($_POST['nom']) && $_POST["nom"] !== ""){
	$_SESSION["nom"] = $_POST["nom"];
	header('Location: index.php');
	exit(0);
}elseif(isset($_POST["nom"]) && $_POST["nom"] !== ""){
	header('Location: index.php');
	exit(0);
}else{
	include 'accueil.php';
}
include 'footer.php';
 ?>

