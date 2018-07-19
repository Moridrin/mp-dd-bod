<?

namespace mp_ssv_events;

use WP_Query;

if (!defined('ABSPATH')) {
    exit;
}

$args = array(
    'posts_per_page' => 10,
    'paged'          => get_query_var('paged'),
    'post_type'      => ['encounter', 'post'],
);
$posts = new WP_Query($args);

get_header();
?>
    <div id="page" class="container <?= is_admin_bar_showing() ? 'wpadminbar' : '' ?>">
        <div class="row">
            <div class="col s12 <?= is_dynamic_sidebar() ? 'm7 l8 xxl9' : '' ?>">
                <div id="primary" class="content-area">
                    <main id="main" class="site-main" role="main">
                        <?php
                        while ($posts->have_posts()) {
                            $posts->the_post();
                            echo 'testy<br/>';
                        }
                        ?>
                    </main>
                </div>
            </div>
            <?php get_sidebar(); ?>
        </div>
    </div>
    <?php
get_footer();
