<?php
    // Conexão com o banco de dados
    $DATABASE = "mysql";
    $HOST = "localhost";
    $DBNAME = "db_cidades";
    $USER = "root";
    $PASSWORD = "root";

    try {
        $db = new PDO("$DATABASE:host=$HOST;dbname=$DBNAME", $USER, $PASSWORD);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Erro na conexão com o banco de dados: " . $e->getMessage());
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Verifica se o campo está presente
        if (isset($_POST['id'])) {
            $id = $_POST['id'];

            // Consulta SQL para remover o município
            $sql = "DELETE FROM T_CIDADES WHERE id = :id";
            try {
                $stmt = $db->prepare($sql);
                $stmt->bindParam(':id', $id);
                $stmt->execute();
                echo "Município removido com sucesso!";
            } catch (PDOException $e) {
                echo "Erro ao remover município: " . $e->getMessage();
            }
        } else {
            echo "Por favor, forneça o ID do município a ser removido.";
        }
    }
?>