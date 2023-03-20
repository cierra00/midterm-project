<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Quote.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate quote object
  $quote = new Quote($db);

  // Get raw quote data
  $data = json_decode(file_get_contents("php://input"));

  // Set ID to UPDATE
  $quote->id = $data->id;
  

  // Delete post
  if($quote->delete()) {
    echo json_encode(
      array('message' => 'Author deleted')
    );
  } else {
    echo json_encode(
      array('message' => 'Author not deleted')
    );
  }
