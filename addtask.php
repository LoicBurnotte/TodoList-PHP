<?php 
include 'fonctions.php';
include 'login.php';

 ?>
	<div class="CONTAINER">
		<div class="row">
			<div class="col-sm-3"></div>
			<div class="col-sm-6">
				<div id="addTaskBox">
					<div id="barreAddTask"><p id="textAddTask">Ajouter une tâche</p></div>
					<div id="inputAddTask">
						<form action="#" method="POST">
							<p>Tâche :</p>
							
							<!-- VALEUR A CHANGER -->
							<input type="text" value="Ecrire une tâche" name="task" id="task">

							<br><br>
							<input type="submit" value="Ajouter" id="btnAddTask" class="btn btn-default">
						</form>
					</div>
				</div> 
			</div>
			<div class="col-sm-3"></div>
		</div> 
<?php 
if(!empty($_POST)){
	if(validatePassword('task')){//valide les champs
		$co = getConnection($connection);
		$task = $_POST['task'];
		//recherche du nom utilisateur via son ID
		$username = 'SELECT username FROM users WHERE id = ' . $_SESSION['id'];
		$username = $co->query($username)->fetch();

		//insertion de la nouvelle tâche et démarrage de la durée
		$requete = "INSERT INTO tasks (id_user, task, state, time_creation) VALUES (:id_user, :task, :state, :time_creation)";
		$insertion = $co->prepare($requete);
		$insertion->execute(array(
			":id_user" => $_SESSION['id'],
			":task" => $task,
			":state" => 0,
			":time_creation" => date("Y-m-d H:i:s") /*DATETIME*/
		));
		// VISUEL : facultatif
		echo "<p class=\"text-center\">Voilà " . $username["username"] . ", la tâche : \"$task\" a été ajoutée!</p>";
	}
}
 ?>
<?php 
include 'footer.php';
 ?>
