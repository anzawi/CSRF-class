# phptricks :)

### CSRF-class : 
its easy to use , its simple already


## How to Use : 

1 - include CSRF-class to your project :

```php
<?php 

include_once("project-dir/libs/Csrf.php");

```
2 - initialize CSRF-class :

```php

$token = CSRF::init();

```

3 - check if token its match :

```php

// first method
if($token->checkToken())
{
    // process last action
}
else
{
    // Oops, something error (SCRF Attack)
}

// you can send token value to this method
if($token->checkToken($_POST['token']))
{
    // process last action
}
else
{
    // Oops, something error (SCRF Attack)
}


// other method :

$token->validOrDie(); // any error ??? then kill the page

// process last action

```


### helpers ?

we have only one public helper , its :

#### csrfField()
this method to create token input field.

```html

<form action="?ok" method="POST">

    <input type="text">
    <br>
    <input type="submit" value="SUBMIT">
    <?php echo $token->csrfField() ?>

</form>

```

in other hand you can create this field manually and pass token value

```html

<form action="?ok" method="POST">

    <input type="text">
    <br>
    <input type="submit" value="SUBMIT">
    
    <input type="hidden" name="_token" value="<?php echo $token->getToken() ?>">
</form>

```


## I Hope that Help You :)))

#### License : MIT
