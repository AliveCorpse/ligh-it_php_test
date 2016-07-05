<ol>

<?php foreach($messages as $message): ?>
<?php foreach($users as $user): ?>
    <?php if ($message->user_id == $user->id): ?>
    <li>
        <div class="message" data-userid="<?=$message->user_id?>" data-messageid="<?=$message->id?>">
            <span><?=date('d-m-Y H:i:s',$message->created_at)?></span>
            <p><?=$message->text?></p>
            <p>Posted by <em><?=$user->name?></em></p>
        </div>
    </li>
    <?php endif; ?>
<?php endforeach; ?>
<?php endforeach; ?>