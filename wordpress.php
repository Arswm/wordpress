<?php
//این کد سفارشی امتیاز پست‌های شما را از پایگاه داده دریافت می‌کند و می‌توانید آن را با شورتکد [average_post_rating] در هر صفحه یا پست المنتور نمایش دهید.

/* this custom code returns the rating of your posts from database
and you can show it any elementor page or post with this shortcode [average_post_rating] */

function get_average_post_rating_shortcode() {
    global $wpdb;

    // نام متادیتا که امتیازها در آن ذخیره شده است
    $meta_key = 'post_rating';

    // گرفتن تمام امتیازها از متادیتاهای پست‌ها
    $ratings = $wpdb->get_col(
        $wpdb->prepare(
            "
            SELECT meta_value 
            FROM $wpdb->postmeta 
            WHERE meta_key = %s
            ",
            $meta_key
        )
    );

    // محاسبه میانگین
    if (!empty($ratings)) {
        $total_ratings = array_sum($ratings);
        $number_of_ratings = count($ratings);
        $average_rating = $total_ratings / $number_of_ratings;

        return $average_rating;
    } else {
        return 'امتیازی برای این مقاله ثبت نشده' ;
    }
}
add_shortcode('average_post_rating', 'get_average_post_rating_shortcode');


/* ______________________________________________________________________________________________________________ */

// این کد ویرایشگر گوتنبرگ را غیرفعال می‌کند و ویرایشگر شما را به ویرایشگر کلاسیک وردپرس تغییر می‌دهد
//this code will disable gutenberg editor and changes your editor to classic wp editor

// غیرفعال کردن ویرایشگر گوتنبرگ و فعال کردن ویرایشگر کلاسیک


add_filter('use_block_editor_for_post', '__return_false', 10);

add_action('admin_init', function() {
    remove_action('wp_enqueue_scripts', 'wp_common_block_scripts_and_styles');
    remove_action('admin_enqueue_scripts', 'wp_common_block_scripts_and_styles');
});


/* ______________________________________________________________________________________________________________ */