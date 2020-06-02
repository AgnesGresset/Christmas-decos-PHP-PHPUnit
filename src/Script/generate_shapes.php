<?php
require_once 'src/Controller/ShapeFactory.php';
require_once 'src/Model/UserData.php';

/**
 * @author agnes
 * A simple script to output shapes in the terminal.
 */
$fake_user_data = (new UserData())->getUserData(file_get_contents("src/Model/FakeUserData.json"));
$shape_factory = new ShapeFactory($fake_user_data);

file_put_contents("php://output", $shape_factory->createShapes());
$errors = $shape_factory->errors;

if ($errors) {
    file_put_contents("php://output", $errors);
}