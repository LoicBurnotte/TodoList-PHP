<?php 
include 'login.php';

 ?>
	<div class="CONTAINER">
		<div class="row">
			<div class="col-sm-3"></div>
			<div class="col-sm-6">
				<div id="startTaskBox">
					<div id="barreStartTask"><p id="textStartTask">Démarrer une tâche</p></div>
					<div id="selectStartTask">
						<form action="" method="POST">
							<?php //startTask();
								$co = getConnection($connection);
								//recherche des taches dans la table TASKS via l'ID de l'utilisateur
								$id = intval($_SESSION['id']);
								$tasks = 'SELECT task FROM tasks WHERE id_user = ' . $_SESSION['id'];
								$tasks = $co->query($tasks)->fetchAll();
								$states = 'SELECT state FROM tasks WHERE id_user = ' . $_SESSION['id'];
								$states = $co->query($states)->fetchAll();
								//si la tache n'et pas encore commencée : afficher
								$cptTask = 0;
								foreach ($tasks as $key => $task)
								{		
									if($states[$key]['state'] === '0')// || $states[$id]['state'] === '1')
									{
										echo '<input type="radio" name="selectRadio" id="check' . $key . '" value="' . $key . '" >';
										echo '<label class="checkBox" for=check' . $key . '>' . $task["task"]. '</label>';
										if($states[$key]['state'] === '1')
										{
											//affiche le statut en cours :
											echo '<label class="inProgress">En cours</label>';
										}
										echo '<br>';
										$cptTask++;
									}
								}
								if($cptTask === 0){
									echo "<p>Aucune tâche non commencée.<br>";
								}
							 ?>
							<br>
							<input type="submit" value="Démarrer" class="btn btn-default" id="btnStartTask">
						</form>
					</div>
				</div> 
			</div>
			<div class="col-sm-3"></div>
		</div>
		<?php 
		//partie de code permettant de changer le statut de la tache => en cours - si le bouton radio a été sélectionné
		if(isset($_POST) && isset($_POST['selectRadio'])){
			$taskId = 'SELECT id FROM tasks WHERE id_user = ' . $_SESSION['id'];
			$taskId = $co->query($taskId)->fetchAll();
			foreach ($taskId as $key => $ID) 
			{
				if($states[$key]['state'] === '0' && intval($_POST["selectRadio"]) === $key)
				{	
					echo "Vous avez sélectionné " . $_POST["selectRadio"] . "<br>";
					$update = 'UPDATE tasks SET state=:state, time_start=:time_start WHERE id=:id';
					$update = $co->prepare($update);
					$update->execute(array(
						":state" => 1,
						":time_start" => date("Y-m-d H:i:s"), /*DATETIME*/
						":id" => intval($ID['id'])
					));
					header("Refresh: 0;");
				}
			}
		}
		 ?>		
<?php 
include 'footer.php';
 ?> 