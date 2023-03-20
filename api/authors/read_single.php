<?php

// header

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Author.php';


//Instantiate DB & Connect

$database = new Database();
  $db = $database->connect();

//Instantiate blog post object

$author = new Author($db);

//get ID
$author->id = isset($_GET['id']) ? $_GET['id']: die();

// Get post 
$author->read_single();

//create array
$auth_arr = array(
    'id'=> $author->id,
    'author'=> $author->author,
    
);

// make JSON
print_r(json_encode($auth_arr));

//


