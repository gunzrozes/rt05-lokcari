<?php
// public/api/acl.php - simple role check helper
require_once __DIR__ . '/../../config.php';
function require_role($roles = []){
    if(!is_logged_in()) { header('HTTP/1.1 401 Unauthorized'); exit('Not logged in'); }
    $user = current_user();
    if(!$user) { header('HTTP/1.1 401 Unauthorized'); exit('User not found'); }
    if(!in_array($user['role'], (array)$roles)){
        header('HTTP/1.1 403 Forbidden'); exit('Access denied for role: '.$user['role']);
    }
}
?>