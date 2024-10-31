<?php
// User created webhook
add_action( 'user_register', function ( $user_id ) {
	if (isset($_POST['email'])) {
		$access_api_url = SAWO_API_HOST . '/wordpress/customer/'. urlencode($_SERVER['SERVER_NAME']) . '/';
		$query = array(
			"id" => $user_id,
			"email" => $_POST['email']
		);
		$body = wp_json_encode( $query );
		$options = [
			'method' => 'PUT',
			'body'        => $body,
			'headers'     => [
				'Content-Type' => 'application/json',
			],
			'data_format' => 'body',
		];

		$response = wp_remote_request( $access_api_url, $options );
		if ( is_wp_error( $response) ) {
			$error_message = $response->get_error_message();
			error_log( print_r( $error_message, true ) );
		} else if(wp_remote_retrieve_response_code( $response ) != 200) {
			error_log("Response: ". wp_remote_retrieve_response_message( $response ));
		}
	}    
} );

// User deleted webhook
add_action( 'deleted_user', function ($id) {
    $access_api_url = SAWO_API_HOST . '/wordpress/customer/'. urlencode($_SERVER['SERVER_NAME']) . '/';
    $query = array(
        "id" => $id
    );
    $body = wp_json_encode( $query );
		$options = [
			'method' => 'DELETE',
			'body'        => $body,
			'headers'     => [
				'Content-Type' => 'application/json',
			],
			'data_format' => 'body',
		];

		$response = wp_remote_request( $access_api_url, $options );
		if ( is_wp_error( $response) ) {
			$error_message = $response->get_error_message();
			error_log( print_r( $error_message, true ) );
		} else if(wp_remote_retrieve_response_code( $response ) != 200) {
			error_log("Response: ". wp_remote_retrieve_response_message( $response ));
		}
} );

add_action( 'wp_ajax_sawo_login', 'sawo_login' );
add_action( 'wp_ajax_nopriv_sawo_login', 'sawo_login' );

function sawo_debug_to_console($data) {
    $output = $data;
    if (is_array($output))
        $output = sanitize_text_field(implode(',', $output));

    echo esc_js("<script>console.log('Debug Objects: " . $output . "' );</script>");
}


function sawo_login(){
  //DO whatever you want with data posted
  //To send back a response you have to echo the result!
  //IF USER IS LOGGED IN LOG OUT
  //Check Nonce Security
  if ( ! wp_verify_nonce($_POST['nonce'],'sawo_ajax_nonce' ) ) {
	die ( 'Permission Denied!');
	}
	if(is_user_logged_in()){
		wp_logout();
		wp_clear_auth_cookie();
		wp_set_current_user ( NULL );
		wp_set_auth_cookie  ( NULL );
	
		$redirect_to = user_admin_url();
		wp_safe_redirect( $redirect_to );
		exit();
	}
	else //ELSE LOGIN
	{
		$username=sanitize_user($_POST['identifier']); 
		$identifier=sanitize_user($_POST['identifier']);
		$payload = isset( $_POST['payload'] ) ? (array) $_POST['payload'] : array();
		$payload = sawo_recursive_sanitize_text_field($payload);
		$password= sanitize_text_field($payload['wp_key']);

		if ($payload['identifier_type'] == 'email')
		{
			$user_data = [
				'user_login' => $username,
				'user_pass'  => $password,
				'user_email'   => $identifier,
				'role' => 'subscriber'
			  ];
		}
		else
		{
			$user_data = [
				'user_login' => $username,
				'user_pass'  => $password,
				'role' => 'subscriber'
			  ];
		}

		
		
		$new_user_id = wp_insert_user($user_data);
		if(is_wp_error($new_user_id)){
		  $credentials = array(
			  'user_login'    => $username,
			  'user_password' => $password,
			  'remember'      => true
		  );
		  $user = wp_signon($credentials,false);
		}
		else{
		  $user = get_user_by('login', $username );
		}
	  error_log(is_wp_error( $user ) );
	  // Redirect URL //
	  if ( !is_wp_error( $user ) )
	  {
		  wp_clear_auth_cookie();
		  wp_set_current_user ( $user->ID );
		  wp_set_auth_cookie  ( $user->ID );
	  
		  $redirect_to = user_admin_url();
		  wp_safe_redirect( $redirect_to );
		  exit();
	  }
	}


  die();// ajax call must die to avoid trailing 0 in your response
  
}

/**
 * Recursive sanitation for an array
 * 
 * @param $array
 *
 * @return mixed
 */

function sawo_recursive_sanitize_text_field($array) {
    foreach ( $array as $key => &$value ) {
        if ( is_array( $value ) ) {
            $value = sawo_recursive_sanitize_text_field($value);
        }
        else {
            $value = sanitize_text_field( $value );
        }
    }

    return $array;
}
