<?php
if ( ! defined( 'ABSPATH' ) ) exit( 'restricted access' );

$link = '';
if( isset( $_GET['sam-page'] ) && $_GET['sam-page']!= '' ) {
    $link = '&sam-page='.$_GET['sam-page'];
}
?>
<a href="themes.php?page=<?php echo $_GET['page'] ?><?php echo $link ?>&action=restore" class="button4 sampression-restore"><?php echo _e( 'Restore all to default settings', 'sampression' ); ?></a>
</div>
<!-- #sam-main-content-->
</div>
<!-- #sam-wrapper-->