<?php
/**
 * New Counter Offer email (plain text)
 *
 * @since	0.1.0
 * @package public/includes/emails/plain
 * @author  AngellEYE <andrew@angelleye.com>
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

echo $email_heading . "\n\n";

echo sprintf( __('New Counter Offer submitted on', 'offers-for-woocommerce') . ' %s. ' . __('To manage this counter offer please visit the following url:', 'offers-for-woocommerce') . ' %s', get_bloginfo( 'name' ),  admin_url( 'post.php?post='. $offer_args['offer_id']  .'&action=edit' ) ) . "\n\n";

echo "****************************************************\n";

echo sprintf( __( 'Offer ID:', 'offers-for-woocommerce') .' %s', $offer_args['offer_id'] ) . "\n";

echo "\n";

echo __( 'Product', 'offers-for-woocommerce' ) . ': ' . stripslashes($offer_args['product_title_formatted']) . "\n";
echo __( 'Regular Price', 'offers-for-woocommerce' ) . ': ' . wc_price( $offer_args['product']->get_regular_price()) . "\n";
echo __( 'Quantity', 'offers-for-woocommerce' ) . ': ' . number_format( $offer_args['product_qty'], 0 ) . "\n";
echo __( 'Price', 'offers-for-woocommerce' ) . ': ' . wc_price( $offer_args['product_price_per']) . "\n";
echo __( 'Subtotal', 'offers-for-woocommerce' ) . ': ' . wc_price( $offer_args['product_total']) . "\n";

if( isset($offer_args['product_shipping_cost']) && $offer_args['product_shipping_cost'] != '0.00' && !empty($offer_args['product_shipping_cost'])) {
    $product_total = number_format(round($offer_args['product_total'] + $offer_args['product_shipping_cost'], 2), 2, '.', '') . "\n";
    echo __( 'Shipping', 'offers-for-woocommerce' ) . ': ' . wc_price( $offer_args['product_shipping_cost']). "\n";
    echo __( 'Total', 'offers-for-woocommerce' ) . ': ' . wc_price( $product_total) . "\n";
}
echo "\n\n";
if( !$offer_args['is_anonymous_communication_enable'] ) {
    echo __('Offer Contact Details:', 'offers-for-woocommerce');
    echo (isset($offer_args['offer_name']) && $offer_args['offer_name'] != '') ? "\n" . __('Name:', 'offers-for-woocommerce') . " ".stripslashes($offer_args['offer_name']) : "";
    echo (isset($offer_args['offer_company_name']) && $offer_args['offer_company_name'] != '') ? "\n" . __('Company Name:', 'offers-for-woocommerce') . " ".stripslashes($offer_args['offer_company_name']) : "";
    echo (isset($offer_args['offer_email']) && $offer_args['offer_email'] != '') ? "\n" . __('Email:', 'offers-for-woocommerce') . " ".stripslashes($offer_args['offer_email']) : "";
    echo (isset($offer_args['offer_phone']) && $offer_args['offer_phone'] != '') ? "\n" . __('Phone:', 'offers-for-woocommerce') . " ".stripslashes($offer_args['offer_phone']) : "";
}
do_action('make_offer_email_display_custom_field_after_buyer_contact_details', $offer_args['offer_id']);

if(isset($offer_args['offer_notes']) && $offer_args['offer_notes'] != '')
{
    echo "\n\n" . __( 'Offer Notes:', 'offers-for-woocommerce' ) . ' ' . $offer_args['offer_notes'];
}

echo "\n****************************************************\n\n";
echo apply_filters( 'woocommerce_email_footer_text', get_option( 'woocommerce_email_footer_text' ) );