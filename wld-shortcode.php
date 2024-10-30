<?php
// Progress Bar
add_action( 'wld_after_sc_discount_header', 'wld_progress_bar', 10, 2 );
function wld_progress_bar($totalspent, $option_total_order_amount) {
	$progress = ($totalspent / $option_total_order_amount);
	if($progress > 1) { $progress = 1; }
	echo "<div class='progress-bar-container'>";
	echo "<div class='progress-bar' style='width: " . ($progress * 100) . "%;' data-visible='" . ($progress > 0 ? "true" : "false") . "'></div>";
	echo "<div class='progress-text'>" . round($progress * 100, 2) . "%</div>";
	echo "</div>";
}

// Shortcode
function wld_discountinfo( $atts ) {

  	if( !is_admin() ) {

		ob_start();

		$get_options = get_option('woo_loyalty_discounts_options');
		global $woocommerce;
		
		//1
		$option_enable_discount_total = woo_loyalty_discounts_get_option('woo_loyalty_discounts_1_field_total_order');
		$option_total_order_amount = woo_loyalty_discounts_get_option('woo_loyalty_discounts_1_field_order_amount');
		$option_total_discount_amount = woo_loyalty_discounts_get_option('woo_loyalty_discounts_1_field_discount_amount');
		$option_total_type = woo_loyalty_discounts_get_option('woo_loyalty_discounts_1_field_type');
		$option_total_label = woo_loyalty_discounts_get_option('woo_loyalty_discounts_1_field_label');
		$option_total_role = woo_loyalty_discounts_get_option('woo_loyalty_discounts_1_field_role');
		
		//2
		$option_enable_discount_cart = woo_loyalty_discounts_get_option('woo_loyalty_discounts_2_field_total_cart');
		$option_cart_order_amount = woo_loyalty_discounts_get_option('woo_loyalty_discounts_2_field_order_amount');
		$option_cart_discount_amount = woo_loyalty_discounts_get_option('woo_loyalty_discounts_2_field_discount_amount');
		$option_cart_type = woo_loyalty_discounts_get_option('woo_loyalty_discounts_2_field_type');
		$option_cart_label = woo_loyalty_discounts_get_option('woo_loyalty_discounts_2_field_label');
		$option_cart_role = woo_loyalty_discounts_get_option('woo_loyalty_discounts_2_field_role');
		
		//3
		$option_enable_discount_total_items = woo_loyalty_discounts_get_option('woo_loyalty_discounts_3_field_total_order');
		$option_items_order_amount = woo_loyalty_discounts_get_option('woo_loyalty_discounts_3_field_order_amount');
		$option_items_discount_amount = woo_loyalty_discounts_get_option('woo_loyalty_discounts_3_field_discount_amount');
		$option_items_type = woo_loyalty_discounts_get_option('woo_loyalty_discounts_3_field_type');
		$option_items_label = woo_loyalty_discounts_get_option('woo_loyalty_discounts_3_field_label');
		$option_items_role = woo_loyalty_discounts_get_option('woo_loyalty_discounts_3_field_role');

		// ************ Discount 1
		$allowed_roles = $option_total_role;
		if( wld_check_role($allowed_roles) || !$allowed_roles) {
			$label_text1 = "";
			
			if($option_enable_discount_total == "1") {
				echo "<div class='discount_box discount_total'>";
				
					if(!$option_total_label) {
						if($option_total_type == "fixed") {
							$label_text1 = __( "". get_woocommerce_currency_symbol() . $option_total_discount_amount . " discount: Lifetime total spent over " . get_woocommerce_currency_symbol() . $option_total_order_amount );
						}
						if($option_total_type == "percentage") {
							$label_text1 = __( "". $option_total_discount_amount . "% discount: Lifetime total spent over " . get_woocommerce_currency_symbol() . $option_total_order_amount );
						}
						if($option_total_type == "shipping") {
							$label_text1 = __( "Free Shipping: Lifetime total spent over " . get_woocommerce_currency_symbol() . $option_total_order_amount );
						}
					} else {
						$label_text1 = $option_total_label;
					}

					echo "<h3>" . $label_text1 . "</h3>";

					$currentuserid = get_current_user_id();
					$totalspent = wld_get_total_spent($currentuserid);

					do_action('wld_after_sc_discount_header', $totalspent, $option_total_order_amount);

					if ($totalspent >= $option_total_order_amount) {
						echo "<p style='color: green; font-weight: bold;'>Congratulations, you qualify for this discount! It will be applied automatically at checkout.</p>";
					} else {
						echo "<p style='color: red; font-weight: bold;'>You do not qualify for this discount.</p>";
					}

					if(function_exists('get_woocommerce_currency_symbol')) {
						echo "<p>";
						echo "- Required amount to qualify: " . get_woocommerce_currency_symbol() . $option_total_order_amount . "<br/>";
						echo "- Your total spend: " . get_woocommerce_currency_symbol() . $totalspent . "<br/>";
						if ($totalspent < $option_total_order_amount) {
						echo "- Total remaining to qualify: " . get_woocommerce_currency_symbol() . ($option_total_order_amount - $totalspent) . "<br/>";
						}
						echo "</p>";
					}
				echo "</div>";
			}
			
		}
		
		// ************ Discount 2
		
		$allowed_roles2 = $option_cart_role;
		if( wld_check_role($allowed_roles2) || !$allowed_roles) {
			$label_text2 = "";
			
			if($option_enable_discount_cart == "1") {
				echo "<br/>";
				echo "<div class='discount_box discount_cart'>";
					
					if(!$option_cart_label) {
						if($option_cart_type == "fixed") {
							$label_text2 = __( get_woocommerce_currency_symbol() . $option_cart_discount_amount . " discount: Cart total over " . get_woocommerce_currency_symbol() . $option_cart_order_amount . "");
						}
						if($option_cart_type == "percentage") {
							$label_text2 = __( $option_cart_discount_amount . "% discount: Cart over " . get_woocommerce_currency_symbol() . $option_cart_order_amount . "");
						}
						if($option_total_type == "shipping") {
							$label_text1 = __( "Free Shipping: Cart over " . get_woocommerce_currency_symbol() . $option_cart_order_amount . "");
						}
					} else {
						$label_text2 = $option_cart_label;
					}
					
					echo "<h3>" . $label_text2 . "</h3>";

					$currentuserid = get_current_user_id();
					$cart_total = $woocommerce->cart->subtotal_ex_tax;

					do_action('wld_after_sc_discount_header', $cart_total, $option_cart_order_amount);

					if($cart_total >= $option_cart_order_amount) {
						echo "<p style='color: green; font-weight: bold;'>Congratulations, you qualify for this discount! It will be applied automatically at checkout.</p>";
					} else {
						echo "<p style='color: red; font-weight: bold;'>You do not qualify for this discount.</p>";
					}
					if(function_exists('get_woocommerce_currency_symbol')) {
						echo "<p>";
						echo "- Required cart total to qualify: " . get_woocommerce_currency_symbol() . $option_cart_order_amount . "<br/>";
						echo "- Your current cart: " . get_woocommerce_currency_symbol() . $cart_total . "<br/>";
						if($cart_total < $option_cart_order_amount) {
							echo "- Total remaining to qualify: " . get_woocommerce_currency_symbol() . ($option_cart_order_amount - $cart_total) . "<br/>";
						}
						echo "</p>";
					}
				echo "</div>";
			}
			
		}
		
		// ************ Discount 3
		
		$allowed_roles3 = $option_total_role;
		echo $allowed_roles;
		if( wld_check_role($allowed_roles3) || !$allowed_roles) {
			$label_text3 = "";
			
			if($option_enable_discount_total_items == "1") {
				echo "<br/>";
				echo "<div class='discount_box discount_total_items'>";
				
					if($option_items_label == "" ) {
						if($option_items_type == "fixed") {
							$label_text3 = __( "". get_woocommerce_currency_symbol() . $option_items_discount_amount . " discount: Lifetime total items ordered over " . $option_items_order_amount );
						}
						if($option_items_type == "percentage") {
							$label_text3 = __( "". $option_items_discount_amount . "% discount: Lifetime total items ordered over " . $option_items_order_amount );
						}
						if($option_total_type == "shipping") {
							$label_text1 = __( "Free Shipping: Lifetime total items ordered over " . $option_items_order_amount);
						}
					} else {
						$label_text3 = $option_items_label;
					}

					echo "<h3>" . $label_text3 . "</h3>";

					$totalitemsordered = wld_get_total_items_orders();

					do_action('wld_after_sc_discount_header', $totalitemsordered, $option_items_order_amount);
					
					if($totalitemsordered >= $option_items_order_amount) {
						echo "<p style='color: green; font-weight: bold;'>Congratulations, you qualify for this discount! It will be applied automatically at checkout.</p>";
					} else {
						echo "<p style='color: red; font-weight: bold;'>You do not qualify for this discount.</p>";
					}
					
					echo "<p>";
					echo "- Required items purchased to qualify: " . $option_items_order_amount . "<br/>";
					echo "- Your total items purchased: " . $totalitemsordered . "<br/>";
					if ($totalitemsordered < $option_items_order_amount) {
					echo "- Total items remaining to qualify: " . ($option_items_order_amount - $totalitemsordered) . "<br/>";
					}
					echo "</p>";
				
				echo "</div>";
			}
			
			$thecontent = ob_get_contents();
			ob_end_clean();

			wp_reset_postdata();

			// Return content removing white spaces
			$thecontent = trim(preg_replace('/\s+/', ' ', $thecontent));
			return $thecontent;
		
		}
		
	}

}
add_shortcode( 'loyalty-discount-info', 'wld_discountinfo' );