$(document).ready(function() {

    //Submiting "New message" form
    $('.form-message').submit(function(event){
        event.preventDefault();
        var textarea = $(this).children('textarea');
        $.ajax({
            method: "POST",
            url: "index.php?action=addmessage",
            data: {
                text: textarea.val()
            },
            success: function(result){
                textarea.val('');
                $('div.content').html(result);
            }
        });
    });
});