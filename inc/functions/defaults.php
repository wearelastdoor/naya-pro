<?php

if (!defined('ABSPATH'))
    exit('restricted access');

/* ---------- Fonts Defaults ------------- */
/**
 * Fonts Defaults
 *
 * @return array
 */
function sampression_fonts_style() {
    $fonts = array(
        'fonts' => array(
            'google-fonts' => array(
                'Kreon' => 'Kreon',
                'Droid Serif' => 'Droid Serif'
            ),
            'normal-fonts' => array(
                'Arial' => 'Arial, sans-serif',
                'Verdana' => 'Verdana, Geneva, sans-serif',
                'Trebuchet' => 'Trebuchet MS, Tahoma, sans-serif',
                'Georgia' => 'Georgia, serif',
                'Times New Roman' => 'Times New Roman, serif',
                'Tahoma' => 'Tahoma, Geneva, Verdana, sans-serif',
                'Impact' => 'Impact, Charcoal, sans-serif',
                'Courier' => 'Courier, Courier New, monospace',
                'Century Gothic' => 'Century Gothic, sans-serif'
            )
        ),
        'size' => array(
            'min_value' => 8,
            'max_value' => 72
        ),
        'style' => array(
            'Thin' => '300',
            'Thin/Italic' => '300 italic',
            'Normal' => 'normal',
            'Italic' => 'italic',
            'Bold' => 'bold',
            'Bold/Italic' => 'bold italic'
        ),
        'transformation' => array(
            'Capitalize' => 'capitalize',
            'Uppercase' => 'uppercase',
            'Lowercase' => 'lowercase',
            'None' => 'none'
        )
    );
    return $fonts;
}

/**
 * Logos and Icons Defaults.
 * If $defaults is set to true, returns default logo-icon array
 * else fetch from table
 *
 * @param $defaults
 * @return array
 */
function sampression_logos_icons($defaults = false) {
    $logo_icon = array(
        'logo_icon' => array(
            'name' => array('use-title', 'use-logo'),
            'active' => array(
                'name' => 'use-title',
                'font' => 'Kreon',
                'size' => 40,
                'style' => 'bold',
                'color' => '#000000'
            ),
            'image' => SAM_FW_ADMIN_IMAGES_URL . '/logo-naya.png',
            'web_desc' => array(
                'use_desc' => 'yes',
                'font' => 'Kreon',
                'size' => 18,
                'style' => 'normal',
                'color' => '#000000'
            )
        ),
        'fav_icon' => array(
            'favicon_16' => array(
                'image' => SAM_FW_ADMIN_IMAGES_URL . '/16x16.png',
                'donot_use_favicon' => 'no'
            )
        ),
        'apple_icon' => array(
            'favicon_57' => array(
                'image' => SAM_FW_ADMIN_IMAGES_URL . '/apple-touch-icon-57x57.png',
                'donot_use_favicon' => 'no'
            ),
            'favicon_72' => array(
                'image' => SAM_FW_ADMIN_IMAGES_URL . '/apple-touch-icon-72x72.png',
                'donot_use_favicon' => 'no'
            ),
            'favicon_114' => array(
                'image' => SAM_FW_ADMIN_IMAGES_URL . '/apple-touch-icon-114x114.png',
                'donot_use_favicon' => 'no'
            ),
            'favicon_144' => array(
                'image' => SAM_FW_ADMIN_IMAGES_URL . '/apple-touch-icon-144x144.png',
                'donot_use_favicon' => 'no'
            ),
            'donot_use_apple_icon' => 'no'
        )
    );
    $logo_icon = serialize($logo_icon);
    if($defaults === true) {
        return unserialize($logo_icon);
    }
    return unserialize(get_option('sam-logos-icons-settings', $logo_icon));
}

/**
 * Styling Defaults
 * if $defaults is set to True, this function returns
 * default styling array else fetch from table
 *
 * @param boolean $defaults
 * @return  array
 */
function sampression_styling($defaults = false) {
    $styles = array(
        'theme_layout' => array(
            'name' => array('full-width', '960px', '1200px'),
            'active' => '960px'
        ),
        'sidebar' => array(
            'name' => array('left', 'right', 'none'),
            'active' => 'right'
        ),
        'background_color' => array(
            'none' => 'no',
            'active' => '#FFFFFF'
        ),
        'background_image' => array(
            'none' => 'yes',
            'image' => SAM_FW_ADMIN_IMAGES_URL . '/pattern.jpg',
            'repeat' => array('no-repeat', 'repeat', 'repeat-x', 'repeat-y'),
            'position' => array('top left', 'top center', 'top right', 'center left', 'center center', 'center right', 'bottom left', 'bottom center', 'bottom right'),
            'attachment' => array('scroll', 'fixed'),
            'active' => array(
                'repeat' => 'repeat',
                'position' => 'top right',
                'attachment' => 'fixed'
            )
        )
    );
    $styles = serialize($styles);
    if($defaults === true) {
        return unserialize($styles);
    }
    return unserialize(get_option('sam-style-settings', $styles));
}

