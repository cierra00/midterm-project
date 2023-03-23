<?php
    //index for categories
     header('Access-Control-Allow-Origin: *');
     header('Content-Type: application/json');
     $method = $_SERVER['REQUEST_METHOD'];
 
     if ($method === 'OPTIONS') {
         header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
         header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, X-Requested-With');
         exit();
     } 


// GET Methods
if ($method === 'GET') {
  if (isset($_GET['id'])) {
    include_once('./read_single.php');
  } else {
    include_once('./read.php');
  }
}

// POST Methods

if ($method === 'POST') {
  include_once('./create.php');
}

//Delete Methods
if ($method === 'DELETE') {
  include_once('./delete.php');
} 


// Put Methods
if ($method === 'PUT') {
  include_once('./update.php');
}