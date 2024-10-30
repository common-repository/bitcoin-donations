<?php
/*
Plugin Name: Bitcoin Donations
Plugin URI: http://slobros.com/2011/wp/plugins/bitcoin-donations/
Description: Receive bitcoin donations from the visitors on your site
Version: 1.0
Author: SloBros
Author URI: http://slobros.com/
License: GPL2

Copyright 2011  SloBros  (email : rjkoehl@gmail.com)

*/

add_action('wp_print_styles', 'add_bitcoin_stylesheet');

    function add_bitcoin_stylesheet() {
        $myStyleUrl = WP_PLUGIN_URL . '/bitcoin-donations/bitcoinstyle.css';
		$myStyleFile = WP_PLUGIN_DIR . '/bitcoin-donations/bitcoinstyle.css';
        if ( file_exists($myStyleFile) ) {
            wp_register_style('bitcoinStyleSheets', $myStyleUrl);
            wp_enqueue_style( 'bitcoinStyleSheets');
        }
    }

//==============================START WIDGET===================================
class WP_Bitdonations_Widget extends WP_Widget {
    /** constructor */
    function WP_Bitdonations_Widget() {
        parent::WP_Widget(false, $name = 'Bitcoin Donations');
    }

    /** @see WP_Widget::widget */
    function widget($args, $instance) {
        extract( $args );
		  $btc_address = $instance['btc_address'];
	//	  $btc_message = $instance['btc_message'];
		  $btc_design = $instance['btc_design'];

		  
		  
        ?>
              <?php echo $before_widget; ?>
                  <?php echo $before_title . "Bitcoin Donations" . $after_title; ?>
				  
						<table cellspacing='0' class="<?php echo $btc_design; ?>">

<thead>
<tr>
<th class="Corner"><center>Donate to:</center></th>

</tr>
</thead>

<tbody>
<tr>
<th class="Code"><br><center><b><?php echo $btc_address; ?></b></center><br></th>
<!-- <td class="Odd"><center><?php// echo $btc_message; ?></center></td> -->
</tr>
</thead>

</tbody>
</table>
              <?php echo $after_widget; ?>
        <?php
	}

    /** @see WP_Widget::update */
    function update($new_instance, $old_instance) {
	$instance = $old_instance;
	$instance['btc_address'] = strip_tags($new_instance['btc_address']);
//	$instance['btc_message'] = strip_tags($new_instance['btc_message']);
	$instance['btc_design'] = strip_tags($new_instance['btc_design']);

         return $instance;
     }

    /** @see WP_Widget::form */
    function form($instance) {
		$btc_address = esc_attr($instance['btc_address']);
	//	$btc_message = esc_attr($instance['btc_message']);
		$btc_design = esc_attr($instance['btc_design']);

        ?>
         <p>
		 <label for="<?php echo $this->get_field_id('btc_address'); ?>"><?php _e('Bitcoin address:'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('btc_address'); ?>" name="<?php echo $this->get_field_name('btc_address'); ?>" type="text" value="<?php echo $btc_address; ?>" />
		 </p>
	<!--	 <p>
		  <label for="<?php// echo $this->get_field_id('btc_message'); ?>"><?php// _e('User name:'); ?></label> 
          <input class="widefat" id="<?php //echo $this->get_field_id('btc_message'); ?>" name="<?php //echo $this->get_field_name('btc_message'); ?>" type="text" value="<?php// echo $btc_message; ?>" />
		</p> -->
		
		<p>
					  <label for="<?php echo $this->get_field_id('btc_design'); ?>"><?php _e('Style:'); ?></label> 
			<select id="<?php echo $this->get_field_id('btc_design'); ?>" name="<?php echo $this->get_field_name('btc_design'); ?>" class="widefat" style="width:100%;">
    <option <?php selected( $instance['btc_design'], 'Design1'); ?> value="Design1">Design 1</option>
    <option <?php selected( $instance['btc_design'], 'Design2'); ?> value="Design2">Design 2</option> 
    <option <?php selected( $instance['btc_design'], 'Design3'); ?> value="Design3">Design 3</option> 
    <option <?php selected( $instance['btc_design'], 'Design4'); ?> value="Design4">Design 4</option>
    <option <?php selected( $instance['btc_design'], 'Design5'); ?> value="Design5">Design 5</option> 
    <option <?php selected( $instance['btc_design'], 'Design6'); ?> value="Design6">Design 6</option>
	<option <?php selected( $instance['btc_design'], 'Design7'); ?> value="Design7">Design 7</option>
			</select>
		</p>
		
		<p>
		<center>If you like this plugin, please donate to:<br> <p style="font-size:6px;">1C7yGPQ1eWBx9mpHjMCD8RmEjVLZ8KXMX7</p></center>
		</p>
        <?php 
    }

} 

// register WP_Bitdonations_Widget widget
add_action('widgets_init', create_function('', 'return register_widget("WP_Bitdonations_Widget");'));

?>