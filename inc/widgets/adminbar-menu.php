<?php
if ( ! defined('ABSPATH')) exit('restricted access');

class SampressionAdminbarMenu {

  function SampressionAdminbarMenu()
  {
      add_action( 'admin_bar_menu', array( $this, "sampression_links" ), 66 );
  }

  function add_root_menu($name, $id, $href = FALSE)
  {
    global $wp_admin_bar;
    if ( !is_super_admin() || !is_admin_bar_showing() )
        return;

    $wp_admin_bar->add_menu( array(
        'id'   => $id,
        'meta' => array(),
        'title' => $name,
        'href' => $href ) );
  }

  function add_sub_menu($name, $link, $root_menu, $id, $meta = FALSE)
  {
      global $wp_admin_bar;
      if ( ! is_super_admin() || ! is_admin_bar_showing() )
          return;

      $wp_admin_bar->add_menu( array(
          'parent' => $root_menu,
          'id' => $id,
          'title' => $name,
          'href' => $link,
          'meta' => $meta
      ) );
  }

    function sampression_links() {
        $this->add_root_menu( __( 'Theme Options', 'sampression' ), "sam-style" );
            $this->add_sub_menu( __( 'Logos &amp; Icons', 'sampression' ), SAM_FW_SITE_WPADMIN_URL . "themes.php?page=sampression-options", "sam-style", "logos-icons" );
            $this->add_sub_menu( __( 'Styling', 'sampression' ), SAM_FW_SITE_WPADMIN_URL . "themes.php?page=sampression-options&sam-page=styling", "sam-style", "style" );
            $this->add_sub_menu( __( 'Typography', 'sampression' ), SAM_FW_SITE_WPADMIN_URL . "themes.php?page=sampression-options&sam-page=typography", "sam-style", "typography" );
            $this->add_sub_menu( __( 'Social Media', 'sampression' ), SAM_FW_SITE_WPADMIN_URL . "themes.php?page=sampression-options&sam-page=social-media", "sam-style", "social-media" );
            $this->add_sub_menu( __( 'Custom CSS', 'sampression' ), SAM_FW_SITE_WPADMIN_URL . "themes.php?page=sampression-options&sam-page=custom-css", "sam-style", "custom-css" );
            $this->add_sub_menu( __( 'Blog', 'sampression' ), SAM_FW_SITE_WPADMIN_URL . "themes.php?page=sampression-options&sam-page=blog", "sam-style", "blog" );
            $this->add_sub_menu( __( 'Hooks', 'sampression' ), SAM_FW_SITE_WPADMIN_URL . "themes.php?page=sampression-options&sam-page=hooks", "sam-style", "hooks" );
    }
}

add_action( "init", "SampressionAdminbarMenuInit" );
function SampressionAdminbarMenuInit() {
    global $SampressionAdminbarMenu;
    $SampressionAdminbarMenu = new SampressionAdminbarMenu();
}