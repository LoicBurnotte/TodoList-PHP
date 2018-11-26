<?php 
include 'login.php';
 ?>
	<div class="CONTAINER">
		<div class="row">
			<div class="col-sm-3"></div>
			<div class="col-sm-6">
				<div id="todoBox">
					<div id="barreTodo"><p id="textTodo">Tâches en cours</p></div>
					<div id="todoCheckbox">
					<form action="#" method="POST">
						<?php
							$co = getConnection($connection);
							//recherche des taches dans la table TASKS via l'ID de l'utilisateur
							$tasks = 'SELECT task FROM tasks WHERE id_user = ' . $_SESSION['id'];
							$tasks = $co->query($tasks)->fetchAll();
							//sélectionne le statut des taches de l'utilisateur en cours
							$states = 'SELECT state FROM tasks WHERE id_user = ' . $_SESSION['id'];
							$states = $co->query($states)->fetchAll();
							//vérifie si le statut des taches n'est pas TERMINE (terminé = 2)
							foreach ($tasks as $key => $task)
							{		
								if($states[$key]['state'] === '1')
								{		
									echo '<input name="box[]" type="checkbox" id="check' . $key . '" value=' . $key .' >';
									echo '<label class="checkBox" for=check' . $key . '>' . $task["task"]. '</label>';
									//ajoute l'icone EN COURS si le statut est activé (égal à 1)
									if($states[$key]['state'] === '1'){ echo '<label class="inProgress">En cours</label>'; }
									echo '<br>';
								}	
							}
							?>
							<br>
							<input type="submit" value="Tâche(s) terminée(s)" id="btnEndTask" class="btn btn-default">
						</form>
					</div>
				</div> 
			</div>
			<div class="col-sm-3"></div>
		</div> 
		<?php 
		if(isset($_POST) && isset($_POST['box']))
		{
			var_dump($_POST['box']);
			if(!empty($_POST['box'])){
			    foreach($_POST['box'] as $box) {
					$taskId = 'SELECT id FROM tasks WHERE id_user = ' . $_SESSION['id'];
					$taskId = $co->query($taskId)->fetchAll();
					if($states[$box]['state'] === '0' || $states[$box]['state'] === '1')
					{	
						$update = 'UPDATE tasks SET state=:state, time_end=:time_end WHERE id=:id';
						$update = $co->prepare($update);
						$update->execute(array(
							":state" => 2,
							":time_end" => date("Y-m-d H:i:s"), //DATETIME
							":id" => intval($taskId[$box]['id'])
						));
						header("Refresh: 0;"); 
					}
				}
			}
		}
		 ?>

<?php 
include 'footer.php';
 ?>