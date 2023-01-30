<?php

/*
Plugin Name: Overlay Image Divi Module
Plugin URI:  http://learnhowwp.com/divi-overlay-images
Description: This plugins adds a new module in the Divi Builder. The module allows you add text when you hover over an image. There are two effects that you can choose for the overlay, Fade and Slide.
Version:     1.3.2
Author:      learnhowwp.com
Author URI:  http://learnhowwp.com/
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: lwp-overlay-images
Domain Path: /languages

LWP Overlay Images is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

LWP Overlay Images is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with LWP Overlay Images. If not, see https://www.gnu.org/licenses/gpl-2.0.html.
*/
if ( !defined( 'ABSPATH' ) ) {
    exit;
}

if ( function_exists( 'lwp_oidm_fs' ) ) {
    lwp_oidm_fs()->set_basename( false, __FILE__ );
} else {
    
    if ( !function_exists( 'lwp_oidm_fs' ) ) {
        // Create a helper function for easy SDK access.
        function lwp_oidm_fs()
        {
            global  $lwp_oidm_fs ;
            
            if ( !isset( $lwp_oidm_fs ) ) {
                // Include Freemius SDK.
                require_once dirname( __FILE__ ) . '/freemius/start.php';
                $lwp_oidm_fs = fs_dynamic_init( array(
                    'id'             => '8358',
                    'slug'           => 'overlay-image-divi-module',
                    'type'           => 'plugin',
                    'public_key'     => 'pk_f607d882d3ad34f82ebe58c3ec41a',
                    'is_premium'     => false,
                    'premium_suffix' => 'Pro',
                    'has_addons'     => false,
                    'has_paid_plans' => true,
                    'navigation'     => 'tabs',
                    'anonymous_mode' => true,
                    'trial'          => array(
                    'days'               => 7,
                    'is_require_payment' => false,
                ),
                    'menu'           => array(
                    'slug' => 'lwp_overlay_image',
                ),
                    'is_live'        => true,
                ) );
            }
            
            return $lwp_oidm_fs;
        }
        
        // Init Freemius.
        lwp_oidm_fs();
        // Signal that SDK was initiated.
        do_action( 'lwp_oidm_fs_loaded' );
    }
    
    
    if ( !function_exists( 'lwp_initialize_overlay_image_extension' ) ) {
        /**
         * Creates the extension's main class instance.
         *
         * @since 1.0.0
         */
        function lwp_initialize_overlay_image_extension()
        {
            require_once plugin_dir_path( __FILE__ ) . 'includes/LwpOverlayImages.php';
        }
        
        add_action( 'divi_extensions_init', 'lwp_initialize_overlay_image_extension' );
    }
    
    
    if ( !function_exists( 'lwp_overlay_image_add_action_links' ) ) {
        add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'lwp_overlay_image_add_action_links' );
        function lwp_overlay_image_add_action_links( $actions )
        {
            $mylinks = array( '<a href="https://wordpress.org/support/plugin/overlay-image-divi-module/reviews/?filter=5#new-post" target="_blank">' . esc_html__( 'Rate Plugin', 'lwp-overlay-images' ) . '</a>', '<a href="https://www.learnhowwp.com/divi-plugins/" target="_blank">' . esc_html__( 'More Divi Plugins', 'lwp-overlay-images' ) . '</a>' );
            $actions = array_merge( $actions, $mylinks );
            return $actions;
        }
    
    }
    
    if ( !function_exists( 'lwp_overlay_image_page_html' ) ) {
        function lwp_overlay_image_page_html()
        {
            ?>
      <style> 
        .lwp-button {
        background-color: #ff8906;
        border: none;
        color: white;
        padding: 10px 24px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        }
        .lwp-button:hover {
          color: white;
        }
        .lwp-btn-demo{
          background-color:#34c5a8;
        }
        .lwp-heading{
          font-size:23px;
          font-weight:bold;
          margin-top:40px;
        }
        .lwp-flex-container{
          display: flex;
          flex-direction: row;
          margin-bottom: 40px;			
        }
        .lwp-flex-container>div{
          padding-left:20px;
          padding-right:20px;
          margin-top:20px;

        }
        .lwp-features>div{
          width: 50%;
        }
        .lwp-flex-container>div:first-child, .lwp-flex-container>div:nth-child(4n){
          padding-left:0px;
        }	
        h3.lwp-subheading {
            font-size: 1.6em;
        }
        .lwp-getting-started p{
            font-size:15px;
            margin: 0px;
            margin-top: 5px;
        } 
        .lwp-main-text {
            font-size: 18px;
            margin-top:40px;
        }
        .lwp-flex-container ul{
            font-size:16px;
        }
        .lwp-more-modules{
          flex-wrap:wrap;
        }
        .lwp-more-modules>div {
            flex-basis: 30%;
        }
        .lwp-features  li {
            margin-bottom: 16px;
        }
        .lwp-no-margin{
          margin:0px;
        }
        .lwp-images img{
          max-width:100%;
          width:450px;
          box-shadow:0px 2px 18px 0px rgb(0 0 0 / 30%);
        }
        .lwp-images h4{
          font-size:17px;
        }                
        .lwp-images p{
          font-size:15px;
        }                      	
      </style>
    
        <div class="wrap">

        <h1><?php 
            echo  esc_html( get_admin_page_title() ) ;
            ?></h1>

        <p class="lwp-main-text">Divi Overlay Image plugin allows you to add text as an overlay on images inside the Divi Builder. The plugin adds a new module that you can use to add images with overlay. You can find the documentation for all module settings on the <em><a href="https://www.learnhowwp.com/documentation/overlay-image-divi/" target="_blank">Documentation</a></em> page.</p>

        
        <div class="lwp-flex-container">
          <div class="lwp-getting-started">
            <h3 class="lwp-subheading">Get Started</h3>
            <p><strong>Step #0: </strong>Install & Activate the Overlay Image Divi Plugin.</p>
            <p><strong>Step #1: </strong>Add the Overlay Image module in Divi Builder.</p>
            <p><strong>Step #2: </strong>Add your own custom images with overlay text on top of them from within the Divi Builder.</p>
            <p><a href="https://www.learnhowwp.com/add-overlay-text-image-divi/" target="_blank">Getting Started Tutorial with Step By Step Instructions</a></p>
          </div>        
        </div>

        <div class="lwp-flex-container lwp-features lwp-images">
          <div>
            <img src="<?php 
            echo  plugin_dir_url( __FILE__ ) . 'images/image-1.jpg' ;
            ?>"/>
            <h4>Overlay Color and Effect</h4>
            <p>Customize the color and set a custom effect for the overlay in module settings.</p>
          </div>
          <div>
            <img src="<?php 
            echo  plugin_dir_url( __FILE__ ) . 'images/image-2.jpg' ;
            ?>"/>
            <h4>Icon Styles (Pro)</h4>
            <p>Set custom styles for the icon inside the overlay using the settings in the module.</p>
          </div>
        </div>
        <div class="lwp-flex-container lwp-features lwp-images">
          <div>
            <img src="<?php 
            echo  plugin_dir_url( __FILE__ ) . 'images/image-3.jpg' ;
            ?>"/>
            <h4>Overlay Content</h4>
            <p>Set a custom image and custom text for the overlay from within the module right inside the Visual Builder.</p>
          </div>
          <div>
            <img src="<?php 
            echo  plugin_dir_url( __FILE__ ) . 'images/image-4.jpg' ;
            ?>"/>
            <h4>Image Attributes</h4>
            <p>Set custom alt and title attribute for the image inside the module settings.</p>
          </div>
        </div>

        <div class="lwp-flex-container lwp-features">
          <div>
            <h3 class="lwp-subheading">Free Features</h3>
            <ul>
              <li>* Visual Builder Supported</li>
              <li>* Slide Effect</li>
              <li>* Zoom Effect</li>
              <li>* Fade Effect</li>
              <li><strong>* Many more options</strong></li>
            </ul>
          </div>
          <div>
            <h3 class="lwp-subheading">Pro Features</h3>
            <ul>
              <li>* Option to add a Button</li>
              <li>* Option style Button</li>
              <li>* Option to add an Icon</li>
              <li>* Option to style Icon</li>
            </ul>
            <a class="lwp-button" href="<?php 
            echo  admin_url( 'admin.php?page=lwp_overlay_image-pricing' ) ;
            ?>">Upgrade <strong>$5.99</strong></a>				
          </div>
        </div>

        <h2 class="wrap lwp-heading">More Modules</h2>
        
        <div class="lwp-flex-container lwp-more-modules">
          <div>
            <h3>Divi Breadcrumbs</h3>
            <p>Easily add breadcrumbs to your website using a breadcrumbs module.</p>
            <a href="https://wordpress.org/plugins/breadcrumbs-divi-module/" class="lwp-button" target="_blank">Download</a>
            <a href="https://www.learnhowwp.com/divi-breadcrumbs-module/" class="lwp-button lwp-btn-demo" target="_blank">Demo</a>
          </div>
          <div>
            <h3>Divi Flip Cards</h3>
            <p>Easily add flip cards to your website using a flip cards module.</p>				
            <a href="https://wordpress.org/plugins/flip-cards-module-divi/" class="lwp-button" target="_blank">Download</a>
            <a href="https://www.learnhowwp.com/divi-flip-cards-plugin/" class="lwp-button lwp-btn-demo" target="_blank">Demo</a>
          </div>
          <div>
            <h3>Divi Image Carousel</h3>
            <p>Easily add image carousel to your website using an image carousel module.</p>				
            <a href="https://wordpress.org/plugins/image-carousel-divi/" class="lwp-button" target="_blank">Download</a>
            <a href="https://www.learnhowwp.com/divi-image-carousel-plugin/" class="lwp-button lwp-btn-demo" target="_blank">Demo</a>
          </div>						
          <div>
            <h3>Divi Post Carousel</h3>
            <p>Easily add post carousel to your website using the post carousel module.</p>				
            <a href="https://wordpress.org/plugins/post-carousel-divi/" class="lwp-button" target="_blank">Download</a>
            <a href="https://www.learnhowwp.com/divi-post-carousel/" class="lwp-button lwp-btn-demo" target="_blank">Demo</a>
          </div>						
        </div>

        </div>
    
        <?php 
        }
    
    }
    
    if ( !function_exists( 'lwp_overlay_options_page' ) ) {
        add_action( 'admin_menu', 'lwp_overlay_options_page' );
        function lwp_overlay_options_page()
        {
            add_menu_page(
                'Divi Overlay Image',
                'Overlay Image',
                'manage_options',
                'lwp_overlay_image',
                'lwp_overlay_image_page_html',
                'dashicons-format-image',
                100
            );
        }
    
    }

}

