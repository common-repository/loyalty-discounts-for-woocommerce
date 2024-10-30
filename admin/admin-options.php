<?php
/**
 * register our woo_loyalty_discounts_settings_init to the admin_init action hook
 */
add_action( 'admin_init', 'woo_loyalty_discounts_settings_init' );
function woo_loyalty_discounts_field_cb( $args ) {
$options = get_option( 'woo_loyalty_discounts_options' );
?>

<hr/>

<h2>Enabled Discounts:</h2><br/>

	<!-- ********** TOTAL ORDER AMOUNT ********** -->
	<p class="wld_discount_option">
		<?php
			$woo_loyalty_discounts_2_show_total_cart = woo_loyalty_discounts_get_option('woo_loyalty_discounts_1_field_total_order');
			$checked2 = ($woo_loyalty_discounts_2_show_total_cart == '1' ? ' checked="checked"' : '');
		?>
		<label class="switch">
			<input type="hidden" value="0" data-custom="custom" name="woo_loyalty_discounts_options[woo_loyalty_discounts_1_field_total_order]" >
			<input type="checkbox" value="1" id="woo_loyalty_discounts_1_field_total_order" data-custom="custom" name="woo_loyalty_discounts_options[woo_loyalty_discounts_1_field_total_order]" <?php echo $checked2; ?>>
			<span class="slider round">
			  <span class="on"><span class="fa-solid fa-check"></span></span>
			  <span class="off"></span>
			</span>
		</label>
		<strong><label for="woo_loyalty_discounts_1_field_total_order">Users lifetime total order amount.</label></strong>
	</p>
	<br/>
	<div id="totalorders-options" class="option-section">
	
	<p>This will add a discount to the users checkout for all future orders, if they have spent over a certain amount from all their past orders.</p>
	
	<p>Order statuses must be marked as "completed" to be counted towards this total.</p><br/>
	
		<div class="woo_loyalty_discounts_settings_box woo_loyalty_discounts_1">
			<p>
				<!-- Order Amount -->
				<strong>Total LIFETIME order amount required:</strong><br/>
				<i class="field-tooltip">How much should the user have SPENT in total (from all previous orders) for this discount?</i><br/>
				<input type="number" value="<?php echo woo_loyalty_discounts_get_option('woo_loyalty_discounts_1_field_order_amount', '0'); ?>" id="<?php echo esc_attr('woo_loyalty_discounts_1_field_order_amount'); ?>" data-custom="<?php echo esc_attr('woo_loyalty_discounts_custom_data'); ?>" name="woo_loyalty_discounts_options[<?php echo esc_attr('woo_loyalty_discounts_1_field_order_amount'); ?>]"><br/>
			</p><br/>
			<p>
				<!-- Order Amount -->
				<strong>Discount amount:</strong><br/>
				<i class="field-tooltip">What discount should they receive on their cart?</i><br/>
				<input type="number" value="<?php echo woo_loyalty_discounts_get_option('woo_loyalty_discounts_1_field_discount_amount', '0'); ?>" id="<?php echo esc_attr('woo_loyalty_discounts_1_field_discount_amount'); ?>" data-custom="<?php echo 			esc_attr('woo_loyalty_discounts_custom_data'); ?>" name="woo_loyalty_discounts_options[<?php echo esc_attr('woo_loyalty_discounts_1_field_discount_amount'); ?>]"><br/>
			</p><br/>
			<p>
				<!-- Order Amount -->
				<strong>Discount Type:</strong><br/>
				<i class="field-tooltip">Should this discount be a percentage of their cart total, or a fixed amount?</i><br/>
				<select id="<?php echo esc_attr('woo_loyalty_discounts_1_field_type'); ?>" data-custom="<?php echo esc_attr('woo_loyalty_discounts_custom_data'); ?>"
					name="woo_loyalty_discounts_options[<?php echo esc_attr('woo_loyalty_discounts_1_field_type'); ?>]">
					<option value="percentage" <?php selected(woo_loyalty_discounts_get_option('woo_loyalty_discounts_1_field_type'), "percentage"); ?>>Percentage</option>
					<option value="fixed" <?php selected(woo_loyalty_discounts_get_option('woo_loyalty_discounts_1_field_type'), "fixed"); ?>>Fixed Amount</option>
					<option value="shipping" <?php selected(woo_loyalty_discounts_get_option('woo_loyalty_discounts_1_field_type'), "shipping"); ?>>Free Shipping</option>
				</select>
			</p><br/>
			<p>
				<!-- Discount Label -->
				<strong>Custom Discount Label:</strong><br/>
				<i class="field-tooltip">Add a custom label for the discount in checkout.</i><br/>
				<input type="text" value="<?php echo woo_loyalty_discounts_get_option('woo_loyalty_discounts_1_field_label', ''); ?>" id="<?php echo esc_attr('woo_loyalty_discounts_1_field_label'); ?>" data-custom="<?php echo esc_attr('woo_loyalty_discounts_custom_data'); ?>" name="woo_loyalty_discounts_options[<?php echo esc_attr('woo_loyalty_discounts_1_field_label'); ?>]"><br/>
				<i>Leave empty for default label.</i>
			</p><br/>
			<p>
				<!-- Discount Role -->
				<strong>Roles:</strong><br/>
				<i class="field-tooltip">Apply this discount to specific user roles. Seperate multiple roles with ",". For example: <strong>customer,member</strong></i><br/>
				<input type="text" value="<?php echo woo_loyalty_discounts_get_option('woo_loyalty_discounts_1_field_role', ''); ?>" id="<?php echo esc_attr('woo_loyalty_discounts_1_field_role'); ?>" data-custom="<?php echo esc_attr('woo_loyalty_discounts_custom_data'); ?>" name="woo_loyalty_discounts_options[<?php echo esc_attr('woo_loyalty_discounts_1_field_role'); ?>]"><br/>
				<i>Leave empty to apply to all roles.</i>
			</p>
		</div>

	</div>
	
	<br/>

	<!-- ********** TOTAL CART ********** -->
	<p class="wld_discount_option">
		<!-- Show/Hide -->
		<?php
			$woo_loyalty_discounts_2_show_total_cart = woo_loyalty_discounts_get_option('woo_loyalty_discounts_2_field_total_cart', '');
			$checked2 = ($woo_loyalty_discounts_2_show_total_cart == '1' ? ' checked="checked"' : '');
		?>
		<label class="switch">
			<input type="hidden" value="0" data-custom="custom" name="woo_loyalty_discounts_options[woo_loyalty_discounts_2_field_total_cart]" >
			<input type="checkbox" value="1" id="woo_loyalty_discounts_2_field_total_cart" data-custom="custom" name="woo_loyalty_discounts_options[woo_loyalty_discounts_2_field_total_cart]" <?php echo $checked2; ?>>
			<span class="slider round">
			<span class="on"><span class="fa-solid fa-check"></span></span>
			<span class="off"></span>
			</span>
		</label>
		<strong><label for="woo_loyalty_discounts_2_field_total_cart">Current total cart amount.</label></strong>
	</p>
	<br/>
	<div id="totalcart-options" class="option-section">

	<p>This will add a discount to the users checkout if their current cart is over a certain price total.</p><br/>

	<div class="woo_loyalty_discounts_settings_box woo_loyalty_discounts_2">
		<p>
			<!-- Order Amount -->
			<strong>Total CART amount required:</strong><br/>
			<i class="field-tooltip">How much should the users cart total be for this discount?</i><br/>
			<input type="number" value="<?php echo woo_loyalty_discounts_get_option('woo_loyalty_discounts_2_field_order_amount', '0'); ?>" id="<?php echo esc_attr('woo_loyalty_discounts_2_field_order_amount'); ?>" data-custom="<?php echo esc_attr('woo_loyalty_discounts_custom_data'); ?>" name="woo_loyalty_discounts_options[<?php echo esc_attr('woo_loyalty_discounts_2_field_order_amount'); ?>]"><br/>
		</p><br/>
		<p>
			<!-- Order Amount -->
			<strong>Discount amount:</strong><br/>
			<i class="field-tooltip">What discount should they receive on their cart?</i><br/>
			<input type="number" value="<?php echo woo_loyalty_discounts_get_option('woo_loyalty_discounts_2_field_discount_amount', '0'); ?>" id="<?php echo esc_attr('woo_loyalty_discounts_2_field_discount_amount'); ?>" data-custom="<?php echo esc_attr('woo_loyalty_discounts_custom_data'); ?>" name="woo_loyalty_discounts_options[<?php echo esc_attr('woo_loyalty_discounts_2_field_discount_amount'); ?>]"><br/>
		</p><br/>
		<p>
			<!-- Order Amount -->
		<strong>Discount Type:</strong><br/>
		<i class="field-tooltip">Should this discount be a percentage of their cart total, or a fixed amount?</i><br/>
		<select id="<?php echo esc_attr('woo_loyalty_discounts_2_field_type'); ?>" data-custom="<?php echo esc_attr('woo_loyalty_discounts_custom_data'); ?>"
			name="woo_loyalty_discounts_options[<?php echo esc_attr('woo_loyalty_discounts_2_field_type'); ?>]">
				<option value="percentage" <?php selected(woo_loyalty_discounts_get_option('woo_loyalty_discounts_2_field_type', ''), "percentage"); ?>>Percentage</option>
				<option value="fixed" <?php selected(woo_loyalty_discounts_get_option('woo_loyalty_discounts_2_field_type', ''), "fixed"); ?>>Fixed Amount</option>
		</select>
		</p><br/>
		<p>
			<!-- Discount Label -->
			<strong>Custom Discount Label:</strong><br/>
			<i class="field-tooltip">Add a custom label for the discount in checkout.</i><br/>
			<input type="text" value="<?php echo woo_loyalty_discounts_get_option('woo_loyalty_discounts_2_field_label', ''); ?>" id="<?php echo esc_attr('woo_loyalty_discounts_2_field_label'); ?>" data-custom="<?php echo esc_attr('woo_loyalty_discounts_custom_data'); ?>" name="woo_loyalty_discounts_options[<?php echo esc_attr('woo_loyalty_discounts_2_field_label'); ?>]"><br/>
			<i>Leave empty for default label.</i>
		</p><br/>
		<p>
			<!-- Discount Role -->
			<strong>Roles:</strong><br/>
			<i class="field-tooltip">Apply this discount to specific user roles. Seperate multiple roles with ",". For example: <strong>customer,member</strong></i><br/>
			<input type="text" value="<?php echo woo_loyalty_discounts_get_option('woo_loyalty_discounts_2_field_role', ''); ?>" id="<?php echo esc_attr('woo_loyalty_discounts_2_field_role'); ?>" data-custom="<?php echo esc_attr('woo_loyalty_discounts_custom_data'); ?>" name="woo_loyalty_discounts_options[<?php echo esc_attr('woo_loyalty_discounts_2_field_role'); ?>]"><br/>
			<i>Leave empty to apply to all roles.</i>
		</p>
	</div>

	</div>

	<br/>

	<!-- ********** TOTAL ITEMS ORDERED AMOUNT ********** -->
	<p class="wld_discount_option">
		<!-- Show/Hide -->
		<?php
			$woo_loyalty_discounts_3_show_total_order = woo_loyalty_discounts_get_option('woo_loyalty_discounts_3_field_total_order', '');
			$checked1 = ($woo_loyalty_discounts_3_show_total_order == '1' ? ' checked="checked"' : '');
		?>
		<label class="switch">
			<input type="hidden" value="0" data-custom="custom" name="woo_loyalty_discounts_options[woo_loyalty_discounts_3_field_total_order]" >
			<input  type="checkbox" value="1" id="woo_loyalty_discounts_3_field_total_order" data-custom="custom" name="woo_loyalty_discounts_options[woo_loyalty_discounts_3_field_total_order]" <?php echo $checked1; ?>>
			<span class="slider round">
			<span class="on"><span class="fa-solid fa-check"></span></span>
			<span class="off"></span>
			</span>
		</label>
		<strong><label for="woo_loyalty_discounts_3_field_total_order">Users lifetime total items purchased.</label></strong>
	</p>
	<br/>
	<div id="totalordersitems-options" class="option-section">

	<p>This will add a discount to the users checkout for all future orders, if they have purchased over a certain amount of items in total from all their past orders.</p>

	<p>Order statuses must be marked as "completed" to be counted towards this total.</p><br/>

	<div class="woo_loyalty_discounts_settings_box woo_loyalty_discounts_3">
		<p>
			<!-- Order Amount -->
			<strong>Total LIFETIME amount of items ordered required:</strong><br/>
			<i class="field-tooltip">How many items should the user have order in total (from all previous orders) for this discount?</i><br/>
			<input type="number" value="<?php echo woo_loyalty_discounts_get_option('woo_loyalty_discounts_3_field_order_amount', '0'); ?>" id="<?php echo esc_attr('woo_loyalty_discounts_3_field_order_amount'); ?>" data-custom="<?php echo esc_attr('woo_loyalty_discounts_custom_data'); ?>" name="woo_loyalty_discounts_options[<?php echo esc_attr('woo_loyalty_discounts_3_field_order_amount'); ?>]"><br/>
		</p><br/>
		<p>
			<!-- Order Amount -->
			<strong>Discount amount:</strong><br/>
			<i class="field-tooltip">What discount should they receive on their cart?</i><br/>
			<input type="number" value="<?php echo woo_loyalty_discounts_get_option('woo_loyalty_discounts_3_field_discount_amount', '0'); ?>" id="<?php echo esc_attr('woo_loyalty_discounts_3_field_discount_amount'); ?>" data-custom="<?php echo esc_attr('woo_loyalty_discounts_custom_data'); ?>" name="woo_loyalty_discounts_options[<?php echo esc_attr('woo_loyalty_discounts_3_field_discount_amount'); ?>]"><br/>
		</p><br/>
		<p>
			<!-- Order Amount -->
			<strong>Discount Type:</strong><br/>
			<i class="field-tooltip">Should this discount be a percentage of their cart total, or a fixed amount?</i><br/>
			<select id="<?php echo esc_attr('woo_loyalty_discounts_3_field_type'); ?>" data-custom="<?php echo esc_attr('woo_loyalty_discounts_custom_data'); ?>"
				name="woo_loyalty_discounts_options[<?php echo esc_attr('woo_loyalty_discounts_3_field_type'); ?>]">
				<option value="percentage" <?php selected(woo_loyalty_discounts_get_option('woo_loyalty_discounts_3_field_type', ''), 'percentage'); ?>>Percentage</option>
				<option value="fixed" <?php selected(woo_loyalty_discounts_get_option('woo_loyalty_discounts_3_field_type', ''), 'fixed'); ?>>Fixed Amount</option>
			</select>
		</p><br/>
		<p>
			<!-- Discount Label -->
			<strong>Custom Discount Label:</strong><br/>
			<i class="field-tooltip">Add a custom label for the discount in checkout.</i><br/>
			<input type="text" value="<?php echo woo_loyalty_discounts_get_option('woo_loyalty_discounts_3_field_label', ''); ?>" id="<?php echo esc_attr('woo_loyalty_discounts_3_field_label'); ?>" data-custom="<?php echo esc_attr('woo_loyalty_discounts_custom_data'); ?>" name="woo_loyalty_discounts_options[<?php echo esc_attr('woo_loyalty_discounts_3_field_label'); ?>]"><br/>
			<i>Leave empty for default label.</i>
		</p><br/>
		<p style="opacity: 0.7;">
			<!-- Order Amount -->
			<strong>Product category: (COMING SOON)</strong><br/>
			<i class="field-tooltip">Limit total items count to specific category. For example X amount of t-shirts.</i><br/>
			<input type="text" disabled><br/>
		</p><br/>
		<p>
			<!-- Discount Role -->
			<strong>Roles:</strong><br/>
			<i class="field-tooltip">Apply this discount to specific user roles. Seperate multiple roles with ",". For example: <strong>customer,member</strong></i><br/>
			<input type="text" value="<?php echo woo_loyalty_discounts_get_option('woo_loyalty_discounts_3_field_role', ''); ?>" id="<?php echo esc_attr('woo_loyalty_discounts_3_field_role'); ?>" data-custom="<?php echo esc_attr('woo_loyalty_discounts_custom_data'); ?>" name="woo_loyalty_discounts_options[<?php echo esc_attr('woo_loyalty_discounts_3_role'); ?>]"><br/>
			<i>Leave empty to apply to all roles.</i>
		</p>
	</div>

	</div>
	
 <?php
}
 
