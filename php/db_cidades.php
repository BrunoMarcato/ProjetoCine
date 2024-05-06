<?php 
	function executarSQL($db, $sql){

		try {

			if($db->query($sql)){
				//echo "<h3>SQL: [". $sql ."] realizada com sucesso!</h3>";
			} else {
				echo "<h3>ERRO na SQL: ". $sql ." </h3>";
			}

		} catch(PDOException $e){
			echo '<h3>EXCEPTION: ' . $e->getMessage() . '</h3>';
		}
	}

	function imprimir($db, $tabela){
		$res = $db->query("SELECT * FROM $tabela");
		if($res){
			$res->setFetchMode(PDO::FETCH_OBJ);
	
			while( $tupla = $res->fetch() ){ //recupera uma linha por vez
				echo '<h3>';
				foreach($tupla as $coluna){
					echo $coluna . ", ";
				}
				echo '</h3><br>';
			}
		} else {
			echo "<h3>ERRO: Erro na consulta.</h3>";
		}
	}

	function lerArquivoCidades($db, $fp, $fname){
		
		$separador = ',';
		$delimitador = '"'; //aspas duplas

		//Ignora a primeira linha (cabecalho do arquivo)
		if(is_resource($fp))
			$linha = fgetcsv($fp, 0, $separador, $delimitador); //$linha eh um vetor
		
		//Leh as demais linhas
		$status = true;
		while(!feof($fp)){
			
			//Ler uma linha do arquivo
			$linha = fgetcsv($fp, 0, $separador, $delimitador); //$linha eh um vetor

			if($linha!=NULL){
				//Consulta a tabela de 'T_ESTADOS' para buscar o 'id_estado'
				$sql = 'SELECT id FROM T_ESTADOS WHERE sigla=\'' . $linha[0] .'\';';

				$res = $db->query($sql);
				if($res){
					$res->setFetchMode(PDO::FETCH_OBJ);
	
					while( $tupla = $res->fetch() ){ //recupera uma linha por vez
				
						foreach($tupla as $coluna){
							$id_estado = $coluna;
						}
					}
				} else {
					echo "<div><h3>ERRO: Erro na consulta.</h3></div>";
				}

				$status = !$status; //Apenas para exibir no CSS
			
				$nome = $linha[3];
				$codigo_cidade = $linha[2];
				executarSQL($db, 'INSERT INTO T_CIDADES(nome,codigo_cidade,id_estado) VALUES ( "' . 
				$nome . '", "' . 
				$codigo_cidade . '", "' . 
				$id_estado . '");', $status);
			}

		}
	}

	function lerArquivoEstados($db, $fp, $fname){
		
		$separador = '|';
		$delimitador = '"'; //aspas duplas

		//Ignora a primeira linha (cabecalho do arquivo)
		if(is_resource($fp))
			$linha = fgetcsv($fp, 0, $separador, $delimitador); //$linha eh um vetor

		//Leh as demais linhas
		$status = true;
		while(!feof($fp)){

			//Ler uma linha do arquivo
			$linha = fgetcsv($fp, 0, $separador, $delimitador); //$linha eh um vetor

			if($linha!=NULL) {
				$status = !$status;

				//necessario descomentar a linha extension=mbstring no arquivo php-ini
				executarSQL($db, 'INSERT INTO T_ESTADOS(sigla,nome) VALUES ( "' . mb_convert_encoding($linha[0], "UTF-8", mb_detect_encoding($linha[0])) . '", "' . mb_convert_encoding($linha[1], "UTF-8", mb_detect_encoding($linha[1])) . '");', $status);
			}
		}
	}

	function fecharArquivo($fp,$fname){
		
		//echo '<h3>'.var_dump($fp).'</h3><br>';
		fclose($fp);
		//echo '<h3>'.var_dump($fp).'</h3><br>';
		if(is_resource($fp)){ //Da documentacao do PHP
			echo '<h3>ERRO: Erro ao fechar o arquivo: [' . $fname . ']</h3><br>';
		}
	}

	function abrirArquivo($db,$fname){

		$fp = fopen($fname, 'r');
		//var_dump($fp);
		if(!$fp){
			echo '<h3>ERRO: Erro na leitura do arquivo: ' . $fname . '</h3><br>';
		}

		return $fp;
	}

	function definirCaracterInclusao($db){
		
		echo '<div>';
		
				 
		echo '</div>';
	}


	function definirUTF8($db){
		
		//Gravar com UTF-8
		executarSQL($db, "SET CHARACTER SET utf8");
		executarSQL($db, "SET NAMES utf8"); 
	}

	function criarTabelas($db){
		$stmt = $db->query("SHOW TABLES LIKE 'T_CIDADES'");
		$table_exists = $stmt->rowCount() > 0;

		if(!$table_exists) {
			executarSQL($db, "CREATE TABLE IF NOT EXISTS T_ESTADOS( 
								id int primary key not null auto_increment, 
								sigla varchar(50) not null, 
								nome varchar(50) not null);");
			executarSQL($db, "CREATE TABLE IF NOT EXISTS T_CIDADES( 
								id int primary key not null auto_increment, 
								nome varchar(50) not null, 
								codigo_cidade varchar(50) not null, 
								id_estado int not null, 
								foreign key(id_estado) references T_ESTADOS(id))");
			
			return 0;
		}
		
		return 1;
	}

	function main(){
		$DATABASE = "mysql";
		$HOST = "localhost";
		$DBNAME = "db_cidades"; //mysql> create database db_cidades;
		$USER = "root"; 
		$PASSWORD = "root";


        $db = new PDO("$DATABASE: host=$HOST; dbname=$DBNAME", $USER, $PASSWORD); //Para o MySQL

		$table_already_exists = criarTabelas($db);

		if(!$table_already_exists) {
			definirUTF8($db);

			$fname = 'estados.txt';
			$fp = abrirArquivo($db,$fname);

			lerArquivoEstados($db,$fp,$fname);

			//imprimir($db, "T_ESTADOS");

			fecharArquivo($fp,$fname);
				
			$fname = 'municipios.csv';
			$fp = abrirArquivo($db,$fname);

			lerArquivoCidades($db,$fp,$fname);

			//imprimir($db, "T_CIDADES");

			fecharArquivo($fp,$fname);
		}
	}

	main()

?>