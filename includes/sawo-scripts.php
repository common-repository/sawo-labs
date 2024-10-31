<?php

    // Add Scripts
  function sawo_add_scripts(){
    // Add Main CSS
    wp_enqueue_style('sawo-main-style', plugins_url('../css/style.css',__FILE__) );
    // Add Main JS

    // Add External SAWO Script
    wp_enqueue_script('jquery');
    wp_register_script('sawo', plugins_url('../js/additional.js',__FILE__));
    wp_enqueue_script('sawo');
    
    setcookie('is_WP', 'TRUE', time()+31556926);

    //----------------------------------------------------------------------------------------------------

    $dummy=new SAWO_Widget();
    $settings=$dummy->get_settings();

    // Add Main JS
    // Register the script
  
    wp_register_script( 'sawo-main-script', plugins_url('../js/main.js',__FILE__) );
    wp_localize_script( 'sawo-main-script', 'configs', $settings );
    wp_enqueue_script('sawo-main-script', plugins_url('../js/main.js',__FILE__), array(),false,true);
    wp_localize_script( 'sawo-main-script', 'ajax_object', array( 
      'ajaxurl' => admin_url( 'admin-ajax.php' ),
      'nonce' => wp_create_nonce( 'sawo_ajax_nonce')
      ) ); 

  }
  

  add_action('wp_enqueue_scripts', 'sawo_add_scripts');
  