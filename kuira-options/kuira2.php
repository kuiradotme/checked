<?php 


function arnob_option_menu(){
	add_menu_page(
	'Option Page Title Arnob',
	'Arnob Menu',
	'administrator',
	'arnob-slug',
	'arnob_option_display'
 );

}
add_action( 'admin_menu', 'arnob_option_menu' );



function all_fields_callback_functions() {
	$defaul = array(
		'first_field_arnob' => 'arnob',
		'second_field_arnob' => 'arnob',
		'third_field_arnob' => '',
		'forth_field_arnob' => ''
		);
	return apply_filters( 'all_fields_callback_functions', $defaul );
}



function arnob_option_display(){
	?>
		<h1><?php _e( 'Arnob Option Settings', 'WPPPU' ); ?></h1>

		<div class="wrap">
			<?php settings_errors(); ?>

			<form action="options.php" method="post">
				<?php 

					settings_fields( 'arnob_option_section' );
					do_settings_sections( 'arnob_option_section' );
					submit_button();

				 ?>

			</form>
		</div>

	<?php
}


function first_option_work_callback(){
	echo "";
}


function first_field_a_callback(){
	$options_armpn = get_option( 'arnob_option_section' );

	?>
	<input type="text" name="arnob_option_section[first_field_arnob]" value="<?php echo $options_armpn['first_field_arnob'] ?>">
	<?php
}

function second_field_a_callback() {
	$options = get_option( 'arnob_option_section' );

	?>

	<textarea name="arnob_option_section[second_field_arnob]"><?php echo $options['second_field_arnob'] ?></textarea>

	<?php
}


function select_valuesfsdfsdf(){
	$select_val = array(
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

	return apply_filters( 'select_valuesfsdfsdf',  $select_val );
}



function third_field_a_callback(){
	$options = get_option( 'arnob_option_section' );



?>

<select  id="third_field_arnob" name="arnob_option_section[third_field_arnob]">
	<?php
		$selected = $options['third_field_arnob'];
		$p = '';
		$r = '';

		foreach ( select_valuesfsdfsdf() as $option ) {
			$label = $option['label'];
			if ( $selected == $option['value'] ) // Make default first in list
				$p = "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
			else
				$r .= "\n\t<option style=\"padding-right: 10px;\" value='" . esc_attr( $option['value'] ) . "'>$label</option>";
		}
		echo $p . $r;
	?>
</select>

<?php


}



function radio_valuesfsdfsdf(){
	$radio_val = array(
		array(
			'value' => 'radio_1',
			'label' => 'radio one'
		),
		array(
			'value' => 'radio_2',
			'label' => 'radio two'
		),
		array(
			'value' => 'radio_3',
			'label' => 'radio three'
		),
		array(
			'value' => 'radio_4',
			'label' => 'radio four'
		)
	);

	return apply_filters( 'radio_valuesfsdfsdf',  $radio_val );
}




function forth_field_a_callback(){
	$options = get_option( 'arnob_option_section' );
	$checked = $options['forth_field_arnob'];

		foreach (radio_valuesfsdfsdf() as $radio_option) {
			$label_radio = $radio_option['label'];
			$value_radio = $radio_option['value'];

				?>
				<input type="radio" name="arnob_option_section[forth_field_arnob]" value="<?php echo $value_radio ?>" <?php checked( $value_radio, $options['forth_field_arnob'], true ) ?>><?php echo $label_radio; ?>
				<?php


		}


}



function arnob_option_init(){
	register_setting(
		'arnob_option_section',
		'arnob_option_section',
		'kuira_opions_valide_arnob'
 	);

 	add_settings_section(
 		'first_option_work_arnob',
 		'All section',
 		'first_option_work_callback',
 		'arnob_option_section'
	 );

 	add_settings_field(
 		'first_field_arnob',
 		'Facebool Url',
 		'first_field_a_callback',
 		'arnob_option_section',
 		'first_option_work_arnob'

 	 );

 	add_settings_field(
 		'second_field_arnob',
 		'Write your description here',
 		'second_field_a_callback',
 		'arnob_option_section',
 		'first_option_work_arnob'

 	 );

 	add_settings_field(
 		'third_field_arnob',
 		'Write your description here',
 		'third_field_a_callback',
 		'arnob_option_section',
 		'first_option_work_arnob'

 	 );

 	add_settings_field(
 		'forth_field_arnob',
 		'Write your description here',
 		'forth_field_a_callback',
 		'arnob_option_section',
 		'first_option_work_arnob'

 	 );


}

add_action( 'admin_init', 'arnob_option_init' );





function kuira_opions_valide_arnob( $input ) {

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
	return apply_filters( 'kuira_opions_valide_arnob', $output, $input );

} // end sandbox_theme_validate_input_examples

	

 ?>