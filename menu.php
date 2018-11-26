	<div id="menu">
		<nav class="navbar navbar-inverse">
			<div class="container-fluid">
				<div class="navbar-header">
				</div>
				<?php 
				if(isset($_SESSION["id"])){
					echo '<a class="navbar-brand" href="todo.php">TodoList</a>';
					echo '<ul class="nav navbar-nav" id="listeMenu">';
						echo '<li class="menu active"><a href="todo.php">A faire</a></li>';
						echo '<li class="menu"><a href="startTask.php">Démarrer une tâche</a></li>';
						echo '<li class="menu"><a href="taskInProgress.php">Tâches en cours</a></li>';
						echo '<li class="menu"><a href="endTask.php">Tâches terminées</a></li>';
						echo '<li class="menu"><a href="addTask.php">Ajouter une tâche</a></li>';
					echo '</ul>';
					//script permettant de convertir le bouton MENU selectionné en ACTIVE!
					echo '<script type="text/javascript" src="js/script.js"></script>';
					echo '<ul class="nav navbar-nav navbar-right">';
						echo '<li id="welcome">';
						//permet d'afficher le nom de la personne qui s'est connectée
						$co = getConnection($connection);
						$sqlSelectName = 'SELECT username FROM users WHERE id = ' . $_SESSION['id'];
						$nom = $co->query($sqlSelectName)->fetch();
						echo "Bienvenue " . $nom["username"] . " ! </li>";
						echo '<li><a href="logout.php">Déconnexion</a></li>';
					echo '</ul>';
				}else{
					echo '<a class="navbar-brand" href="index.php">TodoList</a>';
					echo '<ul class="nav navbar-nav navbar-right">';
						echo '<li><a href="register.php">Nouvel utilisateur</a></li>';
						echo '<li><a href="index.php">Connexion</a></li>';
					echo '</ul>';
				}
				?>
			</div>
		</nav>

		
		<!-- <script>
			// Get the container element
			var btnContainer = document.getElementById("listeMenu");
			// Get all buttons with class="btn" inside the container
			var btns = btnContainer.getElementsByClassName("menu");
		
			// Loop through the buttons and add the active class to the current/clicked button
			for (var i = 0; i < btns.length; i++) {
				btns[i].addEventListener("click", function() {
					var current = document.getElementsByClassName("active");
					current[0].className = current[0].className.replace(" active", "");
					this.className += " active";
				});
			}	
		</script> -->
		