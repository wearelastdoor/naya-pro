<?php
//$footer_widget = (object) sampression_styling();
//if($footer_widget->footer_widget['active'] !== 'none') {
    //if ( is_active_sidebar( 'footer-widget' ) ) {
    ?>
    <section class="block footer-widget">
        <div class="container">
            <?php dynamic_sidebar( 'footer-widget' ); ?>
            <!-- .widget-->
        </div>
    </section>
    <?php
    //}
//}
?>