/*
Rating
*/

if ( !function_exists( 'lwp_overlay_image_activation_time' ) ) {
    function lwp_overlay_image_activation_time()
    {
        $get_activation_time = strtotime( "now" );
        add_option( 'lwp_overlay_image_activation_time', $get_activation_time );
    }
    
    register_activation_hook( __FILE__, 'lwp_overlay_image_activation_time' );
}


if ( !function_exists( 'lwp_overlay_image_check_installation_time' ) ) {
    function lwp_overlay_image_check_installation_time()
    {
        $install_date = get_option( 'lwp_overlay_image_activation_time' );
        $spare_me = get_option( 'lwp_overlay_image_spare_me' );
        $past_date = strtotime( '-7 days' );
        if ( $past_date >= $install_date && $spare_me == false ) {
            add_action( 'admin_notices', 'lwp_overlay_image_rating_admin_notice' );
        }
    }
    
    add_action( 'admin_init', 'lwp_overlay_image_check_installation_time' );
}

if ( !function_exists( 'lwp_overlay_image_rating_admin_notice' ) ) {
    /*
    Display Admin Notice, asking for a review
    */
    function lwp_overlay_image_rating_admin_notice()
    {
        $dont_disturb = esc_url( get_admin_url() . '?lwp_overlay_image_spare_me=1' );
        $dont_show = esc_url( get_admin_url() . '?lwp_overlay_image_spare_me=1' );
        $plugin_info = 'Divi Overlay Image';
        $reviewurl = esc_url( 'https://wordpress.org/support/plugin/overlay-image-divi-module/reviews/?filter=5' );
        printf(
            __( '<div class="wrap notice notice-info">
                          <div style="margin:10px 0px;">
                              Hello! Seems like you are using <strong> %s </strong> plugin to build your Divi website - Thanks a lot! Could you please do us a BIG favor and give it a 5-star rating on WordPress? This would boost our motivation and help other users make a comfortable decision while choosing the plugin.
                          </div>	
                          <div class="button-group" style="margin:10px 0px;">
                              <a href="%s" class="button button-primary" target="_blank" style="margin-right:10px;">Ok,you deserve it</a>
                              <span class="dashicons dashicons-smiley"></span><a href="%s" class="button button-link" style="margin-right:10px; margin-left:3px;">I already did</a>
                              <a href="%s" class="button button-link"> Don\'t show this again.</a>							
                          </div>
                      </div>', 'lwp-overlay-images' ),
            $plugin_info,
            $reviewurl,
            $dont_disturb,
            $dont_show
        );
    }

}

if ( !function_exists( 'lwp_overlay_image_spare_me' ) ) {
    function lwp_overlay_image_spare_me()
    {
        
        if ( isset( $_GET['lwp_overlay_image_spare_me'] ) && !empty($_GET['lwp_overlay_image_spare_me']) ) {
            $lwp_overlay_image_spare_me = $_GET['lwp_overlay_image_spare_me'];
            if ( $lwp_overlay_image_spare_me == 1 ) {
                add_option( 'lwp_overlay_image_spare_me', TRUE );
            }
        }
    
    }
    
    add_action( 'admin_init', 'lwp_overlay_image_spare_me', 5 );
}


if ( !function_exists( 'lwp_overlay_images_add_icons' ) ) {
    add_filter( 'et_global_assets_list', 'lwp_overlay_images_add_icons', 10 );
    function lwp_overlay_images_add_icons( $assets )
    {
        if ( isset( $assets['et_icons_all'] ) && isset( $assets['et_icons_fa'] ) ) {
            return $assets;
        }
        $assets_prefix = et_get_dynamic_assets_path();
        $assets['et_icons_all'] = array(
            'css' => "{$assets_prefix}/css/icons_all.css",
        );
        $assets['et_icons_fa'] = array(
            'css' => "{$assets_prefix}/css/icons_fa_all.css",
        );
        return $assets;
    }

}
