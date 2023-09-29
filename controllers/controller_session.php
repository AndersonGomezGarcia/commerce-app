<?php
function checkSessionAndRedirect($requiredRole = null, $redirectPage = "index.php") {
    if (empty($_SESSION["id"])) {
        header("location: login.php");
        exit; // Termina la ejecución del script
    }

    // Si se especifica un rol requerido y no coincide, redirige
    if ($requiredRole !== null && ($_SESSION["role"] !== $requiredRole && $_SESSION["role"] !== "Admin")) {
        header("location: $redirectPage");
        exit;
    }
}
?>