/**
 * Typography Setting Defaults
 * If $defaults is set to TRUE, returns default Image setting array
 * else returns from table
 *
 * @param $defaults
 * @return array
 */
function sampression_typography($defaults = false) {
    $typo = array(
        'typography' => array(
            'general' => array(
                'h1' => array(
                    'active' => array(
                        'font' => 'Kreon',
                        'size' => 36,
                        'style' => 'normal',
                        'color' => '#000000'
                    )
                ),
                'h2' => array(
                    'active' => array(
                        'font' => 'Kreon',
                        'size' => 32,
                        'style' => 'normal',
                        'color' => '#000000'
                    )
                ),
                'h3' => array(
                    'active' => array(
                        'font' => 'Kreon',
                        'size' => 28,
                        'style' => 'normal',
                        'color' => '#000000'
                    )
                ),
                'h4' => array(
                    'active' => array(
                        'font' => 'Kreon',
                        'size' => 24,
                        'style' => 'normal',
                        'color' => '#000000'
                    )
                ),
                'h5' => array(
                    'active' => array(
                        'font' => 'Kreon',
                        'size' => 20,
                        'style' => 'normal',
                        'color' => '#000000'
                    )
                ),
                'h6' => array(
                    'active' => array(
                        'font' => 'Kreon',
                        'size' => 16,
                        'style' => 'normal',
                        'color' => '#000000'
                    )
                ),
                'p' => array(
                    'active' => array(
                        'font' => 'Droid Serif',
                        'size' => 18,
                        'style' => 'normal',
                        'color' => '#333333'
                    )
                ),
                'link' => array(
                    'active' => array(
                        'color' => array(
                            'normal' => '#57b94a',
                            'hover' => '#000000'
                        )
                    )
                )
            ),
            'navigation' => array(
                'text' => array(
                    'active' => array(
                        'font' => 'Droid Serif',
                        'size' => 14,
                        'style' => 'normal',
                        'transformation' => 'uppercase',
                        'color' => '#000000'
                    )
                ),
                'link' => array(
                    'active' => array(
                        'color' => array(
                            'hover' => '#57b94a'
                        )
                    )
                )
            ),
            'post_pages' => array(
                'title' => array(
                    'text' => array(
                        'active' => array(
                            'font' => 'Kreon',
                            'size' => 36,
                            'style' => 'normal',
                            'color' => '#000000'
                        )
                    ),
                    'link' => array(
                        'active' => array(
                            'color' => array(
                                'hover' => '#57b94a'
                            )
                        )
                    )
                ),
                'meta' => array(
                    'text' => array(
                        'active' => array(
                            'font' => 'Droid Serif',
                            'size' => 14,
                            'style' => 'italic',
                            'color' => '#666666'
                        )
                    ),
                    'link' => array(
                        'active' => array(
                            'color' => array(
                                'normal' => '#666666',
                                'hover' => '#333333'
                            )
                        )
                    )
                ),
                'more_link' => array(
                    'text' => array(
                        'active' => array(
                            'font' => 'Droid Serif',
                            'size' => 18,
                            'style' => 'normal',
                            'color' => array(
                                'normal' => '#57b94a',
                                'hover' => '#000000'
                            )
                        )
                    )
                )
            ),
            'widget' => array(
                'title' => array(
                    'active' => array(
                        'font' => 'Kreon',
                        'size' => 16,
                        'style' => 'normal',
                        'color' => '#000000'
                    )
                ),
                'text' => array(
                    'active' => array(
                        'font' => 'Droid Serif',
                        'size' => 14,
                        'style' => 'normal',
                        'color' => '#333333'
                    )
                ),
                'link' => array(
                    'active' => array(
                        'color' => array(
                            'normal' => '#333333',
                            'hover' => '#666666'
                        )
                    )
                )
            ),
            'footer' => array(
                'text' => array(
                    'active' => array(
                        'font' => 'Droid Serif',
                        'size' => 12,
                        'style' => 'normal',
                        'color' => '#333333'
                    )
                ),
                'link' => array(
                    'active' => array(
                        'color' => array(
                            'normal' => '#57b94a',
                            'hover' => '#000000'
                        )
                    )
                )
            )
        )
    );
    $typo = serialize($typo);
    if($defaults === true) {
        return unserialize($typo);
    }
    return unserialize(get_option('sam-typography-settings', $typo));
}

/**
 * Social Media Defaults
 * If $defaults is set to true, returns default social media setting array
 * else fetch from table
 *
 * @param $defaults
 * @return array
 */
function sampression_social_media($defaults = false) {
    $social_media = array(
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
            )
        ),
        'links' => array(
        ),
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
                'type' => 'icon_only',
                'color_n' => '#666666',
                'color_h' => '#57b94a'
            )
        )
    );

    $social_media_serialize = serialize($social_media);
    if($defaults === true) {
        return unserialize($social_media_serialize);
    }
    return unserialize(get_option('sam-social-media-settings', $social_media_serialize));
}

/**
 * Custom Css Defaults
 * If $defaults is set to true, returns default custom css setting array
 * else fetch from table
 *
 * @param $defaults
 * @return array
 */
