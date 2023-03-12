<?php

class RRCLET_Options {
	private $RRCLET_apikey;
	public function __construct() {
		
	}
public function RRCLET_register_stuff(){
    add_action( 'admin_menu', array( $this, 'RRCLET_add_plugin_page' ) );
	add_action( 'admin_init', array( $this, 'RRCLET_page_init' ) );
}
	public function RRCLET_add_plugin_page() {
		add_options_page(
			'rrclet', // page_title
			'rrclet', // menu_title
			'manage_options', // capability
			'rrclet', // menu_slug
			array( $this, 'RRCLET_create_admin_page' ) // function
		);
	}

	public function RRCLET_create_admin_page() {
		$this->RRCLET_apikey = get_option('RRCLET_apikey');
		
		?>

		<div class="wrap">
			<h2>CasperLet</h2>
			<p>Settings for CasperLet</p>
			<?php settings_errors(); ?>

			<form method="post" action="options.php">
				<?php
					settings_fields( 'RRCLET_group' );
					do_settings_sections( 'rrclet' );
					submit_button();
				?>
			</form>
		</div>
	<?php }

	public function RRCLET_page_init() {
		register_setting(
			'RRCLET_group', // option_group
			'RRCLET_api_key', // option_name
			array( $this, 'RRCLET_sanitize' ) // sanitize_callback
		);
	

		add_settings_section(
			'RRCLET_settings_section', // id
			'Settings', // title
			array( $this, 'RRCLET_section_info' ), // callback
			'rrclet' // page
		);
     add_settings_field(
			'RRCLET_api_key', // id
			'RRCLET_api_key', // title
			array( $this, 'RRCLET_api_key_callback' ), // callback
			'rrclet', // page
			'RRCLET_settings_section' // section
		);

	
	}

	public function RRCLET_sanitize($input) {
return	sanitize_text_field( $input );
	
	}

	public function RRCLET_section_info() {
		echo "Testing";
	}

	public function RRCLET_api_key_callback() {
		printf(
			'<input class="regular-text" type="text" name="RRCLET_api_key" id="RRCLET_api_key" value="%s">',
			isset( $this->RRCLET_apikey ) ? esc_attr( $this->RRCLET_apikey) : ''
		);
	}



}
if ( is_admin() )
	$rrcletoptions = new RRCLET_Options();

