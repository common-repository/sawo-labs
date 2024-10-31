<?php
function get_user_existence(WP_REST_Request $request) {
    return email_exists($request['email']);
}
?>