<?php
if ( ! defined( 'ABSPATH' ) ) exit( 'restricted access' );

$logo_icon = (object) sampression_logos_icons();
$default_fonts = (object) sampression_fonts_style();
//sam_p($logo_icon);
?>
<div id="content">
    <form id="sampression-metadata" onsubmit="javascript:return false;">
        <input type="hidden" name="meta_data" value="logos-icons" />
        <section class="row sam-logooption">
            <h3 class="sec-title"><?php echo _e( 'Logos &amp; Icons', 'sampression' ); ?></h3>
            <?php
            $logo_icons = (object) $logo_icon->logo_icon;
            $logo_icons_name = $logo_icons->name;
            $logo_icon_active = $logo_icons->active;
            $logo_icon_image = $logo_icons->image;
            ?>
            <div class="sam-section-wrapper clearfix">
                <div class="box titled-box col first-child">
                    <div  class="box-title">
                        <div class="sam-radio clearfix">
                            <input id="sam-use-logo" type="radio" value="use-logo" name="sam-logo" <?php echo $logo_icon_active['name'] == 'use-logo' ? 'checked="checked"' : ''; ?>>
                            <label for="sam-use-logo"><?php echo _e( 'Website Logo', 'sampression' ); ?></label>
                        </div>
                    </div>
                    <div class="box-entry clearfix">
                        <figure class="image-holder image-preview">
                            <img src="<?php echo $logo_icon_image ? $logo_icon_image : SAM_FW_ADMIN_IMAGES_URL . '/logo.jpg'; ?>" alt="Sampression" id="website-image-preview" />
                        </figure>
                        <div class="backgroundimage-option alignleft">
                            <div class="image-title" id="website-image-title"><?php echo truncate_text( basename( $logo_icon_image ) ); ?></div>
                            <div class="fileUpload button1 button2">
                                <span><?php _e( 'Change', 'sampression' );?></span>
                                <input type="hidden" id="website_image" class="upload_image" name="website_image" value="<?php echo $logo_icon_image; ?>" />
                                <input type="button" id="websiteimage" name="websiteimage" class="upload_image_button" />
                            </div>
                        </div>
                        <div class="alignleft sam-section-detail">
                            <p><?php echo _e('Website logo must be 340px x 75px<br>jpg, png, gif are supported.', 'sampression'); ?></p>
                        </div>
                    </div>
                </div>
                <div class="box titled-box col">
                    <?php
                    $fonts = $default_fonts->fonts;
                    $size = $default_fonts->size;
                    $style = $default_fonts->style
                    ?>
                    <div  class="box-title">
                        <div class="sam-radio clearfix">
                            <input id="sam-use-title" type="radio" value="use-title" name="sam-logo" <?php echo $logo_icon_active['name'] == 'use-title' ? 'checked="checked"' : ''; ?>>
                            <label for="sam-use-title"><?php echo _e( 'Website Title', 'sampression' ); ?></label>
                        </div>
                    </div>
                    <div class="box-entry sam-add-border"><?php //echo $logo_icon_active['color'] ?>
                        <div class="sam-site-title font-demo" style="font: <?php echo $logo_icon_active['style']; ?> <?php echo $logo_icon_active['size']; ?>px <?php echo $logo_icon_active['font']; ?>; color: <?php echo $logo_icon_active['color']; ?>;<?php if($logo_icon_active['color'] == '#ffffff') { echo ' background-color: #57B94A;'; } ?>"><?php echo get_bloginfo('name') ? get_bloginfo('name') : _e( 'nay&#225;', 'sampression' ); ?></div>
                        <div class="select-wrapper font-face medium-select alignleft" >
                            <?php sampression_font_select( 'website_font_face', 'sam-select change-site-fontface', $logo_icon_active['font'] ) ?>
                        </div>
                        <div class="select-wrapper font-size small-select alignleft">
                            <?php sampression_font_size_select( 'website_font_size', 'sam-select change-site-fontsize', $logo_icon_active['size'] ) ?>
                        </div>
                        <div class="select-wrapper font-style small-select alignleft" style="margin-right: 0;">
                            <?php sampression_font_style_select( 'website_font_style', 'sam-select change-site-fontstyle', $logo_icon_active['style'] ) ?>
                        </div>
                        <input type="text" name="sam-site-color" value="<?php echo $logo_icon_active['color']; ?>" class="sam-site-title-color wp-color-picker" data-default-color="#00CC99" />
                    </div>
                    <div class="box-entry">
                        <div class="clearfix remove-description">
                            <input id="no-webdesc" class="sam-checkbox samp-style" type="checkbox" <?php if ($logo_icons->web_desc['use_desc'] == 'yes') echo ' checked="checked"'; ?>>
                            <label class="checkbox-label" for="no-webdesc"><?php echo _e( 'Website Description', 'sampression' ); ?></label>
                            <input type="hidden" id="sam-use-webdesc" name="use_webdesc" value="<?php echo $logo_icons->web_desc['use_desc']; ?>" />
                        </div>
                        <div class="sam-site-desc font-demo" style="font: <?php echo $logo_icons->web_desc['style']; ?> <?php echo $logo_icons->web_desc['size']; ?>px <?php echo $logo_icons->web_desc['font']; ?>; color: <?php echo $logo_icons->web_desc['color']; ?>;<?php if( $logo_icons->web_desc['color'] == '#ffffff' ) { echo ' background-color: #57B94A;'; } ?>"><?php echo get_bloginfo( 'description' ) ? get_bloginfo( 'description' ) : _e( 'a new theme', 'sampression' ); ?></div>
                        <div class="select-wrapper font-face medium-select alignleft" >
                            <?php sampression_font_select( 'webdesc_font_face', 'sam-select change-sitedesc-fontface', $logo_icons->web_desc['font'] ) ?>
                        </div>
                        <div class="select-wrapper font-size small-select alignleft">
                            <?php sampression_font_size_select( 'webdesc_font_size', 'sam-select change-sitedesc-fontsize', $logo_icons->web_desc['size'], $size['min_value'], $size['max_value'] ) ?>
                        </div>
                        <div class="select-wrapper font-style small-select alignleft" style="margin-right: 0;">
                            <?php sampression_font_style_select( 'webdesc_font_style', 'sam-select change-sitedesc-fontstyle', $logo_icons->web_desc['style'] ) ?>
                        </div>
                        <input type="text" name="webdesc_font_color" value="<?php echo $logo_icons->web_desc['color']; ?>" class="sam-site-desc-color wp-color-picker" data-default-color="#00CC99" />
                    </div>
                </div>
            </div>
        </section>
        <!-- end of .row-->
        <section class="row">
            <?php
            $favicon = $logo_icon->fav_icon;
            ?>
            <div class="box titled-box ">
                <div class="box-title"><h4><?php _e('Favicon', 'sampression'); ?></h4></div>
                <div class="box-entry sam-favicon">
                    <ul id="bgimage-selector" class="style-selector-list clearfix add-image-section">
                        <li class="clearfix sam-no-spacing sam-no-border">
                            <figure class="image-holder alignleft image-preview">
                                <img src="<?php echo $favicon['favicon_16']['image'] ? $favicon['favicon_16']['image'] : SAM_FW_ADMIN_IMAGES_URL . '/favicon.jpg'; ?>" alt="<?php get_bloginfo( 'name' ); ?> favicon" id="website-image-preview" />
                            </figure>
                            <div class="backgroundimage-option alignleft">
                                <div class="image-title" id="website-image-title"><?php echo truncate_text( basename( $favicon['favicon_16']['image'] ) ); ?></div>
                                <div class="fileUpload button1 button2">
                                    <span><?php _e( 'Change', 'sampression' ); ?></span>
                                    <input type="hidden" id="favicon_image" class="upload_image" name="favicon_image" value="<?php echo $favicon['favicon_16']['image']; ?>" />
                                    <input type="button" id="faviconimage" name="faviconimage" class="upload_image_button" />
                                </div>
                            </div>
                            <div class="alignleft sam-section-detail">
                                <p><?php _e( 'Favicon must be 16px x 16px<br>jpg, png, gif, ico are supported.', 'sampression' ); ?></p>
                                <input type="checkbox" class="sam-checkbox samp-style" id="use-favicon"<?php if ( $favicon['favicon_16']['donot_use_favicon'] == 'yes' ) echo ' checked="checked"'; ?> />
                                <label for="use-favicon" class="checkbox-label"><?php echo _e('Disable', 'sampression'); ?></label>
                                <input type="hidden" class="sam-use-favicon" name="use-favicon" value="<?php echo $favicon['favicon_16']['donot_use_favicon']; ?>" />
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </section>
        <!-- .row-->
        <section class="row">
            <?php
            $apple_favicon = $logo_icon->apple_icon;
            ?>
            <div class="box titled-box ">
                <div class="box-title"><h4><?php _e( 'Apple Touch Icons', 'sampression' );?></h4>
                    <div class="right-cnt">
                    <input type="checkbox" class="sam-checkbox samp-style" <?php if ( $apple_favicon['donot_use_apple_icon'] == 'yes' ) echo ' checked="checked"'; ?> id="no-touchicon" />

                    <label for="no-touchicon" class="checkbox-label"><?php _e( 'Disable All', 'sampression' );?></label>
                    <input type="hidden" class="sam-no-touchicon" name="no-touchicon" value="<?php echo $apple_favicon['donot_use_apple_icon']; ?>" />
                    </div>
                </div>
                <div class="box-entry sam-appletouchicon">
                    <ul id="bgimage-selector" class="style-selector-list clearfix add-image-section">
                        <li class="clearfix">
                            <figure class="image-holder image-preview">
                                <img src="<?php echo $apple_favicon['favicon_57']['image'] ? $apple_favicon['favicon_57']['image'] : SAM_FW_ADMIN_IMAGES_URL . '/favicon.jpg'; ?>" alt="<?php get_bloginfo('name'); ?> apple favicon" id="favicon_57-image-preview" />
                            </figure>
                            <div class="backgroundimage-option alignleft">
                                <div class="image-title" id="website-image-title"><?php echo truncate_text( basename( $apple_favicon['favicon_57']['image'] ) ); ?></div>
                                <div class="fileUpload button1 button2">
                                    <span><?php _e( 'Change', 'sampression' ); ?></span>
                                    <input type="hidden" id="favicon_image" class="upload_image" name="favicon_57_image" value="<?php echo $apple_favicon['favicon_57']['image']; ?>" />
                                    <input type="button" id="faviconimage" name="favicon_57_image" class="upload_image_button" />
                                </div>
                            </div>
                            <div class="alignleft sam-section-detail">
                                <p><?php _e( 'Upload Apple iPhone Icon (57px x 57px)', 'sampression' );?></p>
                                <input type="checkbox" class="sam-checkbox samp-style appleicons" <?php if ( $apple_favicon['favicon_57']['donot_use_favicon'] == 'yes' ) echo ' checked="checked"'; ?> id="use-iphone" />

                                <label for="use-iphone" class="checkbox-label"><?php _e( 'Disable', 'sampression' );?></label>
                                <input type="hidden" class="sam-use-iphone" name="use-iphone" value="<?php echo $apple_favicon['favicon_57']['donot_use_favicon']; ?>" />
                            </div>
                        </li>
                        <li class="clearfix">
                            <figure class="image-holder alignleft image-preview">
                                <img src="<?php echo $apple_favicon['favicon_72']['image'] ? $apple_favicon['favicon_72']['image'] : SAM_FW_ADMIN_IMAGES_URL . '/favicon.jpg'; ?>" alt="<?php get_bloginfo( 'name' ); ?> apple favicon" id="favicon_72-image-preview" />
                            </figure>
                            <div class="backgroundimage-option alignleft">
                                <div class="image-title" id="website-image-title"><?php echo truncate_text( basename( $apple_favicon['favicon_72']['image'] ) ); ?> </div>
                                <div class="fileUpload button1 button2">
                                    <span><?php _e( 'Change', 'sampression' ); ?></span>
                                    <input type="hidden" id="favicon_image" class="upload_image" name="favicon_72_image" value="<?php echo $apple_favicon['favicon_72']['image']; ?>" />
                                    <input type="button" id="faviconimage" name="favicon_72_image" class="upload_image_button" />
                                </div>
                            </div>
                            <div class="alignleft sam-section-detail">
                                <p><?php _e( 'Upload Apple iPad Icon (72px x 72px)', 'sampression' );?></p>
                                <input type="checkbox" class="sam-checkbox samp-style appleicons" <?php if ( $apple_favicon['favicon_72']['donot_use_favicon'] == 'yes' ) echo ' checked="checked"'; ?> id="use-ipad" />

                                <label for="use-ipad" class="checkbox-label"><?php _e( 'Disable', 'sampression' );?></label>
                                <input type="hidden" class="sam-use-ipad" name="use-ipad" value="<?php echo $apple_favicon['favicon_72']['donot_use_favicon']; ?>" />
                            </div>
                        </li>
                        <li class="clearfix">
                            <figure class="image-holder alignleft image-preview">
                                <img src="<?php echo $apple_favicon['favicon_114']['image'] ? $apple_favicon['favicon_114']['image'] : SAM_FW_ADMIN_IMAGES_URL . '/favicon.jpg'; ?>" alt="<?php get_bloginfo( 'name' ); ?> apple favicon" id="favicon_114-image-preview" />
                            </figure>
                            <div class="backgroundimage-option alignleft">
                                <div class="image-title" id="website-image-title"><?php echo truncate_text( basename( $apple_favicon['favicon_114']['image'] ) ); ?></div>
                                <div class="fileUpload button1 button2">
                                    <span><?php _e( 'Change', 'sampression' ); ?></span>
                                    <input type="hidden" id="favicon_image" class="upload_image" name="favicon_114_image" value="<?php echo $apple_favicon['favicon_114']['image']; ?>" />
                                    <input type="button" id="faviconimage" name="favicon_114_image" class="upload_image_button" />
                                </div>
                            </div>
                            <div class="alignleft sam-section-detail">
                                <p><?php _e( 'Upload Apple iPhone Retina Icon (114px x 114px)', 'sampression' );?></p>
                                <input type="checkbox" class="sam-checkbox samp-style appleicons" <?php if ( $apple_favicon['favicon_114']['donot_use_favicon'] == 'yes' ) echo ' checked="checked"'; ?> id="use-iphoneretina" />

                                <label for="use-iphoneretina" class="checkbox-label"><?php _e( 'Disable', 'sampression' );?></label>
                                <input type="hidden" class="sam-use-iphoneretina" name="use-iphoneretina" value="<?php echo $apple_favicon['favicon_144']['donot_use_favicon']; ?>" />
                            </div>
                        </li>
                        <li class="clearfix sam-no-spacing sam-no-border">
                            <figure class="image-holder alignleft image-preview">
                                <img src="<?php echo $apple_favicon['favicon_144']['image'] ? $apple_favicon['favicon_144']['image'] : SAM_FW_ADMIN_IMAGES_URL . '/favicon.jpg'; ?>" alt="<?php get_bloginfo('name'); ?> apple favicon" id="favicon_144-image-preview" />
                            </figure>
                            <div class="backgroundimage-option alignleft">
                                <div class="image-title" id="website-image-title"><?php echo truncate_text( basename( $apple_favicon['favicon_144']['image'] ) ); ?></div>
                                <div class="fileUpload button1 button2">
                                    <span><?php _e( 'Change', 'sampression' ); ?></span>
                                    <input type="hidden" id="favicon_image" class="upload_image" name="favicon_144_image" value="<?php echo $apple_favicon['favicon_144']['image']; ?>" />
                                    <input type="button" id="faviconimage" name="favicon_144_image" class="upload_image_button" />
                                </div>
                            </div>
                            <div class="alignleft sam-section-detail">
                                <p><?php _e( 'Upload Apple iPad Retina Icon (144px x 144px)', 'sampression' );?></p>
                                <input type="checkbox" class="sam-checkbox samp-style appleicons" <?php if ( $apple_favicon['favicon_144']['donot_use_favicon'] == 'yes' ) echo ' checked="checked"'; ?> id="use-ipadretina" />

                                <label for="use-ipadretina" class="checkbox-label"><?php _e( 'Disable', 'sampression' );?></label>
                                <input type="hidden" class="sam-use-ipadretina" name="use-ipadretina" value="<?php echo $apple_favicon['favicon_144']['donot_use_favicon']; ?>" />
                            </div>
                        </li>
                    </ul>

                </div>
            </div>
        </section>
        <!-- .row-->
        <div id="response"></div>
        <a id="save" href="javascript:void(0);" class="button1 alignright save-data"><?php _e( 'Save', 'sampression' );?></a>
    </form>
</div>