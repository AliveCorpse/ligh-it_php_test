<?php require_once __DIR__ . '/helpers/lib.php'?>
<ol>

<?php foreach($messages as $message): ?>

    <li>
        <div class="message" 
            data-userid="<?=$message->user_id?>" 
            data-messageid="<?=$message->id?>"
        >

            <div class="message-head">
                <span>Posted by <strong><?=$message->user_name?></strong> at <em><?=date('d-m-Y H:i:s',$message->created_at)?></em>
                <?php if($message->created_at !== $message->updated_at): ?>
                   <span><em>(updated at <?=date('d-m-Y H:i:s',$message->updated_at)?>)</em></span>
                <?php endif; ?>
                </span>
                <?php if($message->user_id == $current_user->id): ?>
                    <button class="editmessage btn btn-xs">Edit</button>
                <?php endif; ?>
            </div>

            <div class="message-body">
                <p><?=$message->text?></p>
            </div>

            <div class="message-footer">
                <h3>Comments</h3>
                <?php if(isset($current_user->id)): ?>
                <button class="addcomment btn btn-xs btn-success">Add comment</button>
                <?php endif; ?>
                <div class="root">
                    <?php if(!empty($message->comments)){
                        echo drowTree($message->comments, $current_user);
                    } ?>
                </div>
            </div>
        </div> <!-- End div.message -->
    </li>

<hr>
<?php endforeach; ?>
</ol>