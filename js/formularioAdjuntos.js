$(document).ready(function() {
   /* $().ajaxStart(function() {
        $('#loading').show();
        $('#result').hide();
    }).ajaxStop(function() {
        $('#loading').hide();
        $('#result').fadeIn('slow');
    });*/
    $('#formulario').submit(function(event) {
        var formData = new FormData($(this)[0]);
        $('#enviando').addClass('envio');
        $.ajax({
             url: '../html/formularioConAdjuntos2.php',
            type: 'POST',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(rdata) {
                $('#formulario')[0].reset();
                $('#result').html(rdata);
                $('#enviando').removeClass('envio');
            }
        })
        
        return false;
    }); 
});
