$(document).ready(function()
{
    // obtenemos los votos del video
    obtenerPuntaje();

    // si se aprieta algún botón de votación
    $(".like").on("click", function(e) {

        // obtenemos el id del video
        var id=$('#video').attr("data-id");

        // obtenemos el tipo de votación
        var nombre=$(this).attr("name");

        // hacemos el pedido por AJAX a la página PHP
        // se realiza una votación y se obtienen los votos actualizados
        var dataString = 'id='+ id + '&nombre='+ nombre;    
        $.ajax({
            type: "POST",
            url: "votacion.php",
            data: dataString,
            cache: true,
            success: function(html) {

                // si todo salió bien agregamos el resultado a la página
                $("#contenido").html(html);
        }});

        // evitamos el parpadeo de la página
        e.preventDefault();
    });

    //limpiar la votacion
    $(".clear").on("click", function(e) {

       $.ajax({
            type: "POST",
            url: "votacion.php",
            data: "clear=clear",
            cache: true,
            success: function(html) {

                // si todo salió bien agregamos el resultado a la página
                $("#contenido").html(html);
        }});

        // evitamos el parpadeo de la página
        e.preventDefault();
    });
});

// obtenemos los votos, sin hacer una votación 
function obtenerPuntaje (votacion) {
    var id=$('#video').attr("data-id");
    var dataString = 'id='+ id;
    $.ajax({
        type: "POST",
        url: "votacion.php",
        data: dataString,
        cache: true,
        success: function(html) {
            $("#contenido").html(html);
    }});
}