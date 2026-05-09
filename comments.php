<?php

// $comments_args = array(
//         // Change the title of send button 
//         'label_submit' => __( 'Submit', 'textdomain' ),
//         // Change the title of the reply section
//         'title_reply' => __( 'Write a Reply or Comment', 'textdomain' ),
//         // Remove "Text or HTML to be displayed after the set of comment fields".
//         'comment_notes_after' => '',
//         // Redefine your own textarea (the comment body).
//         'comment_field' => '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun' ) . '</label><br /><textarea id="comment" class="comment-field" name="comment" aria-required="true"></textarea></p>',
//         'author' => '<p class="comment-form-author">ddddddddd<label for="author">' . _x( 'Name', 'noun' ) . '</label><br /><input type="text" id="author" class="comment-field" name="author" aria-required="true" /></p>',
//         'email' => '<p class="comment-form-author">ddddddddd<label for="author">' . _x( 'Name', 'noun' ) . '</label><br /><input type="text" id="author" class="comment-field" name="author" aria-required="true" /></p>',
// );

comment_form($comments_args);