function sampression_custom_css($defaults = false) {
    $custom_css = array(
        'css' => "/* Some example CSS */
    /* Any changes made will appear in live site */

    /*@import url(\"something.css\");
    body {
      margin: 0;
      padding: 3em 6em;
      font-family: tahoma, arial, sans-serif;
      color: #000;
    }

    #navigation a {
      font-weight: bold;
      text-decoration: none !important;
    }

    h1 {
      font-size: 2.5em;
    }

    h2 {
      font-size: 1.7em;
    }

    h1:before, h2:before {
      content: \"::\";
    }

    code {
      font-family: courier, monospace;
      font-size: 80%;
      color: #418A8A;
    }*/"
    );

    $custom_css_serialize = serialize($custom_css);
    if($defaults === true) {
        return unserialize($custom_css_serialize);
    }
    return unserialize(get_option('sam-custom-css-settings', $custom_css_serialize));
}

/**
 * Blog Setting Defaults
 * If $defaults is set to true, returns default blog setting array
 * else fetch from table
 * @param $defaults
 * @return array
 */
function sampression_blog($defaults = false) {
    $blog_page = array(
        'post_meta' => array(
            'meta' => array(
                'date' => 'yes',
                'time' => 'yes',
                'author' => 'yes',
                'categories' => 'yes',
                'tags' => 'yes',
                'icon' => 'yes'
            ),
            'date_time' => array(
                'date_format' => array('F j, Y', 'jS F, Y', 'Y/m/d', 'Y-m-d', 'm/d/Y', 'm-d-Y', 'd/m/Y', 'd-m-Y', 'd M, Y'),
                'date_active' => 'F j, Y'
            ),
            'others' => array(
                'more_text' => ''
            )
        ),
        'blog_category' => array(
            'cat_id' => array()
        ),
        'pagination' => array(
            'type' => array('default'),
            'default' => array(
                'active' => 'yes'
            )
        )
    );

    $blog_page_serialize = serialize($blog_page);
    if($defaults === true) {
        return unserialize($blog_page_serialize);
    }
    return unserialize(get_option('sam-blog-page-settings', $blog_page_serialize));
}

/**
 * Miscellaneous setting array
 * If $defaults is set to true, returns default miscellaneous setting array
 * else fetch from table
 *
 * @param $defaults
 * @return array
 */
function sampression_miscellaneous_setting($defaults = false) {
    $miscellaneous = array(
        'right_click_disable' => 'no',
        'responsive_off' => 'no',
        'show_adminbar_frontend' => 'no',
        'generate_custom_notification_frontend' => 'no',
        'notification_frontend' => '',
        'text_404' => '',
        'text_nothing_found' => '',
        'text_footer' => '',
        'robots' => array(
            'no_follow' => 'no',
            'no_index' => 'no',
            'no_ydir' => 'no',
            'no_archieve' => 'no',
            'no_odp' => 'no'
        ),
        'ga' => array(
            'ga_id' => ''
        )
    );
    $miscellaneous_serialize = serialize($miscellaneous);
    if($defaults === true) {
        return unserialize($miscellaneous_serialize);
    }
    return unserialize(get_option('sam-miscellaneous-settings', $miscellaneous_serialize));
}

/**
 * Hook setting defaults
 * If $defaults is set to true, returns default hook setting array
 * else fetch from table
 *
 * @param $defaults
 * @return  array
 */
function sampression_hooks_setting($defaults = false) {
    $hooks = array(
        'hook' => array(
            'sam_before_head_close' => array(
                'label' => 'Before HEAD Tag Close',
                'description' => 'Choosing this option will place the code before HEAD Tag close.',
                'code' => "do_action('sampression_before_head_close');<br>remove_action('sampression_before_head_close', 'sam_hook_before_head_close');",
                'execute' => 'no',
                'content' => ''
            ),
            'sam_after_body' => array(
                'label' => 'After BODY Tag',
                'description' => 'Choosing this option will place the code after BODY Tag.',
                'code' => "do_action('sampression_after_body');<br>remove_action('sampression_after_body', 'sam_hook_after_body');",
                'execute' => 'no',
                'content' => ''
            ),
            'sam_before_body_close' => array(
                'label' => 'Before BODY Tag Close',
                'description' => 'Choosing this option will place the code before BODY Tag close.',
                'code' => "do_action('sampression_before_body_close');<br>remove_action('sampression_before_body_close', 'sam_hook_before_body_close');",
                'execute' => 'no',
                'content' => ''
            ),
            'sam_before_footer' => array(
                'label' => 'Before FOOTER Tag',
                'description' => 'Choosing this option will place the code before FOOTER Tag.',
                'code' => "do_action('sampression_before_footer');<br>remove_action('sampression_before_footer', 'sam_hook_before_footer');",
                'execute' => 'no',
                'content' => ''
            )
        )
    );

    $hooks_serialize = serialize($hooks);
    if($defaults === true) {
        return unserialize($hooks_serialize);
    }
    return unserialize(get_option('sam-hooks-settings', $hooks_serialize));
}