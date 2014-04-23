<?php
if ( ! defined('ABSPATH')) exit('restricted access');
add_action( 'wp_dashboard_setup', 'prefix_add_dashboard_widget' );

function prefix_add_dashboard_widget() {
    wp_add_dashboard_widget(
        'sam_dashboard_widget',
        'Sampression',
        'prefix_dashboard_widget'
    );
    global $wp_meta_boxes;

    $normal_dashboard = $wp_meta_boxes['dashboard']['normal']['core'];

    // Backup and delete our new dashboard widget from the end of the array

    $example_widget_backup = array( 'sam_dashboard_widget' => $normal_dashboard['sam_dashboard_widget'] );
    unset( $normal_dashboard['example_dashboard_widget'] );

    // Merge the two arrays together so our widget is at the beginning

    $sorted_dashboard = array_merge( $example_widget_backup, $normal_dashboard );
    //sam_p($sorted_dashboard);
    // Save the sorted array back into the original metaboxes

    $wp_meta_boxes['dashboard']['normal']['core'] = $sorted_dashboard;
}

function prefix_dashboard_widget() {

    $rss = new DOMDocument();
    $rss->load('http://sampression.com/feed/');
    $feed = array();
    foreach ($rss->getElementsByTagName('item') as $node) {
        $item = array ( 
            'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
            'desc' => $node->getElementsByTagName('description')->item(0)->nodeValue,
            'link' => $node->getElementsByTagName('link')->item(0)->nodeValue,
            'date' => $node->getElementsByTagName('pubDate')->item(0)->nodeValue,
        );
        array_push($feed, $item);
    }
    $limit = 5;
    if(count($feed) < $limit) {
        $limit = count($feed);
    }
    echo '<div class="rss-widget">';
    echo '<ul>';
    for($x=0; $x < $limit; $x++) {
        $title = str_replace(' & ', ' &amp; ', $feed[$x]['title']);
        $link = $feed[$x]['link'];
        $description = $feed[$x]['desc'];
        $date = date('l F d, Y', strtotime($feed[$x]['date']));
        echo '<li>';
        echo '<span class="sam-rss-date">Posted on '.$date.'</span>';
        echo '<a class="sam-rss-title" href="'.$link.'" title="'.$title.'">'.$title.'</a>';
        echo $description;
        echo '</li>';
    }
    echo '</ul>';
    echo '</div>';
}