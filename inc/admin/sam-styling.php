<?php
if ( !defined( 'ABSPATH' ) )
    exit( 'restricted access' );

$style = sampression_styling();
//sam_p($style);
$default_fonts = sampression_fonts_style();
?>
<div id="content">
    <form id="sampression-metadata" onsubmit="javascript:return false;">
        <input type="hidden" name="meta_data" value="styling" />
        <section class="row">
            <h3 class="sec-title"><?php _e( 'Customize', 'sampression' ); ?></h3>
            <div class="box titled-box col">
                <div  class="box-title">
                    <h4><?php _e('Theme Layout', 'sampression'); ?></h4>
                </div>
                <div class="box-entry ">
                    <ul id="layout-selector" class="style-selector-list clearfix layout-list">
                        <?php
                        $layout = $style['theme_layout'];
                        $layout_name = $layout['name'];
                        $layout_active = $layout['active'];
                        for ($i = 0; $i < count($layout_name); $i++) {
                            ?>
                            <li class="<?php
                        if ($i == 0) {
                            echo 'first ';
                        } if ($layout_active == $layout_name[$i]) {
                            echo 'active ';
                        }
                        ?>style-selector">
                                <a href="javascript:void(0);" data-layout="<?php echo $layout_name[$i]; ?>" class="sam-style">
                                    <img class="defult-layout" src="<?php echo SAM_FW_ADMIN_IMAGES_URL; ?>/<?php echo $layout_name[$i]; ?>.png" alt=""/>
                                    <img class="active-layout" src="<?php echo SAM_FW_ADMIN_IMAGES_URL; ?>/<?php echo $layout_name[$i]; ?>-select.png" alt=""/>
                                    <img class="hover-layout" src="<?php echo SAM_FW_ADMIN_IMAGES_URL; ?>/<?php echo $layout_name[$i]; ?>-hover.png" alt=""/>
                            <?php echo ucwords(str_replace('-', ' ', $layout_name[$i])); ?>
                                </a>
                            </li>
    <?php
}
?>
                    </ul>
                    <input type="hidden" name="layout" id="layout" value="<?php echo $layout_active; ?>" />
                </div>
            </div>
            <div class="box titled-box col">
                <div  class="box-title">
                    <h4><?php _e( 'Sidebar', 'sampression' ) ?></h4>
                </div>
                <div class="box-entry">
                    <ul id="sidebar-selector" class="style-selector-list clearfix">
                        <?php
                        $sidebar = $style['sidebar'];
                        $sidebar_name = $sidebar['name'];
                        $sidebar_active = $sidebar['active'];
                        for ( $i = 0; $i < count( $sidebar_name ); $i++ ) {
                            ?>
                            <li class="<?php
                            if ( $i == 0 ) {
                                echo 'first ';
                            } if ( $sidebar_active == $sidebar_name[$i] ) {
                                echo 'active ';
                            }
                            ?>style-selector">
                                <a href="javascript:void(0);" data-sidebar="<?php echo $sidebar_name[$i]; ?>" class="sam-style">
                                    <img src="<?php echo SAM_FW_ADMIN_IMAGES_URL; ?>/<?php echo $sidebar_name[$i]; ?>-layout.jpg" alt=""/>
    <?php echo ucwords( $sidebar_name[$i] ); ?>
                                </a>
                            </li>
    <?php
}
?>
                    </ul>
                    <input type="hidden" name="sidebar" id="sidebar" value="<?php echo $sidebar_active; ?>" />
                </div>
            </div>
        </section>
        <section class="row">
<?php
$style1 = $style;
$bgcolor = $style['background_color'];
$bgcolor_none = $bgcolor['none'];
$bgcolor_active = $bgcolor['active'];
?>
            <div class="box titled-box col"<?php if ($bgcolor_none == 'yes') {
    echo ' style="height: 47px;"';
} else {
    echo ' style="height: 387px;"';
} ?>>
                <div class="box-title">
                    <h4><?php _e('Background Color', 'sampression') ?></h4>
                    <div class="right-cnt">
                        <input type="checkbox" class="sam-checkbox" id="use-bgcolor"<?php if ($bgcolor_none == 'yes') echo ' checked="checked"'; ?> />
                        <label for="use-bgcolor" class="checkbox-label"><?php _e('None', 'sampression');?></label>
                    </div>
                </div>
                <div class="box-entry fixed-colorpicker"<?php if ($bgcolor_none == 'yes') echo ' style="display: none;"'; ?>>
                    <input type="hidden" name="bgcolor_none" id="bgcolor_none" value="<?php echo $bgcolor_none; ?>" />
                    <input type="text" name="bg_color" value="<?php echo $bgcolor_active; ?>" class="sam-background wp-color-picker" data-default-color="<?php echo $bgcolor_active; ?>" />
                </div>
            </div>
