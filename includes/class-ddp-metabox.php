<?php 

if (! defined( 'ABSPATH' )) 
{
	exit;
}
if (! class_exists( 'DDP_metabox')) 
{
    /** Class DDP_METABOX. */

class DDP_metabox
{
    /**  Constructor. */

	public function __construct() 
    {
        add_action('woocommerce_product_options_general_product_data', array($this,'DDP_show_field'));
		add_action('woocommerce_process_product_meta',  array($this, 'DDP_save_value'));
        add_filter( 'woocommerce_get_price_html', array($this, 'DDP_show_price'));
		add_filter( 'woocommerce_before_calculate_totals', array($this, 'DDP_show_price_cart' ));
	}
	
	/** Dynamic Discount Filed & Checkbox Show. */

	public function DDP_show_field () 
    {
		global $woocommerce;
		woocommerce_wp_checkbox( 
			array( 
				'id' => 'dynamic_discount_checkbox',
				'class' => 'checkbox', 
				'label' => __('Enable Discount: ')
				)
			);
		woocommerce_wp_text_input(
			array('custom_attributes' => 
			array( 
					'step' => 'any',
					'min' => '0',
					'max' => '100',
					'required' => true,
				),
				'type' => 'number',
				'id' => 'dynamic_discount_field',
				'label' => __('Discount: '),
				'desc_tip' => true,
				'description' => __('How much discount you want to provide'),
				)
			
		);
	}

	/** Value Save in Database. */

	public function DDP_save_value( $post_id ) 
    {
		$productname = wc_get_product( $post_id );
		$checkbox = isset( $_POST['dynamic_discount_checkbox'] ) ? $_POST['dynamic_discount_checkbox'] : '';
		$discountnumber = isset( $_POST['dynamic_discount_field'] ) ? $_POST['dynamic_discount_field'] : '';
		$productname -> update_meta_data( 'dynamic_discount_field', sanitize_text_field( $discountnumber ) );
		$productname -> update_meta_data("dynamic_discount_checkbox", sanitize_text_field( $checkbox ) );
		$productname -> save();
    }
	

    /** Value Show in Product Page. */

    public function DDP_show_price( $price ) 
    {
		global $post;
		$checbox_value = get_post_meta( $post->ID, 'dynamic_discount_checkbox', true );
		if($checbox_value=="yes")
		{
			$productname = wc_get_product( $post->ID );
			$discount = get_post_meta( $post->ID, 'dynamic_discount_field', true );
			$regular_price = $productname->get_regular_price();
			$price = $regular_price * ((100 - $discount)/ 100) ;
		}
		return $price;
	}

	/** Value Show in Cart Page. */

	public function DDP_show_price_cart($cart_object)
	{
		if($cart_object)
		{
			foreach ( $cart_object->get_cart() as $hash => $value ) 
			{
				$product_id = $value['product_id'];
				$productname = wc_get_product( $product_id );
				$discount = get_post_meta( $product_id, 'dynamic_discount_field', true );
				$sale_price = $productname->get_regular_price();
				$new_price = $sale_price * ((100 - $discount)/ 100) ;
				$value[ 'data' ] -> set_price( $new_price);
			}
		}
	}
}

}

new DDP_metabox(); 
?>