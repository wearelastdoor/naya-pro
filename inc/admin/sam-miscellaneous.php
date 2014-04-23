<?php
if ( ! defined('ABSPATH')) exit('restricted access');

$miscellaneous = (object) sampression_miscellaneous_setting();

?>
<div id="content">
    <form id="sampression-metadata" onsubmit="javascript:return false;">
        <input type="hidden" name="meta_data" value="miscellaneous-settings" />
        <section class="row">
            <h3 class="sec-title"><?php _e('Miscellaneous', 'sampression');?></h3>
            <div class="box">
                <div class="sam-lists sam-misc-option">
                    <ul class=" clearfix">
                        <li class="row sam-no-border">
                            <input type="checkbox" class="sam-checkbox samp-style" id="use-disablrightclick" <?php echo $miscellaneous->right_click_disable == 'yes' ? 'checked="checked"': '';?> />
                            <label for="use-disablrightclick" class="checkbox-label" style="margin-right: 30px;"><?php _e('Disable Right Click', 'sampression');?></label>
                            <input type="hidden" class="sam-use-disablrightclick" id="sam-use-disablrightclick" name="sam-use-disablrightclick" value="<?php echo $miscellaneous->right_click_disable;?>"/>
                            <input type="checkbox" class="sam-checkbox samp-style" id="use-responsive" <?php echo $miscellaneous->responsive_off == 'yes' ? 'checked="checked"': '';?>/>
                            <label for="use-responsive" class="checkbox-label"  style="margin-right: 30px;"><?php _e('Responsive Off', 'sampression');?></label>
                            <input type="hidden" class="sam-use-responsive" id="sam-use-responsive" name="sam-use-responsive" value="<?php echo $miscellaneous->responsive_off;?>"/>
                            <input type="checkbox" class="sam-checkbox samp-style" id="use-adminbar" <?php echo $miscellaneous->show_adminbar_frontend == 'yes' ? 'checked="checked"': '';?> />
                            <label for="use-adminbar" class="checkbox-label samp-style"  style="margin-right: 5px;"><?php _e('Admin Bar Off on Frontend', 'sampression');?></label>
                            <input type="hidden" class="sam-use-adminbar" id="sam-use-adminbar" name="sam-use-adminbar" value="<?php echo $miscellaneous->show_adminbar_frontend;?>"/>
                            <a  href="javascript:;" class="sam-tooltip" title="<?php _e('Selecting this option will remove the Admin Bar in Frontend', 'sampression');?>">?</a>
                        </li>
                        <li class="clearfix sam-customnote-option">
                            <div class="box-title">
                                <input type="checkbox" class="sam-checkbox samp-style" id="use-customnote" <?php echo $miscellaneous->generate_custom_notification_frontend == 'yes' ? 'checked="checked"': '';?> />
                                <label for="use-customnote" class="checkbox-label"><?php _e('Generate custom notifications in frontend', 'sampression');?></label>
                                <input type="hidden" class="sam-use-customnote" id="sam-use-customnote" name="sam-use-customnote" value="<?php echo $miscellaneous->generate_custom_notification_frontend;?>"/>
                            </div>
                            <div class="box-entry">
                                <textarea name="sam-notification" class="full-input" placeholder="<?php _e('Type here', 'sampression');?>"><?php echo $miscellaneous->notification_frontend;?></textarea>
                                <p><?php _e('NOTE : This notification will appear at the top of your website.', 'sampression');?></p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </section>
        <!-- end of .row-->
        <section class="row">
            <div class="box titled-box">
                <div class="box-title">
                    <h4><?php _e('404 Text', 'sampression') ?></h4>
                </div>
                <div class="box-entry clearfix">
                     <textarea name="404_text" class="full-input" placeholder="Type here"><?php echo stripcslashes($miscellaneous->text_404); ?></textarea>
                </div>
            </div>
        </section>
        <!-- end of .row-->
        <section class="row">
            <div class="box titled-box">
                <div class="box-title">
                    <h4><?php _e('Nothing Found Text', 'sampression') ?></h4>
                </div>
                <div class="box-entry clearfix">
                     <textarea name="nothing_found_text" class="full-input" placeholder="Type here"><?php echo stripcslashes($miscellaneous->text_nothing_found); ?></textarea>
                </div>
            </div>
        </section>
        <!-- end of .row-->
        <section class="row">
            <div class="box titled-box">
                <div class="box-title">
                    <h4><?php _e('Footer Text', 'sampression') ?></h4>
                </div>
                <div class="box-entry clearfix">
                     <textarea name="footer_text" class="full-input" placeholder="Type here"><?php echo stripcslashes($miscellaneous->text_footer); ?></textarea>
                </div>
            </div>
        </section>
        <!-- end of .row-->
        <section class="row">
            <div class="box titled-box">
                <div class="box-title">
                    <h4><?php _e('Robots', 'sampression');?></h4>
                    <div class="right-cnt">
                        <input type="checkbox" class="sam-checkbox" id="show-robot-options">
                        <label for="show-robot-options" class="checkbox-label">Show Robot Options</label>
                    </div>
                </div>
                <?php $robots = $miscellaneous->robots;?>
                <div class="box-entry sam-lists sam-misc-option sam-misc-robots" style="display: none;">
                    <ul class="clearfix sam-robots-option">
                        <li>
                            <input type="checkbox" class="sam-checkbox samp-style" id="use-nofollow" <?php echo $robots['no_follow'] == 'yes' ? 'checked="checked"': '';?> />
                            <label for="use-nofollow" class="checkbox-label"><?php _e('No Follow', 'sampression');?></label>
                            <input type="hidden" class="sam-use-nofollow" id="sam-use-nofollow" name="sam-use-nofollow" value="<?php echo $robots['no_follow'];?>"/>
                        </li>
                        <li><input type="checkbox" class="sam-checkbox samp-style" id="use-noindex" <?php echo $robots['no_index'] == 'yes' ? 'checked="checked"': '';?> />
                            <label for="use-noindex" class="checkbox-label"><?php _e('No Index', 'sampression');?></label>
                            <input type="hidden" class="sam-use-noindex" id="sam-use-noindex" name="sam-use-noindex" value="<?php echo $robots['no_index'];?>"/>
                        </li>
                        <li>
                            <input type="checkbox" class="sam-checkbox samp-style" id="use-noydir" <?php echo $robots['no_ydir'] == 'yes' ? 'checked="checked"': '';?> />
                            <label for="use-noydir" class="checkbox-label"><?php _e('No YDIr (Yahoo Directory)', 'sampression');?></label>
                            <input type="hidden" class="sam-use-noydir" id="sam-use-noydir" name="sam-use-noydir" value="<?php echo $robots['no_ydir'];?>"/>
                        </li>
                        <li><input type="checkbox" class="sam-checkbox samp-style" id="use-archieve" <?php echo $robots['no_archieve'] == 'yes' ? 'checked="checked"': '';?> />
                            <label for="use-archieve" class="checkbox-label"><?php _e('No Archive', 'sampression');?></label>
                            <input type="hidden" class="sam-use-archieve" id="sam-use-archieve" name="sam-use-archieve" value="<?php echo $robots['no_archieve'];?>"/>
                        </li>
                        <li> <input type="checkbox" class="sam-checkbox samp-style" id="use-noodp" <?php echo $robots['no_odp'] == 'yes' ? 'checked="checked"': '';?> />
                            <label for="use-noodp" class="checkbox-label"><?php _e('No ODP (Open Directory Project)', 'sampression');?></label>
                            <input type="hidden" class="sam-use-noodp" id="sam-use-noodp" name="sam-use-noodp" value="<?php echo $robots['no_odp'];?>"/>
                        </li>
                    </ul>
                </div>
            </div>
        </section>
        <section class="row">
            <div class="box titled-box">
                <div class="box-title">
                    <h4><?php _e('Google Analytics', 'sampression');?></h4>
                </div>
                <?php
                $googleAnalytics = $miscellaneous->ga;
                ?>
                <div class="box-entry clearfix">
                            <ul>
                                <li class="clearfix sam-margin10 sam-no-border">
                                    <label class="sec-label large-label"><?php _e('Google Analytics Id :', 'sampression');?></label>
                                    <input type="text" placeholder="<?php _e('UA-000000-01','sampression');?>" value="<?php echo $googleAnalytics['ga_id'];?>" class="medium-input" id="sam-ga" name="sam-ga">
                                </li>
                            </ul>
                        </div>
            </div>
        </section>
        <!-- end of .row-->
        <div id="response"></div>
        <a href="javascript:void(0);" class="button1 alignright save-data"><?php _e('Save', 'sampression');?></a>
    </form>

</div>