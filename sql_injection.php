<?php
   $login = false;

   if ($_POST) {
      $username = $_POST['username'];
      $password = $_POST['password'];

      $db = mysqli_connect('localhost', 'root', 'root', 'products');
      $query = "SELECT * FROM users WHERE name = '$username' AND password = '$password'";
      $befehl = mysqli_query($db, $query);
      $resultat = mysqli_fetch_assoc($befehl);
      $login = !empty($resultat);
   }
?>

<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <title>SQL Injection</title>
   <link rel="stylesheet" href="css/bootstrap.min.css">
   <link rel="stylesheet" href="css/XSS.css">
</head>

<body>

   <div class="container">
      <div class="row">
         <div class="main">
            <div class="panel panel-primary">
               <div class="panel-heading">
                  <h3 class="panel-title">Login</h3>
               </div>
               <div class="panel-body">

                  <?php if ($login) : ?>

                     <div class="alert alert-success">
                        <strong>Gratulation!</strong> Sie haben sich erfolgreich eingeloggt.
                     </div>

                  <?php else : ?>

                     <?php if ($_POST && !$login) : ?>

                        <div class="alert alert-danger">
                           <strong>Fehler!</strong> Ungültige Zugangsdaten.
                        </div>

                     <?php endif; ?>

                     <form role="form" action="sql_injection.php" method="POST">
                        <div class="form-group">
                           <input type="text" class="form-control" name="username" placeholder="Name">
                        </div>
                        <div class="form-group">
                           <input type="text" class="form-control" name="password" placeholder="Password">
                        </div>
                        <button type="submit" class="btn btn-primary pull-right">Abschicken</button>
                     </form>

                  <?php endif; ?>

               </div>
            </div>
         </div>

         <form role="form">
            <div class="form-group">
               <textarea class="form-control" style="opacity: 0.7"><?= isset($query) ? $query : "x' OR 1=1;#" ?></textarea>
            </div>
         </form>

      </div>
   </div>

</body>
</html>