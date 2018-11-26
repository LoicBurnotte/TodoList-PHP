<?php 
include 'login.php';
 ?>
	<div class="CONTAINER">
		<div class="row">
			<div class="col-sm-2"></div>
			<div class="col-sm-8">
				<div id="endTaskBox">
					<div id="barreEndTask"><p id="textEndTask">Tâches terminées en:</p></div>
					<div id="endTaskDisplay">
						<p id="lign"></p>
						<h3 class="task"><b>Tâches</b></h3>
						<h3 class="time"><b>Durée</b></h3>
						<div class="clearfix"></div>
						<p id="lign"></p>
						<?php 
							$co = getConnection($connection);
							//recherche des taches dans la table TASKS via l'ID de l'utilisateur
							$tasks = 'SELECT task FROM tasks WHERE id_user = ' . $_SESSION['id'];
							$tasks = $co->query($tasks)->fetchAll();
							$states = 'SELECT state FROM tasks WHERE id_user = ' . $_SESSION['id'];
							$states = $co->query($states)->fetchAll();
							$times_creation = 'SELECT time_creation FROM tasks WHERE id_user = ' . $_SESSION['id'];
							$times_creation = $co->query($times_creation)->fetchAll();
							$times_start = 'SELECT time_start FROM tasks WHERE id_user = ' . $_SESSION['id'];
							$times_start = $co->query($times_start)->fetchAll();
							$times_end = 'SELECT time_end FROM tasks WHERE id_user = ' . $_SESSION['id'];
							$times_end = $co->query($times_end)->fetchAll();
							
							//$time_length->setTimezone(new DateTimeZone('Europe/Brussels'));

							//Pour toutes les taches, si la tache est terminée : afficher
							foreach ($tasks as $key => $task){
								if($states[$key]['state'] === '2'){
									$time_length = new dateTime; //("Y-m-d H:i:s")
									$dteCreation = new DateTime($times_creation[$key]['time_creation']);
									$dteStart = new DateTime($times_start[$key]['time_start']);
		   							$dteEnd   = new DateTime($times_end[$key]['time_end']); 
									//$date_utc = new \DateTime(null, new \DateTimeZone("UTC"));
									if($dteStart == "0000-00-00 00:00:00"){
										$time_length = $dteCreation->diff($dteEnd);
										//echo($time_length->format("Y-m-d H:i:s"));
									}else{
										$time_length = $dteStart->diff($dteEnd);
										//echo($time_length->format("Y-m-d H:i:s"));
									}
									echo '<h4 class="task" for=check' . $key . '>' . $task["task"]. '</h4>';
									echo '<p class="time">' . $time_length->format("%Y/%m/%d %H:%I:%S") . '</p>';
									echo '<div class="clearfix"></div>';
									echo '<p id="lign"></p>';
								}	
							}
						?>
					</div>
				</div> 
				<form action="#" method="POST">
					<input type="submit" value="Supprimer tâches terminées" id="btnEndTask" class="btn btn-default">
				</form>
			</div>
			<div class="col-sm-2"></div>
		</div>
	</div>
	<?php 
	if(isset($_POST)){
		$co = getConnection($connection);
		//SUPPRESSION : suppression dans la DB de toutes les taches terminées 
		$requeteSuppr = 'DELETE FROM `tasks` WHERE state=2 AND id_user=' . $_SESSION['id'];
		$suppression = $co->prepare($requeteSuppr);
		$suppression = $co->exec($requeteSuppr);
	}
	 ?>
<?php 
include 'footer.php';
 ?>