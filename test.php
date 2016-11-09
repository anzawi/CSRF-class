<?php

include_once("Csrf.php");

$token = Csrf::init();


if (isset($_GET["ok"]) && isset($_POST)) {
/**


    if($token->checkToken($_POST['token']))
    {
        // process :)
    }
    else
    {
        // error :(
    }

    //////   OR     ////////

    // without send token-value -> the class has been detected automatically
    if($token->checkToken())
    {
        // process :)
    }
    else
    {
        // error :(
    }

    ///// OR /////
    */

    $token->validOrDie(); // any error ??? then kill the page
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
        <br>
        <input type="submit" value="SUBMIT">
        <?php echo $token->csrfField() ?>
    
    </form>
    <br>
    <hr>
    <form action="?ok" method="POST">
    
        <input type="text">
        <br>
        <input type="submit" value="SUBMIT">
        <?php echo $token->csrfField() ?>
    
    </form>
    <br>
    <hr>
    <form action="?ok" method="POST">
    
        <input type="text">
        <br>
        <input type="submit" value="SUBMIT">
        <?php echo $token->csrfField() ?>
    
    </form>
    <br>
    <hr>
    <form action="?ok" method="POST">
    
        <input type="text">
        <input type="submit" value="SUBMIT">
        <?php echo $token->csrfField() ?>
    
    </form>
</body>
</html>
