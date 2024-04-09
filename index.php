
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <link rel="stylesheet" href="styles.css">
    <title>Formulaire</title>
</head>
<body>
    
	<div class="form-connect">
					<form action="login.php" method="POST">
            
                    <h1>Connexion</h1>

                    
                        <label><b>Identifiant</b></label>
                        <input type="text" name="user_email" class="form-control"  value="<?php if(isset($_COOKIE["user_email"])) { echo $_COOKIE["user_email"]; } ?>" required>
                    

                   
                         <label><b>Mot de passe</b></label>
						 <input type="password" name="user_password" class="form-control" value="<?php if(isset($_COOKIE["user_password"])) { echo $_COOKIE["user_password"]; } ?>" required>
                    

                   
                    
						 <input type="submit" name="login" value="Login" class="btn btn-primary">
                    

                    
                       
                </form>
	

	</div>

</body>
</html>