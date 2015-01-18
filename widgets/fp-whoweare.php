<?php

class Moesia_Who_We_Are extends WP_Widget {

// constructor
    function moesia_who_we_are() {
		$widget_ops = array('classname' => 'moesia_whoweare_widget', 'description' => __( 'Add an about text for your visitors.', 'moesia') );
        parent::WP_Widget(false, $name = __('Moesia FP: Who We Are', 'moesia'), $widget_ops);
		$this->alt_option_name = 'moesia_whoweare_widget';
		
		add_action( 'save_post', 	array($this, 'flush_widget_cache') );
		add_action( 'deleted_post', array($this, 'flush_widget_cache') );
		add_action( 'switch_theme', array($this, 'flush_widget_cache') );		
    }
	
	// widget form creation
	function form($instance) {

	// Check values
		$title      = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$whoweare 	= isset( $instance['whoweare'] ) ? $instance['whoweare'] : '';	
	?>

	<p>
	<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'moesia'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
	</p>

	<p>
	<label for="<?php echo $this->get_field_id('whoweare'); ?>"><?php _e('Enter your "who we are" text. No tags necessary.', 'moesia'); ?></label>
	<textarea class="widefat" id="<?php echo $this->get_field_id('whoweare'); ?>" name="<?php echo $this->get_field_name('whoweare'); ?>" style="max-width: 100%; min-height: 400px;"><?php echo $whoweare; ?></textarea>
	</p>

	<?php
	}

	// update widget
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['whoweare'] = $new_instance['whoweare'];
	    $this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['moesia_whoweare']) )
			delete_option('moesia_whoweare');		  
		  
		return $instance;
	}
	
	function flush_widget_cache() {
		wp_cache_delete('moesia_whoweare', 'widget');
	}
	
	// display widget
	function widget($args, $instance) {
		$cache = array();
		if ( ! $this->is_preview() ) {
			$cache = wp_cache_get( 'moesia_whoweare', 'widget' );
		}

		if ( ! is_array( $cache ) ) {
			$cache = array();
		}

		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		if ( isset( $cache[ $args['widget_id'] ] ) ) {
			echo $cache[ $args['widget_id'] ];
			return;
		}

		ob_start();
		extract($args);

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : '';
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
		$whoweare = isset( $instance['whoweare'] ) ? $instance['whoweare'] : '';

?>
		<section id="whoweare" class="whoweare-area">
			<div class="container">			
				<?php if ( $title ) echo $before_title . '<span class="wow bounce">' . $title . '</span>' . $after_title; ?>
					<div class="wow fadeInRight whoweare"><?php echo $whoweare; ?></div>
				</div>	
			</div>		
		</section>		
	<?php

		if ( ! $this->is_preview() ) {
			$cache[ $args['widget_id'] ] = ob_get_flush();
			wp_cache_set( 'moesia_whoweare', $cache, 'widget' );
		} else {
			ob_end_flush();
		}
	}
	
}