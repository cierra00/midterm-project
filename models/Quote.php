<?php 
  class Quote {
    // DB stuff
    private $conn;
    private $table = 'quotes';

    // Quote Properties
    public $id;
    public $quote_string;
    public $author_name;
    public $category_id;
    public $author_id;
    public $category_name;

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get Quote
    public function read() {
      // Create query
      $query = 'SELECT * FROM quotes';
      
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
          q.quote_string,
          a.author_name as author,
          c.category_name as category
          FROM " . $this->table . " q
          INNER JOIN author a on q.author_id = a.id
          INNER JOIN categories c on q.category_id = c.id
          WHERE q.id = :id
          LIMIT 1 OFFSET 0";

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Bind ID
          $stmt->bindParam(':id', $this->id);

          // Execute query
          $stmt->execute();

          $row = $stmt->fetch(PDO::FETCH_ASSOC);

          // Set properties
          if($row){
                $this->id = $row['id'];
                $this->quote_string = $row['quote_string'];
                $this->category_id = $row['category_id'];
                $this->author_id = $row['author_id'];
               return true;
          } else {
            return false; 
          }
          
          
    }

    // Create Quote
    public function create() {
          // Create query
          $query = 'INSERT INTO ' . $this->table . ' SET title = :title, body = :body, author = :author, category_id = :category_id';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->id = htmlspecialchars(strip_tags($this->id));
          $this->quote_string = htmlspecialchars(strip_tags($this->quote_string));
          $this->author_id = htmlspecialchars(strip_tags($this->author_id));
          $this->category_id = htmlspecialchars(strip_tags($this->category_id));
          $this->category_name = htmlspecialchars(strip_tags($this->category_name));
          $this->author_name = htmlspecialchars(strip_tags($this->author_name));

          // Bind data
          $stmt->bindParam(':id', $this->id);
          $stmt->bindParam(':quote_string', $this->quote_string);
          $stmt->bindParam(':author_id', $this->author_id);
          $stmt->bindParam(':category_id', $this->category_id);
          $stmt->bindParam(':category_name', $this->category_name);
          $stmt->bindParam(':author_name', $this->author_name);

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
                                SET id = :id, quote_string = :quote_string, author_id = :author_id, category_id = :category_id
                                WHERE id = :id';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->id = htmlspecialchars(strip_tags($this->id));
          $this->quote_string = htmlspecialchars(strip_tags($this->quote_string));
          $this->author_id = htmlspecialchars(strip_tags($this->author_id));
          $this->category_id = htmlspecialchars(strip_tags($this->category_id));
          

          // Bind data
          $stmt->bindParam(':id', $this->id);
          $stmt->bindParam(':quote_string', $this->quote_string);
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