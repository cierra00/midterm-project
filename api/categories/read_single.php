<?php

// header

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Category.php';


//Instantiate DB & Connect

$database = new Database();
  $db = $database->connect();

//Instantiate blog post object

$category = new Category($db);

//get ID
$category->id = isset($_GET['id']) ? $_GET['id']: die();

// Get post 
$category->read_single();

//create array
$auth_arr = array(
    'id'=> $category->id,
    'author'=> $category->category,
    
);

// make JSON
print_r(json_encode($auth_arr));

//


