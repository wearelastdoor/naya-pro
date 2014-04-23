<?php
if ( ! defined( 'ABSPATH' ) ) exit( 'restricted access' );

class Sampression_Admin {

    /**
     * construct
     */
    public function __construct() {
        add_action( 'admin_menu', array( $this, 'add_admin_menu' ), 5 );
        add_action( 'admin_print_scripts', array( $this, 'admin_scripts' ) );
        add_action( 'admin_print_styles', array( $this, 'admin_styles' ) );
        add_action( 'admin_head', array( $this, 'admin_ie_js_css' ) );
        add_action( 'wp_enqueue_scripts', array( $this, 'sampression_stylesheets_scripts' ) );
    }

    /**
     * desctruct
     */
    public function __destruct() {}

    /**
     * add admin menu
     */
    public function add_admin_menu() {
        add_theme_page( 'Sampression', 'Theme Options', 'edit_theme_options', 'sampression-options', array( $this, 'sampression_load_page' ) );
    }
    
    function sampression_load_page() {
        $pages = array( 'styling', 'typography', 'social-media', 'custom-css', 'blog', 'miscellaneous', 'hooks' );
        if( isset( $_GET['sam-page'] ) && in_array( $_GET['sam-page'], $pages ) ) {
            $page_slug = str_replace( '-', '_', $_GET['sam-page'] );
            $this->layout( $page_slug );
        } else {
            $this->layout( 'logos_icons' );
        }
    }

    /**
     * load layout
     * @param $page pagename
     */
    public function layout($page) {
        //sam_a($page);
        require_once SAM_FW_ADMIN_DIR . '/header.php';
        require_once SAM_FW_ADMIN_DIR . '/sidebar.php';
        require_once SAM_FW_ADMIN_DIR . '/sam-' . $page . '.php';
        require_once SAM_FW_ADMIN_DIR . '/footer.php';
    }

    /**
     * load admin scripts
     */
    public function sampression_stylesheets_scripts() {
        $this->sampression_enqueue_skeleton();

        wp_register_style( 'gfont-kreon', 'http://fonts.googleapis.com/css?family=Kreon:400,700' );
        wp_register_style( 'gfont-droid', 'http://fonts.googleapis.com/css?family=Droid+Serif:400,400italic' );
        wp_register_style( 'custom-css', SAM_FW_CSS_URL . '/custom-css.css' );


        wp_enqueue_style( 'gfont-kreon' );
        wp_enqueue_style( 'gfont-droid' );
        wp_enqueue_style( 'custom-css' );

        wp_register_script( 'plugins', SAM_FW_JS_URL . '/plugins.js', array('jquery'), '1.0', true );
        wp_register_script( 'main', SAM_FW_JS_URL . '/main.js', array('jquery', 'plugins'), '1.0', true );

        wp_enqueue_script( 'plugins' );
        wp_enqueue_script( 'main' );

    }

    /**
     * load css
     */
    public function sampression_enqueue_skeleton() {
        wp_register_style( 'fonts', SAM_FW_CSS_URL . '/fonts-sampression.css' );            
        wp_register_style( 'superfish', SAM_FW_CSS_URL . '/superfish.css' );
        wp_register_style( 'mediaquery', SAM_FW_CSS_URL . '/mediaquery.css' );
        wp_enqueue_style( 'fonts' );
        wp_enqueue_style( 'superfish' );
        wp_enqueue_style( 'mediaquery' );
    }

    /**
     * load admin scripts
     */
    public function admin_scripts() {
        wp_register_script( 'modernizr', SAM_FW_ADMIN_JS_URL . '/modernizr.js', array(), '2.6.2', false );
        wp_register_script( 'selectivizr', SAM_FW_ADMIN_JS_URL . '/selectivizr.js', array( 'jquery' ), '1.0.2', true );
        wp_register_script( 'SelectBox', SAM_FW_ADMIN_JS_URL . '/SelectBox.js', array( 'jquery' ), '1.0', true );
        wp_register_script( 'jScrollPane', SAM_FW_ADMIN_JS_URL . '/jScrollPane.js', array( 'jquery' ), '1.0', true );
        wp_register_script( 'jquerymousewheel', SAM_FW_ADMIN_JS_URL . '/jquery.mousewheel.js', array( 'jquery' ), '1.0', true );
        wp_register_script( 'codemirror', SAM_FW_ADMIN_JS_URL . '/codemirror.js', array(), '1.0', true);
        wp_register_script( 'csscodemirror', SAM_FW_ADMIN_JS_URL . '/csscodemirror.js', array(), '1.0', true);
        wp_register_script( 'admin-script', SAM_FW_ADMIN_JS_URL . '/admin-script.js', array( 'jquery', 'wp-color-picker','jquery-ui-tooltip' ), '1.0', true );//, 'thickbox', 'media-upload'
        wp_enqueue_media();
        wp_enqueue_script( 'jquery-ui-tooltip' );
        wp_enqueue_script( 'modernizr' );
        wp_enqueue_script( 'selectivizr' );
        wp_enqueue_script( 'SelectBox' );
        wp_enqueue_script( 'jScrollPane' );
        wp_enqueue_script( 'jquerymousewheel' );
        wp_enqueue_script( 'codemirror' );
        wp_enqueue_script( 'csscodemirror' );
        wp_enqueue_script( 'admin-script' );
    }

    /**
     * load admin styles
     */
    public function admin_styles() {
        wp_enqueue_style( 'wp-color-picker' );
        wp_enqueue_style( 'admin-style', SAM_FW_ADMIN_CSS_URL . '/admin-style.css', false, false, 'screen' );
        wp_enqueue_style( 'font-style', 'http://fonts.googleapis.com/css?family=Kreon', false, false, 'screen' );
    }

    /**
     * check for ie
     */
    public function admin_ie_js_css() {
        echo '<!--[if lt IE 8]><!-->
          <link rel="stylesheet" href="' . SAM_FW_ADMIN_CSS_URL . '/fontsie7.css' . '">
          <script type="text/javascript" src="' . SAM_FW_ADMIN_JS_URL . '/fontsie7.js' . '"></script>
          <!--<![endif]-->';
    }

    /**
     * Load logo and icon layout
     */
    public function logos_icons() {
        $this->layout( 'logos_icons' );
    }

    /**
     * Load styling layout
     */
    public function styling() {
        $this->layout( 'styling' );
    }

    /**
     * Load typography layout
     */
    public function typography() {
        $this->layout( 'typography' );
    }

    /**
     * Load social media layout
     */
    public function social_media() {
        $this->layout( 'social_media' );
    }

    /**
     * Load custom css layout
     */
    public function custom_css() {
        $this->layout( 'custom_css' );
    }

    /**
     * Load blog layout
     */
    public function blog() {
        $this->layout( 'blog' );
    }
    
    /**
     * Load miscellaneous layout
     */
    public function miscellaneous() {
        $this->layout('miscellaneous');
    }

    /**
     * Load hooks layout
     */
    public function hooks() {
        $this->layout( 'hooks' );
    }

}