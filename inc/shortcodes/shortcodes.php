<?php

/**
 * La Saphire Video Modal Wordpress Shortcode
*/

function lsq_load(){
		$return_html = '';
		$return_html .= '
			<section id="lsq_load" class="lsq_load" />
		';
		// $return_html .= '
		// 	<div class="proba container">
		// 		<div class="row justify-content-center">
		// 			<h1 class="text-center">Your Skincare Ritual</h1>
		// 		</div>
		// 	</div>
		// ';
	return $return_html;
}
add_shortcode( 'lasaphire_search_helper', 'lsq_load' );

