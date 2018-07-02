$( document ).ready(function() {
    $('.message').delay(3000).fadeOut();
});

function changeView(){

    var thumb = $('.img-thumbnail');

    if(!thumb.hasClass('thumbnailLarge')){
        thumb.addClass('thumbnailLarge');
    }else{
        thumb.removeClass('thumbnailLarge');
    }

}

//CHAMADA ESTILO AJAX
function deleteImage(id_imagem){

    $.post('deleteImagem.php',
        {
         id: id_imagem
        }
    );

}