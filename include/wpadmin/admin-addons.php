<?php

// Login area branding styles
function wp_login_candy() {
    wp_enqueue_style( 'wpcandy', theme('include/wpadmin/admin-area.css'), false );
}
add_action( 'login_enqueue_scripts', 'wp_login_candy', 10 );