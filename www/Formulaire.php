<?php 

session_start();

$localhost = "db"; 
$password = "root"; 
$username = "user"; 


if(isset($_POST["BtnAjout"]))

{
$db;
try{
  $db = new PDO("mysql:host=$localhost;dbname=soutenance;charset=utf8mb4",$username,$password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
}
catch (PDOException $e)
{
echo $e->getMessage();
}

if(isset($_POST['BtnAjout'])){
    $Nom = htmlentities(trim($_POST['Nom_U'])); 
    $Prenom = htmlentities(trim($_POST['Prenom_U'])); 
    $email = htmlentities(trim($_POST['Email_U']));
    $motdepasse = htmlentities(trim($_POST['Mdp_U']));
	$mdpCrypte = hash('sha256', $motdepasse);

$query = "INSERT INTO users (prenom, nom , email, mdp)  VALUES ('$Nom','$Prenom','$email','$mdpCrypte')"; 
if($db->query($query))
{
    header('Location: index.php');
}

$dbh = NULL;

}

}
  
?> 


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Formulaire </title>
	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<!-- Font-->
	<link rel="stylesheet" type="text/css" href="css/opensans-font.css">
	<link rel="stylesheet" type="text/css" href="fonts/line-awesome/css/line-awesome.min.css">
	<!-- Jquery -->
	<link rel="stylesheet" href="https://jqueryvalidation.org/files/demo/site-demos.css">
	<!-- Main Style Css -->
    <link rel="stylesheet" href="css/style.css"/>
</head>
<body class="form-v4">
	<div class="page-content">
		<div class="form-v4-content">
			<div class="form-left">
				<h2>ESGI Groupe 3</h2>
				<p class="text-1">ESGI Ecole Supérieure de Génie Informatique </p>
				<p class="text-2"><span>Formulaire : </span> Veuilez renseigner un nom un prénom une adresse email ainsi qu'un mot de passe </p>
				<form action="index.php">
                <input type="submit" name="account" class="account" value="Index" style="height: 45px;width: 20%;">
                </form>
			</div>
			<form class="form-detail" method="post" id="myform">
				<h2>Formulaire d'inscription</h2>
				<div class="form-group">
					<div class="form-row form-row-1">
						<label for="first_name">Prénom</label>
						<input type="text" name="Prenom_U" id="first_name" class="input-text">
					</div>
					<div class="form-row form-row-1">
						<label for="last_name">Nom</label>
						<input type="text" name="Nom_U" id="last_name" class="input-text">
					</div>
				</div>
				<div class="form-row">
					<label for="your_email">Email</label>
					<input type="text" name="Email_U" id="your_email" class="input-text" required pattern="[^@]+@[^@]+.[a-zA-Z]{2,6}">
				</div>
				<div class="form-group">
					<div class="form-row form-row-1 ">
						<label for="password">Mot de passe</label>
						<input type="password" name="Mdp_U" id="Mdp_U" class="input-text" required>
					</div>
					<div class="form-row form-row-1">
						<label for="comfirm-password">Confirmation</label>
						<input type="password" name="comfirm_password" id="comfirm_password" class="input-text" required>
					</div>
				</div>
				<div class="form-row-last">
					<input type="submit" name="BtnAjout" class="register" value="Valider">
				</div>
			</form>
		</div>
	</div>
	<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
	<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
	<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
	<script>
		jQuery.validator.setDefaults({
		  	debug: false,
		  	success:  function(label){
        		label.attr('id', 'valid');
   		 	},
		});
		$( "#myform" ).validate({
		  	rules: {
			    Mdp_U: "required",
		    	comfirm_password: {
		      		equalTo: "#Mdp_U"
		    	}
		  	},
		  	messages: {
		  		Prenom_U: {
		  			required: "Entrez un prénom"
		  		},
		  		Nom_U: {
		  			required: "Entrez un nom"
		  		},
		  		Email_U: {
		  			required: "Entrez une adresse mail de passe"
		  		},
		  		Mdp_U: {
	  				required: "Entrez un mot de passe"
		  		},
		  		comfirm_password: {
		  			required: "Entrez un mot de passe",
		      		equalTo: "Mots de passe différents"
		    	}
		  	}
		});
	</script>
</body>
</html>

