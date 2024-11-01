<?php
/*
Plugin Name: ToRelax.Me Widget
Plugin Script: to-relax-me-widget.php
Description: This widget allow you to show a ToRelax.me Logo in sidebar
Version: 1.0
License: GPL 2.0
Author: Francesco Gentili
*/

class to_relax_me_widget extends WP_Widget
{
	public function __construct()
	{
		parent::WP_Widget( 'to-relax-me', 'ToRelax.Me', array('description' => 'This widget allow you to show a ToRelax.me logo in sidebar'));
	} 
 
	public function form($instance)
	{
		/* Widget default settings */
		$defaults = array(
		'title' => 'ToRelax.Me',
		);

		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">
				Title:
			</label>
			<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
<?php
	}

	public function widget($args, $instance)
	{
		extract( $args );

		$title = apply_filters('widget_title', $instance['title'] );

		echo $before_widget;
		echo $before_title . $title . $after_title;
?>
		<div>
			<p><?php echo $instance['img']; ?></p>
		</div>

		<div>
			<a href="http://torelax.me" id="logo" ><img src="<?php echo plugins_url('to-relax-me/img/torelaxme-tag.png') ?>" /></a>
		</div>

		<?php
		echo $after_widget;
	}

	public function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );

		return $instance;
	}
}

function to_relax_me_register_widgets()
{
	register_widget( 'to_relax_me_widget' );
	wp_enqueue_style('to_relax_me_style', WP_PLUGIN_URL.'/to-relax-me/css/style.css');
}

add_action( 'widgets_init', 'to_relax_me_register_widgets' );

?>