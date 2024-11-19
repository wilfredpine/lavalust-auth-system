<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');

/**
 * Check if user is logged in
 */
if (!function_exists('is_logged_in')) {
    //check if user is logged in
    function is_logged_in()
    {
        $LAVA = &lava_instance();
        if ($LAVA->session->userdata('logged_in') == 1)
            return true;
    }
}


if (!function_exists('is_admin')) {
    //check if user is admin
    function is_admin()
    {
        $LAVA = &lava_instance();
        if ($LAVA->session->userdata('user_type') == 'admin')
            return true;
    }
}
