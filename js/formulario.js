$(document).ready(function() {
    $().ajaxStart(function() {
        $('#loading').show();
        $('#result').hide();
    }).ajaxStop(function() {
        $('#loading').hide();
        $('#result').fadeIn('slow');
    });
    
})

/*
$('#formulario').submit(function() {
    var formData = new FormData($(this)[0]);
        $.ajax({
            type: 'POST',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            enctype: "multipart/form-data",
            url: '../html/formularioConAdjuntos2.php',
            success: function(data) {
                $('#formulario')[0].reset();
                $('#result').html(data);
            }
        })

        return false;
    }); 
*/
/*////////////////////////////////////////////*/
$('#formulario').submit(function(event) {
        event.preventDefault();
        var formData = new FormData($(this)[0]);
        $.ajax({
            url: '../html/formularioConAdjuntos2.php',
            type: 'POST',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(returndata) {
                $('#formulario')[0].reset();
                $('#result').html(returndata);
            }
        })
        return false;

    });