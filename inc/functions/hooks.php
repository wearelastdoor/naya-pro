<?php

function sampression_action_hooks($hook = '') {
    if($hook === '')
        return;

    $hooks = (object) sampression_hooks_setting();
    foreach($hooks->hook as $hkey => $hval) {
        if((str_replace('sam_', '', $hkey) === $hook) && $hval['execute'] === 'yes') {
            echo $hval['content'];
        }
    }
}


function sam_hook_before_head_close(){
    sampression_action_hooks('before_head_close');
}
function sam_hook_after_body(){
    sampression_action_hooks('after_body');
}
function sam_hook_before_body_close(){
    sampression_action_hooks('before_body_close');
}
function sam_hook_before_footer(){
    sampression_action_hooks('before_footer');
}
add_action('sampression_before_head_close', 'sam_hook_before_head_close');
add_action('sampression_after_body', 'sam_hook_after_body');
add_action('sampression_before_body_close', 'sam_hook_before_body_close');
add_action('sampression_before_footer', 'sam_hook_before_footer');