<?php class UserController {
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
class User {
    private $id;
    private $name;
    private $email;
    private $cellphone;
    private $password;
    private $role;

    // Constructor
    public function __construct($id, $name, $email, $cellphone, $password, $role) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->cellphone = $cellphone;
        $this->password = $password;
        $this->role = $role;
    }

    // Métodos getter y setter para todas las propiedades
    // Implementa otros métodos según las necesidades de tu aplicación

	/**
	 * @return mixed
	 */
	public function getId() {
		return $this->id;
	}
	
	/**
	 * @param mixed $id 
	 * @return self
	 */
	public function setId($id): self {
		$this->id = $id;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getName() {
		return $this->name;
	}
	
	/**
	 * @param mixed $name 
	 * @return self
	 */
	public function setName($name): self {
		$this->name = $name;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getEmail() {
		return $this->email;
	}
	
	/**
	 * @param mixed $email 
	 * @return self
	 */
	public function setEmail($email): self {
		$this->email = $email;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getCellphone() {
		return $this->cellphone;
	}
	
	/**
	 * @param mixed $cellphone 
	 * @return self
	 */
	public function setCellphone($cellphone): self {
		$this->cellphone = $cellphone;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getPassword() {
		return $this->password;
	}
	
	/**
	 * @param mixed $password 
	 * @return self
	 */
	public function setPassword($password): self {
		$this->password = $password;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getRole() {
		return $this->role;
	}
	
	/**
	 * @param mixed $role 
	 * @return self
	 */
	public function setRole($role): self {
		$this->role = $role;
		return $this;
	}
    // Método para convertir el objeto User en un array asociativo
    public function toArray() {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'cellphone' => $this->cellphone,
            'password' => $this->password,
            'role' => $this->role
        ];
    }

    // Método estático para crear un objeto User a partir de un array asociativo
    public static function fromArray($data) {
        return new User(
            $data['id'],
            $data['name'],
            $data['email'],
            $data['cellphone'],
            $data['password'],
            $data['role']
        );
    }
	

}

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
?>