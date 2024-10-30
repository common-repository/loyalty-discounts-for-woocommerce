<?php
/**
* Register Settings
*/
function woo_loyalty_discounts_settings_init() {
    
    // register a new setting for "woo_loyalty_discounts" page
    register_setting( 'woo_loyalty_discounts', 'woo_loyalty_discounts_options' );

    // register a new section in the "woo_loyalty_discounts" page
    add_settings_section('woo_loyalty_discounts_section_developers', __( '', 'woo_loyalty_discounts' ), '', 'woo_loyalty_discounts' );

    // register woo_loyalty_discounts_orders
    add_settings_field(
        'woo_loyalty_discounts_field_orders',
        __( '', 'woo_loyalty_discounts' ),
        'woo_loyalty_discounts_field_cb',
        'woo_loyalty_discounts',
        'woo_loyalty_discounts_section_developers',
        [
            'woo_loyalty_discounts_1_field_total_order',
            'woo_loyalty_discounts_1_field_order_amount',
            'woo_loyalty_discounts_1_field_discount_amount',
            'woo_loyalty_discounts_1_field_type',
            'woo_loyalty_discounts_1_field_label',
            'woo_loyalty_discounts_1_field_role',

            'woo_loyalty_discounts_2_field_total_cart',
            'woo_loyalty_discounts_2_field_order_amount',
            'woo_loyalty_discounts_2_field_discount_amount',
            'woo_loyalty_discounts_2_field_type',
            'woo_loyalty_discounts_2_field_label',
            'woo_loyalty_discounts_2_field_role',

            'woo_loyalty_discounts_3_field_total_cart',
            'woo_loyalty_discounts_3_field_order_amount',
            'woo_loyalty_discounts_3_field_discount_amount',
            'woo_loyalty_discounts_3_field_type',
            'woo_loyalty_discounts_3_field_label',
            'woo_loyalty_discounts_3_field_role',

            'woo_loyalty_discounts_row',
            'custom',
        ]
    );
    
}
    
/**
* Get Option
*/
function woo_loyalty_discounts_get_option($option = '') {
    $options = get_option( 'woo_loyalty_discounts_options' );
    if ( isset( $options[ $option ] ) ) {
        return $options[$option];
    } else {
        return "";
    }
}