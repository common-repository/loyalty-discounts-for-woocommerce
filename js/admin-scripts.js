/* Total Order Amount */
jQuery(document).ready(function() {
	if( jQuery('#woo_loyalty_discounts_1_field_total_order').is(':checked')) {
		jQuery("#totalorders-options").show();
	} else {
		jQuery("#totalorders-options").hide();
	}
    jQuery('#woo_loyalty_discounts_1_field_total_order').click(function() {
        if( jQuery(this).is(':checked')) {
            jQuery("#totalorders-options").show();
        } else {
            jQuery("#totalorders-options").hide();
        }
    }); 
});
/* Total Cart */
jQuery(document).ready(function() {
	if( jQuery('#woo_loyalty_discounts_2_field_total_cart').is(':checked')) {
		jQuery("#totalcart-options").show();
	} else {
		jQuery("#totalcart-options").hide();
	}
    jQuery('#woo_loyalty_discounts_2_field_total_cart').click(function() {
        if( jQuery(this).is(':checked')) {
            jQuery("#totalcart-options").show();
        } else {
            jQuery("#totalcart-options").hide();
        }
    }); 
});
/* Total Order Items */
jQuery(document).ready(function() {
	if( jQuery('#woo_loyalty_discounts_3_field_total_order').is(':checked')) {
		jQuery("#totalordersitems-options").show();
	} else {
		jQuery("#totalordersitems-options").hide();
	}
		jQuery('#woo_loyalty_discounts_3_field_total_order').click(function() {
			if( jQuery(this).is(':checked')) {
				jQuery("#totalordersitems-options").show();
			} else {
				jQuery("#totalordersitems-options").hide();
			}
		}); 
	});