<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Quote.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate category object
  $quote = new Quote($db);

  // Category read query
  $result = $quote->read();
  
  // Get row count
  $num = $result->rowCount();

  // Check if any categories
  if($num > 0) {
        // Cat array
        $quo_arr = array();
        $quo_arr = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
          extract($row);

          $quo_item = array(
            'id' => $id,
            'quote' => $quote,
            'author' => $author,
            'category' => $category
            
          );

          // Push to "data"
          array_push($quo_arr, $quo_item);
        }

        // Turn to JSON & output
        echo json_encode($quo_arr);

  } else {
        // No Categories
        echo json_encode(
          array('message' => 'No Categories Found')
        );
  }
