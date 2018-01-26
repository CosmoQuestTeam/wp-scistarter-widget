<?php
/*
Plugin Name: Scistarter Widget
Plugin URI: https://github.com/CosmoQuestTeam/wp-scistarter-widget
Description: Display SciSarter Widget
Author: Ryan Owens
Version: 1
Author URI: https://cosmoquest.org/x
License: Apache-2.0
*/

class Scistarter_Widget extends WP_Widget
{
    public function __construct()
    {
        $widget_ops = array(
          'classname' => 'scistarter_widget',
          'description' => 'Display a SciStarter Project Widget'
        );
        parent::__construct('scistarter_widget', 'SciStarter Widget', $widget_ops);
    }

    public function widget($args, $instance)
    {
        echo $args['before_widget'];
        if (!empty($instance['title'])) {
            echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
        }
        if (!empty($instance['key'])) {
            $key = $instance['key'];
            echo `<iframe frameBorder="0" width="200" height="244" src="https://scistarter.com/widget/${key}"></iframe>`;
        }
        echo $args['after_widget'];
    }

    public function form($instance)
    {
        $title = !empty($instance['title'])? $instance['title']: esc_html__('SciStarter', 'text_domain');
        $key = !empty($instance['key'])? $instance['key']: esc_html__('65', 'text_domain'); ?>
        <p>
        <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_attr_e('Title:', 'text_domain'); ?></label>
    		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>
        <p>
        <label for="<?php echo esc_attr($this->get_field_id('key')); ?>"><?php esc_attr_e('SciStarter Widget Key:', 'text_domain'); ?></label>
        <input class="widefat" id="<?php echo esc_attr($this->get_field_id('key')); ?>" name="<?php echo esc_attr($this->get_field_name('key')); ?>" type="text" value="<?php echo esc_attr($key); ?>">
        <span>The key is the number at the end of the widget URL which can be generated on <a href="https://scistarter.com/widget/new">this page</a></span>
        </p>
        <?php
    }

    public function update($new_instance, $old_instance)
    {
        $instance = array();
        $instance['title'] = (! empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        $instance['key'] = (! empty($new_instance['key'])) ? strip_tags($new_instance['key']) : '';

        return $instance;
    }
}

function register_scistarter_widget() {
	register_widget( 'Scistarter_Widget' );
}
add_action( 'widgets_init', 'register_scistarter_widget' );

?>
