<h1><?php require "includes/header.php" ?></h1>
<?php
    echo '<form method="post" action="/category/create">
        Category name: <input type="text" name="cat_name" />
        Category description: <textarea name="cat_description" /></textarea>
        <input type="submit" value="Add category" />
     </form>';
?>
<h1><?php require "includes/footer.php" ?></h1>