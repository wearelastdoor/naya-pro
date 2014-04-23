<?php
if (!defined('ABSPATH'))
    exit('restricted access');


add_action('wp_ajax_save_style', 'save_style_callback');
add_action('wp_ajax_nopriv_save_style', 'save_style_callback');

/**
 * callback function to save data
 */
function save_style_callback() {
    parse_str($_POST['elements'], $elements);
    //sam_p($elements); die;
    $message = '';
    if (isset($elements['meta_data']) && $elements['meta_data'] == 'logos-icons') {
        $key = 'sam-logos-icons-settings';
        $data = array(
            'logo_icon' => array(
                'name' => array('use-title', 'use-logo'),
                'active' => array(
                    'name' => $elements['sam-logo'],
                    'font' => $elements['website_font_face'],
                    'size' => $elements['website_font_size'],
                    'style' => $elements['website_font_style'],
                    'color' => $elements['sam-site-color'],
                ),
                'image' => $elements['website_image'],
                'web_desc' => array(
                    'use_desc' => $elements['use_webdesc'],
                    'font' => $elements['webdesc_font_face'],
                    'size' => $elements['webdesc_font_size'],
                    'style' => $elements['webdesc_font_style'],
                    'color' => $elements['webdesc_font_color']
                )
            ),
            'fav_icon' => array(
                'favicon_16' => array(
                    'image' => $elements['favicon_image'],
                    'donot_use_favicon' => $elements['use-favicon']
                )
            ),
            'apple_icon' => array(
                'favicon_57' => array(
                    'image' => $elements['favicon_57_image'],
                    'donot_use_favicon' => $elements['use-iphone']
                ),
                'favicon_72' => array(
                    'image' => $elements['favicon_72_image'],
                    'donot_use_favicon' => $elements['use-ipad']
                ),
                'favicon_114' => array(
                    'image' => $elements['favicon_114_image'],
                    'donot_use_favicon' => $elements['use-iphoneretina']
                ),
                'favicon_144' => array(
                    'image' => $elements['favicon_144_image'],
                    'donot_use_favicon' => $elements['use-ipadretina']
                ),
                'donot_use_apple_icon' => $elements['no-touchicon']
            )
        );
    } elseif (isset($elements['meta_data']) && $elements['meta_data'] == 'styling') {
        $key = 'sam-style-settings';
        if (isset($_POST['preset'])) {
            $style_option = get_option('sam-style-settings');
            if ($style_option) {
                $data = sampression_styling();
                $data['presets']['active'] = $elements['presets'];
            } else {
                $data = sampression_styling(true);
                $data['presets']['active'] = 'my-settings';
            }
        } else {
            $data = array(
                'theme_layout' => array(
                    'name' => array('full-width', '960px', '1200px'),
                    'active' => $elements['layout']
                ),
                'sidebar' => array(
                    'name' => array('right', 'none'),
                    'active' => $elements['sidebar']
                ),
                'background_color' => array(
                    'none' => $elements['bgcolor_none'],
                    'active' => $elements['bg_color']
                ),
                'background_image' => array(
                    'none' => $elements['bgimage_none'],
                    'image' => $elements['bg_image'],
                    'repeat' => array('no-repeat', 'repeat', 'repeat-x', 'repeat-y'),
                    'position' => array('top left', 'top center', 'top right', 'center left', 'center center', 'center right', 'bottom left', 'bottom center', 'bottom right'),
                    'attachment' => array('scroll', 'fixed'),
                    'active' => array(
                        'repeat' => $elements['bg_img_repeat'],
                        'position' => $elements['bg_img_position'],
                        'attachment' => $elements['bg_img_attachment']
                    )
                )
            );
        }
    }  elseif (isset($elements['meta_data']) && $elements['meta_data'] == 'typography') {
        $key = 'sam-typography-settings';
        $style_option = sampression_styling();
        if($style_option['presets']['active'] === 'naya') {
            $style_option['presets']['active'] = 'my-settings';
            $serialize_style = serialize($style_option);
            if (get_option('sam-style-settings')) {
                update_option('sam-style-settings', $serialize_style);
            } else {
                add_option('sam-style-settings', $serialize_style, '', 'yes');
            }
        }
        $data = array(
            'typography' => array(
                'general' => array(
                    'h1' => array(
                        'active' => array(
                            'font' => $elements['h1_font_face'],
                            'size' => $elements['h1_font_size'],
                            'style' => $elements['h1_font_style'],
                            'color' => $elements['h1_font_color']
                        )
                    ),
                    'h2' => array(
                        'active' => array(
                            'font' => $elements['h2_font_face'],
                            'size' => $elements['h2_font_size'],
                            'style' => $elements['h2_font_style'],
                            'color' => $elements['h2_font_color']
                        )
                    ),
                    'h3' => array(
                        'active' => array(
                            'font' => $elements['h3_font_face'],
                            'size' => $elements['h3_font_size'],
                            'style' => $elements['h3_font_style'],
                            'color' => $elements['h3_font_color']
                        )
                    ),
                    'h4' => array(
                        'active' => array(
                            'font' => $elements['h4_font_face'],
                            'size' => $elements['h4_font_size'],
                            'style' => $elements['h4_font_style'],
                            'color' => $elements['h4_font_color']
                        )
                    ),
                    'h5' => array(
                        'active' => array(
                            'font' => $elements['h5_font_face'],
                            'size' => $elements['h5_font_size'],
                            'style' => $elements['h5_font_style'],
                            'color' => $elements['h5_font_color']
                        )
                    ),
                    'h6' => array(
                        'active' => array(
                            'font' => $elements['h6_font_face'],
                            'size' => $elements['h6_font_size'],
                            'style' => $elements['h6_font_style'],
                            'color' => $elements['h6_font_color']
                        )
                    ),
                    'p' => array(
                        'active' => array(
                            'font' => $elements['p_font_face'],
                            'size' => $elements['p_font_size'],
                            'style' => $elements['p_font_style'],
                            'color' => $elements['p_font_color']
                        )
                    ),
                    'link' => array(
                        'active' => array(
                            'color' => array(
                                'normal' => $elements['link_font_color_n'],
                                'hover' => $elements['link_font_color_h']
                            )
                        )
                    )
                ),
                'navigation' => array(
                    'text' => array(
                        'active' => array(
                            'font' => $elements['nav_font_face'],
                            'size' => $elements['nav_font_size'],
                            'style' => $elements['nav_font_style'],
                            'transformation' => $elements['nav_font_transformation'],
                            'color' => $elements['nav_font_color']
                        )
                    ),
                    'link' => array(
                        'active' => array(
                            'color' => array(
                                'hover' => $elements['nav_link_font_color_h']
                            )
                        )
                    )
                ),
                'post_pages' => array(
                    'title' => array(
                        'text' => array(
                            'active' => array(
                                'font' => $elements['pp_title_font_face'],
                                'size' => $elements['pp_title_font_size'],
                                'style' => $elements['pp_title_font_style'],
                                'color' => $elements['pp_title_font_color']
                            )
                        ),
                        'link' => array(
                            'active' => array(
                                'color' => array(
                                    'hover' => $elements['pp_title_link_color_h']
                                )
                            )
                        )
                    ),
                    'meta' => array(
                        'text' => array(
                            'active' => array(
                                'font' => $elements['pp_meta_font_face'],
                                'size' => $elements['pp_meta_font_size'],
                                'style' => $elements['pp_meta_font_style'],
                                'color' => $elements['pp_meta_font_color']
                            )
                        ),
                        'link' => array(
                            'active' => array(
                                'color' => array(
                                    'normal' => $elements['pp_meta_link_color_n'],
                                    'hover' => $elements['pp_meta_link_color_h']
                                )
                            )
                        )
                    ),
                    'more_link' => array(
                        'text' => array(
                            'active' => array(
                                'font' => $elements['pp_more_font_face'],
                                'size' => $elements['pp_more_font_size'],
                                'style' => $elements['pp_more_font_style'],
                                'color' => array(
                                    'normal' => $elements['pp_more_link_color_n'],
                                    'hover' => $elements['pp_more_link_color_h']
                                )
                            )
                        )
                    )
                ),
                'widget' => array(
                    'title' => array(
                        'active' => array(
                            'font' => $elements['wid_title_font_face'],
                            'size' => $elements['wid_title_font_size'],
                            'style' => $elements['wid_title_font_style'],
                            'color' => $elements['wid_title_font_color']
                        )
                    ),
                    'text' => array(
                        'active' => array(
                            'font' => $elements['wid_text_font_face'],
                            'size' => $elements['wid_text_font_size'],
                            'style' => $elements['wid_text_font_style'],
                            'color' => $elements['wid_text_font_color']
                        )
                    ),
                    'link' => array(
                        'active' => array(
                            'color' => array(
                                'normal' => $elements['wid_link_font_color_n'],
                                'hover' => $elements['wid_link_font_color_h']
                            )
                        )
                    )
                ),
                'footer' => array(
                    'text' => array(
                        'active' => array(
                            'font' => $elements['footer_text_font_face'],
                            'size' => $elements['footer_text_font_size'],
                            'style' => $elements['footer_text_font_style'],
                            'color' => $elements['footer_text_font_color']
                        )
                    ),
                    'link' => array(
                        'active' => array(
                            'color' => array(
                                'normal' => $elements['footer_text_link_color_n'],
                                'hover' => $elements['footer_text_link_color_h']
                            )
                        )
                    )
                )
            )
        );
    } elseif (isset($elements['meta_data']) && $elements['meta_data'] == 'social_media_settings') {
        $key = 'sam-social-media-settings';
        $social_media_data = array();
        if (isset($elements['social_media_slug'])) {
            for($i=0; $i < count($elements['social_media_slug']); $i++) {
                $social_media_data[$elements['social_media_slug'][$i]] = array(
                    'label' => $elements['social_media_label'][$i],
                    'url' => $elements['social_media_url'][$i]
                );
            }
        }
        $data = array(
            'link_name' => array(
                'facebook' => array(
                    'label' => 'Facebook',
                    'url' => 'http://www.facebook.com/sampressiontheme'
                ),
                'twitter' => array(
                    'label' => 'Twitter',
                    'url' => 'http://www.twitter.com/sampressiontheme'
                ),
                'youtube' => array(
                    'label' => 'Youtube',
                    'url' => 'http://www.youtube.com/sampressiontheme'
                ),
                'linkedin' => array(
                    'label' => 'LinkedIn',
                    'url' => 'http://www.linkedin.com/in/sampression'
            )),
            'links' => $social_media_data,
            'link_styling' => array(
                'type' => array('icon_only', 'icon_text', 'text_only'),
                'header' => array(
                    'active' => 'yes',
                    'type' => 'icon_only',
                    'color_n' => '#666666',
                    'color_h' => '#57b94a'
                ),
                'footer' => array(
                    'active' => 'no',
                    'type' => 'text_only',
                    'color_n' => '#666666',
                    'color_h' => '#57b94a'
                )
            )
        );
    } elseif (isset($elements['meta_data']) && $elements['meta_data'] == 'custom_css_settings') {
        $key = 'sam-custom-css-settings';
        $data = array(
            'css' => $elements['code']
        );
    } elseif (isset($elements['meta_data']) && $elements['meta_data'] == 'blog_page_settings') {
        $blog_settings = sampression_blog();
        $meta = $blog_settings['post_meta']['meta'];
        $key = 'sam-blog-page-settings';
        $show_meta = array();
        foreach ($meta as $mkey => $mval) {
            $show_meta[$mkey] = $elements['show_' . $mkey];
        }
        $data = array(
            'post_meta' => array(
                'meta' => $show_meta,
                'date_time' => array(
                    'date_format' => array('F j, Y', 'jS F, Y', 'Y/m/d', 'Y-m-d', 'm/d/Y', 'm-d-Y', 'd/m/Y', 'd-m-Y', 'd M, Y'),
                    'date_active' => $elements['date_format']
                ),
                'others' => array(
                    'more_text' => $elements['read_more_text']
                )
            ),
            'blog_category' => array(
                'cat_id' => isset($elements['categories_ids']) ? $elements['categories_ids'] : array()
            ),
            'pagination' => array(
                'type' => array('default'),
                'default' => array(
                    'active' => 'yes'
                )
            )
        );
        //sam_p($data); die;
    } elseif (isset($elements['meta_data']) && $elements['meta_data'] == 'miscellaneous-settings') {
        $key = 'sam-miscellaneous-settings';
        $data = array(
            'right_click_disable' => $elements['sam-use-disablrightclick'],
            'responsive_off' => $elements['sam-use-responsive'],
            'show_adminbar_frontend' => $elements['sam-use-adminbar'],
            'generate_custom_notification_frontend' => $elements['sam-use-customnote'],
            'notification_frontend' => $elements['sam-notification'],
            'text_404' => $elements['404_text'],
            'text_nothing_found' => $elements['nothing_found_text'],
            'text_footer' => $elements['footer_text'],
            'robots' => array(
                'no_follow' => $elements['sam-use-nofollow'],
                'no_index' => $elements['sam-use-noindex'],
                'no_ydir' => $elements['sam-use-noydir'],
                'no_archieve' => $elements['sam-use-archieve'],
                'no_odp' => $elements['sam-use-noodp']
            ),
            'ga' => array(
                'ga_id' => $elements['sam-ga']
                ));
    } elseif (isset($elements['meta_data']) && $elements['meta_data'] == 'hooks-settings') {
        $key = 'sam-hooks-settings';
        $hook_array = array();
        if ($elements['hook_name']) {
            foreach ($elements['hook_name'] as $hook) {
                $hook_array[$hook] = array(
                    'label' => $elements['sam-hook-label-' . $hook],
                    'description' => stripcslashes($elements['sam-hook_description-' . $hook]),
                    'code' => $elements['sam-hook_code-' . $hook],
                    'execute' => $elements['sam-use-excute-' . $hook],
                    'content' => stripcslashes($elements[$hook . '_content'])
                );
            }
        }
        $data = array(
            'hook' => $hook_array
        );
    }
    $serialize = serialize($data);
    if (get_option($key)) {
        update_option($key, $serialize);
    } else {
        add_option($key, $serialize, '', 'yes');
    }
    if (isset($elements['meta_data']) && $elements['meta_data'] == 'logos-icons') {
        sampression_write_custom_css();
    }
    if (isset($elements['meta_data']) && $elements['meta_data'] == 'typography') {
        sampression_write_custom_css();
    }
    if (isset($elements['meta_data']) && $elements['meta_data'] == 'custom_css_settings') {
        sampression_write_custom_css();
    }    
    if ($message !== '') {
        echo $message;
    }
    die();
}

