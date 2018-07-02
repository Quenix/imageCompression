<?php
/**
 * Created by PhpStorm.
 * User: Quenix
 * Date: 01/07/2018
 * Time: 17:55
 */

include('conexao.php');
require_once("vendor/autoload.php");
ini_set('max_execution_time', 300); //300 seconds = 5 minutes

\Tinify\setKey("uK4yoQGRgJotdIovvaYVeMM4bYRVZDPM");

$imageBinary   = $_FILES['imagem'];
$file_size = $imageBinary['size'];
$compressionType = $_POST['compressed'];

if($compressionType == 1){
    $sourceData = file_get_contents($_FILES['imagem']['tmp_name']);
    $resultData = \Tinify\fromBuffer($sourceData)->toBuffer();
    $dados = \Tinify\fromBuffer($sourceData)->result();

    $file_size = $dados->size();
}

//Nome final que será inserido no banco de dados
$nomeFinal = time().'.jpg';

//Verifica se é um arquivo válido e o move para o servidor
if (move_uploaded_file($imageBinary['tmp_name'], $nomeFinal)) {

    //Conteúdo da imagem
    if($compressionType == 1){
        $imagem = addslashes($resultData);
    }else{
        $imagem = addslashes(file_get_contents($nomeFinal));
    }

    $query = "INSERT INTO imagem (imagem, tamanho, compressed) VALUES('$imagem', $file_size, $compressionType);";
    mysqli_query($conexao, $query) or die('Informe isso ao programador mais próximo: ' . mysqli_error($conexao));


    //Retorna um parâmetro de SUCESSO notificando que o arquivo foi gravado com sucesso
    unlink($nomeFinal);
    header ("Location: index.php?upload=1");
}else{
    //Retorna um parâmetro de ERRO notificando que não foi possível efetuar o Upload
    unlink($nomeFinal);
    header ("Location: index.php?upload=0");
}

//Remove o arquivo temporário do servidor


