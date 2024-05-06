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

    // Verifica se foi submetida uma pesquisa
    if (isset($_GET['search_query'])) {
        $search_query = $_GET['search_query'];
        // Consulta SQL para pesquisar os municípios
        $sql = "SELECT * FROM T_CIDADES WHERE nome LIKE :search_query";
        try {
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':search_query', '%' . $search_query . '%', PDO::PARAM_STR);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Exibe os resultados
            if ($results) {
                echo "<h3>Resultados da pesquisa:</h3>";
                foreach ($results as $row) {
                    echo "<p>Cidade: {$row['nome']}, Codigo cidade: {$row['codigo_cidade']}, id: {$row['id']}</p>";
                }
            } else {
                echo "<h3>Nenhum resultado encontrado para '$search_query'.</h3>";
            }
        } catch (PDOException $e) {
            echo "Erro na execução da consulta: " . $e->getMessage();
        }

        echo '<div class="continue-button"><button><a href="cidades.php">Voltar</a></button></div>';
    }
?>