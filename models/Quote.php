<?php 
  class Quote {
    // DB stuff
    private $conn;
    private $table = 'quotes';

    // Quote Properties
    public $id;
    public $quote;
    public $author;
    public $category;
    public $category_id;
    public $author_id;


    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get Quote
    public function read() {
      // Create query
      $query = 'SELECT 
                q.id, 
                q.quote, 
                a.author, 
                c.category
            FROM 
            ' . $this->table . ' q 
            INNER JOIN author a
                ON q.author_id = a.id
            INNER JOIN categories c
                ON q.category_id = c.id';
      
      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }

    // Get Single Quote
    public function read_single() {
          // Create query
          $query = "SELECT
                     q.id,
                     q.quote,
                     a.author as author,
                     c.category as category
                     FROM " . $this->table . " q
                     INNER JOIN author a on q.author_id = a.id
                     INNER JOIN categories c on q.category_id = c.id
                     WHERE q.id = :id
                     LIMIT 1 OFFSET 0";

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Bind ID
          $stmt->bindParam(1, $this->id);

          // Execute query
          $stmt->execute();

          $row = $stmt->fetch(PDO::FETCH_ASSOC);

          // Set properties
          
                $this->id = $row['id'];
                $this->quote = $row['quote'];
                $this->category = $row['category'];
                $this->author = $row['author'];
               
         
          
          
    }

    // Create Quote
    public function create() {
          // Create query
          $query = 'INSERT INTO ' . $this->table . ' SET title = :title, body = :body, author = :author, category_id = :category_id';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->id = htmlspecialchars(strip_tags($this->id));
          $this->quote = htmlspecialchars(strip_tags($this->quote));
          $this->author_id = htmlspecialchars(strip_tags($this->author_id));
          $this->category_id = htmlspecialchars(strip_tags($this->category_id));
          
          

          // Bind data
          $stmt->bindParam(':id', $this->id);
          $stmt->bindParam(':quote', $this->quote);
          $stmt->bindParam(':author', $this->author);
          $stmt->bindParam(':category', $this->category);
          $stmt->bindParam(':author_id', $this->author_id);
          $stmt->bindParam(':category_id', $this->category_id);
          
         

          // Execute query
          if($stmt->execute()) {
            return true;
      }

      // Print error if something goes wrong
      printf("Error: %s.\n", $stmt->error);

      return false;
    }

    // Update Quote
    public function update() {
          // Create query
          $query = 'UPDATE ' . $this->table . '
                                SET id = :id, quote = :quote, author_id = :author_id, category_id = :category_id
                                WHERE id = :id';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->id = htmlspecialchars(strip_tags($this->id));
          $this->quote = htmlspecialchars(strip_tags($this->quote_));
          $this->author_id = htmlspecialchars(strip_tags($this->author_id));
          $this->category_id = htmlspecialchars(strip_tags($this->category_id));
          

          // Bind data
          $stmt->bindParam(':id', $this->id);
          $stmt->bindParam(':quote', $this->quote);
          $stmt->bindParam(':author_id', $this->author_id);
          $stmt->bindParam(':category_id', $this->category_id);
          

          // Execute query
          if($stmt->execute()) {
            return true;
          }

          // Print error if something goes wrong
          printf("Error: %s.\n", $stmt->error);

          return false;
    }

    // Delete Quote
    public function delete() {
          // Create query
          $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->id = htmlspecialchars(strip_tags($this->id));

          // Bind data
          $stmt->bindParam(':id', $this->id);

          // Execute query
          if($stmt->execute()) {
            return true;
          }

          // Print error if something goes wrong
          printf("Error: %s.\n", $stmt->error);

          return false;
    }
    
  }
?>