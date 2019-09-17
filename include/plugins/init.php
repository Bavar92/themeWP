<?php
//Cyr to lat for Hashtag
function transliterate($textcyr = null, $textlat = null)
{
    $cyr = array(
        'ы', ' ', 'є', 'ї', 'ж', 'ч', 'щ', 'ш', 'ю', 'а', 'б', 'в', 'г', 'д', 'е', 'з', 'и', 'й', 'і', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ъ', 'ь', 'я',
        'Ы', 'Є', 'Ї', 'Ж', 'Ч', 'Щ', 'Ш', 'Ю', 'А', 'Б', 'В', 'Г', 'Д', 'Е', 'З', 'И', 'Й', 'І', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ъ', 'Ь', 'Я');
    $lat = array(
        'y', '_', 'ye', 'yi', 'zh', 'ch', 'sht', 'sh', 'yu', 'a', 'b', 'v', 'g', 'd', 'e', 'z', 'i', 'j', 'i', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'c', 'y', 'x', 'ya',
        'Y', 'Ye', 'Yi', 'Zh', 'Ch', 'Sht', 'Sh', 'Yu', 'A', 'B', 'V', 'G', 'D', 'E', 'Z', 'I', 'J', 'I', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'H', 'c', 'Y', 'X', 'Ya');
    if ($textcyr) {
        return str_replace($cyr, $lat, $textcyr);
    } else if ($textlat) {
        return str_replace($lat, $cyr, $textlat);
    } else {
        return null;
    }

}

/*
Plugin Name: Cyr to Lat enhanced
Plugin URI: http://wordpress.org/plugins/cyr3lat/
Description: Converts Cyrillic, European and Georgian characters in post, term slugs and media file names to Latin characters. Useful for creating human-readable URLs. Based on the original plugin by Anton Skorobogatov.
Author: Sol, Sergey Biryukov, Nikolay Karev, Dmitri Gogelia
Author URI: http://karevn.com/
Version: 3.5
 */
function ctl_sanitize_title($title)
{
    global $wpdb;
    $iso9_table = array(
        'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Ѓ' => 'G',
        'Ґ' => 'G', 'Д' => 'D', 'Е' => 'E', 'Ё' => 'YO', 'Є' => 'YE',
        'Ж' => 'ZH', 'З' => 'Z', 'Ѕ' => 'Z', 'И' => 'I', 'Й' => 'J',
        'Ј' => 'J', 'І' => 'I', 'Ї' => 'YI', 'К' => 'K', 'Ќ' => 'K',
        'Л' => 'L', 'Љ' => 'L', 'М' => 'M', 'Н' => 'N', 'Њ' => 'N',
        'О' => 'O', 'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T',
        'У' => 'U', 'Ў' => 'U', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'TS',
        'Ч' => 'CH', 'Џ' => 'DH', 'Ш' => 'SH', 'Щ' => 'SHH', 'Ъ' => '',
        'Ы' => 'Y', 'Ь' => '', 'Э' => 'E', 'Ю' => 'YU', 'Я' => 'YA',
        'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'ѓ' => 'g',
        'ґ' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo', 'є' => 'ye',
        'ж' => 'zh', 'з' => 'z', 'ѕ' => 'z', 'и' => 'i', 'й' => 'j',
        'ј' => 'j', 'і' => 'i', 'ї' => 'yi', 'к' => 'k', 'ќ' => 'k',
        'л' => 'l', 'љ' => 'l', 'м' => 'm', 'н' => 'n', 'њ' => 'n',
        'о' => 'o', 'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't',
        'у' => 'u', 'ў' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'ts',
        'ч' => 'ch', 'џ' => 'dh', 'ш' => 'sh', 'щ' => 'shh', 'ъ' => '',
        'ы' => 'y', 'ь' => '', 'э' => 'e', 'ю' => 'yu', 'я' => 'ya',
    );
    $geo2lat = array(
        'ა' => 'a', 'ბ' => 'b', 'გ' => 'g', 'დ' => 'd', 'ე' => 'e', 'ვ' => 'v',
        'ზ' => 'z', 'თ' => 'th', 'ი' => 'i', 'კ' => 'k', 'ლ' => 'l', 'მ' => 'm',
        'ნ' => 'n', 'ო' => 'o', 'პ' => 'p', 'ჟ' => 'zh', 'რ' => 'r', 'ს' => 's',
        'ტ' => 't', 'უ' => 'u', 'ფ' => 'ph', 'ქ' => 'q', 'ღ' => 'gh', 'ყ' => 'qh',
        'შ' => 'sh', 'ჩ' => 'ch', 'ც' => 'ts', 'ძ' => 'dz', 'წ' => 'ts', 'ჭ' => 'tch',
        'ხ' => 'kh', 'ჯ' => 'j', 'ჰ' => 'h',
    );
    $iso9_table = array_merge($iso9_table, $geo2lat);
    $locale = get_locale();
    switch ($locale) {
        case 'bg_BG':
            $iso9_table['Щ'] = 'SHT';
            $iso9_table['щ'] = 'sht';
            $iso9_table['Ъ'] = 'A';
            $iso9_table['ъ'] = 'a';
            break;
        case 'uk':
            $iso9_table['И'] = 'Y';
            $iso9_table['и'] = 'y';
            break;
        case 'uk_ua':
            $iso9_table['И'] = 'Y';
            $iso9_table['и'] = 'y';
            break;
    }
    $is_term = false;
    $backtrace = debug_backtrace();
    foreach ($backtrace as $backtrace_entry) {
        if ($backtrace_entry['function'] == 'wp_insert_term') {
            $is_term = true;
            break;
        }
    }
    $term = $is_term ? $wpdb->get_var("SELECT slug FROM {$wpdb->terms} WHERE name = '$title'") : '';
    if (empty($term)) {
        $title = strtr($title, apply_filters('ctl_table', $iso9_table));
        if (function_exists('iconv')) {
            $title = iconv('UTF-8', 'UTF-8//TRANSLIT//IGNORE', $title);
        }
        $title = preg_replace("/[^A-Za-z0-9'_\-\.]/", '-', $title);
        $title = preg_replace('/\-+/', '-', $title);
        $title = preg_replace('/^-+/', '', $title);
        $title = preg_replace('/-+$/', '', $title);
    } else {
        $title = $term;
    }
    return $title;
}

add_filter('sanitize_title', 'ctl_sanitize_title', 9);
add_filter('sanitize_file_name', 'ctl_sanitize_title');
function ctl_convert_existing_slugs()
{
    global $wpdb;
    $posts = $wpdb->get_results("SELECT ID, post_name FROM {$wpdb->posts} WHERE post_name REGEXP('[^A-Za-z0-9\-]+') AND post_status IN ('publish', 'future', 'private')");
    foreach ((array)$posts as $post) {
        $sanitized_name = ctl_sanitize_title(urldecode($post->post_name));
        if ($post->post_name != $sanitized_name) {
            add_post_meta($post->ID, '_wp_old_slug', $post->post_name);
            $wpdb->update($wpdb->posts, array('post_name' => $sanitized_name), array('ID' => $post->ID));
        }
    }
    $terms = $wpdb->get_results("SELECT term_id, slug FROM {$wpdb->terms} WHERE slug REGEXP('[^A-Za-z0-9\-]+') ");
    foreach ((array)$terms as $term) {
        $sanitized_slug = ctl_sanitize_title(urldecode($term->slug));
        if ($term->slug != $sanitized_slug) {
            $wpdb->update($wpdb->terms, array('slug' => $sanitized_slug), array('term_id' => $term->term_id));
        }
    }
}

function ctl_schedule_conversion()
{
    add_action('shutdown', 'ctl_convert_existing_slugs');
}

register_activation_hook(__FILE__, 'ctl_schedule_conversion');

require_once 'TGM-Plugin.php';
/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.4.0
 * @author     Thomas Griffin <thomasgriffinmedia.com>
 * @author     Gary Jones <gamajo.com>
 * @copyright  Copyright (c) 2014, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/thomasgriffin/TGM-Plugin-Activation
 */
/**
 * Include the TGM_Plugin_Activation class.
 */
// require_once dirname( __FILE__ ) . '/class-tgm-plugin-activation.php';
add_action('tgmpa_register', 'my_theme_register_required_plugins');
/**
 * Register the required plugins for this theme.
 *
 * In this example, we register two plugins - one included with the TGMPA library
 * and one from the .org repo.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function my_theme_register_required_plugins()
{
    /**
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(
        // This is an example of how to include a plugin from the WordPress Plugin Repository.
        array(
            'name' => 'Contact Form 7',
            'slug' => 'contact-form-7',
            'required' => false,
        ),
        array(
            'name' => 'WP Migrate DB',
            'slug' => 'wp-migrate-db',
            'required' => false,
        ),
        array(
            'name' => 'Wp-scss',
            'slug' => 'wp-scss',
            'required' => true,
        ),
        array(
            'name' => 'Yoast SEO',
            'slug' => 'wordpress-seo',
            'required' => false,
        ),
        array(
            'name' => 'TinyMCE Advanced',
            'slug' => 'tinymce-advanced',
            'required' => false,
        ),
        array(
            'name' => 'Change Case',
            'slug' => 'change-case-for-tinymce',
            'required' => false,
        ),
        array(
            'name' => 'Add Logo to Admin',
            'slug' => 'add-logo-to-admin',
            'required' => false,
        ),
        array(
            'name' => 'AJAX Thumbnail Rebuild',
            'slug' => 'ajax-thumbnail-rebuild',
            'required' => false,
        ),
        array(
            'name' => 'Jquery Validation For Contact Form 7',
            'slug' => 'jquery-validation-for-contact-form-7',
            'required' => false,
        ),
        array(
            'name' => 'Classic Editor',
            'slug' => 'classic-editor',
            'required' => false,
        ),
        array(
            'name' => 'Advanced Custom Fields: PRO',
            'slug' => 'advanced-custom-fields-pro',
            'source' => get_stylesheet_directory() . '/include/plugins/advanced-custom-fields-pro.zip',
            'required' => false,
            'version' => '',
            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            'external_url' => 'http://www.advancedcustomfields.com/pro/', // If set, overrides default API URL and points to an external URL.
        ),
    );
    /**
     * Array of configuration settings. Amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * leave the strings uncommented.
     * Some of the strings are added into a sprintf, so see the comments at the
     * end of each line for what each argument will be.
     */
    $config = array(
        'id' => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '',                      // Default absolute path to bundled plugins.
        'menu' => 'tgmpa-install-plugins', // Menu slug.
        'parent_slug' => 'plugins.php',            // Parent menu slug.
        'capability' => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
        'has_notices' => true,                    // Show admin notices or not.
        'dismissable' => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg' => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => true,                   // Automatically activate plugins after installation or not.
        'message' => '',                      // Message to output right before the plugins table.
    );
    tgmpa($plugins, $config);
}

