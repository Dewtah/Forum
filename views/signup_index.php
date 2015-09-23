<h1><?php require "includes/header.php" ?></h1>
<?php

    echo '<form method="post" action="signup">
        Username:           <input type="text" name="user_name" />
        <br>Password:       <input type="password" name="user_pass">
        <br>Password again: <input type="password" name="user_pass_check">
        <br>E-mail:         <input type="email" name="user_email">
        <br>                <input type="submit" value="Sign up" />
     </form>';


?>
<h1><?php require "includes/footer.php" ?></h1>