function sampression_write_custom_css() {
    WP_Filesystem();
    global $wp_filesystem;    
    
    $file = SAM_FW_CSS_DIR . '/custom-css.css';
    $css = generate_custom_css();
    if($css === '') {
        return;
    }
    if (!is_writable($file)) {
        $str = '<p class="message info">' . $file . ' is not writeable.<br />Copy the generated css from the text area below and paste it in the file above.</p>';
        $str .= '<textarea id="custom-css-select" style="width: 100%; height: 150px;">' . $css . '</textarea><br /><br />';
        $str .= '<script>window.document.getElementById("custom-css-select").select();</script>';
        echo $str;
        return;
    }
    if ( ! $wp_filesystem->put_contents( $file, ' ', FS_CHMOD_FILE) ) {
        echo __('CSS could not be written at this time. Please try again later.', 'sampression');
    }
    
    if (file_exists($file)) {
        if ( ! $wp_filesystem->put_contents( $file, $css, FS_CHMOD_FILE) ) {
            echo __('CSS could not be written at this time. Please try again later.', 'sampression');
        }
    }
}

function generate_custom_css() {
    $css = '';
    if (get_option('sam-logos-icons-settings')) {
        $logo_icon_option = get_option('sam-logos-icons-settings');
        $logo_icon = (object) unserialize($logo_icon_option);
        if ($logo_icon->logo_icon['active']['name'] === 'use-title') {
            $css .= '.site-title .home-link { font: ' . $logo_icon->logo_icon['active']['style'] . ' ' . $logo_icon->logo_icon['active']['size'] . 'px ' . $logo_icon->logo_icon['active']['font'] . '; color: ' . $logo_icon->logo_icon['active']['color'] . '; }' . PHP_EOL;
            //$css .= '.site-title .home-link { color: ' . $logo_icon->logo_icon['active']['color'] . '; }' . PHP_EOL;
            if ($logo_icon->logo_icon['web_desc']['use_desc'] === 'yes') {
                $css .= '.site-description { font: ' . $logo_icon->logo_icon['web_desc']['style'] . ' ' . $logo_icon->logo_icon['web_desc']['size'] . 'px ' . $logo_icon->logo_icon['web_desc']['font'] . '; color: ' . $logo_icon->logo_icon['web_desc']['color'] . '; }' . PHP_EOL;
            }
        }
    }
    if(get_option('sam-typography-settings')) {
        $style_option = get_option('sam-typography-settings');
        $sampression_style = (object) unserialize($style_option);
        //sam_p($sampression_style);die;
        $css .= 'body { font: ' . $sampression_style->typography['general']['p']['active']['size'] . 'px ' . $sampression_style->typography['general']['p']['active']['font'] . '; }' . PHP_EOL;
        $css .= '.entry-title { font: ' . $sampression_style->typography['post_pages']['title']['text']['active']['size'] . 'px ' . $sampression_style->typography['post_pages']['title']['text']['active']['font'] . '; }' . PHP_EOL;
        $css .= '.entry-meta { font: ' . $sampression_style->typography['post_pages']['meta']['text']['active']['size'] . 'px ' . $sampression_style->typography['post_pages']['meta']['text']['active']['font'] . '; }' . PHP_EOL;
    }
    if(get_option('sam-custom-css-settings')) {
        $css_option = get_option('sam-custom-css-settings');
        $css_settings = (object) unserialize($css_option);
        $css .= $css_settings->css;
    }
    return $css;
}

add_action('wp_ajax_return_slug', 'return_slug_callback');
add_action('wp_ajax_nopriv_return_slug', 'return_slug_callback');

function return_slug_callback() {
    echo sanitize_title($_POST['value']);
    die;
}

add_action('wp_ajax_sanitize_text', 'sanitize_text_callback');
add_action('wp_ajax_nopriv_sanitize_text', 'sanitize_text_callback');

function sanitize_text_callback() {
    echo sanitize_text_field($_POST['value']);
    die;
}