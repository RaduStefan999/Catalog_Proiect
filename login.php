<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <link rel="stylesheet" href="./css/login.css">
</head>
<body>

<div class="login_container">
  <form class="form-signin">       
    <h2 class="form-signin-heading">Profesor Autentificare</h2>
    <input type="text" class="form-control" name="username" placeholder="Email Address" required="" autofocus="" />
    <input type="password" class="form-control" name="password" placeholder="Password" required=""/>      

    <button class="btn btn-lg btn-danger btn-block" type="submit">Login</button>  
    <div class="login_errors"></div> 
    <div class="login_back"><a href="./index.php">Inapoi</a></div>
  </form>
<div>

</body>
</html>