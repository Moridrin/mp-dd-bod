<?php
if (!defined('ABSPATH')) {
    exit;
}

#region Change Publish Date
function mp_filter_publish_date($the_date, $d, WP_Post $post) {
    $tmp = new DateTime($the_date);
    $tmp->add(new DateInterval('P1100Y'));
    if ( '' == $d ) {
        $d = get_option('date_format');
    }
    return $tmp->format($d);
}
add_filter('get_the_date', 'mp_filter_publish_date', 10, 3);
#endregion

#region Replace Words
function mp_filter_word_replacements($content) {
    $content = preg_replace('/\b(Anlanya Damodred|Anlanya|Damodred)\b/', '<a href="http://moridrin.com/the-players/anlanya-damodred/" target="_blank">$0</a>', $content);
    $content = preg_replace('/\b(Atra Art|Atra Tealeaf|Atra|Art|Tealeaf)\b/', '<a href="http://moridrin.com/the-players/atra/" target="_blank">$0</a>', $content);
    $content = preg_replace('/\b(Phoenix)\b/', '<a href="http://moridrin.com/the-players/phinux/" target="_blank">$0</a>', $content);
    $content = preg_replace('/\b(Reaflynn Liadon|Reaflynn|Liadon)\b/', '<a href="http://moridrin.com/the-players/raeflynn-liadon/" target="_blank">$0</a>', $content);
    $content = preg_replace('/\b(Ronan Overwood|Ronan|Overwood)\b/', '<a href="http://moridrin.com/the-players/ronan-overwood/" target="_blank">$0</a>', $content);
    $content = preg_replace('/\b(William Richfield|William|Richfield)\b/', '<a href="http://moridrin.com/the-players/william-richfield/" target="_blank">$0</a>', $content);
    $content = preg_replace('/\b(Ykki(uto)? Quaews|Ykki(uto)?|Quaews)\b/', '<a href="http://moridrin.com/the-players/ykkiuto-quaews/" target="_blank">$0</a>', $content);
    return $content;
}
add_filter('the_content', 'mp_filter_word_replacements');
#endregion
