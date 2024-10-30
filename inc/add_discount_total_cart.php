<?php
// DISCOUNT FOR CART TOTAL
add_action( 'woocommerce_cart_calculate_fees','wld_add_discount_total_cart', 20, 1 );
function wld_add_discount_total_cart( $cart_object ) {
	
	$get_options = get_option('woo_loyalty_discounts_options');
	//2
	$option_enable_discount_cart = woo_loyalty_discounts_get_option('woo_loyalty_discounts_2_field_total_cart');
	$option_cart_order_amount = woo_loyalty_discounts_get_option('woo_loyalty_discounts_2_field_order_amount');
	$option_cart_discount_amount = woo_loyalty_discounts_get_option('woo_loyalty_discounts_2_field_discount_amount');
	$option_cart_type = woo_loyalty_discounts_get_option('woo_loyalty_discounts_2_field_type');
	$option_cart_label = woo_loyalty_discounts_get_option('woo_loyalty_discounts_2_field_label');
	$option_cart_role = woo_loyalty_discounts_get_option('woo_loyalty_discounts_2_field_role');
	
	global $woocommerce;
	
	$allowed_roles = $option_cart_role;
	if( wld_check_role($allowed_roles) ) {
	
		if($option_enable_discount_cart == "1") {

			$discountamount = $option_cart_discount_amount;
			$cart_total = $cart_object->subtotal_ex_tax;
			
			if($option_cart_label == "" ) {
				if($option_cart_type == "fixed") {
					$label_text = __( get_woocommerce_currency_symbol() . $option_cart_discount_amount . " discount: Cart total over " . get_woocommerce_currency_symbol() . $option_cart_order_amount . "");
				}
				if($option_cart_type == "percentage") {
					$label_text = __( $option_cart_discount_amount . "% discount: Cart over " . get_woocommerce_currency_symbol() . $option_cart_order_amount . "");
				}
			} else {
				$label_text = $option_cart_label;
			}
			
			// Calculation
			if($cart_total >= $option_cart_order_amount) {
				if ($option_cart_type == "percentage" ||  $option_cart_type == "") {
					$discount = number_format(($cart_total / 100) * $discountamount, 2);
				} elseif ($option_cart_type == "fixed") {
					$discount = $discountamount;
				}
				
				// Add the discount
				$cart_object->add_fee( $label_text, -$discount, false );
			}
			
		}
		
	}
	
}