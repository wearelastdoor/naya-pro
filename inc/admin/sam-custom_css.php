<?php
if ( ! defined( 'ABSPATH' ) ) exit( 'restricted access' );

$css_settings = sampression_custom_css();
//sam_p($css_settings);
?>
<div id="content">
    <form id="sampression-metadata" onsubmit="javascript:return false;">
        <input type="hidden" name="meta_data" value="custom_css_settings" />
        <textarea id="sam-custom-code" name="code"><?php echo $css_settings['css'] ?></textarea>
        <div id="response"></div>
        <a id="save" href="javascript:void(0);" class="button1 alignright save-data"><?php _e( 'Save', 'sampression' );?></a>
    </form>
</div>