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

    // открывает для редактирвоания сообщение
    $('div.content').delegate('button.editmessage', 'click', function(){
        var parent_div = $(this).closest('div.message');
        parent_div.children('div.message-body').html('<textarea>' + parent_div.find('div.message-body>p').text() + '</textarea>');
        parent_div.find('div.message-body>textarea').focus();
        parent_div.children('button').replaceWith('<button class="savemessage">Save</button>');
    });

    // Нажатие Enter или уход фокуса сохроняет измениеия в имени узла
    $("div.content").on("keypress focusout", "textarea", function(event) {
        if (event.which == 13 || event.type == 'focusout') {
            if('' == $(this).text()){
                $(this).parent('div').parent('li').remove();
            }else{
                var parent_div = $(this).closest('div.message');

                var message_id = parent_div.attr('data-messageid');
                var user_id = parent_div.attr('data-userid');
                var message_text = $(this).val();
                $(this).replaceWith('<p>' + message_text + '</p>');

                $.post('index.php?action=addmessage', {
                        id: message_id,
                        text: $(this).val()
                    }, function(result){
                        $('div.content').html(result);
                    }
                );
            }
        }
    });

});