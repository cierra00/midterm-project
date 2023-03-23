<?php

// header

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Quote.php';


//Instantiate DB & Connect

$database = new Database();
  $db = $database->connect();

//Instantiate blog post object

$quote = new Quote($db);

//get ID
$quote->id = isset($_GET['id']) ? $_GET['id']: die();

// Get post 
$quote->read_single();

//create array

//create array
$quo_arr = array(
    'id'=> $quote->id,
    'quote'=> $quote->quote,
    'author' => $quote->author,
    'category' => $quote->category,
    'author_id' => $quote->author_id
    
);
if($quote->quote !== null){
// make JSON
print_r(json_encode($quo_arr));
} else {
  
  echo (json_encode (array("message"=> "Quotes Not Found")));
}
//




