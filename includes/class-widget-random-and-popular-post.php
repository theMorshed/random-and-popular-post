<?php

class Random_And_Popular_Post_Widget extends WP_Widget {

    /**
	 * Register widget with WordPress.
	*/
    public function __construct() {
        parent::__construct(
            'random-and-popular-post-widget',
            __('Random AND Popular Post', 'random-and-popular-post'),
            array('description' => __('Random And Popular Post Widget', 'random-and-popular-post'))
        );
    }

    /**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	*/
    public function form($instance) {

        $title = isset($instance['title']) ? $instance['title'] : __('Random Posts', 'random-and-popular-post');
        $post_per_page = isset($instance['post_per_page']) ? $instance['post_per_page'] : 4;
        $orderby = isset($instance['orderby']) ? $instance['orderby'] : '';

        ?>
        <h4><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title: ', 'random-and-popular-post'); ?></label></h4>
        <input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php esc_attr_e($title); ?>">

        <h4><label for="<?php echo $this->get_field_id('post_per_page'); ?>"><?php _e('Posts Per Page: ', 'random-and-popular-post'); ?></label></h4>
        <input type="number" class="widefat" id="<?php echo $this->get_field_id('post_per_page'); ?>" name="<?php echo $this->get_field_name('post_per_page'); ?>" value="<?php esc_attr_e($post_per_page); ?>">

        <h4><label for="<?php echo $this->get_field_id('orderby'); ?>"><?php _e('Order By: ', 'random-and-popular-post'); ?></label></h4>
        <p class="inline-group">
            <label class="radio"><input type="radio" name="<?php echo $this->get_field_name('orderby'); ?>"  <?php if ($orderby == 'rand' ) { ?>checked="checked"<?php }?> value="rand" checked><i></i><?php _e('Random', 'random-and-popular-post'); ?></label>
            <label class="radio"><input type="radio" name="<?php echo $this->get_field_name('orderby'); ?>"  <?php if ($orderby == 'comment_count' ) { ?>checked="checked"<?php }?> value="comment_count"><i></i><?php _e('Popular', 'random-and-popular-post'); ?></label>
            <label class="radio"><input type="radio" name="<?php echo $this->get_field_name('orderby'); ?>"  <?php if ($orderby == 'none' ) { ?>checked="checked"<?php }?> value="none"><i></i><?php _e('Recent', 'random-and-popular-post'); ?></label>
            <label class="radio"><input type="radio" name="<?php echo $this->get_field_name('orderby'); ?>"  <?php if ($orderby == 'date' ) { ?>checked="checked"<?php }?> value="date"><i></i><?php _e('Date', 'random-and-popular-post'); ?></label>
        </p>
        
        <?php
    }

    /**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	*/
    public function widget($args, $instance) {
        $title = apply_filters('random_and_popular_post_title', $instance['title']);
        $post_per_page = $instance['post_per_page'] ? $instance['post_per_page'] : 4;
        $orderby = $instance['orderby'];

        echo $args['before_widget'];
        if(!empty($title)){
            echo $args['before_title'];
            echo $title;
            echo $args['after_title'];
        }
        ?>
        <div class="random-post-widget">
            <?php
                $random_and_popular_posts = new WP_Query( array(
                    'posts_per_page'      => $post_per_page,
                    'ignore_sticky_posts' => 1,
                    'orderby'             => $orderby
                ) );

                while ( $random_and_popular_posts->have_posts() ) {
                    $random_and_popular_posts->the_post();
                    ?>
                    <article>
                        <div class="post-thumb">
                            <a href="<?php the_permalink(); ?>">
                                <?php 
                                    if(has_post_thumbnail()) {
                                        the_post_thumbnail(array(80, 80));
                                    }else {
                                        printf('<img src="%s" alt="Thumbnail">', plugin_dir_url(__FILE__).'../public/img/thumbnail.png');
                                    } 
                                ?>
                            </a>
                        </div>
                        <div class="post-content">
                            <h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                            <section class="random_post__meta">
                                <span class="random_post__author"><span><?php _e( "By", "random-and-popular-post" ); ?></span> <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( "ID" ) ) ); ?>"> <?php the_author(); ?></a></span>
                                <p class="random_post__date"><span><?php _e( "on", "random-and-popular-post" ); ?></span> <time datetime="2017-12-19"><?php echo get_the_date(); ?></time></p>
                            </section>
                        </div>
                        <div style="clear: both;"></div>
                    </article>
                    <?php
                }

                wp_reset_query();
                ?>
        </div>
        <?php
        echo $args['after_widget'];
    }

    /**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	*/
    public function update($new_instance, $old_instance) {
        $instance = $new_instance;
        $instance['title'] = sanitize_text_field( $instance['title'] );
        $instance['orderby'] = sanitize_text_field( $instance['orderby'] );
        if(!is_numeric($new_instance['post_per_page'])) {
            $instance['post_per_page'] = $old_instance['post_per_page'];
        }
        
        return $instance;
    }
} // class Random_And_Popular_Post_Widget

// Register Random_And_Popular_Post_Widget widget
function register_random_and_popular_post_widget() {
    register_widget('Random_And_Popular_Post_Widget');
}
add_action( 'widgets_init', 'register_random_and_popular_post_widget' );