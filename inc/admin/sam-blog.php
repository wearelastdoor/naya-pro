<?php
if ( ! defined( 'ABSPATH' ) ) exit( 'restricted access' );

$blog_settings = sampression_blog();
$post_meta = $blog_settings['post_meta'];
?>
<div id="content">
    <form id="sampression-metadata" onsubmit="javascript:return false;">
        <input type="hidden" name="meta_data" value="blog_page_settings" />
        <section class="row">
            <h3 class="sec-title"><?php _e( 'Blog Page Settings', 'sampression' );?></h3>
            <div class="box titled-box">
                <div  class="box-title">
                    <h4><?php _e( 'Post Meta Settings', 'sampression' );?></h4>
                </div>
                <div class="box-entry sam-lists sam-blogmeta-option">
                    <ul class=" clearfix">
                        <li class="row">
                            <label class="sec-label small"><?php _e( 'Show', 'sampression' );?></label>
                            <?php
                            $meta = $post_meta['meta'];
                            foreach ( $meta as $mkey => $mval ) {
                            ?>
                            <input type="checkbox" class="sam-checkbox" id="use-<?php echo $mkey; ?>"<?php if ( $mval == 'yes' ) echo ' checked="checked"'; ?> />
                            <label for="use-<?php echo $mkey; ?>" class="checkbox-label show-meta"><?php echo ucwords( $mkey ); ?></label>
                            <input type="hidden" name="show_<?php echo $mkey; ?>" id="show-use-<?php echo $mkey; ?>" value="<?php echo $mval; ?>" />
                            <?php
                            }
                            ?>
                        </li>
                        <li class="row">
                           <label class="sec-label small alignleft"><?php _e('Date Format', 'sampression');?></label>
                           <div class="select-wrapper large-select alignleft">
                               <select class="sam-select" name="date_format">
                                   <?php
                                   $date_format = $post_meta['date_time']['date_format'];
                                   for($i=0; $i<count($date_format); $i++) {
                                   ?>
                                   <option value="<?php echo $date_format[$i]; ?>"<?php if($post_meta['date_time']['date_active'] === $date_format[$i]) { echo 'selected="selected"'; } ?>><?php echo $date_format[$i] . ' - ' . date($date_format[$i]); ?></option>
                                   <?php
                                   }
                                   ?>
                                </select>
                           </div>
                        </li>
                        <li class="row">
                            <label class="sec-label small"><?php _e( 'Read more text', 'sampression' ) ?></label>
                            <input class="medium-input sanitize_text" name="read_more_text" type="text" value="<?php echo $post_meta['others']['more_text']; ?>" placeholder="Read More">
                        </li>
                    </ul>
                </div>
            </div>
        </section>
        <!-- .row-->
        <section class="row">
            <div class="box titled-box">
                <div  class="box-title">
                    <h4><?php _e( 'Hide blog from the following categories', 'sampression' );?></h4>
                    <?php
                    $blog_category = $blog_settings['blog_category'];
                    ?>
                </div>
                <div class="box-entry sam-lists sam-blogmeta-option exclude-cat-list">
                    <ul class=" clearfix">
                        <li class="clearfix">
                            <?php
                            $categories = get_categories( array( 'hide_empty' => 0 ) );
                            ?>
                            <div class="sam-margin10">
                                <input type="checkbox" class="sam-checkbox" id="show-all-categories"<?php if( count( $blog_category['cat_id']) === count( $categories ) ) { echo 'checked="checked"'; } ?> />
                                <label for="show-all-categories" class="checkbox-label"><?php _e( 'All', 'sampression' );?></label>
                            </div>
                            <?php
                            foreach ( $categories as $category ) {
                            ?>
                            <input type="checkbox" name="categories_ids[]" value="<?php echo $category->term_id; ?>" class="sam-checkbox show-categories" id="cat-<?php echo $category->slug; ?>"<?php if( in_array( $category->term_id, $blog_category['cat_id'] ) ) { echo 'checked="checked"'; } ?> />
                                <label for="cat-<?php echo $category->slug; ?>" class="checkbox-label"><?php echo $category->name; ?></label>
                            <?php
                            }
                            ?>
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