<?php 
require_once 'src/Controller/ShapeFactory.php';
require_once 'src/Model/UserData.php';

$fake_user_data = (new UserData())->getUserData(file_get_contents("src/Model/FakeUserData.json"));
$shape_factory = new ShapeFactory($fake_user_data);
$shapes = $shape_factory->createShapes();
$errors = $shape_factory->errors;
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Kyto's cute Christmas cacophonies</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Kyto's cute Christmas cacophonies">
    </head>
    <body>
        <header>
            <h1>Kyto's cute Christmas cacophonies</h1>
        </header>
        <main>
            <?php
                foreach($errors as $error) { ;?>
                    <div><pre><?php echo $error;?></pre></div>
                <?php } ?>
                <?php foreach($shapes as $shape) { ;?>
                    <div><pre><?php  echo $shape;?></pre></div>
                <?php } ?>
       </body>
</html>

