<?php
if ( ! defined( 'ABSPATH' ) ) exit( 'restricted access' );

$hooks = (object) sampression_hooks_setting();

$available_hooks = $hooks->hook;
//sam_p($available_hooks);
?>
<div id="content">
    <form id="sampression-metadata" onsubmit="javascript:return false;">
        <input type="hidden" name="meta_data" value="hooks-settings" />
    <h3 class="sec-title"><?php _e( 'Hooks', 'sampression' );?></h3>
    <?php foreach ( $available_hooks as $available_hook_key => $available_hook_val ) {
        ?>
        <section class="row">
            <div class="box titled-box">
                <div class="box-title sam-hooks-cb">
                    <h4><?php echo $available_hook_val['label'];?></h4>
                    <div class="right-cnt">
                        <input type="checkbox" class="sam-checkbox samp-style" id="use-excute-<?php echo $available_hook_key;?>" <?php echo $available_hook_val['execute'] == 'yes' ? 'checked="checked"' : '';?>/>
                        <label for="use-excute-<?php echo $available_hook_key;?>" class="checkbox-label"><?php _e('Execute this Hook', 'sampression');?></label>
                        <input type="hidden" class="sam-use-excute-<?php echo $available_hook_key;?>" id="sam-use-excute-<?php echo $available_hook_key;?>" name="sam-use-excute-<?php echo $available_hook_key;?>" value="<?php echo $available_hook_val['execute'];?>" />
                    </div>
                </div>
                <div class="box-entry sam-hooks-option clearfix">
                    <div class="alignright sam-hooks-info">
                        <input type="hidden" name="hook_name[]" value="<?php echo $available_hook_key;?>"/>
                        <input type="hidden" name="sam-hook-label-<?php echo $available_hook_key;?>" value="<?php echo $available_hook_val['label'];?>"/>
                        <input type="hidden" name="sam-hook_description-<?php echo $available_hook_key;?>" value="<?php echo $available_hook_val['description'];?>"/>
                        <input type="hidden" name="sam-hook_code-<?php echo $available_hook_key;?>" value="<?php echo stripcslashes($available_hook_val['code']);?>"/>
                        <div class="notice"><?php _e('Description', 'sampression');?></div>
                        <div class="sam-info"><p><?php echo $available_hook_val['description']; ?></p></div>
                    </div>
                    <textarea name="<?php echo $available_hook_key . '_content';?>" class="large-input alignleft" placeholder="<?php _e('Type here', 'sampression');?>"><?php echo $available_hook_val['content'];?></textarea>
                    <pre class='select-me'>&#60;&#63;php<br><?php echo stripcslashes($available_hook_val['code']); ?><br>&#63;&#62;</pre>
                </div>
            </div>
        </section>
    <?php } ?>
        <!-- .row-->
        <div id="response"></div>
        <a id="save" href="javascript:void(0);" class="button1 alignright save-data"><?php _e('Save', 'sampression');?></a>
    </form>
</div>