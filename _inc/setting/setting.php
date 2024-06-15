<?php
function kmk_render_images_html()
{
    if (!current_user_can('manage_options')) {
        return;
    }
    if (isset($_GET['setting_update'])) {
        add_settings_error('setting', 'setting-mesage', 'تنظیمات ذخیره گردید');
        settings_errors('setting-mesage');
    }
?>
    <div class="rp-wrap">
        <form action="options.php" method="post" class="related-post">
            <h1><?php echo esc_html(get_admin_page_title()) ?></h1>
            <?php settings_fields('related-posts') ?>
            <?php do_settings_sections('related-post-html') ?>
            <?php submit_button() ?>
        </form>
    </div>
<?php
}

/**
 * Fires as an admin screen or script is being initialized.
 *
 */
function  action_admin_init_rp(): void
{
    $args = [
        'type' => 'string',
        'sanitize_callback' => 'sanitize_text_field',
        'default' => NULL,
    ];
    // register_setting('related-posts', '_rp_title', $args);
    // register_setting('related-posts', '_rp_number', $args);
    // register_setting('related-posts', '_rp_accoording_to', $args);
    // register_setting('related-posts', '_rp_show', $args);
    $settings_array = [
        '_rp_title',
        '_rp_number',
        '_rp_accoording_to',
        '_rp_show'
    ];
    foreach ($settings_array as $item) {
        # code...
        register_setting('related-posts', $item, $args);
    }
    add_settings_section('related-post-section', '', '', 'related-post-html');
    add_settings_field(
        'related-post-field',
        '',
        'rp_render_html',
        'related-post-html',
        'related-post-section'
    );
}
add_action('admin_init', 'action_admin_init_rp');

/**
 * Fires as an admin screen or script is being initialized.
 *
 */

function rp_render_html()
{
    $rp_title = get_option('_rp_title');
    $rp_number = get_option('_rp_number');
    $rp_accroding_to = get_option('_rp_accoording_to');
    $rp_show = get_option('_rp_show');

?>
    <div class="el-wraper">

        <label for="title">عنوان</label>
        <input type="text" id="title" name="_rp_title" value="<?php echo isset($rp_title) ? esc_attr($rp_title) : '' ?>">
        <label for="number">تعداد نمایش مطالب</label>
        <input type="text" id="number" name="_rp_number" value="<?php echo isset($rp_number) ? esc_attr($rp_number) : '' ?>">
        <label for="according_to">نمایش بر اساس</label>
        <select name="_rp_accoording_to" id="according_to">
            <option value="tags" <?php echo  selected($rp_accroding_to, 'tags') ?> <?php // echo $rp_accroding_to == 'tags' ? 'selected' : '' 
                                                                                    ?>>برچسپ</option>
            <option value="category" <?php echo  selected($rp_accroding_to, 'category') ?> <?php // echo $rp_accroding_to == 'category' ? 'selected' : '' 
                                                                                            ?>>دسته بندی</option>
        </select>
        <div class="show">
            حالت نمایش
            <label for="show-list">
                لیست
                <input type="radio" name="_rp_show" id="show-list" value="list" <?php echo checked($rp_show, 'list') ?>>
            </label>
            <label for="show-block">اسلاید
                <input type="radio" name="_rp_show" id="show-block" value="slide" <?php echo  checked($rp_show, 'slide') ?>>
            </label>
        </div>

    </div>
<?php
}
