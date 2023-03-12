<?php

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * HELPER COMMENT START
 * 
 * This class is used to bring your plugin to life. 
 * All the other registered classed bring features which are
 * controlled and managed by this class.
 * 
 * Within the add_hooks() function, you can register all of 
 * your WordPress related actions and filters as followed:
 * 
 * add_action( 'my_action_hook_to_call', array( $this, 'the_action_hook_callback', 10, 1 ) );
 * or
 * add_filter( 'my_filter_hook_to_call', array( $this, 'the_filter_hook_callback', 10, 1 ) );
 * or
 * add_shortcode( 'my_shortcode_tag', array( $this, 'the_shortcode_callback', 10 ) );
 * 
 * Once added, you can create the callback function, within this class, as followed: 
 * 
 * public function the_action_hook_callback( $some_variable ){}
 * or
 * public function the_filter_hook_callback( $some_variable ){}
 * or
 * public function the_shortcode_callback( $attributes = array(), $content = '' ){}
 * 
 * 
 * HELPER COMMENT END
 */

/**
 * Class RR_APX_Shortcodes_Arrests
 *
 * Thats where we bring the plugin to life
 *
 * @package		APIFORAPEX
 * @subpackage	Classes/RR_APX_Shortcodes_Arrests
 * @author		Nolan Perry, LLC
 * @since		1.0.0
 */
class RR_CLET_Shortcodes_Rentals{

	/**
	 * Our RR_APX_Shortcodes_Arrests constructor 
	 * to run the plugin logic.
	 *
	 * @since 1.0.0
	 */
	function __construct(){
		$this->add_hooks();
	}

	/**
	 * ######################
	 * ###
	 * #### WORDPRESS HOOKS
	 * ###
	 * ######################
	 */

	/**
	 * Registers all WordPress and plugin related hooks
	 *
	 * @access	private
	 * @since	1.0.0
	 * @return	void
	 */
	private function add_hooks(){
	add_shortcode( 'show_clet_rentals', array( $this, 'create_clet_rentals_shortcode' ));
    add_action( 'rest_api_init', function () {
  register_rest_route( 'rrclet/v1', '/available', array(
    'methods' => 'GET',
    'callback' => array( $this, 'clet_handler_json' ),
    'permission_callback' => function () {
      return true;
    }
  ) );
} );
	
	}

	public function clet_rentals_templater($data){
if($data->locked == "1"){
    return;
}
	    
return '


<div class="wp-block-media-text alignwide is-stacked-on-mobile" style="grid-template-columns:18% auto">
<figure class="wp-block-media-text__media">
<img src="https://www.casperpanel.com/texture.php?uuid='. $data->availableImage .  '" alt="" class="wp-image-45 size-full"/>
</figure>

<div class="wp-block-media-text__content">
<b>'. $data->unitName .  '</b>

<p class="has-small-font-size">$L '. $data->price . '/' . $data->priceTerm . ' for '. $data->prims .  ' prims. </p>


<p class="has-small-font-size">'. $data->description .  '</p>

<div class="wp-block-buttons"><!-- wp:button -->
<div class="wp-block-button">
<a href="https://maps.secondlife.com/secondlife/'.  urlencode($data->region)  . '/' .  $data->unitX  . '/' .  $data->unitY  . '/' . $data->unitZ .'" target="blank" class="wp-block-button__link wp-element-button">Teleport</a>
</div>
</div>
</div>
</div>


<hr class="wp-block-separator has-alpha-channel-opacity"/>


';	    
	   
	   
	  
	}
	public function create_clet_rentals_shortcode( $atts = array(), $content = '' ) {


$output = '';
$api_key_1 = get_option( 'RRCLET_api_key' ); // Array of All Options

$theurltouse = 'https://www.casperpanel.com/api/rentals.php?accessKey=' . $api_key_1;
$args = array();
$response = wp_remote_get( $theurltouse, $args );

$bodyofchrist =  wp_remote_retrieve_body( $response );
$d1 = json_decode(substr($bodyofchrist,5));
$d2 = $d1->availableUnits;

foreach($d2 as $query){
$addon = $this->clet_rentals_templater($query);
$output .= $addon;
}


return $output;
}

public function clet_handler_json(WP_REST_Request $request) {

$api_key_1 = get_option( 'RRCLET_api_key' ); // Array of All Options

$theurltouse = 'https://www.casperpanel.com/api/rentals.php?accessKey=' . $api_key_1;
$args = array();
$response = wp_remote_get( $theurltouse, $args );

$bodyofchrist =  wp_remote_retrieve_body( $response );
$d1 = json_decode(substr($bodyofchrist,5));
$d2 = $d1->availableUnits;


 return new WP_REST_Response(
      array(
        'status' => 200,
        'response' => '',
        'data' => $d2
));
}
	

}


