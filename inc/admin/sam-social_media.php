<?php
if ( ! defined( 'ABSPATH' ) ) exit( 'restricted access' );

$social_media = (object) sampression_social_media();

//sam_p($social_media);

// social media links
$sm_links = $social_media->links;
//sam_p($sm_links);
$available_social_media = $social_media->link_name;
?>
<div id="content">
    <form id="sampression-metadata" onsubmit="javascript:return false;">
        <input type="hidden" name="meta_data" value="social_media_settings" />
        <section class="row">
            <h3 class="sec-title"><?php _e( 'Social Media', 'sampression' ); ?></h3>
            <div class="box ">
                <div class="box-entry sam-lists sam-image-settings sam-social-option">

                    <ul class="social-media-list clearfix">
                        <?php
                        // check if any social media links saved
                        if ( $sm_links ) :
                            $cnt = 0;
                            foreach ( $sm_links as $sm_key => $sm_val ):
                                $cnt++;
                                //echo $sm_val['label'];
                            ?>
                                <li class="row<?php echo $cnt == count( $sm_links ) ? ' sam-no-border' : ''; ?> ">
                                    <label for="use-<?php echo $sm_key; ?>" class=""><i class="icon-<?php echo $sm_key; ?>"></i><?php echo $sm_val['url']; ?></label>
                                    <div class="button-wrapper alignright">
                                        <a data-social-media-slug="<?php echo $sm_key; ?>" data-social-media-url="<?php echo $sm_val['url']; ?>" data-social-media-label="<?php echo $sm_val['label']; ?>" class="button3 edit-social-media" href="javascript:;"><?php _e( 'EDIT', 'sampression' );?></a>
                                        <a class="button4 delete-social-media" href="javascript:;"><?php _e( 'DELETE', 'sampression' );?></a>
                                    </div>
                                    <input type="hidden" name="social_media_slug[]" value="<?php echo $sm_key; ?>" />
                                    <input type="hidden" name="social_media_url[]" value="<?php echo $sm_val['url']; ?>" />
                                    <input type="hidden" name="social_media_label[]" value="<?php echo $sm_val['label']; ?>" />
                                </li>
                            <?php
                            endforeach; endif;
                            ?>
                        <?php
                        if( $available_social_media ) :
                        ?>
                        <li class="clearfix add-social-option">
                            <div class="box-title"><?php _e( 'Add New', 'sampression' );?></div>
                            <div class="box-entry">
                                <ul class="custom-social-media-sizes">
                                    <li class="clearfix">
                                        <label class="sec-label large-label" id=""><?php _e( 'Social Media Name :', 'sampression' );?></label>
                                        <div class="select-wrapper alignleft large-select" id="social-media-select-wrapper">
                                            <select id="social_media_name" class="change-social-media">
                                                <?php foreach( $available_social_media as $key => $val ) :?>
                                                <option value="<?php echo $key;?>"><?php echo $val['label'];?></option>
                                                <?php endforeach;?>
                                            </select>
                                        </div>
                                    </li>
                                    <li class="clearfix sam-add-border">
                                        <label class="sec-label large-label"><?php _e( 'URL:', 'sampression' );?></label>
                                        <input class="medium-input" id="social_media_url" type="text" placeholder="<?php _e( 'Social media Url', 'sampression' );?>">
                                        <?php
                                        $cntr = 1;
                                        foreach ( $available_social_media as $key => $val ) :
                                            $hidden = $cntr == 1? "": "hidden" ;
                                            echo '<div class="example sam-info ' . $hidden . '" id="social_example_' . $key . '">' . $val['url'] . '</div>';
                                            $cntr ++;
                                        endforeach; ?>
                                    </li>
                                    <li class="clearfix ">
                                        <a href="javascript:;" class="button1 alignright small-button add-custom-social-media"><?php _e( 'Add', 'sampression' );?></a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <?php endif; ?>
                    </ul>

                </div>
            </div>
        </section>
        <!-- .row-->
        <div id="response"></div>
        <a id="save" href="javascript:void(0);" class="button1 alignright save-data"><?php _e( 'Save', 'sampression' );?></a>
    </form>
</div>
