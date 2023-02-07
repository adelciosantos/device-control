<?php 
	session_start();
	
	function auth_login($password){
		if($password=="232430"){
			$_SESSION['logon'] = "LOGADO";
			header('Location: index.php');
		} else {
			header('Location: login.php');
		}
	}
	
	$pass = filter_input(INPUT_POST, 'passwd');
	
	if(isset($pass)){
	$pass = filter_input(INPUT_POST, 'passwd');

	if(!empty($pass)){
		auth_login($pass);
	}
			if(!empty($pass)){
		auth_login($pass);
	}
	}

?>

<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="widht=device-widht, initial-scale=1.0">
        <link type="text/css" href="templates/stylesheet.css" rel="stylesheet">
        <link rel="icon" href="templates/img/icon.ico">
        <title>Atec Control</title>
    </head>
    <body>
        <div id="site">
            <div class="login-box">
                <img class="logo-login" src="templates/img/logo.png">
                <form method="POST" action="login.php">
                    <input class="pass-box" type="password" name="passwd" autofocus required="required">
                    <button type="submit" name="botao-logar" class="botao-logar">Entrar</button>
                </form>
            </div>
        </div>
    </body>
</html>
