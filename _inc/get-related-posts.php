<?php
global $post;
$total_posts = !empty(get_option('_rp_number')) ? get_option('_rp_number') : 4;
$related_by = !empty(get_option('_rp_accoording_to')) ? get_option('_rp_accoording_to') : 'category';
echo '<pre>';
var_dump($total_posts);
echo '</pre>';
echo '</br>';
if ($related_by === 'category') {
    $cats = get_the_category($post->ID);
    $cat_id = '';
    foreach ($cats as $cat) {
        $cat_id .= $cat->cat_ID . ',';
    };
    $args = [
        'post_type' => 'post',
        'posts_per_page' => $total_posts,
        'cat' => $cat_id,
        'status' => 'publish',
        'post__not_in' => [$post->ID],
        'orderby' => 'rand'

    ];
} elseif ($related_by === 'tags') {
    $tags = wp_get_post_tags($post->ID);
    $tags_id = [1];
    foreach ($tags as $tag) $tags_id[] = $tag->term_id;
    echo '<pre>';
    var_dump($tags_id);
    echo '</pre>';
    echo '</br>';
    $args = [
        'post_type' => 'post',
        'posts_per_page' => $total_posts,
        'tag__in' => $tags_id,
        'status' => 'publish',
        'post__not_in' => [$post->ID],
        'orderby' => 'rand'

    ];

    // The Query.

    // echo '<pre>';
    // echo '</pre>';
    // var_dump($tags_id);
    // echo '</br>';
}
