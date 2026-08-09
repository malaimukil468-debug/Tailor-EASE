<?php
/**
 * TailorEase - Authentication Guard
 */

require_once __DIR__ . '/functions.php';

function require_login() {
    if (!get_logged_in_user()) {
        header("Location: login.php?msg=please_login");
        exit();
    }
}

function require_admin() {
    require_login();
    if (!is_admin()) {
        header("Location: customer-dashboard.php?error=unauthorized");
        exit();
    }
}