/*
 * Function creates post duplicate as a draft and redirects then to the edit post screen
 */
function tt_wp_duplicate_posts(){
    global $wpdb;
    if (! ( isset( $_GET['post']) || isset( $_POST['post'])  || ( isset($_REQUEST['action']) && 'tt_wp_duplicate_posts' == $_REQUEST['action'] ) ) ) {
        wp_die('No post to duplicate has been supplied!');
    }

    /*
     * get the original post id
     */
    $post_id = (isset($_GET['post']) ? $_GET['post'] : $_POST['post']);
    /*
     * and all the original post data then
     */
    $post = get_post( $post_id );

    /*
     * if you don't want current user to be the new post author,
     * then change next couple of lines to this: $new_post_author = $post->post_author;
     */
    $current_user = wp_get_current_user();
    $new_post_author = $current_user->ID;

    /*
     * if post data exists, create the post duplicate
     */
    if (isset( $post ) && $post != null) {

        /*
         * new post data array
         */
        $args = array(
            'comment_status' => $post->comment_status,
            'ping_status'    => $post->ping_status,
            'post_author'    => $new_post_author,
            'post_content'   => $post->post_content,
            'post_excerpt'   => $post->post_excerpt,
            'post_name'      => $post->post_name,
            'post_parent'    => $post->post_parent,
            'post_password'  => $post->post_password,
            'post_status'    => $post->post_status,
            'post_title'     => $post->post_title,
            'post_type'      => $post->post_type,
            'to_ping'        => $post->to_ping,
            'menu_order'     => $post->menu_order
        );

        /*
         * insert the post by wp_insert_post() function
         */
        $new_post_id = wp_insert_post( $args );

        /*
         * get all current post terms ad set them to the new post draft
         */
        $taxonomies = get_object_taxonomies($post->post_type); // returns array of taxonomy names for post type, ex array("category", "post_tag");
        foreach ($taxonomies as $taxonomy) {
            $post_terms = wp_get_object_terms($post_id, $taxonomy, array('fields' => 'slugs'));
            wp_set_object_terms($new_post_id, $post_terms, $taxonomy, false);
        }

        /*
         * duplicate all post meta just in two SQL queries
         */
        $post_meta_infos = $wpdb->get_results("SELECT meta_key, meta_value FROM $wpdb->postmeta WHERE post_id=$post_id");
        if (count($post_meta_infos)!=0) {
            $sql_query = "INSERT INTO $wpdb->postmeta (post_id, meta_key, meta_value) ";
            foreach ($post_meta_infos as $meta_info) {
                $meta_key = $meta_info->meta_key;
                $meta_value = addslashes($meta_info->meta_value);
                $sql_query_sel[]= "SELECT $new_post_id, '$meta_key', '$meta_value'";
            }
            $sql_query.= implode(" UNION ALL ", $sql_query_sel);
            $wpdb->query($sql_query);
        }


        /*
         * finally, redirect to the edit post screen for the new draft
         */
        wp_redirect( admin_url( 'post.php?action=edit&post=' . $new_post_id ) );
        exit;
    } else {
        wp_die('Post creation failed, could not find original post: ' . $post_id);
    }
}
add_action( 'admin_action_tt_wp_duplicate_posts', 'tt_wp_duplicate_posts' );

