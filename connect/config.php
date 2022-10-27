<?php

class Conexion {
    
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $db = "beginningrise";

    public function Conectando() {
        $con = mysqli_connect($this->host, $this->user, $this->pass, $this->db);
        return $con;
    }

}

$obj = new Conexion();
if($obj->conectando()) {
    // echo "<div class='alert alert-success' role='alert'>Conectado!</div>";
} else {
    echo "Uh oh! Algo salió mal...";
}

?>