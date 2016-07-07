 $(document).ready(function() {
     //Add comment
     $('div.content').delegate('button.addcomment', 'click', function() {
         var parent_div = $(this).closest('div.message-footer');
         var form_comment = '<form action="index.php" method="post" class="form-comment">';
         form_comment += '<textarea class="postcomment"></textarea>';
         form_comment += ' <input class="btn btn-primary" type="submit" value="Comment">';
         form_comment += ' <button class="cancelcomment btn btn-warning">Cancel</button>';
         form_comment += '</form>'
         $(this).replaceWith(form_comment);
         parent_div.find('textarea.postcomment').focus();
     });
     //Submiting "New root comment" form
     $('div.content').delegate('.form-comment', 'submit', function(event) {
         event.preventDefault();
         var textarea = $(this).children('textarea.postcomment');
         var message_id = $(this).closest('div.message').attr('data-messageid');
         var parent_id = 0; //$(this).closest('div.comment').attr('data-commentid');
         $.ajax({
             method: "POST",
             url: "index.php?action=addcomment",
             data: {
                 text: textarea.val(),
                 parent_id: parent_id,
                 message_id: message_id,
             },
             success: function(result) {
                 textarea.val('');
                 $('div.content').html(result);
             }
         });
     });
     // открывает для редактирвоания комментарий
     $('div.content').delegate('button.editcomment', 'click', function() {
         var parent_div = $(this).closest('div.comment');
         console.log(parent_div);
         parent_div.children('div.comment-body').html('<textarea class="editcomment">' + parent_div.find('div.comment-body>p').text() + '</textarea>');
         parent_div.find('div.comment-body>textarea.editcomment').focus();
         parent_div.find('button.editcomment').replaceWith('<button class="savecomment">Save</button><button class="deletecomment">Delete</button>');
     });
     // Нажатие Enter или уход фокуса сохроняет измениеия 
     $("div.content").on("keypress focusout", "textarea.editcomment", function(event) {
         var comment_text = $(this).val();
         var parent_div = $(this).closest('div.comment');
         if (event.which == 13 || event.type == 'focusout') {
             if ('' == comment_text) {
                 alert('Текст комментария не может быть пустым');
             } else {
                 var comment_id = parent_div.attr('data-commentid');
                 var user_id = parent_div.attr('data-userid');
                 $(this).replaceWith('<p>' + comment_text + '</p>');
                 $.post('index.php?action=addcomment', {
                     id: comment_id,
                     text: $(this).val()
                 }, function(result) {
                     $('div.content').html(result);
                 });
             }
         }
     });
     // Удаение комментария при нажатии на button.deletecomment
     $('div.content').delegate('button.deletecomment', 'click', function() {
         var parent_div = $(this).closest('div.comment');
         var comment_id = parent_div.attr('data-commentid');
         var conf = confirm('Вы уверены, что хотите удалить этот комментарий?');
         if (conf) {
             parent_div.remove();
             $.post('index.php?action=deletecomment', {
                 id: comment_id
             }, function(result) {
                 $('div.content').html(result);
             });
         }
     });
     // ответ на другой комментарий
     $('div.content').delegate('button.addanswer', 'click', function() {
         var parent_div = $(this).closest('div.message-footer');
         var form_comment = '<form action="index.php" method="post" class="form-answer">';
         form_comment += '<textarea class="answercomment"></textarea>';
         form_comment += ' <input class="btn btn-primary" type="submit" value="Ansver">';
         form_comment += ' <button class="cancelcomment btn btn-warning">Cancel</button>';
         form_comment += '</form>'
         $(this).replaceWith(form_comment);
         parent_div.find('textarea.answercomment').focus();
     });
    // Сохроняет вложенный комментарий
     $('div.content').delegate('.form-answer', 'submit', function(event) {
         event.preventDefault();
         var textarea = $(this).children('textarea.answercomment');
         var message_id = $(this).closest('div.message').attr('data-messageid');
         var parent_id = $(this).closest('div.comment').attr('data-commentid');
         $.ajax({
             method: "POST",
             url: "index.php?action=addcomment",
             data: {
                 text: textarea.val(),
                 parent_id: parent_id,
                 message_id: message_id,
             },
             success: function(result) {
                 textarea.val('');
                 $('div.content').html(result);
             }
         });
     });
 });