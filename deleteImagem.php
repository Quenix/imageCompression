<?php
/**
 * Created by PhpStorm.
 * User: Quenix
 * Date: 02/07/2018
 * Time: 00:06
 */

include('conexao.php');

$id = $_POST['id'];

$query = "DELETE FROM imagem WHERE id_imagem = $id";

mysqli_query($conexao, $query);

header("Location: index.php");