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

    // Código para tratar a inserção do município
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $nome = $_POST['nome'];
        $id_estado = $_POST['id_estado'];
        $codigo_cidade = $_POST['codigo_cidade']; 

        $stmt = $db->prepare("INSERT INTO T_CIDADES (nome, codigo_cidade, id_estado) VALUES (:nome, :codigo_cidade, :id_estado)");
        $stmt->bindParam(':codigo_cidade', $codigo_cidade);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':id_estado', $id_estado);

        if ($stmt->execute()) {
            echo "Município inserido com sucesso.";
        } else {
            echo "Erro ao inserir município: " . $stmt->errorInfo()[2];
        }
    }
?>