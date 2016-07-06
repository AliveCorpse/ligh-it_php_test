<?php

function drowTree($items, $current_user, $parent_id = 0)
{
    $result = '<ul>';
    foreach ($items as $comment) {
        if($parent_id == $comment->parent_id) {
            
            $result .= '<li><div calss="comment"
                                data-userid="'.$comment->user_id.'"
                                data-commentid="'.$comment->id.'"
                                data-parentid="'.$comment->parent_id.'"
            >';
                $result .= '<div class="coment-head">'
                    . '<span>Commeted by <strong>' . $comment->user_name . '</strong> at <em>'
                    . date('d-m-Y H:i:s', $comment->created_at) . '</em>';
                $result .=  ($comment->created_at !== $comment->updated_at)
                            ? '<span><em>(updated at ' . date('d-m-Y H:i:s', $comment->updated_at) . '</em></span>'
                            : '';
                $result .= ($comment->user_id == $current_user->id)
                            ? '<button class="editcomment">Edit comment</button>'
                            : '';
                $result .= '</div>'; // End div.comment-head

                $result .= '<div class="coment-body">' . $comment->text . '</div>';

                $result .= '<div class="coment-footer"></div>';
            $result .= '</div>'; // End div.comment

            drowTree($items, $current_user, $comment->id);
            $result .= '</li>';
            
        }      
    }
    $result .= '</ul>'; 
    echo $result;
}