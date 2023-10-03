<?php
class Database {
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "commerce_db";
    private $charset = "utf8";
    private $connection;

    // Constructor para establecer la conexión
    public function __construct() {
        $this->connection = new mysqli($this->host, $this->username, $this->password, $this->dbname);

        if ($this->connection->connect_error) {
            die("Error de conexión: " . $this->connection->connect_error);
        }

        $this->connection->set_charset($this->charset);
    }

    // Método para obtener la conexión
    public function getConnection() {
        return $this->connection;
    }

    // Método para cerrar la conexión
    public function closeConnection() {
        $this->connection->close();
    }
}
// Uso de la clase para obtener la conexión
$database = new Database();
global $connection;
$connection = $database->getConnection();
// usar $connection para ejecutar consultas a la base de datos.
// Al terminar, puede cerrar la conexión usando $database->closeConnection();
?>