/*
 * Add the duplicate link to action list for post_row_actions
 */
function tt_wp_duplicate_post_link( $actions, $post ) {
    if (current_user_can('edit_posts')) {
        $actions['duplicate'] = '<a href="admin.php?action=tt_wp_duplicate_posts&amp;post=' . $post->ID . '" rel="permalink"><span class="dashicons dashicons-arrow-left-alt2" style="font-size: 8px;vertical-align: baseline"></span>Duplicate<span class="dashicons dashicons-arrow-right-alt2" style="font-size: 8px;vertical-align: baseline"></span></a>';
    }
    return $actions;
}

add_filter('post_row_actions', 'tt_wp_duplicate_post_link', 10, 2 );
add_filter('page_row_actions', 'tt_wp_duplicate_post_link', 10, 2);


/* ===== qTranslate/qTranslate X  ===== */
if(defined('QTX_VERSION')) {
    remove_action('wp_head', 'qtranxf_wp_head_meta_generator');
    remove_action('wp_head', 'qtranxf_head', 10, 0);
    remove_action('wp_head', 'qtranxf_wp_head', 10, 0);
    remove_action('wp_head', 'qtrans_header', 10, 0);
    // Convert blogurl
    function qtrans_home_url($url = '') {
        return qtranxf_convertURL(site_url($url));
    }
    // Custom Links fix
    add_filter('walker_nav_menu_start_el', 'qtrans_in_nav_el', 10, 4);
    function qtrans_in_nav_el($item_output, $item, $depth, $args){
        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        // Determine integration with qTranslate Plugin
        if (function_exists('qtranxf_convertURL')) {
            $attributes .= ! empty( $item->url ) ? ' href="' . qtranxf_convertURL(esc_attr( $item->url )) .'"' : '';
        } else {
            $attributes .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) .'"' : '';
        }
        $item_output = $args->before;
        $item_output .= '<a'. $attributes .'>';
        $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;
        return $item_output;
    }
}

//Show empty categories in category widget
function show_empty_categories_links($args) {
    $args['hide_empty'] = 0;
    return $args;
}
add_filter('widget_categories_args','show_empty_categories_links');
//remove empty title from widget
function foo_widget_title($title) {
    return $title == '&nbsp;' ? '' : $title;
}
add_filter('widget_title', 'foo_widget_title');