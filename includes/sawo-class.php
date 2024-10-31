<?php

/**
 * Adds SAWO_Widget widget.
 */
class SAWO_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'sawo_widget', // Base ID
			esc_html__( 'SAWO', 'sawo_domain' ), // Name
			array( 'description' => esc_html__( 'Widget to integrate SAWO', 'sawo_domain' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		echo $args['before_widget'];// Whatever you want to display before widget (<div>, etc)
        
        // Widget Content Output
		if(!is_user_logged_in()){
			echo '
				<button class="sawo-login-button" id="sawo-login-button-id">'.esc_html($instance['loginButtonText']).'</button>
			';
		}
		else{
			echo '
				<button class="sawo-login-button" id="sawo-login-button-id">'.esc_html("Logout").'</button>
			';
		}
		echo '

		<!-- The Modal -->
		<div id="myModal" class="modal">

			<!-- Modal content -->
			<div class="modal-content">
			<span class="close">&times;</span>
			<div id="sawo-container" style="
				height: 250px;
				width: calc(100% - 40px);
				position: absolute;
				top: 50%;
				transform: translateY(-50%);
			"></div>
			</div>

		</div>
		';
    

		echo $args['after_widget'];// Whatever you want to display after widget (</div>, etc)
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
        $title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'SAWO', 'sawo_domain' );
        
        $apikey = ! empty( $instance['apikey'] ) ? $instance['apikey'] : esc_html__( '', 'sawo_domain' );

        $authType = ! empty( $instance['authType'] ) ? $instance['authType'] : esc_html__( 'email', 'sawo_domain' );

		$containerHeight = ! empty( $instance['containerHeight'] ) ? $instance['containerHeight'] : esc_html__( '400px', 'sawo_domain' );

		$successRedirectIsActivated= ! empty( $instance['successRedirectIsActivated'] ) ? $instance['successRedirectIsActivated'] : esc_html__( 'DEACTIVATED', 'sawo_domain' );

        $successRedirect = ! empty( $instance['successRedirect'] ) ? $instance['successRedirect'] : esc_html__( '', 'sawo_domain' );
		
		$loginButtonText = ! empty( $instance['loginButtonText'] ) ? $instance['loginButtonText'] : esc_html__( 'LOGIN', 'sawo_domain' );
		?>

        <!-- TITLE -->
		<p>
		    <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
                <?php esc_attr_e( 'Title:', 'sawo_domain' ); ?>
            </label> 
		    <input 
            class="widefat" 
            id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" 
            name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" 
            type="text" 
            value="<?php echo esc_attr( $title ); ?>">
		</p>

        <!-- API KEY -->
		<p>
		    <label for="<?php echo esc_attr( $this->get_field_id( 'apikey' ) ); ?>">
                <?php esc_attr_e( 'API KEY:', 'sawo_domain' ); ?>
            </label> 
		    <input 
            class="widefat" 
            id="<?php echo esc_attr( $this->get_field_id( 'apikey' ) ); ?>" 
            name="<?php echo esc_attr( $this->get_field_name( 'apikey' ) ); ?>" 
            type="text" 
            value="<?php echo esc_attr( $apikey ); ?>">
		</p>


		<!-- lOGIN TYPE-->
		<p>
		    <label for="<?php echo esc_attr( $this->get_field_id( 'authType' ) ); ?>">
                <?php esc_attr_e( 'LOGIN TYPE', 'sawo_domain' ); ?>
            </label> 
		    <select 
            class="widefat" 
            id="<?php echo esc_attr( $this->get_field_id( 'authType' ) ); ?>" 
            name="<?php echo esc_attr( $this->get_field_name( 'authType' ) ); ?>">

                <option value="email" <?php echo ($successRedirectIsActivated == 'email') ? 'selected' : ''; ?>>
					Email
                </option>
                <option value="phone_number_sms" <?php echo ($successRedirectIsActivated == 'phone_number_sms') ? 'selected' : ''; ?>>
					Phone_number
                </option>
				<option value="both_email_phone" <?php echo ($successRedirectIsActivated == 'both_email_phone') ? 'selected' : ''; ?>>
					Both_email_phone
                </option>
            </select>
		</p>

		<!-- CONTAINER HEIGHT -->
		<p>
		    <label for="<?php echo esc_attr( $this->get_field_id( 'containerHeight' ) ); ?>">
                <?php esc_attr_e( 'CONTAINER HEIGHT:', 'sawo_domain' ); ?>
            </label> 
		    <input 
            class="widefat" 
            id="<?php echo esc_attr( $this->get_field_id( 'containerHeight' ) ); ?>" 
            name="<?php echo esc_attr( $this->get_field_name( 'containerHeight' ) ); ?>" 
            type="text" 
            value="<?php echo esc_attr( $containerHeight ); ?>">
		</p>


		<!-- SUCCESS REDIRECT ACTIVATED-->
		<p>
		    <label for="<?php echo esc_attr( $this->get_field_id( 'successRedirectIsActivated' ) ); ?>">
                <?php esc_attr_e( 'SUCCESS REDIRECT: (Do you want to redirect user to another page on successful authentication?)', 'sawo_domain' ); ?>
            </label> 
		    <select 
            class="widefat" 
            id="<?php echo esc_attr( $this->get_field_id( 'successRedirectIsActivated' ) ); ?>" 
            name="<?php echo esc_attr( $this->get_field_name( 'successRedirectIsActivated' ) ); ?>">

                <option value="DEACTIVATED" <?php echo ($successRedirectIsActivated == 'DEACTIVATED') ? 'selected' : ''; ?>>
					DEACTIVATED
                </option>
                <option value="ACTIVATED" <?php echo ($successRedirectIsActivated == 'ACTIVATED') ? 'selected' : ''; ?>>
					ACTIVATED
                </option>
            </select>
		</p>


        <!-- SUCCESS REDIRECT -->
		<p>
		    <label for="<?php echo esc_attr( $this->get_field_id( 'successRedirect' ) ); ?>">
                <?php esc_attr_e( 'SUCCESS REDIRECT URL: (On successful authentication,  the user will be redirected to this URL)', 'sawo_domain' ); ?>
            </label> 
			<input 
			placeholder="/hello.php"
            class="widefat" 
            id="<?php echo esc_attr( $this->get_field_id( 'successRedirect' ) ); ?>" 
            name="<?php echo esc_attr( $this->get_field_name( 'successRedirect' ) ); ?>" 
            type="text" 
            value="<?php echo esc_attr( $successRedirect ); ?>">
		</p>

		<!-- BUTTON TEXT -->
		<p>
		    <label for="<?php echo esc_attr( $this->get_field_id( 'loginButtonText' ) ); ?>">
                <?php esc_attr_e( 'LOGIN BUTTON TEXT:', 'sawo_domain' ); ?>
            </label> 
		    <input 
            class="widefat" 
            id="<?php echo esc_attr( $this->get_field_id( 'loginButtonText' ) ); ?>" 
            name="<?php echo esc_attr( $this->get_field_name( 'loginButtonText' ) ); ?>" 
            type="text" 
            value="<?php echo esc_attr( $loginButtonText ); ?>">
		</p>

		<p>
		<button 
		style="background: #ffde59;
		padding: 10px;
		font-size: 14px;
		font-weight: bold;
		border-radius: 10px;
		border: white;
		box-shadow: 2px 2px 3px #999;" 
		onclick="location.href='https://sawolabs.com/pricing'" type="button">
         	Buy/Renew SAWO Subscription?
		 </button>
		</p>

		<?php 
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';

        $instance['apikey'] = ( ! empty( $new_instance['apikey'] ) ) ? sanitize_text_field( $new_instance['apikey'] ) : '';

		$instance['containerHeight'] = ( ! empty( $new_instance['containerHeight'] ) ) ? sanitize_text_field( $new_instance['containerHeight'] ) : '';

        $instance['authType'] = ( ! empty( $new_instance['authType'] ) ) ? sanitize_text_field( $new_instance['authType'] ) : '';
		
		$instance['successRedirectIsActivated'] = ( ! empty( $new_instance['successRedirectIsActivated'] ) ) ? sanitize_text_field( $new_instance['successRedirectIsActivated'] ) : '';

        $instance['successRedirect'] = ( ! empty( $new_instance['successRedirect'] ) ) ? sanitize_text_field( $new_instance['successRedirect'] ) : '';

		$instance['loginButtonText'] = ( ! empty( $new_instance['loginButtonText'] ) ) ? sanitize_text_field( $new_instance['loginButtonText'] ) : '';
		
		return $instance;
	}

}
