<?php 

include_once("Csrf.php");

$token = Csrf::init();


if(isset($_GET["ok"]) && isset($_POST))
{
    $token->validOrDie();
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <form action="?ok" method="POST">
    
        <input type="text">
        <input type="submit" value="SUBMIT">
        <?php echo $token->csrfField() ?>
    
    </form>
        <form action="?ok" method="POST">
    
        <input type="text">
        <input type="submit" value="SUBMIT">
        <?php echo $token->csrfField() ?>
    
    </form>
        <form action="?ok" method="POST">
    
        <input type="text">
        <input type="submit" value="SUBMIT">
        <?php echo $token->csrfField() ?>
    
    </form>
        <form action="?ok" method="POST">
    
        <input type="text">
        <input type="submit" value="SUBMIT">
        <?php echo $token->csrfField() ?>
    
    </form>
</body>
</html>