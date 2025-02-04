<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <h1>home</h1>
  <?php
if(isset($data['users']) && (!empty($data['users']))){
  foreach($data['users'] as $user){
    echo '<p>'.$user->email.'</p>';
  }
}

?>
</body>
</html>