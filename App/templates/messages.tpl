<ol>

<?php foreach($messages as $message): ?>
<?php foreach($users as $user): ?>
    <?php if ($message->user_id == $user->id): ?>
    <li>
        <div class="message" data-userid="<?=$message->user_id?>" data-messageid="<?=$message->id?>">

            <div class="message-head">
                <span>Posted by <strong><?=$user->name?></strong> at <em><?=date('d-m-Y H:i:s',$message->created_at)?></em>
                <?php if($message->created_at !== $message->updated_at): ?>
                   <span><em>(updated at <?=date('d-m-Y H:i:s',$message->updated_at)?>)</em></span>
                <?php endif; ?>
                </span>
                <?php if($user->id == $current_user->id): ?>
                    <button class="editmessage">Edit</button>
                <?php endif; ?>
            </div>

            <div class="message-body">
                <p><?=$message->text?></p>
            </div>

            <div class="message-footer">
                <h3>Add comment</h3>
                <!-- <textarea name="comment"></textarea> -->
            </div>
        </div>
    </li>
    <?php endif; ?>
<?php endforeach; ?>
<?php endforeach; ?>