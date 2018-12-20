<?php require_once 'include/plugins/init.php';
require_once('include/wpadmin/admin-addons.php');
require_once 'include/init.php';

//images sizes
add_image_size( 'free', '1920', '', true );

//light function fo wp_get_attachment_image_src()
function image_src($id, $size = 'full', $background_image = false, $height = false) {
    if ($image = wp_get_attachment_image_src($id, $size, true)) {
        return $background_image ? 'background-image: url('.$image[0].');' . ($height?'min-height:'.$image[2].'px':'') : $image[0];
    }
}

function content_button($atts,$content = null){
    extract(shortcode_atts(array(
        'link' => '#',
        'class' => false,
        'target' => false
    ), $atts ));
    return '<a href="' . $link . '" class="button'.($class?' '.$class:'').'" '.($target?'target="'.$target.'"':'').'>' . do_shortcode($content) . '</a>';
}
add_shortcode("button", "content_button");

function some() {
    $some = get_field('some', 'option');
    $soc = '';
    if($some) {
        $soc .= '<div class="some">';
        foreach($some as $sm) {
            $soc .= '<a class="fas fa-'.$sm['icon'].'" target="_blank" href="'.$sm['link'].'" rel="nofollow"></a>';
        }
        $soc .= '</div>';
    }
    return $soc;
}
add_shortcode("social", "some");

add_theme_support('custom-logo');
