
<h1><?php require "includes/header.php" ?></h1>
<?php
echo '<h3>Sign in</h3>';

        echo '<form method="post" action="signin">
            Username: <input type="text" name="user_name" />
            Password: <input type="password" name="user_pass">
            <input type="submit" value="Sign in" />
         </form>';
    echo ' Dont have an account yet click <a href="/signup">here</a> to create one.';
?>
<h1><?php require "includes/footer.php" ?></h1>