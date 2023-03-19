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
if($quote->read_single()){

//create array
$quo_arr = array(
    'id'=> $quote->id,
    'quote_string'=> $quote->quote_string,
    'author_id' => $quote->author_id,
    'category_id' => $quote->category_id,
    
);
} else {
  $quo_arr = array(
    'message' => 'There are no quotes here'
  );
}
// make JSON
print_r(json_encode($quo_arr));

//


