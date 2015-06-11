<?php

   if (!isset($_GET['name']))
      header('Location: content_spoofing.php?name=Emil');

?>

<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <title>Content Spoofing</title>
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
                  <h2>Hallo <?= $_GET['name'] ?></h2>
               </div>
            </div>
         </div>

         <form role="form">
            <div class="form-group">
               <textarea class="form-control" rows="8" style="opacity: 0.7"><h4>Bitte logge dich neu ein:</h4><form method="POST" action="boese.php"><div class="form-group"><input type="text" class="form-control" name="username" placeholder="Name"></div><div class="form-group"><input type="password" class="form-control" name="password" placeholder="Passwort"></div><button type="submit" class="btn btn-primary pull-right">Sicher Einloggen</button></form>&lt;!--</textarea>
            </div>
         </form>

      </div>
   </div>
</body>
</html>