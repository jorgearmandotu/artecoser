$(document).ready(function() {
    $().ajaxStart(function() {
        $('#loading').show();
        $('#result').hide();
    }).ajaxStop(function() {
        $('#loading').hide();
        $('#result').fadeIn('slow');
    });
    $('#formulario').submit(function() {
        $.ajax({
            type: 'POST',
            url: '../html/formulario.php',
            data: $(this).serialize(),
            success: function(data) {
                $('#formulario')[0].reset();
                $('#result').html(data);
            }
        })
        
        return false;
    }); 
})  