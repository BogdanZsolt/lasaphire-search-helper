<?php
/**
 * Init Styles & scripts
 *
 * @return void
*/
function lsq_public_styles_scripts(){
	wp_enqueue_style( 'lsq-public-style', LSQ_URL . 'public/public.css', '', '');
	wp_register_script( 'lsq-public-script', LSQ_URL . 'public/public.js', null, '', true );
	wp_localize_script( 'lsq-public-script', 'sHelperData', array(
		'site_url' => get_site_url(),
		'ajax_url'		=> admin_url('admin-ajax.php'),
		'sec'				=> wp_create_nonce('get-product-query'),
	));
	wp_enqueue_script( 'lsq-public-script' );

}
add_action( 'wp_enqueue_scripts', 'lsq_public_styles_scripts' );

//La Saphire Search Helper Woocommerce Product Query PHP REST API endpoint
add_action('rest_api_init', 'get_product_query');

function get_product_query(){
	register_rest_route('lasaphire/v1', 'getproduct', array(
		'methods'		=> WP_REST_Server::READABLE,
		'callback'	=> 'getProductCallback',
	));
}


function getProductCallback(){
	$products = new WP_QUERY(array(
		'post_type'	=> 'product',
		'posts_per_page' => 4,
		// 's'									=> sanitize_text_field($data['term']),
	));

	$productResults = array();

	while($products->have_posts()){
		$products->the_post();
		$product = wc_get_product( get_the_id() );
		if($product->is_type('simple')){
			$salePrice = $product->get_sale_price();
			$regularPrice = $product->get_regular_price();
		} elseif ($product->is_type('variable')){
			$salePrice = $product->get_variation_sale_price( 'min', true );
			$regularPrice = $product->get_variation_regular_price( 'max', true );
		} elseif ( $product->get_type() === "grouped") {
			$child_products = $product->get_children();
			foreach ($child_products as $pid) {
				$product = wc_get_product($pid);
				$price = $product->get_price();
  	}
		}
		$description = null;
		if(has_excerpt()){
			$description = wp_trim_words(sanitize_text_field(get_the_excerpt()), 18);
		} else {
			$description = wp_trim_words(get_the_content(), 18);
		}

		array_push($productResults, array(
			'id'											=> get_the_id(),
			'name'									=> $product->get_name(),
			'permalink'				=> get_the_permalink(),
			'image'								=> get_the_post_thumbnail_url(0, 'woocommerce_thumbnail'),
			'description'		=> $description,
			'type'									=> $product->get_type(),
			'categories'			=> $product->get_categories(),
			'categoryIds'		=>	$product->get_category_ids(),
			'tagIds'							=> $product->get_tag_ids(),
			'status'							=> $product->get_status(),
			'price_html'			=> $product->get_price_html(),
			'price'								=> $price,
			'regularPrice'	=> $regularPrice,
			'salePrice' 			=> $salePrice,
		));
	}

	return $productResults;
}
