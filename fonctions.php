<?php 

function displayValue($name){
	if(isset($_POST[$name])){
		echo "value=" . $_POST[$name];
	}
}//isset($_POST[$name]) ? echo "value=" . $_POST[$name] : echo "value=" . null ;

function validateRequiredField($name){
	//trim : pas d'espace superflux dans le champ NAME
	return isset($_POST[$name]) && trim($_POST[$name] != '');
}

function validatePassword($password){
	return isset($_POST[$password]) && $_POST[$password] != '';
}

function hashPassword(&$password, $salt = null){
	if(strlen($salt) !== 22){
		$password = null;
		exit(1);
	}
	$options = array(
		'salt' => $salt
	);
	$password = password_hash($password,PASSWORD_BCRYPT, $options);
}

function generateSalt(){ //génère la clé de hashage pour hasher le 
	return bin2hex(random_bytes(11));
}

// ADDTASK /////////////////////////////////////////////////////////////


// STARTTASK ///////////////////////////////////////////////////////////
function startTask(){
	
}

// TODO ////////////////////////////////////////////////////////////////
function toDo(){
	
}

// TASKINPROGRESS  /////////////////////////////////////////////////////
function taskInProgress(){

}

// ENDTASK /////////////////////////////////////////////////////////////
function endTask(){
		
}
 ?>