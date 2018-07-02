<!DOCTYPE HTML>
<HTML>
    <head>
        <meta charset="UTF-8">
        <title>Upload de imagens</title>

        <!-- BOOTSTRAP, FONTAWESOME e folha de estilo padrão -->
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">

        <script src="js/jquery.js"></script>
    </head>

    <body>
        <div class="container">
            <div class="uploader">
                <?php
                    if(array_key_exists('upload', $_GET)){
                        if($_GET['upload']=="1"){
                            echo "<p class='message alert-success'>Imagem enviada com sucesso!</p>";
                        }else{
                            echo "<p class='message alert-danger'>Arquivo de imagem inválido!</p>";
                        }

                    }
                ?>
                <form class="form-group" action="upload.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="MAX_FILE_SIZE" value="3000000" />

                    <label for='upload'>Selecione uma imagem:</label>
                    <input id="upload" name="imagem" type="file" accept="image/jpeg" class="btn-dark form-control">

                    <select class="form-control" name="compressed">
                        <option value="0">Sem compressão</option>
                        <option value="1">TinyPNG</option>
                    </select>
                    <button type="submit" class="btn btn-info">Upload</button>

                </form>

                <div class="thumbnailView">
                    <button class="btn btn-light" onclick="changeView()"><i class="fas fa-images"></i> Tamanho</button>
                </div>

                <div>
                    <?php

                    include('conexao.php');

                    $query = "SELECT * FROM imagem";
                    $result = mysqli_query($conexao, $query);

                    while($row=mysqli_fetch_object($result)) {
                        $url = "getImagem.php?id=$row->id_imagem";
                        echo "<figure class='figure'>";
                        echo "<img class='img-thumbnail rounded float-left' src='$url'>";
                        echo "<figcaption class='figure-caption text-right'>File size: "
                            .$row->tamanho."KB 
                            <form action='deleteImagem.php' method='post'>
                                <input type='hidden' value='$row->id_imagem' name='id'>
                                <button class='btn btn-danger'>
                                <i class='delete far fa-trash-alt'></i></figcaption></button>
                            </form>";
                        echo "</figure>";

                    }

                    ?>
                </div>
            </div>
        </div>

    <script src="js/main.js"></script>
    </body>


</HTML>