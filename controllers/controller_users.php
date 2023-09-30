<?php
include_once "../models/user.php";
include_once "functions_controllers.php";

class User_Controller {
    private $connection; // Debes tener una instancia de conexión a la base de datos aquí

    public function __construct($connection) {
        $this->connection = $connection;
    }

    public function getAllUsers() {
        // Realiza la consulta SQL para obtener todos los usuarios
        $sql = "SELECT * FROM users";
        $result = $this->connection->query($sql);

        // Verifica si se obtuvieron resultados
        if ($result) {
            // Convierte los resultados en objetos User
            $users = [];
            while ($row = $result->fetch_assoc()) {
                $user = new User(
                    $row['id'],
                    $row['name'],
                    $row['email'],
                    $row['cellphone'],
                    $row['password'],
                    $row['role']
                );
                $users[] = $user;
            }

            return $users;
        } else {
            // Maneja errores de consulta aquí si es necesario
            return [];
        }
    }
    
}
$allsqlusers = $connection->query(" select * from users ");


// Función para obtener un usuario por su ID
function getUserById($id) {
    global $connection;
    // Realiza la consulta SQL para obtener el usuario por su ID
    $sql = "SELECT * FROM users WHERE id = $id";
    $result = $connection->query($sql);

    // Verifica si se encontró un usuario
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Crea un objeto User con los datos obtenidos de la base de datos
        $user = new User(
            $row['id'],
            $row['name'],
            $row['email'],
            $row['cellphone'],
            $row['password'],
            $row['role']
        );
        return $user;
    } else {
        return null; // Si no se encuentra el usuario, devuelve null
    }
}



// Función para eliminar el registro de un cliente
function deleteClientRecord($id_user) {
    // Realiza la consulta SQL para eliminar el registro de cliente
    global $connection;
    $sql = "DELETE FROM clients WHERE id_user = $id_user";
    return $connection->query($sql);
}

// Función para eliminar el registro de un vendedor
function deleteSellerRecord($id_user) {
    // Realiza la consulta SQL para eliminar el registro de vendedor
    global $connection;
    $sql = "DELETE FROM sellers WHERE id_user = $id_user";
    return $connection->query($sql);
}

// Función para eliminar el registro de un desarrollador
function deleteDeveloperRecord($id_user) {
    // Realiza la consulta SQL para eliminar el registro de desarrollador
    global $connection;
    $sql = "DELETE FROM developers WHERE id_user = $id_user";
    return $connection->query($sql);
}

// Función para agregar un registro de cliente
function addClientRecord($id_user) {
    // Realiza la consulta SQL para agregar el registro de cliente
    global $connection;
    $sql = "INSERT INTO clients (id, id_user) VALUES (NULL, $id_user)";
    return $connection->query($sql);
}

// Función para agregar un registro de vendedor
function addSellerRecord($id_user) {
    global $connection;
    // Realiza la consulta SQL para agregar el registro de vendedor
    $sql = "INSERT INTO sellers (id, id_user) VALUES (NULL, $id_user)";
    return $connection->query($sql);
}

// Función para agregar un registro de desarrollador
function addDeveloperRecord($id_user) {
    // Realiza la consulta SQL para agregar el registro de desarrollador
    global $connection;
    $sql = "INSERT INTO developers (id, id_user) VALUES (NULL, $id_user)";
    return $connection->query($sql);
}

// Función para actualizar un usuario en la base de datos
function updateUserInDatabase($user) {
    global $connection;
    // Obtén los atributos del usuario
    $id = $user->getId();
    $name = $user->getName();
    $email = $user->getEmail();
    $cellphone = $user->getCellphone();
    $password = $user->getPassword();
    $role = $user->getRole();

    // Realiza la consulta SQL para actualizar el usuario
    $sql = "UPDATE users SET name = '$name', email = '$email', cellphone = '$cellphone', password = '$password', role = '$role' WHERE id = $id";
    return $connection->query($sql);
}



if (!empty($_POST["updateRolebtn"])) {
    // Obtiene el ID de usuario, el nuevo rol y el antiguo rol
    $id_user = $_POST["id_update_user"];
    $role = $_POST["roles"];
    $oldrole = $_POST["old_role"];

    // Consulta la base de datos para obtener el usuario actual
    $user = getUserById($id_user); // Define esta función para obtener el usuario por su ID

    if ($user) {
        // Actualiza el rol del usuario
        $user->setRole($role);

        // Dependiendo del rol anterior, realiza las operaciones necesarias
        if ($oldrole == "Client") {
            // Elimina el registro del cliente si era un cliente
            deleteClientRecord($id_user); // Define esta función para eliminar el registro del cliente
        } elseif ($oldrole == "Seller") {
            // Elimina el registro del vendedor si era un vendedor
            deleteSellerRecord($id_user); // Define esta función para eliminar el registro del vendedor
        } elseif ($oldrole == "Developer") {
            // Elimina el registro del desarrollador si era un desarrollador
            deleteDeveloperRecord($id_user); // Define esta función para eliminar el registro del desarrollador
        }

        // Agrega el nuevo registro según el nuevo rol
        if ($role == "Client") {
            addClientRecord($id_user); // Define esta función para agregar el registro del cliente
        } elseif ($role == "Seller") {
            addSellerRecord($id_user); // Define esta función para agregar el registro del vendedor
        } elseif ($role == "Developer") {
            addDeveloperRecord($id_user); // Define esta función para agregar el registro del desarrollador
        }

        // Realiza la actualización del usuario en la base de datos
        updateUserInDatabase($user); // Define esta función para actualizar el usuario en la base de datos

        clearHistory(); // Limpia el historial (define esta función según tus necesidades)
    }
}
if (!empty($_POST["updateAccountbtn"])) {
    $id_user = $_POST["id_update_account"];
    $name = $_POST["name"];
    $cellphone = $_POST["cellphone"];
    $password = $_POST["password"];

    // Consulta la información del usuario utilizando la clase User
    $user = getUserById($id_user);

    // Actualiza los campos si se proporcionaron nuevos valores
    if (!empty($name)) {
        $user->setName($name);
    }

    if (!empty($cellphone)) {
        $user->setCellphone($cellphone);
    }

    if (!empty($password)) {
        $user->setPassword($password);
    }

    // Actualiza el usuario en la base de datos
    if (updateUserInDatabase($user)) {
        // Si la actualización es exitosa, actualiza la sesión
        $_SESSION["name"] = $user->getName();
        $_SESSION["cellphone"] = $user->getCellphone();
        $_SESSION["password"] = $user->getPassword();
        header("location: account.php");
    }
}
if (!empty($_POST["deleteAccountBtn"])) {
    $id_user = $_POST["id_delete_account"];
    if ($_SESSION["role"] !== "Admin") {
        // Consulta la información del usuario utilizando la clase User
        $user = getUserById($id_user);
    }
}
?>
