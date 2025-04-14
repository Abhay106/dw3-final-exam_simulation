<?php
session_start();

class Database {
    private $host = 'localhost';
    private $db_name = 'mini_catelog';
    private $username = 'test123';
    private $password = 'test123';
    public $conn;

    public function __construct() {
        $this->connect();
    }

    private function connect() {
        try {
            $this->conn = new PDO("mysql:host={$this->host};dbname={$this->db_name}",
                                  $this->username, $this->password);
 
        } catch(PDOException $e) {
            die("Connection error: " . $e->getMessage());
        }
    }
    public function login($username, $password) {
      
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
       
        if ($user && $password === $user['password']) {
       
            $_SESSION['user_id'] = $user['id'];
            return true;
        }
    

        return false;
    }
    

    public function logout() {
        session_unset();
        session_destroy();
    }
    public function addProduct($name, $description, $price, $image_path) {
        if (!isset($_SESSION['user_id'])) {
            return false;
        }
    
   
        $user_id = $_SESSION['user_id'];
    
        $stmt = $this->conn->prepare("INSERT INTO products (user_id, name, description, price, image_path) 
                                      VALUES (:user_id, :name, :description, :price, :image_path)");
    
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':image_path', $image_path, PDO::PARAM_STR);
    
        return $stmt->execute();
    }

    public function deleteProduct($product_id) {
        if (!isset($_SESSION['user_id'])) {
            return false;
        }

        $stmt = $this->conn->prepare("DELETE FROM products WHERE id = ? AND user_id = ?");
        return $stmt->execute([$product_id, $_SESSION['user_id']]);
    }

    public function getAllProducts() {
       
        if (!isset($_SESSION['user_id'])) {
      
            return [];
        }

        $userId = $_SESSION['user_id'];
    
   
        $stmt = $this->conn->prepare("SELECT p.*, u.username FROM products p 
                                      JOIN users u ON p.user_id = u.id 
                                      WHERE p.user_id = :user_id 
                                      ORDER BY p.id DESC");

        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
    
  
        $stmt->execute();
    
     
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
}
?>
