<?php

// header

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Authors.php';


//Instantiate DB & Connect

$database = new Database();
  $db = $database->connect();

//Instantiate blog post object

$author = new Authors($db);

//get ID
$author->id = isset($_GET['id']) ? $_GET['id']: die();

// Get post 
$author->read_single();

if($author->author !== null) {
//create array
$auth_arr = array(
    'id'=> $author->id,
    'author'=> $author->author
    
);

// make JSON
print_r(json_encode($auth_arr));
} else  {
  print_r(json_encode (array("message"=> "Author ID Not Found")));
}