<?php
/*
* Add discount to cart based on total items ordered
*/
add_action( 'woocommerce_cart_calculate_fees','wld_add_discount_total_items_ordered', 20, 1 );
function wld_add_discount_total_items_ordered( $cart_object ) {

	$get_options = get_option('woo_loyalty_discounts_options');
	//3
	$option_enable_discount_total_items = woo_loyalty_discounts_get_option('woo_loyalty_discounts_3_field_total_order');
	$option_items_order_amount = woo_loyalty_discounts_get_option('woo_loyalty_discounts_3_field_order_amount');
	$option_items_discount_amount = woo_loyalty_discounts_get_option('woo_loyalty_discounts_3_field_discount_amount');
	$option_items_type = woo_loyalty_discounts_get_option('woo_loyalty_discounts_3_field_type');
	$option_items_label = woo_loyalty_discounts_get_option('woo_loyalty_discounts_3_field_label');
	$option_items_role = woo_loyalty_discounts_get_option('woo_loyalty_discounts_3_field_role');
	
	global $woocommerce;
	
	$allowed_roles = $option_items_role;
	if( wld_check_role($allowed_roles) ) {
		
		if($option_enable_discount_total_items == "1") {

			$totalitemsordered = 0;
			$totalitemsordered = wld_get_total_items_orders();
			
			//Apply discount
			if($totalitemsordered >= $option_items_order_amount) {
		
				$discountamount = $option_items_discount_amount;
				$cart_total = $cart_object->subtotal_ex_tax;

				if($option_items_label == "" ) {
					if($option_items_type == "fixed") {
						$label_text = __( "Loyalty Discount (". get_woocommerce_currency_symbol() . $option_items_discount_amount . "): Lifetime total items ordered over " . $option_items_order_amount );
					}
					if($option_items_type == "percentage") {
						$label_text = __( "Loyalty Discount (". $option_items_discount_amount . "%): Lifetime total items ordered over " . $option_items_order_amount );
					}
				} else {
					$label_text = $option_items_label;
				}
				
				// Calculation
				if ($option_items_type == "percentage" ||  $option_items_type == "") {
					$discount = number_format(($cart_total / 100) * $discountamount, 2);
				} elseif ($option_items_type == "fixed") {
					$discount = $option_items_discount_amount;
				}
				
				// Add the discount
				$cart_object->add_fee( $label_text, -$discount, false );
			}
		
		}
	
	}
	
}

/* 
* Get total items ordered by user
*/
function wld_get_total_items_orders() {

	$totalitemsordered = 0;

	$customer_orders = get_posts( array(
		'numberposts' => - 1,
		'meta_key'    => '_customer_user',
		'meta_value'  => get_current_user_id(),
		'post_type'   => array( 'shop_order' ),
		'post_status' => array( 'wc-completed' )
	) );

	foreach ( $customer_orders as $customer_order ) {
	
		$order = wc_get_order( $customer_order );
		
		foreach ($order->get_items() as $item_id => $item_data) {

			// Get an instance of corresponding the WC_Product object
			$product = $item_data->get_product();
			//$product_name = $product->get_name();

			$item_quantity = $item_data->get_quantity(); // Get the item quantity
			//$item_total = $item_data->get_total(); // Get the item line total
			
			$totalitemsordered += $item_quantity;
		}
	}
	return $totalitemsordered;
}