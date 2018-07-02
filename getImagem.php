<?php
/**
 * Created by PhpStorm.
 * User: Quenix
 * Date: 01/07/2018
 * Time: 22:06
 */

include('conexao.php');


$id_imagem = $_GET['id'];

$query = "SELECT * FROM imagem WHERE id_imagem = '$id_imagem'";
$result = mysqli_query($conexao, $query);

$row = mysqli_fetch_object($result);

header( "Content-type: image/jpeg");

echo $row->imagem;
