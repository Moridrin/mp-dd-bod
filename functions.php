<?php

use dd_encounters\models\CombatAction;

if (!defined('ABSPATH')) {
    exit;
}

function mp_filter_atra_from_log(CombatAction $action, array $creatures)
{
    $actorIsAtra = $creatures[$action->getActor()]->getName() === 'Atra';
    $currentUserIsAtra = current_user_can('atra') || current_user_can('administrator');
    if ($actorIsAtra && !$currentUserIsAtra) {
        return false;
    }
    return true;
}

add_filter('dd_encounters_player_is_allowed_to_view_log', 'mp_filter_atra_from_log', 10, 2);

function mp_filter_publish_date($the_date, $d, WP_Post $post)
{
    $tmp = new DateTime($the_date);
    $tmp->add(new DateInterval('P1100Y'));
    if ('' == $d) {
        $d = get_option('date_format');
    }
    return $tmp->format($d);
}

add_filter('get_the_date', 'mp_filter_publish_date', 10, 3);

function mp_filter_word_replacements($content)
{
    // Players
    $content = preg_replace('/\b(Anlanya Damodred|Anlanya|Damodred)\b/', '<a href="http://moridrin.com/the-players/anlanya-damodred/">$0</a>', $content);
    $content = preg_replace('/\b(Atra Art|Atra Tealeaf|Atra|Tealeaf)\b/', '<a href="http://moridrin.com/the-players/atra/">$0</a>', $content);
    $content = preg_replace('/\b(Phoenix|Phinux)\b/', '<a href="http://moridrin.com/the-players/phinux/" target="_blank">$0</a>', $content);
    $content = preg_replace('/\b(Raeflynn Liadon|Raeflynn|Liadon)\b/', '<a href="http://moridrin.com/the-players/raeflynn-liadon/">$0</a>', $content);
    $content = preg_replace('/\b(Ronan Overwood|Ronan|Overwood)\b/', '<a href="http://moridrin.com/the-players/ronan-overwood/">$0</a>', $content);
    $content = preg_replace('/\b(William Richfield|William|Richfield)\b/', '<a href="http://moridrin.com/the-players/william-richfield/">$0</a>', $content);
    $content = preg_replace('/\b(Ykki(uto)? Quaews|Ykki(uto)?|Quaews)\b/', '<a href="http://moridrin.com/the-players/ykkiuto-quaews/">$0</a>', $content);

    // Important NPCs and Organizations
    $content = preg_replace('/\b(Albert Morbo|K?k?ing Morbo|Morbo)\b/', '<a href="http://moridrin.com/npc/albert-morbo/">$0</a>', $content);
    $content = preg_replace('/Cal&#8217;Chos/', '<a href="https://moridrin.com/important-characters/kirin-tor/#calchos">$0</a>', $content);
    $content = preg_replace('/>Kirin Tor</', '>########<', $content);
    $content = preg_replace('/\b(Kirin Tor)\b/', '<a href="https://moridrin.com/important-characters/kirin-tor/">$0</a>', $content);
    $content = preg_replace('/>########</', '>Kirin Tor<', $content);

    return $content;
}

// add_filter('the_content', 'mp_filter_word_replacements', 11);


function recent_posts_function(array $args, string $content, string $tag)
{
    $id          = (int)$args['id'];
    $title       = get_post($id)->post_title;
    $trapModal   = mp_dd_make_modal('<h1>'.$title.'</h1>'.mp_dd_get_trap_content($id), $id);
    $trapTrigger = '<a href="#modal_'.$id.'" class="modal-trigger">'.esc_html($title).'</a>';
    wp_reset_postdata();
    return $trapTrigger.$trapModal;
}
