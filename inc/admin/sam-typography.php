<?php
if (!defined('ABSPATH'))
    exit('restricted access');

$style = sampression_styling();
$typo = sampression_typography();
if ($style['presets']['active'] == 'naya') {
    $typo = sampression_typography(true);
}
$general = $typo['typography']['general'];
$nav = $typo['typography']['navigation'];
$pp = $typo['typography']['post_pages'];
$wid = $typo['typography']['widget'];
$foot = $typo['typography']['footer'];
//sam_p($style);
$default_fonts = sampression_fonts_style();
?>
<div id="content">
    <form id="sampression-metadata" onsubmit="javascript:return false;">
        <input type="hidden" name="meta_data" value="typography" />
        <section class="row">
            <div class="box titled-box">
                <div class="box-title">
                    <h4><?php _e('Typography', 'sampression') ?></h4>
                    <div class="select-wrapper">
                        <select class="sam-select" id="typo-selctor" autocomplete="off">
                            <?php
                            $t_options = array('general' => 'General', 'primary-nav' => 'Primary Nav', 'post-pages' => 'Post/Pages', 'widget' => 'Widget', 'footer' => 'Footer');
                            $counter = 0;
                            foreach($t_options as $tkey => $tval) {
                                $counter++;
                                $sel = '';
                                if($counter === 1) { $sel = ' selected="selected"'; }
                                echo '<option'.$sel.' value="'.$tkey.'">'.$tval.'</option>';
                            }                            
                            ?>
                        </select>
                    </div>
                </div>
                <div class="box-entry typo-general" id="typography-general">
                    <div class="section row">
                        <div class="sec-label"><?php _e('H1', 'sampression') ?></div>
                        <div class="entry">
                            <h1 id="heading1" class="font-demo" style="font: <?php echo $general['h1']['active']['style']; ?> <?php echo $general['h1']['active']['size']; ?>px <?php echo $general['h1']['active']['font']; ?>; color: <?php echo $general['h1']['active']['color']; ?>;<?php if($general['h1']['active']['color'] == '#ffffff') { echo ' background-color: #57B94A;'; } ?>"><?php _e('The quick brown fox jumps over the lazy dog.', 'sampression') ?></h1>
                            <div class="select-wrapper font-face large-select alignleft" >
                                <?php sampression_font_select('h1_font_face', 'sam-select change-fontface', $general['h1']['active']['font']) ?>
                            </div>
                            <div class="select-wrapper font-size alignleft">
                                <?php sampression_font_size_select('h1_font_size', 'sam-select change-fontsize', $general['h1']['active']['size']) ?>
                            </div>
                            <div class="select-wrapper font-style alignleft">
                                <?php sampression_font_style_select('h1_font_style', 'sam-select change-fontstyle', $general['h1']['active']['style']) ?>
                            </div>
                            <input type="text" name="h1_font_color" value="<?php echo $general['h1']['active']['color']; ?>" class="heading1-color wp-color-picker" data-default-color="#8C8C8C" />
                        </div>
                    </div>
                    <!--end of .section-->
                    <div class="section row">
                        <div class="sec-label"><?php _e('H2', 'sampression') ?></div>
                        <div class="entry">
                            <h2 id="heading2" class="font-demo" style="font: <?php echo $general['h2']['active']['style']; ?> <?php echo $general['h2']['active']['size']; ?>px <?php echo $general['h2']['active']['font']; ?>; color: <?php echo $general['h2']['active']['color']; ?>;<?php if($general['h2']['active']['color'] == '#ffffff') { echo ' background-color: #57B94A;'; } ?>"><?php _e('The quick brown fox jumps over the lazy dog.', 'sampression') ?></h2>
                            <div class="select-wrapper font-face large-select alignleft">
                                <?php sampression_font_select('h2_font_face', 'sam-select change-fontface', $general['h2']['active']['font']) ?>
                            </div>
                            <div class="select-wrapper font-size alignleft">
                                <?php sampression_font_size_select('h2_font_size', 'sam-select change-fontsize', $general['h2']['active']['size']) ?>
                            </div>
                            <div class="select-wrapper font-style alignleft">
                                <?php sampression_font_style_select('h2_font_style', 'sam-select change-fontstyle', $general['h2']['active']['style']) ?>
                            </div>
                            <input type="text" name="h2_font_color" value="<?php echo $general['h2']['active']['color']; ?>" class="heading2-color wp-color-picker" data-default-color="#FF9900" />
                        </div>
                    </div>
                    <!--end of .section-->
                    <div class="section row">
                        <div class="sec-label"><?php _e('H3', 'sampression') ?></div>
                        <div class="entry">
                            <h3 id="heading3" class="font-demo" style="font: <?php echo $general['h3']['active']['style']; ?> <?php echo $general['h3']['active']['size']; ?>px <?php echo $general['h3']['active']['font']; ?>; color: <?php echo $general['h3']['active']['color']; ?>;<?php if($general['h3']['active']['color'] == '#ffffff') { echo ' background-color: #57B94A;'; } ?>"><?php _e('The quick brown fox jumps over the lazy dog.', 'sampression') ?></h3>
                            <div class="select-wrapper font-face large-select alignleft" >
                                <?php sampression_font_select('h3_font_face', 'sam-select change-fontface', $general['h3']['active']['font']) ?>
                            </div>
                            <div class="select-wrapper font-size alignleft">
                                <?php sampression_font_size_select('h3_font_size', 'sam-select change-fontsize', $general['h3']['active']['size']) ?>
                            </div>
                            <div class="select-wrapper font-style alignleft">
                                <?php sampression_font_style_select('h3_font_style', 'sam-select change-fontstyle', $general['h3']['active']['style']) ?>
                            </div>
                            <input type="text" name="h3_font_color" value="<?php echo $general['h3']['active']['color']; ?>" class="heading3-color wp-color-picker" data-default-color="#8c0505" />
                        </div>
                    </div>
                    <!--end of .section-->
                    <div class="section row">
                        <div class="sec-label"><?php _e('H4', 'sampression') ?></div>
                        <div class="entry">
                            <h4 id="heading4" class="font-demo" style="font: <?php echo $general['h4']['active']['style']; ?> <?php echo $general['h4']['active']['size']; ?>px <?php echo $general['h4']['active']['font']; ?>; color: <?php echo $general['h4']['active']['color']; ?>;<?php if($general['h4']['active']['color'] == '#ffffff') { echo ' background-color: #57B94A;'; } ?>"><?php _e('The quick brown fox jumps over the lazy dog.', 'sampression') ?></h4>
                            <div class="select-wrapper font-face large-select alignleft" >
                                <?php sampression_font_select('h4_font_face', 'sam-select change-fontface', $general['h4']['active']['font']) ?>
                            </div>
                            <div class="select-wrapper font-size alignleft">
                                <?php sampression_font_size_select('h4_font_size', 'sam-select change-fontsize', $general['h4']['active']['size']) ?>
                            </div>
                            <div class="select-wrapper font-style alignleft">
                                <?php sampression_font_style_select('h4_font_style', 'sam-select change-fontstyle', $general['h4']['active']['style']) ?>
                            </div>
                            <input type="text" name="h4_font_color" value="<?php echo $general['h4']['active']['color']; ?>" class="heading4-color wp-color-picker" data-default-color="#8C8C8C" />
                        </div>
                    </div>
                    <!--end of .section-->
                    <div class="section row">
                        <div class="sec-label"><?php _e('H5', 'sampression') ?></div>
                        <div class="entry">
                            <h5 id="heading5" class="font-demo" style="font: <?php echo $general['h5']['active']['style']; ?> <?php echo $general['h5']['active']['size']; ?>px <?php echo $general['h5']['active']['font']; ?>; color: <?php echo $general['h5']['active']['color']; ?>;<?php if($general['h5']['active']['color'] == '#ffffff') { echo ' background-color: #57B94A;'; } ?>"><?php _e('The quick brown fox jumps over the lazy dog.', 'sampression') ?></h5>
                            <div class="select-wrapper font-face large-select alignleft" >
                                <?php sampression_font_select('h5_font_face', 'sam-select change-fontface', $general['h5']['active']['font']) ?>
                            </div>
                            <div class="select-wrapper font-size alignleft">
                                <?php sampression_font_size_select('h5_font_size', 'sam-select change-fontsize', $general['h5']['active']['size']) ?>
                            </div>
                            <div class="select-wrapper font-style alignleft">
                                <?php sampression_font_style_select('h5_font_style', 'sam-select change-fontstyle', $general['h5']['active']['style']) ?>
                            </div>
                            <input type="text" name="h5_font_color" value="<?php echo $general['h5']['active']['color']; ?>" class="heading5-color wp-color-picker" data-default-color="#8C8C8C" />
                        </div>
                    </div>
                    <!--end of .section-->
                    <div class="section row">
                        <div class="sec-label"><?php _e('H6', 'sampression') ?></div>
                        <div class="entry">
                            <h6 id="heading6" class="font-demo" style="font: <?php echo $general['h6']['active']['style']; ?> <?php echo $general['h6']['active']['size']; ?>px <?php echo $general['h6']['active']['font']; ?>; color: <?php echo $general['h6']['active']['color']; ?>;<?php if($general['h6']['active']['color'] == '#ffffff') { echo ' background-color: #57B94A;'; } ?>"><?php _e('The quick brown fox jumps over the lazy dog.', 'sampression') ?></h6>
                            <div class="select-wrapper font-face large-select alignleft" >
                                <?php sampression_font_select('h6_font_face', 'sam-select change-fontface', $general['h6']['active']['font']) ?>
                            </div>
                            <div class="select-wrapper font-size alignleft">
                                <?php sampression_font_size_select('h6_font_size', 'sam-select change-fontsize', $general['h6']['active']['size']) ?>
                            </div>
                            <div class="select-wrapper font-style alignleft">
                                <?php sampression_font_style_select('h6_font_style', 'sam-select change-fontstyle', $general['h6']['active']['style']) ?>
                            </div>
                            <input type="text" name="h6_font_color" value="<?php echo $general['h6']['active']['color']; ?>" class="heading6-color wp-color-picker" data-default-color="#8C8C8C" />
                        </div>
                    </div>
                    <!--end of .section-->
                    <div class="section row">
                        <div class="sec-label"><?php _e('Body Text', 'sampression') ?></div>
                        <div class="entry">
                            <p id="paragraphtext" class="font-demo" style="font: <?php echo $general['p']['active']['style']; ?> <?php echo $general['p']['active']['size']; ?>px <?php echo $general['p']['active']['font']; ?>; color: <?php echo $general['p']['active']['color']; ?>;<?php if($general['p']['active']['color'] == '#ffffff') { echo ' background-color: #57B94A;'; } ?>"><?php _e('The quick brown fox jumps over the lazy dog.', 'sampression') ?></p>
                            <div class="select-wrapper font-face large-select alignleft" >
                                <?php sampression_font_select('p_font_face', 'sam-select change-fontface', $general['p']['active']['font']) ?>
                            </div>
                            <div class="select-wrapper font-size alignleft">
                                <?php sampression_font_size_select('p_font_size', 'sam-select change-fontsize', $general['p']['active']['size']) ?>
                            </div>
                            <div class="select-wrapper font-style alignleft">
                                <?php sampression_font_style_select('p_font_style', 'sam-select change-fontstyle', $general['p']['active']['style']) ?>
                            </div>
                            <input type="text" name="p_font_color" value="<?php echo $general['p']['active']['color']; ?>" class="paragraphtext-color wp-color-picker" data-default-color="#8C8C8C" />
                        </div>
                    </div>
                    <!--end of .section-->
                    <div class="section row sam-no-border sam-no-spacing">
                        <div class="sec-label"><?php _e('Link', 'sampression') ?></div>
                        <div class="entry">
                            <ul class="link-style">
                                <li class="clearfix">
                                    <span class="label"><?php _e('Normal', 'sampression') ?></span>
                                    <input type="text" name="link_font_color_n" value="<?php echo $general['link']['active']['color']['normal']; ?>" class="link-normal-color wp-color-picker" data-default-color="#8C8C8C" />
                                    <span class="link-normal-text alignright link" style="color:<?php echo $general['link']['active']['color']['normal'] ?>;"><?php _e('Link Preview', 'sampression') ?></span>
                                </li>
                                <li class="clearfix">
                                    <span class="label"><?php _e('Hover', 'sampression') ?></span>
                                    <input type="text" name="link_font_color_h" value="<?php echo $general['link']['active']['color']['hover']; ?>" class="link-hover-color wp-color-picker" data-default-color="#FF9900" />
                                    <span class="link-hover-text alignright link" style="color:<?php echo $general['link']['active']['color']['hover'] ?>;"><?php _e('Link Preview', 'sampression') ?></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!--end of .section-->
                </div>
                <div id="typography-primary-nav" class="box-entry hide typo-primary-nav">
                    <div class="section row">
                        <div class="sec-label"><?php _e('Navigation', 'sampression') ?></div>
                        <div class="entry">
                            <p id="navigation-text" class="font-demo" style="font: <?php echo $nav['text']['active']['style']; ?> <?php echo $nav['text']['active']['size']; ?>px <?php echo $nav['text']['active']['font']; ?>; text-transform: <?php echo $nav['text']['active']['transformation'] ?>; color: <?php echo $nav['text']['active']['color']; ?>;"><?php _e('The quick brown fox jumps over the lazy dog.', 'sampression') ?></p>
                            <div class="select-wrapper font-face medium-select alignleft" >
                                <?php sampression_font_select('nav_font_face', 'sam-select change-fontface-navi nav-typo', $nav['text']['active']['font']) ?>
                            </div>
                            <div class="select-wrapper font-size small-select alignleft">
                                <?php sampression_font_size_select('nav_font_size', 'sam-select change-fontsize-navi', $nav['text']['active']['size']) ?>
                            </div>
                            <div class="select-wrapper font-style small-select alignleft">
                                <?php sampression_font_style_select('nav_font_style', 'sam-select change-fontstyle-navi', $nav['text']['active']['style']) ?>
                            </div>
                            <div class="select-wrapper font-transformation small-select alignleft" style="margin-right: 0;">
                                <?php sampression_font_transformation_select('nav_font_transformation', 'sam-select change-transformation', $nav['text']['active']['transformation']) ?>
                            </div>
                            <input type="text" name="nav_font_color" value="<?php echo $nav['text']['active']['color']; ?>" class="nav-font-color wp-color-picker" data-default-color="#8C8C8C" />
                        </div>
                    </div>
                    <!--end of .section-->
                    <div class="section row  sam-no-border sam-no-spacing">
                        <div class="sec-label"><?php _e('Link', 'sampression') ?></div>
                        <div class="entry">
                            <ul class="link-style">
                                <li class="clearfix">
                                    <span class="label"><?php _e('Hover', 'sampression') ?></span>
                                    <input type="text" name="nav_link_font_color_h" value="<?php echo $nav['link']['active']['color']['hover']; ?>" class="nav-font-color-hover wp-color-picker" data-default-color="#8C8C8C" />
                                    <span class="nav-link-font-color-hover alignright link" style="color:<?php echo $nav['link']['active']['color']['hover'] ?>;"><?php _e('Link Preview', 'sampression') ?></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!--end of .section-->
                </div>
                <div id="typography-post-pages" class="box-entry hide typo-post-pages">
                    <section class="row">
                        <div class="box titled-box ">
                            <div class="box-title">
                                <h4><?php _e('Post/Page Title', 'sampression') ?></h4>
                            </div>
                            <div class="box-entry">
                                <div class="section row">
                                    <div class="sec-label"><?php _e('Title', 'sampression') ?></div>
                                    <div class="entry">
                                        <h1 id="sam-post-title" class="font-demo" style="font: <?php echo $pp['title']['text']['active']['style']; ?> <?php echo $pp['title']['text']['active']['size']; ?>px <?php echo $pp['title']['text']['active']['font']; ?>; color: <?php echo $pp['title']['text']['active']['color']; ?>;"><?php _e('The quick brown fox jumps over the lazy dog.', 'sampression') ?></h1>
                                        <div class="select-wrapper font-face large-select alignleft" >
                                            <?php sampression_font_select('pp_title_font_face', 'sam-select change-fontface', $pp['title']['text']['active']['font']) ?>
                                        </div>
                                        <div class="select-wrapper font-size small-select alignleft">
                                            <?php sampression_font_size_select('pp_title_font_size', 'sam-select change-fontsize', $pp['title']['text']['active']['size']) ?>
                                        </div>
                                        <div class="select-wrapper font-style small-select alignleft" style="margin-right: 0;">
                                            <?php sampression_font_style_select('pp_title_font_style', 'sam-select change-fontstyle', $pp['title']['text']['active']['style']) ?>
                                        </div>
                                        <input type="text" name="pp_title_font_color" value="<?php echo $pp['title']['text']['active']['color']; ?>" class="meta-title-color wp-color-picker" data-default-color="#8C8C8C" />
                                    </div>
                                </div>
                                <!--end of .section-->
                                <div class="section row  sam-no-border sam-no-spacing">
                                    <div class="sec-label"><?php _e('Link', 'sampression') ?></div>
                                    <div class="entry">
                                        <ul class="link-style">
                                            <li class="clearfix">
                                                <span class="label"><?php _e('Hover', 'sampression') ?></span>
                                                <input type="text" name="pp_title_link_color_h" value="<?php echo $pp['title']['link']['active']['color']['hover']; ?>" class="meta-title-hover-color wp-color-picker" data-default-color="#8C8C8C" />
                                                <span class="pp-title-link-color-hover alignright link" style="color:<?php echo $pp['title']['link']['active']['color']['hover'] ?>;"><?php _e('Link Preview', 'sampression') ?></span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <!--end of .section-->
                            </div>
                            </div>
                    </section>
                    <section class="row">
                        <div class="box titled-box ">
                            <div class="box-title">
                                <h4><?php _e('Meta Text', 'sampression') ?></h4>
                            </div>
                            <div class="box-entry">
                                <div class="section row">
                                    <div class="sec-label"><?php _e('Text', 'sampression') ?></div>
                                    <div class="entry">
                                        <div id="sam-meta-text" class="font-demo" style="font: <?php echo $pp['meta']['text']['active']['style']; ?> <?php echo $pp['meta']['text']['active']['size']; ?>px <?php echo $pp['meta']['text']['active']['font']; ?>; color: <?php echo $pp['meta']['text']['active']['color']; ?>;"><?php _e('The quick brown fox jumps over the lazy dog.', 'sampression') ?></div>
                                        <div class="select-wrapper font-face large-select alignleft" >
                                            <?php sampression_font_select('pp_meta_font_face', 'sam-select change-fontface', $pp['meta']['text']['active']['font']) ?>
                                        </div>
                                        <div class="select-wrapper font-size small-select alignleft">
                                            <?php sampression_font_size_select('pp_meta_font_size', 'sam-select change-fontsize', $pp['meta']['text']['active']['size']) ?>
                                        </div>
                                        <div class="select-wrapper font-style small-select alignleft" style="margin-right: 0;">
                                            <?php sampression_font_style_select('pp_meta_font_style', 'sam-select change-fontstyle', $pp['meta']['text']['active']['style']) ?>
                                        </div>
                                        <input type="text" name="pp_meta_font_color" value="<?php echo $pp['meta']['text']['active']['color']; ?>" class="metatext-color wp-color-picker" data-default-color="#8C8C8C" />
                                    </div>
                                </div>
                                <!--end of .section-->
                                <div class="section row  sam-no-border sam-no-spacing">
                                    <div class="sec-label"><?php _e('Link', 'sampression') ?></div>
                                    <div class="entry">
                                        <ul class="link-style">
                                            <li class="clearfix">
                                                <span class="label"><?php _e('Normal', 'sampression') ?></span>
                                                <input type="text" name="pp_meta_link_color_n" value="<?php echo $pp['meta']['link']['active']['color']['normal']; ?>" class="metatext-normal-color wp-color-picker" data-default-color="#8C8C8C" />
                                                <span class="pp-meta-link-color-normal alignright link" style="color:<?php echo $pp['meta']['link']['active']['color']['normal'] ?>;"><?php _e('Link Preview', 'sampression') ?></span>
                                            </li>
                                            <li  class="clearfix">
                                                <span class="label"><?php _e('Hover', 'sampression') ?></span>
                                                <input type="text" name="pp_meta_link_color_h" value="<?php echo $pp['meta']['link']['active']['color']['hover']; ?>" class="metatext-hover-color wp-color-picker" data-default-color="#57b94a" />
                                                <span class="pp-meta-link-color-hover alignright link" style="color:<?php echo $pp['meta']['link']['active']['color']['hover'] ?>;"><?php _e('Link Preview', 'sampression') ?></span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <!--end of .section-->
                            </div>
                        </div>
                    </section>
                    <section class="row">
                        <div class="box titled-box ">
                            <div class="box-title">
                                <h4><?php _e('Read more link', 'sampression') ?></h4>
                            </div>
                            <div class="box-entry">
                                <div class="section clearfix sam-no-border sam-no-spacing">
                                    <div class="sec-label"><?php _e('Link', 'sampression') ?></div>
                                    <div class="entry">
                                        <div id="sam-readmore-text" class="font-demo" style="font: <?php echo $pp['more_link']['text']['active']['style']; ?> <?php echo $pp['more_link']['text']['active']['size']; ?>px <?php echo $pp['more_link']['text']['active']['font']; ?>; color: <?php echo $pp['more_link']['text']['active']['color']['normal']; ?>;"><?php _e('The quick brown fox jumps over the lazy dog.', 'sampression') ?></div>
                                        <div class="select-wrapper font-face large-select alignleft" >
                                            <?php sampression_font_select('pp_more_font_face', 'sam-select change-fontface', $pp['more_link']['text']['active']['font']) ?>
                                        </div>
                                        <div class="select-wrapper font-size small-select alignleft">
                                            <?php sampression_font_size_select('pp_more_font_size', 'sam-select change-fontsize', $pp['more_link']['text']['active']['size']) ?>
                                        </div>
                                        <div class="select-wrapper font-style small-select alignleft" style="margin-right: 0;">
                                            <?php sampression_font_style_select('pp_more_font_style', 'sam-select change-fontstyle', $pp['more_link']['text']['active']['style']) ?>
                                        </div>
                                        <input type="text" name="pp_more_link_color_n" value="<?php echo $pp['more_link']['text']['active']['color']['normal']; ?>" class="readmore-normal-color wp-color-picker" data-default-color="#8C8C8C" />
                                        <ul class="link-style">
                                            <li  class="clearfix">
                                                <span class="label">Hover</span>
                                                <input type="text" name="pp_more_link_color_h" value="<?php echo $pp['more_link']['text']['active']['color']['hover']; ?>" class="readmore-hover-color wp-color-picker" data-default-color="#57b94a" />
                                                <span class="pp-more-link-color-hover alignright link" style="color:<?php echo $pp['more_link']['text']['active']['color']['hover'] ?>;"><?php _e('Link Preview', 'sampression') ?></span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <!--end of .section-->
                            </div>
                            </div>
                    </section>
                </div>
                <div id="typography-widget" class="box-entry hide typo-widget">
                    <div class="section row">
                        <div class="sec-label"><?php _e('Title', 'sampression') ?></div>
                        <div class="entry">
                            <p id="widget-title" class="font-demo" style="font: <?php echo $wid['title']['active']['style']; ?> <?php echo $wid['title']['active']['size']; ?>px <?php echo $wid['title']['active']['font']; ?>; color: <?php echo $wid['title']['active']['color']; ?>;"><?php _e('The quick brown fox jumps over the lazy dog.', 'sampression') ?></p>
                            <div class="select-wrapper font-face large-select alignleft" >
                                <?php sampression_font_select('wid_title_font_face', 'sam-select change-fontface', $wid['title']['active']['font']) ?>
                            </div>
                            <div class="select-wrapper font-size alignleft">
                                <?php sampression_font_size_select('wid_title_font_size', 'sam-select change-fontsize', $wid['title']['active']['size']) ?>
                            </div>
                            <div class="select-wrapper font-style alignleft">
                                <?php sampression_font_style_select('wid_title_font_style', 'sam-select change-fontstyle', $wid['title']['active']['style']) ?>
                            </div>                            
                            <input type="text" name="wid_title_font_color" value="<?php echo $wid['title']['active']['color']; ?>" class="widget-title-color wp-color-picker" data-default-color="#8C8C8C" />
                        </div>
                    </div>
                    <!--end of .section-->
                    <div class="section row">
                        <div class="sec-label"><?php _e('Text', 'sampression') ?></div>
                        <div class="entry">
                            <p id="widget-text" class="font-demo" style="font: <?php echo $wid['text']['active']['style']; ?> <?php echo $wid['text']['active']['size']; ?>px <?php echo $wid['text']['active']['font']; ?>; color: <?php echo $wid['text']['active']['color']; ?>;"><?php _e('The quick brown fox jumps over the lazy dog.', 'sampression') ?></p>
                            <div class="select-wrapper font-face large-select alignleft" >
                                <?php sampression_font_select('wid_text_font_face', 'sam-select change-fontface', $wid['text']['active']['font']) ?>
                            </div>
                            <div class="select-wrapper font-size alignleft">
                                <?php sampression_font_size_select('wid_text_font_size', 'sam-select change-fontsize', $wid['text']['active']['size']) ?>
                            </div>
                            <div class="select-wrapper font-style alignleft">
                                <?php sampression_font_style_select('wid_text_font_style', 'sam-select change-fontstyle', $wid['text']['active']['style']) ?>
                            </div>                            
                            <input type="text" name="wid_text_font_color" value="<?php echo $wid['text']['active']['color']; ?>" class="widget-text-color wp-color-picker" data-default-color="#8C8C8C" />
                        </div>
                    </div>
                    <!--end of .section-->
                    <div class="section row sam-no-border sam-no-spacing">
                        <div class="sec-label"><?php _e('Link', 'sampression') ?></div>
                        <div class="entry">
                            <ul class="link-style">
                                <li class="clearfix">
                                     <span class="label"><?php _e('Normal', 'sampression') ?></span>
                                     <input type="text" name="wid_link_font_color_n" value="<?php echo $wid['link']['active']['color']['normal']; ?>" class="widgetlink-normal-color wp-color-picker" data-default-color="#8C8C8C" />
                                     <span class="wid-link-font-color-normal alignright link" style="color:<?php echo $wid['link']['active']['color']['normal'] ?>;"><?php _e('Link Preview', 'sampression') ?></span>
                                </li>
                                <li class="clearfix">
                                    <span class="label"><?php _e('Hover', 'sampression') ?></span>
                                    <input type="text" name="wid_link_font_color_h" value="<?php echo $wid['link']['active']['color']['hover']; ?>" class="widgetlink-hover-color wp-color-picker" data-default-color="#57b94a" />
                                    <span class="wid-link-font-color-hover alignright link" style="color:<?php echo $wid['link']['active']['color']['hover'] ?>;"><?php _e('Link Preview', 'sampression') ?></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!--end of .section-->
                </div>
                <div id="typography-footer" class="box-entry hide typo-footer">
                    <div class="section row">
                        <div class="sec-label"><?php _e('Text', 'sampression') ?></div>
                        <div class="entry">
                            <p id="footer-text" class="font-demo" style="font: <?php echo $foot['text']['active']['style']; ?> <?php echo $foot['text']['active']['size']; ?>px <?php echo $foot['text']['active']['font']; ?>; color: <?php echo $foot['text']['active']['color']; ?>;"><?php _e('The quick brown fox jumps over the lazy dog.', 'sampression') ?></p>
                            <div class="select-wrapper font-face large-select alignleft" >
                                <?php sampression_font_select('footer_text_font_face', 'sam-select change-fontface', $foot['text']['active']['font']) ?>
                            </div>
                            <div class="select-wrapper font-size alignleft">
                                <?php sampression_font_size_select('footer_text_font_size', 'sam-select change-fontsize', $foot['text']['active']['size']) ?>
                            </div>
                            <div class="select-wrapper font-style alignleft">
                                <?php sampression_font_style_select('footer_text_font_style', 'sam-select change-fontstyle', $foot['text']['active']['style']) ?>
                            </div>                            
                            <input type="text" name="footer_text_font_color" value="<?php echo $foot['text']['active']['color']; ?>" class="footertext-color wp-color-picker" data-default-color="#8C8C8C" />
                        </div>
                    </div>
                    <!--end of .section-->
                    <div class="section row sam-no-border sam-no-spacing">
                        <div class="sec-label"><?php _e('Link', 'sampression') ?></div>
                        <div class="entry">
                            <ul class="link-style">
                                <li class="clearfix">
                                     <span class="label"><?php _e('Normal', 'sampression') ?></span>
                                    <input type="text" name="footer_text_link_color_n" value="<?php echo $foot['link']['active']['color']['normal']; ?>" class="footertext-normal-color wp-color-picker" data-default-color="#8C8C8C" />
                                    <span class="footer-text-link-color-normal alignright link" style="color:<?php echo $foot['link']['active']['color']['normal'] ?>;"><?php _e('Link Preview', 'sampression') ?></span>
                                </li>
                                <li class="clearfix">
                                    <span class="label"><?php _e('Hover', 'sampression') ?></span>
                                    <input type="text" name="footer_text_link_color_h" value="<?php echo $foot['link']['active']['color']['hover']; ?>" class="footertext-hover-color wp-color-picker" data-default-color="#57b94a" />
                                    <span class="footer-text-link-color-hover alignright link" style="color:<?php echo $foot['link']['active']['color']['hover'] ?>;"><?php _e('Link Preview', 'sampression') ?></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!--end of .section--></div>
            </div>
        </section><a name="response"></a>
        <div id="response"></div>
        <a href="javascript:void(0);" class="button1 alignright save-data"><?php _e('Save', 'sampression') ?></a>
    </form>
</div>