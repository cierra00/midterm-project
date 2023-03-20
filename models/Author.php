<?php
class Author
{
    // DB Stuff
    private $conn;
    private $table = 'author';

    // Properties
    public $id;
    public $author_name;
    

    // Constructor with DB
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Get Authors
    public function read()
    {
        // Create query
        $query = 'SELECT
        id,
        author_name
        FROM
        ' . $this->table . '
      ORDER BY
        id DESC';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();

        return $stmt;
    }

    // Get Single Author
    public function read_single()
    {
        // Create query
        $query = 'SELECT
          id,
          author_name
        FROM
          ' . $this->table . '
      WHERE id = :id
      LIMIT 1 OFFSET 0';

        //Prepare statement
        $stmt = $this->conn->prepare($query);

        // Bind ID
        $stmt->bindParam(1, $this->id);

        // Execute query
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set properties
        $this->id = $row['id'];
        $this->author_name = $row['author_name'];
    }

    // Create Author
    public function create()
    {
        // Create Query
        $query = 'INSERT INTO ' .
            $this->table . '
    (author_name) VALUES (:author_name)';

        // Prepare Statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->author_name = htmlspecialchars(strip_tags($this->author_name));

        // Bind data
        $stmt->bindParam(':author_name', $this->author_name);

        // Execute query
        if ($stmt->execute()) {
            return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }

    // Update Author
    public function update()
    {
        // Create Query
        $query = 'UPDATE ' .
            $this->table . '
    SET
      author_name = :author_name
      WHERE
      id = :id';

        // Prepare Statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->author_name = htmlspecialchars(strip_tags($this->author_name));
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Bind data
        $stmt->bindParam(':author_name', $this->author_name);
        $stmt->bindParam(':id', $this->id);

        // Execute query
        if ($stmt->execute()) {
            return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }

    // Delete Author
    public function delete()
    {
        // Create query
        $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

        // Prepare Statement
        $stmt = $this->conn->prepare($query);

        // clean data
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Bind Data
        $stmt->bindParam(':id', $this->id);

        // Execute query
        if ($stmt->execute()) {
            return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }
}