/**
 * top level menu
 */
function woo_loyalty_discounts_options_page() {
 // add top level menu page
 add_submenu_page( 
 'options-general.php',
 'WooCommerce Loyalty Discounts',
 'Woo Loyalty Discounts',
 'manage_options',
 'woo_loyalty_discounts',
 'woo_loyalty_discounts_options_page_html'
 );
}
 
/**
 * register our woo_loyalty_discounts_options_page to the admin_menu action hook
 */
add_action( 'admin_menu', 'woo_loyalty_discounts_options_page' );
 
/**
 * top level menu:
 * callback functions
 */
function woo_loyalty_discounts_options_page_html() {
 // check user capabilities
 if ( ! current_user_can( 'manage_options' ) ) {
 return;
 }
 
 // add error/update messages
 
 // check if the user have submitted the settings
 // wordpress will add the "settings-updated" $_GET parameter to the url
 if ( isset( $_GET['settings-updated'] ) ) {
 // add settings saved message with the class of "updated"
 add_settings_error( 'woo_loyalty_discounts_messages', 'woo_loyalty_discounts_message', __( 'Settings Saved', 'woo_loyalty_discounts' ), 'updated' );
 }
 
 // show error/update messages
 settings_errors( 'woo_loyalty_discounts_messages' );
 ?>
 <div class="wrap">
 <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
 <form action="options.php" method="post" class="wld-settings">
 <?php
 // output security fields for the registered setting "woo_loyalty_discounts"
 settings_fields( 'woo_loyalty_discounts' );
 // output setting sections and their fields
 // (sections are registered for "woo_loyalty_discounts", each field is registered to a specific section)
 do_settings_sections( 'woo_loyalty_discounts' );
 // output save settings button
 submit_button( 'Save Settings' );
 ?>
 </form>
 
<br/><hr/><br/>

		<div style="background: #e1e1e1; padding: 30px; border-radius: 10px;">

			<strong>Shortcodes</strong>
			<p style="font-size: 14px;">You can use shortcode <strong>[loyalty-discount-info]</strong> on a page to allow users to view their current progress and eligibility to the available loyalty discounts.</p><br/>
 
			<strong>Suggestions</strong>
			<p style="font-size: 14px;">Do you have any suggestions for this plugin, such as additional/more complex discount types?<br/><br/>
			Some examples would be discounts based on:<br/>
			- How long a user has been registered<br/>
			- Amount of items in cart<br/>
			- Automatically apply discount based on referral URL<br/>
			- Billing address/location<br/>
			- Chosen payment method<br/>
			- If they have ever ordered a specific product in the past.<br/>
			- Or anything even more complicated!<br/><br/>
			<a href="https://wordpress.org/support/plugin/loyalty-discounts-for-woocommerce">Get in touch</a> if you have any suggestions!</p>

			<br/><strong>Bug Reporting</strong>
			<p style="font-size: 14px;">If you find a bug, please <a href="https://wordpress.org/support/plugin/loyalty-discounts-for-woocommerce">get in touch</a>.</p>

			<br/><strong>Like this plugin?</strong>
			<p style="font-size: 14px;">Feel free to <a href="https://www.paypal.com/donate/?hosted_button_id=RX28BBH7L5XDS" target="_blank">donate</a> or <a href="https://wordpress.org/support/plugin/loyalty-discounts-for-woocommerce/reviews/#new-post" target="_blank">leave a review.</a><br/><br/>
			Currently this is the only version of this plugin, and is 100% free.
 
		</div>
 
 </div>
 <?php
}