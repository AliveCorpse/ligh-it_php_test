$(document).ready(function() {
    $('.form-message').submit(function(event){
        event.preventDefault();

        $.ajax({
            method: "POST",
            url: "index.php?action=addmessage",
            // data: new FormData(this),
            data: {
                text: $(this).children('textarea').val()
            },
            success: function(result){
                $('div.content').html(result);
            }
        });
    });
});