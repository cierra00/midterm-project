<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Quote.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate quote object
  $author = new Author($db);

  // Get raw quote data
  $data = json_decode(file_get_contents("php://input"));

  $quotes->quote = $data->id;
  $quotes->quote = $data->quote;
  $quotes->quote = $data->author_id;
  $quotes->quote = $data->category_id;

  // Create Category
  if($author->create()) {
    echo json_encode(
      array('message' => 'Author Created')
    );
  } else {
    echo json_encode(
      array('message' => 'Author Not Created')
    );
  }
