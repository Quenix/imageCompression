<?php
/**
 * Created by PhpStorm.
 * User: Quenix
 * Date: 01/07/2018
 * Time: 17:55
 */

    include('conexao.php');

    $imageBinary   = $_FILES['imagem'];
    $file_size = $imageBinary['size'];
    var_dump($_FILES['imagem']['size']);
    //Nome final que será inserido no banco de dados
    $nomeFinal = time().'.jpg';

    //Verifica se é um arquivo válido e o move para o servidor
    if (move_uploaded_file($imageBinary['tmp_name'], $nomeFinal)) {

        //Abre o arquivo, lê o conteúdo deste e grava numa string e faz uma validação para prevenir caracteres inválidos
        $imagem = addslashes(file_get_contents($nomeFinal));

        //Conexão com o banco de dados
        $query = "INSERT INTO imagem (imagem, tamanho) VALUES('$imagem', $file_size);";
        mysqli_query($conexao, $query) or die('Informe isso ao programador mais próximo: max_allowed_packet');

        //Retorna um parâmetro de SUCESSO notificando que o arquivo foi gravado com sucesso
        unlink($nomeFinal);
        header ("Location: index.php?upload=1");
    }else{
        //Retorna um parâmetro de ERRO notificando que não foi possível efetuar o Upload
        unlink($nomeFinal);
        header ("Location: index.php?upload=0");
    }

    //Remove o arquivo temporário do servidor


