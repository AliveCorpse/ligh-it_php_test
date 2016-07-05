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
        parent_div.find('button.editmessage').replaceWith('<button class="savemessage">Save</button><button class="deletemessage">Delete</button>');
    });

    // Нажатие Enter или уход фокуса сохроняет измениеия в имени узла
    $("div.content").on("keypress focusout", "textarea", function(event) {
        var message_text = $(this).val();
        var parent_div = $(this).closest('div.message');

        if (event.which == 13 || event.type == 'focusout') {
            if('' == message_text){
                alert('Текст сообщение не может быть пустым');
            }else{                
                var message_id = parent_div.attr('data-messageid');
                var user_id = parent_div.attr('data-userid');
                
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

    $('div.content').delegate('button.deletemessage', 'click', function(){
        var parent_div = $(this).closest('div.message');
        var message_id = parent_div.attr('data-messageid');
        
        var conf = confirm('Вы уверены, что хотите удалить это сообщение?');
        if(conf){    
            parent_div.remove();
            $.post('index.php?action=deletemessage', {
                id: message_id
                },
                function(result){
                     $('div.content').html(result);
                }
            );
        }   
    });

    // Comments
    
    // Add comment
    $('div.comtent').delegate('button.addcomment', 'click', function(){
        
    });
});