<?php
$bgimage = $style['background_image'];
$bgimage_none = $bgimage['none'];
$bgimage_url = $bgimage['image'];
?>
            <div class="box titled-box col"<?php if ($bgimage_none == 'yes') echo ' style="height: 47px;"'; ?>>
                <div  class="box-title">
                    <h4><?php _e('Background Image', 'sampression') ?></h4>
                    <div class="right-cnt">
                        <input type="checkbox" class="sam-checkbox" id="use-bgimage"<?php if ($bgimage_none == 'yes') echo ' checked="checked"'; ?> />
                        <label for="use-bgimage" class="checkbox-label"><?php _e('None', 'sampression') ?></label>
                    </div>
                </div>
                <div class="box-entry"<?php if ($bgimage_none == 'yes') echo ' style="display: none;"'; ?>>
                    <ul id="bgimage-selector" class="style-selector-list clearfix add-image-section">
                        <li class="clearfix">
                            <figure class="image-holder alignleft image-preview">
                                <img src="<?php echo $bgimage_url; ?>" alt="<?php _e('Background Image', 'sampression') ?>" title="<?php _e('Background Image', 'sampression') ?>" />
                            </figure>
                            <div class="bakgroundimage-option alignleft">
                                <div class="image-title" id="bg-image-title"><?php echo truncate_text(basename($bgimage_url)); ?></div>
                                <div class="fileUpload button1 button2">
                                    <span><?php _e('Change', 'sampression') ?></span>
                                    <input type="hidden" id="bg_image" class="upload_image" name="bg_image" value="<?php echo $bgimage_url; ?>" />
                                    <input type="button" id="bgimage" class="upload_image_button" />
                                </div>
                            </div>
                            <input type="hidden" name="bgimage_none" id="bgimage_none" value="<?php echo $bgimage_none; ?>" />
                        </li>
                        <li class="clearfix">
                            <span class="sec-label"><?php _e('Repeat', 'sampression') ?>:</span>
                            <div class="select-wrapper">
                                <select name="bg_img_repeat" class="" id="bg_img_repeat">
<?php
$bgimage_repeat = $bgimage['repeat'];
for ($i = 0; $i < count($bgimage_repeat); $i++) {
    $sel = '';
    if ($bgimage_repeat[$i] == $bgimage['active']['repeat'])
        $sel = ' selected="selected"';
    ?>
                                        <option value="<?php echo $bgimage_repeat[$i]; ?>"<?php echo $sel; ?>><?php echo ucwords($bgimage_repeat[$i]); ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </li>
                        <li class="clearfix" <?php echo $bgimage['active']['repeat'] != 'no-repeat' ? ' style="display:none"' : ''; ?> >
                            <span class="sec-label"><?php _e('Position', 'sampression') ?>:</span>
                            <div class="select-wrapper" >
                                <select name="bg_img_position" class="sam-select">
<?php
$bgimage_position = $bgimage['position'];
for ($i = 0; $i < count($bgimage_position); $i++) {
    $sel = '';
    if ($bgimage_position[$i] == $bgimage['active']['position'])
        $sel = ' selected="selected"';
    ?>
                                        <option value="<?php echo $bgimage_position[$i]; ?>"<?php echo $sel; ?>><?php echo ucwords($bgimage_position[$i]); ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </li>
                        <li class="clearfix" <?php echo $bgimage['active']['repeat'] != 'no-repeat' ? ' style="display:none"' : ''; ?>>
                            <span class="sec-label"><?php _e('Attachment', 'sampression') ?>:</span>
                            <div class="select-wrapper" >
                                <select name="bg_img_attachment" class="sam-select">
<?php
$bgimage_attachment = $bgimage['attachment'];
for ($i = 0; $i < count($bgimage_attachment); $i++) {
    $sel = '';
    if ($bgimage_attachment[$i] == $bgimage['active']['attachment'])
        $sel = ' selected="selected"';
    ?>
                                        <option value="<?php echo $bgimage_attachment[$i]; ?>"<?php echo $sel; ?>><?php echo ucwords($bgimage_attachment[$i]); ?></option>
    <?php
}
?>
                                </select>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </section>
        <div id="response"></div>
        <a id="save" href="javascript:void(0);" class="button1 alignright save-data"><?php _e( 'Save', 'sampression' );?></a>
    </form>
</div>