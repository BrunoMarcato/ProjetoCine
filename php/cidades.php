<div id="projeto">
    <?php
    require("db_cidades.php");
    ?>
</div>

<!-- Barra de Pesquisa de Municípios -->
<div style="display: flex; justify-content: center;">
    <form action="formulario.php" method="GET" class="form-inline central">
        <input type="text" name="search_query" class="form-control mr-1 mr-sm-3" placeholder="Pesquisar Município" aria-label="Pesquisar Município" style="width: 750px;">
        <button type="submit" class="btn btn-busca ml-1 my-2 my-sm-0 ml-sm-0">Pesquisar</button>
    </form>
</div>
<!-- Fim da Barra de Pesquisa de Municípios -->

<!-- Formulário para inserir e remover municípios -->
<h2>Formulário de Inserção de Município</h2>

<form action="insert.php" method="post">
    <label for="nome">Nome do Município:</label><br>
    <input type="text" id="nome" name="nome" required><br><br>

    <label for="codigo_cidade">Código Cidade:</label><br>
    <input type="text" id="codigo_cidade" name="codigo_cidade" required><br><br>

    <label for="id_estado">Selecione o Estado:</label><br>
    <select id="id_estado" name="id_estado">
        <?php
            // Conecta ao banco de dados
            $pdo = new PDO("mysql:host=localhost;dbname=db_cidades", 'root', 'root');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Consulta os estados na tabela T_ESTADOS
            $query = "SELECT id, nome FROM T_ESTADOS";
            $stmt = $pdo->query($query);

            // Exibe as opções do menu suspenso
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<option value='" . $row['id'] . "'>" . $row['nome'] . "</option>";
            }
        ?>
    </select><br><br>

    <input type="submit" value="Inserir Município">
</form>

<div>
    <h3>Remover Município:</h3>
    <form action="delete.php" id="form-delete" method="post">
        <label for="id">ID do Município:</label><br>
        <input type="text" id="id" name="id" required>
        <button type="submit">Remover</button>
    </form>
</div>

<div>
    <button>
        <a href='../html/index.html'>Voltar</a>
    </button>
</div>

<script>
    // Função para lidar com a submissão do formulário de inserção
    document.getElementById('form-insert').addEventListener('submit', function(event) {
        event.preventDefault();
        let formData = new FormData(this);

        fetch('insert.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            alert(data);
            // Recarrega a página para atualizar a lista de municípios
            location.reload();
        })
        .catch(error => {
            console.error('Erro ao inserir município:', error);
        });
    });

    // Função para lidar com a submissão do formulário de remoção
    document.getElementById('form-delete').addEventListener('submit', function(event) {
        event.preventDefault();
        let formData = new FormData(this);

        fetch('delete.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            alert(data);
            // Recarrega a página para atualizar a lista de municípios
            location.reload();
        })
        .catch(error => {
            console.error('Erro ao remover município:', error);
        });
    });
</script>