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


/* custom metabox for podcast */
// این کد فیلد پادکست رو اضافه میکنه به پست ها
function nias_arsamFunction_0() {
    add_meta_box(
        'nias_gooyandeMeta_0',
        'اطلاعات پادکست',
        'nias_arsamFunction_0_content',
        'post', // تغییر از 'product' به 'post'
        'normal',
        'default'
    );
}
add_action('add_meta_boxes', 'nias_arsamFunction_0');

function nias_arsamFunction_0_content($post) {
    $voiceTime = get_post_meta($post->ID, 'voiceTime', true);
    $podcastLink = get_post_meta($post->ID, 'podcastLink', true);
    $publishDate = get_post_meta($post->ID, 'publishDate', true);
    $nameGooyandeh = get_post_meta($post->ID, 'nameGooyandeh', true);
    $podcastTitle = get_post_meta($post->ID, 'podcastTitle', true);
    $podcastPicture = get_post_meta($post->ID, 'podcastPicture', true);
    ?>
    <p>
        <label style=" color : #53CEA2 ;" for="voiceTime">مدت زمان صوت : | (آیدی فیلد: voiceTime)</label>
        <input type="text" id="voiceTime" name="voiceTime" value="<?php echo esc_attr($voiceTime); ?>" style="width: 100%;" />
    </p>
    <p>
        <label style=" color : #53CEA2 ;" for="podcastLink">لینک پادکست : | (آیدی فیلد: podcastLink)</label>
        <input type="text" id="podcastLink" name="podcastLink" value="<?php echo esc_attr($podcastLink); ?>" style="width: 100%;" />
    </p>
    <p>
        <label style=" color : #53CEA2 ;" for="publishDate">تاریخ انتشار: | (آیدی فیلد: publishDate)</label>
        <input type="text" id="publishDate" name="publishDate" value="<?php echo esc_attr($publishDate); ?>" style="width: 100%;" />
    </p>
    <p>
        <label style=" color : #53CEA2 ;" for="nameGooyandeh">نام گوینده: | (آیدی فیلد: nameGooyandeh)</label>
        <input type="text" id="nameGooyandeh" name="nameGooyandeh" value="<?php echo esc_attr($nameGooyandeh); ?>" style="width: 100%;" />
    </p>
    <p>
        <label style=" color : #53CEA2 ;" for="podcastTitle">عنوان پادکست: | (آیدی فیلد: podcastTitle)</label>
        <input type="text" id="podcastTitle" name="podcastTitle" value="<?php echo esc_attr($podcastTitle); ?>" style="width: 100%;" />
    </p>
    <p>
        <label style=" color : #53CEA2 ;" for="podcastPicture">عکس گوینده: | (آیدی فیلد: podcastPicture)</label>
        <input type="text" id="podcastPicture" name="podcastPicture" value="<?php echo esc_attr($podcastPicture); ?>" style="width: 100%;" />
    </p>
    <style>
		
		
        #nias_gooyandeMeta_0 input {
            border: 1px solid white;
            padding: 5px 10px;
            border-radius: 10px;
            background-color: #0000000d;
            color: #808080;
            margin: 10px 0 20px 10px;
            box-shadow: none;
        }
        #nias_gooyandeMeta_0 input:focus-within {
            border: none;
            background: none;
            border-bottom: 3px solid #53CEA2;
            border-radius: 0;
        }
        #nias_gooyandeMeta_0 label {
            border-right: 3px solid #53CEA2;
            padding-right: 5px;
            color: #53CEA2 !important;
            font-weight: bold;
			font-family : "iranyekanwebbold";
        }
        #nias_gooyandeMeta_0 {
            background: #ffffff3d;
            border-radius: 15px;
			border: 1px solid #53CEA2;
            z-index: 9999;
            box-shadow: none;
            position: relative;
			margin : 1rem ;
			padding:1rem ;
        }
		#nias_gooyandeMeta_0 .postbox-header{
			 border: 1px solid #53CEA2;
   			 border-radius: 10px;
   			 background: #53CEA220;
   			 padding: 1rem;
		}
		
		#nias_gooyandeMeta_0 .postbox-header h2.ui-sortable-handle {
			font-size: 20px !important;
   			font-family: "iranyekanwebbold" !important ;
		}
    </style>
    <?php
}

function save_nias_arsamFunction_0($post_id) {
    if ('post' !== get_post_type($post_id)) {
        return;
    }

    if (isset($_POST['voiceTime'])) {
        update_post_meta($post_id, 'voiceTime', sanitize_text_field($_POST['voiceTime']));
    }

    if (isset($_POST['podcastLink'])) {
        update_post_meta($post_id, 'podcastLink', sanitize_text_field($_POST['podcastLink']));
    }

    if (isset($_POST['publishDate'])) {
        update_post_meta($post_id, 'publishDate', sanitize_text_field($_POST['publishDate']));
    }

    if (isset($_POST['nameGooyandeh'])) {
        update_post_meta($post_id, 'nameGooyandeh', sanitize_text_field($_POST['nameGooyandeh']));
    }

    if (isset($_POST['podcastTitle'])) {
        update_post_meta($post_id, 'podcastTitle', sanitize_text_field($_POST['podcastTitle']));
    }
    
    if (isset($_POST['podcastPicture'])) {
        update_post_meta($post_id, 'podcastPicture', sanitize_text_field($_POST['podcastPicture']));
    }
}
add_action('save_post', 'save_nias_arsamFunction_0');



function display_podcast_picture() {
    if (is_single()) {
        global $post;
        $podcast_picture_url = get_post_meta($post->ID, 'podcastPicture', true);
        if ($podcast_picture_url) {
            return '<img src="' . esc_url($podcast_picture_url) . '" alt="Podcast Picture" style="max-width: 100%; height: auto; object-fit: cover ; padding:0; margin:0; box-sizing:border-box;" />';
        }
    }
    return '';
}
add_shortcode('podcast_picture', 'display_podcast_picture');
