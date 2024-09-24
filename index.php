<!doctype html>
<html lang="en">
<head>

<style>
@import url(https://fonts.googleapis.com/css?family=Raleway:300,400,600);


body{
    margin: 0;
    font-size: .9rem;
    font-weight: 400;
    line-height: 1.6;
    color: #212529;
    text-align: left;
    background-color: #f5f8fa;
}

.navbar-laravel
{
    box-shadow: 0 2px 4px rgba(0,0,0,.04);
}

.navbar-brand , .nav-link, .my-form, .login-form
{
    font-family: Raleway, sans-serif;
}

.my-form
{
    padding-top: 1.5rem;
    padding-bottom: 1.5rem;
}

.my-form .row
{
    margin-left: 0;
    margin-right: 0;
}

.login-form
{
    padding-top: 1.5rem;
    padding-bottom: 1.5rem;
}

.login-form .row
{
    margin-left: 0;
    margin-right: 0;
}

.box {
  height: 150px;
  width: 700px;
}

.center {
    margin: auto;
    width: 65%;
    padding: 1px;
}
</style>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="css/style.css">

    <link rel="icon" href="Favicon.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

    <title>SAVONA SV</title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light navbar-laravel">
    <div class="container">
        <a class="navbar-brand" href="#">SAVONA SV</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
			<!---
                <li class="nav-item">
                    <a class="nav-link" href="#">Registrar</a>
                </li>
					
                <li class="nav-item">
                    <a class="nav-link" href="#">Login</a>
                </li>
			-->	
            </ul>

        </div>
    </div>
</nav>
<?php

if(empty($_GET["est"]))
{
?>
<main class="login-form">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
				<center>
                    <div class="card-header">Iniciar Session</div>
                </center>
				<div class="card-body">
                        <form action="mantenimiento.php" method="POST">
                            <div class="form-group row">
                                <label for="user" class="col-md-4 col-form-label text-md-right">Usuario</label>
                                <div class="col-md-6">
                                    <input type="text" id="user" class="form-control" name="user" required autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Contraseña</label>
                                <div class="col-md-6">
                                    <input type="password" id="password" class="form-control" name="pass" required>
                                </div>
                            </div>

                            <div class="col-md-6 offset-md-4">
                                <input type="submit" name="login" class="btn btn-primary" value="Ingresar">
                            </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>			
<?php
}
else
{
$msj="ACCESO INVALIDO";
?>
<br>
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Iniciar Session</div>
                    <div class="card-body">
                        <form action="mantenimiento.php" method="POST">
                            <div class="form-group row">
                                <label for="email_address" class="col-md-4 col-form-label text-md-right">Usuario</label>
                                <div class="col-md-6">
                                    <input type="text" id="email_address" class="form-control" name="user" required autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Contraseña</label>
                                <div class="col-md-6">
                                    <input type="password" id="password" class="form-control" name="pass" required>
                                </div>
                            </div>

                            <div class="col-md-6 offset-md-4">
                                <input type="submit" name="login" class="btn btn-primary" value="Ingresar">
                            </div>
                    </div>
                    </form>
                </div>			
            </div>
				<div class="box center">
					<div class="alert alert-danger text-center" style="margin-top:20px;">
					<?php echo $msj; ?>
					</div>
				</div>				
        </div>
    </div>	

			


<?php
}
?>
</main>
</body>
</html>
