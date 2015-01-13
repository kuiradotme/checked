<?php 
// kuira options
function kuira_options_dilamna(){

	add_theme_page(
		'options page title', // browser title
		'kuira options',
		'administrator',
		'kuira_options', // slug
		'kuira_options_display'
		);
	add_menu_page( 
		'options page title', // browser title
		'kuira options',
		'administrator',
		'kuira_options', // slug
		'kuira_options_display',
		'dashicons-welcome-learn-more' // icon
	 );

	add_options_page(
		'options page title', // browser title
		'kuira options',
		'administrator',
		'kuira_options', // slug
		'kuira_options_display'
	 );
	add_plugins_page(
		'options page title', // browser title
		'kuira options',
		'administrator',
		'kuira_options', // slug
		'kuira_options_display'
	 );
	add_users_page( 
		'options page title', // browser title
		'kuira options',
		'administrator',
		'kuira_options', // slug
		'kuira_options_display'
		);
	add_media_page(
		'options page title', // browser title
		'kuira options',
		'administrator',
		'kuira_options', // slug
		'kuira_options_display' );

}
add_action('admin_menu' , 'kuira_options_dilamna');


function all_filed_defaul_callback() {
	$defaul = array(
		'first_filed' => 'kuira',
		'textarea_filed' => 'kuira',
		'select_filed' => '',
		'arnob_text_filed' => 'kuiras'
		);
	return apply_filters( 'all_filed_defaul_callback', $defaul );
}

function kuira_options_display() {
	?>

	<h2><?php _e('kuira options page', 'wpppu') ?></h2>
	<div class="wrap">
		<?php settings_errors(); ?>

		<form action="options.php" method="post">
			<?php 
				settings_fields( 'faul_options_section' );
				do_settings_sections( 'faul_options_section' );
				submit_button();
			 ?>
		</form>
	</div>

	<?php
}

function first_kuira_sec() {
	echo 'we are not real kuira';
}

function first_filed_callback(){
	$options = get_option( 'faul_options_section' );

	?>
	<input type="text" name="faul_options_section[first_filed]" value="<?php echo $options['first_filed'] ?>">
	<?php
}

function textarea_field_callfunc() {
	$options = get_option( 'faul_options_section' );

	?>
	<textarea name="faul_options_section[textarea_filed]"><?php echo $options['textarea_filed'] ?></textarea>
	<?php
}

function select_values() {
	$select_valu = array(
		array(
			'value' => 'select_1',
			'label' => 'select one'
		),
		array(
			'value' => 'select_2',
			'label' => 'select two'
		),
		array(
			'value' => 'select_3',
			'label' => 'select three'
		),
		array(
			'value' => 'select_4',
			'label' => 'select four'
		)
	);

	return apply_filters( 'select_values',  $select_valu );
}

function select_field_callfunc() {
	$options = get_option( 'faul_options_section' );
?>
<select  id="select_filed" name="faul_options_section[select_filed]">
	<?php
		$selected = $options['select_filed'];
		$p = '';
		$r = '';

		foreach ( select_values() as $option ) {
			$label = $option['label'];
			if ( $selected == $option['value'] ) // Make default first in list
				$p = "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
			else
				$r .= "\n\t<option style=\"padding-right: 10px;\" value='" . esc_attr( $option['value'] ) . "'>$label</option>";
		}
		echo $p . $r;
	?>
</select>
<?php }


function arnob_text_f_callback(){
	$options = get_option( 'faul_options_section' );

	?>
	<input type="text" name="faul_options_section[arnob_text_filed]" value="<?php echo $options['arnob_text_filed'] ?>">
	<?php	
}

function kuira_options_init(){

	register_setting(
		'faul_options_section', // settings api
		'faul_options_section', // opions name
		'kuira_opions_valide'
		);

	add_settings_section(
		'fist_options_work', // section id
		'First Options Sec',
		'first_kuira_sec', // function call back
		'faul_options_section' // $page
	 );

	add_settings_field(
		'first_filed',
		'First Field',
		'first_filed_callback',
		'faul_options_section', // $page
		'fist_options_work' // section id
	 );

	add_settings_field(
		'textarea_filed',
		'textare Field',
		'textarea_field_callfunc',
		'faul_options_section', // $page
		'fist_options_work' // section id
	 );

	add_settings_field(
		'select_filed',
		'select Field',
		'select_field_callfunc',
		'faul_options_section', // $page
		'fist_options_work' // section id
	 );

	add_settings_field(
		'arnob_text_filed',
		'Arnob Text Field',
		'arnob_text_f_callback',
		'faul_options_section', // $page
		'fist_options_work' // section id
	 );

}

add_action('admin_init', 'kuira_options_init');


function kuira_opions_valide( $input ) {

	// Create our array for storing the validated options
	$output = array();
	
	// Loop through each of the incoming options
	foreach( $input as $key => $value ) {
		
		// Check to see if the current option has a value. If so, process it.
		if( isset( $input[$key] ) ) {
		
			// Strip all HTML and PHP tags and properly handle quoted strings
			$output[$key] = strip_tags( stripslashes( $input[ $key ] ) );
			
		} // end if
		
	} // end foreach
	
	// Return the array processing any additional functions filtered by this action
	return apply_filters( 'kuira_opions_valide', $output, $input );

} // end sandbox_theme_validate_input_examples