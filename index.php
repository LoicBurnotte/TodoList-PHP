<?php 
include 'session.php';
include 'fonctions.php';
include 'database.php';
 ?>

<?php 
include 'head.php';
include 'menu.php';
 ?>
	<div class="CONTAINER">
		<div class="row">
			<div class="col-sm-3"></div>
			<div class="col-sm-6">
				
			<!--<div id="message">Veuillez vous connecter !</div>
				<div id="incorrectpassword">Login ou mot de passe incorrect</div>-->
				<div id="contact">
					<div id="barreConnexion"><p id="textConnexion">Connexion</p></div>
					<div id="formulaire">
						<form action="#" method="POST">
							<p>Login :</p>
							<input type="text" name="username" id="username" required autofocus autocomplete <?php displayValue('username') ?>>
							<p>Mot de passe :</p>
							<input type="password" name="password" id="password" required>
							<p></p>
							<input type="submit" value="Envoyer" id="btnEnvoyer" class="btn btn-default">
						</form>
					</div>
				</div> 
			</div>
			<div class="col-sm-3"></div>
		</div> 

<?php 
if(!empty($_POST)){
	if(validateRequiredField('username') && validatePassword('password')){//valide les champs
		$co = getConnection($connection);
		$username = $_POST['username'];
		$sql = "SELECT * FROM users WHERE username LIKE \"$username\"";

		//va rechercher l'utilisateur dans la DB
		$result = $co->query($sql)->fetch();
		if($result !== false){
			//récupère le mot de passe dans la base de donnée!
			$password = $result['password'];
			$salt = $result['salt'];
			hashPassword($_POST['password'], $salt);

			if(strcmp($_POST['password'], $password)== 0){
				//Si l'authentification a réussie, sauver l'id du user en session
				$_SESSION['id'] = $result['id']; 
				header('Location: todo.php');
				exit(0);
			}else{
				echo '<style>#incorrectpassword{ display:block; }</style>';
			}
		}else{
			echo '<style>#incorrectpassword{ display:block; }</style>';
		}
	}else{
		echo '<style>#message{ display:block; }</style>';
	}
}
if(!isset($_SESSION["count"])){
	$_SESSION["count"] = 1;
}else{
	echo '<style>#message{ display:block; }</style>';
}
 ?>

<?php 
include 'footer.php';
 ?>

