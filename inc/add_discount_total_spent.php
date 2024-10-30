<?php
// DISCOUNT FOR ORDERS PRICE TOTAL
add_action( 'woocommerce_cart_calculate_fees','wld_add_discount_total_spent', 20, 1 );
function wld_add_discount_total_spent( $cart_object ) {

	$get_options = get_option('woo_loyalty_discounts_options');
	$option_total_discount_amount = woo_loyalty_discounts_get_option('woo_loyalty_discounts_1_field_discount_amount');
	$option_total_type = woo_loyalty_discounts_get_option('woo_loyalty_discounts_1_field_type');
	$option_total_label = woo_loyalty_discounts_get_option('woo_loyalty_discounts_1_field_label');
	$option_total_order_amount = woo_loyalty_discounts_get_option('woo_loyalty_discounts_1_field_order_amount');

	if($option_total_type != "shipping") {

		if(wld_check_discount_total_spent()) {

			$discountamount = $option_total_discount_amount;
			$cart_total = $cart_object->subtotal_ex_tax;

			if($option_total_label == "" ) {
				if($option_total_type == "fixed") {
					$label_text = __( "Loyalty Discount (". get_woocommerce_currency_symbol() . $option_total_discount_amount . "): Lifetime total spent over " . get_woocommerce_currency_symbol() . $option_total_order_amount );
				}
				if($option_total_type == "percentage") {
					$label_text = __( "Loyalty Discount (". $option_total_discount_amount . "%): Lifetime total spent over " . get_woocommerce_currency_symbol() . $option_total_order_amount );
				}
			} else {
				$label_text = $option_total_label;
			}
			
			// Calculation
			if ($option_total_type == "percentage" ||  $option_total_type == "") {
				$discount = number_format(($cart_total / 100) * $discountamount, 2);
			} elseif ($option_total_type == "fixed") {
				$discount = $option_total_discount_amount;
			}
			
			// Add the discount
			$cart_object->add_fee( $label_text, -$discount, false );

		}

	}
	
}

// FREE SHIPPING FOR ORDERS PRICE TOTAL
function filter_woocommerce_package_rates( $rates, $package ) {

	if(wld_check_discount_total_spent()) {

		$option_total_label = woo_loyalty_discounts_get_option('woo_loyalty_discounts_1_field_label');
		if(!$option_total_label) { $option_total_label = "Free"; }

		$cart_total = WC()->cart->cart_contents_total;
		foreach ( $rates as $rate_key => $rate ) {
			// Append rate label titles
			$rates[$rate_key]->label .= ' (' . $option_total_label . ')';
			// Set rate cost
			$rates[$rate_key]->cost = 0;
			// Set taxes rate cost (if enabled)
			$taxes = array();
			foreach ( $rates[$rate_key]->taxes as $key => $tax ) {
				if ( $rates[$rate_key]->taxes[$key] > 0 ) {
					$taxes[$key] = 0;
				}
			}
			$rates[$rate_key]->taxes = $taxes;
		}

	}

    return $rates;
	
}
add_filter( 'woocommerce_package_rates','filter_woocommerce_package_rates', 10, 2 );

/*
* Function to check if discount show be applied
*/
function wld_check_discount_total_spent() {

	$get_options = get_option('woo_loyalty_discounts_options');
	$option_enable_discount_total = woo_loyalty_discounts_get_option('woo_loyalty_discounts_1_field_total_order');
	$option_total_order_amount = woo_loyalty_discounts_get_option('woo_loyalty_discounts_1_field_order_amount');
	$option_total_discount_amount = woo_loyalty_discounts_get_option('woo_loyalty_discounts_1_field_discount_amount');
	$option_total_type = woo_loyalty_discounts_get_option('woo_loyalty_discounts_1_field_type');
	$option_total_label = woo_loyalty_discounts_get_option('woo_loyalty_discounts_1_field_label');
	$option_total_role = woo_loyalty_discounts_get_option('woo_loyalty_discounts_1_field_role');
	
	global $woocommerce;
	
	$allowed_roles = $option_total_role;
	if( wld_check_role($allowed_roles) ) {
	
		if($option_enable_discount_total == "1") {

			$currentuserid = get_current_user_id();
			$totalspent = wld_get_total_spent($currentuserid);
				
			//Apply discount
			if($totalspent >= $option_total_order_amount) {
				return true;
			}

		}
	}
	
	return false;

}

/*
* Function to get users total spent lifetime.
*/
function wld_get_total_spent($currentuserid) {
    $customer_orders = get_posts( array(
        'numberposts' => - 1,
        'meta_key'    => '_customer_user',
        'meta_value'  => $currentuserid,
        'post_type'   => array( 'shop_order' ),
        'post_status' => array( 'wc-completed' )
    ) );
    $total = 0;
	$totalspent = 0;
    foreach ( $customer_orders as $customer_order ) {
        $order = wc_get_order( $customer_order );
        $totalspent += $order->get_total();
    }
	return $totalspent;
}