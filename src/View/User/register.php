<?php

if($_POST['email'] != null && $_POST['email'] != "" && $_POST['password'] != null && $_POST['password'] != ""){
    require_once("./src/Controller/UserController.php");
    $this->register();
}
else{
    echo '
<form method="POST">
    <input type="text" name="email" placeholder="email">
    <input type="text" name="password" placeholder="password">
    <input type="submit" name="login" value="Register">
</form>
';
}

?>

