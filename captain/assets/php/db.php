<?php

class Database
{
  private $dsn = 'mysql:host=localhost;dbname=esuroy';
  private $user = 'root';
  private $pass = '';
  // private $dsn = 'mysql:host=localhost;dbname=u394881581_esuroy';
  // private $user = 'u394881581_root';
  // private $pass = 'EsuroyPilar54321';

  public $conn;

  public function __construct()
  {
    try {
      $this->conn = new PDO($this->dsn, $this->user, $this->pass);
    } catch (PDOException $e) {
      echo 'Error: ' . $e->getMessage();
    }
  }

  public function testInput($data)
  {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    $data = strip_tags($data);
    return $data;
  }
}
