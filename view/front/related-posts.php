<?php
function wp_rp_related_post()
{

    include_once rp_PLUGIN_DIR . '_inc/get-related-posts.php';
    $title = !empty(get_option('_rp_title')) ? get_option('_rp_title') : 'مطالب مرتبط';

    echo '<h4>' . $title . ':  </h4>';

    $the_query = new WP_Query($args);
    if ($the_query->have_posts()) {

        if (get_option('_rp_show') === 'slide') {
            //show slid
            echo '<div  class="owl-carousel owl-theme" >';
            while ($the_query->have_posts()) {
                $the_query->the_post();
?>
                <a href="<?php the_permalink();
                            ?>">

                    <h1><?php echo the_ID()
                        ?></h1>
                    <div>
                        <span>
                            <?php if (has_post_thumbnail()) :
                            ?>
                                <?php echo the_post_thumbnail('thumbnail', ['class' => 'rp_thumbnail wp-post-image'])
                                ?>
                        </span>
                    <?php else :
                    ?>
                        <img class="altrnate-post-thumbnail">
                    <?php endif;
                    ?>
                    <h4><?php the_title()
                        ?></h4>
                    </div>
                </a>
            <?php
            }
            echo '</div>';
        }
        //********************** */
        if (get_option('_rp_show') === 'list') {
            // show  list
            echo '<ul  class="showList" >';
            while ($the_query->have_posts()) {
                $the_query->the_post(); ?>
                <li>
                    <a href="<?php the_permalink(); ?>">
                        <?php echo 'count' . $the_query->found_posts ?>

                        <div>
                            <span>
                                <?php if (has_post_thumbnail()) : ?>
                                    <?php echo the_post_thumbnail('thumbnail', ['class' => 'rp_thumbnail wp-post-image']) ?></span>
                        <?php else : ?>
                            <img class="altrnate-post-thumbnail">
                        <?php endif; ?>
                        <h4><?php the_title() ?></h4>
                        </div>
                    </a>
                </li>
        <?php
            }
            echo ' </ul>';
        }
    } else {
        ?>
        <div class="alert alert-warning">مطلب مرتبطی وجود ندارد.</div>
    <?php
    }
    // Restore original Post Data.
    wp_reset_postdata();

    ?>




<?php
}
add_shortcode('related-post', 'wp_rp_related_post');
