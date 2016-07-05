<ol>
<?php foreach($messages as $message): ?>
    <li>
        <span><?=date('d-m-Y H:i:s',$message->created_at)?></span>
        <p><?=$message->text?></p>
    </li>
<?php endforeach; ?>