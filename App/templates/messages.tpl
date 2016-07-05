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
                    <button class="editmessage">Edit</button>
                <?php endif; ?>
            </div>

            <div class="message-body">
                <p><?=$message->text?></p>
            </div>

            <div class="message-footer">
                <h3>Add comment</h3>
                <?php if(isset($current_user->id)): ?>
                <button class="addcomment">Add comment</button>
                <?php endif; ?>
                <ul>
                    <li>comment 1</li>
                    <li>comment 22</li>
                </ul>
            </div>
        </div> <!-- End div.message -->
    </li>
    
<hr>
<?php endforeach; ?>
</ol>