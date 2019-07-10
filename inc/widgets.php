<?php

###########
# WIDGETS #
###########

// Bump Envy
class WRNY_Bump_Envy_Widget extends WP_Widget {  
	
	function WRNY_Bump_Envy_Widget() {  
		parent::WP_Widget( false, 'WRNY: Bump Envy Widget' );
		
		parent::__construct(
			'WRNY_Bump_Envy_Widget',
			'WRNY: Bump Envy Widget',
			array( 'description' => 'Displays the latest Bump Envy article' )
		);
		
	}

    public function form( $instance ) {
        //Defaults
        $instance = wp_parse_args( (array) $instance, array( 'link_title' => '', 'link_url' => '') );
        $link_title = sanitize_text_field( $instance['link_title'] );
        $link_url = sanitize_text_field( $instance['link_url'] );
        ?>
        <p><label for="<?php echo $this->get_field_id('link_title'); ?>"><?php _e( 'Link title:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('link_title'); ?>" name="<?php echo $this->get_field_name('link_title'); ?>" type="text" value="<?php echo esc_attr( $link_title ); ?>" /></p>
        <p><label for="<?php echo $this->get_field_id('link_url'); ?>"><?php _e( 'Link url:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('link_url'); ?>" name="<?php echo $this->get_field_name('link_url'); ?>" type="text" value="<?php echo esc_attr( $link_url ); ?>" /></p>
        <?php
    }
	
	function update( $new_instance, $old_instance ) {
		// processes widget options to be saved
        $instance = $old_instance;
        $instance['link_title'] = sanitize_text_field( $new_instance['link_title'] );
        $instance['link_url'] = sanitize_text_field( $new_instance['link_url'] );
        return $instance;
	}  
	
	function widget( $args, $instance ) {
        $link_title = $instance['link_title'];
        $link_url = $instance['link_url'];

		// outputs the content of the widget		
		$args = array(
			'category_name' => 'bump-envy',
			'post_type' => 'post',
			'post_status' => 'publish',
			'posts_per_page' => 1,
			'post__not_in' => array( get_the_ID() )
		);
		
		$latest_bump_envy = new WP_Query( $args );
		
		if( $latest_bump_envy->have_posts() ) {
			while( $latest_bump_envy->have_posts()) : $latest_bump_envy->the_post();
				?>
				<aside class="widget widget_text bump-envy">
					<div class="widget-table">
						<div class="widget-cell left"></div>
						<div class="widget-cell middle">
                            <?php if($link_title): ?>
							<h3 class="widget-title"><?php if($link_url): ?><a href="<?php echo $link_url; ?>"><?php endif; ?><?php echo $link_title; ?><?php if($link_url): ?></a><?php endif; ?></h3>
                            <?php endif; ?>
							<div class="textwidget">
								<div class="widget-image"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php
									if( has_post_thumbnail() ) {
										$image_src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'widget' );
										echo '<img src="' . $image_src[0]  . '" width="100%" border="0" />';
									} else {
										echo '<div class="no-image"></div>';
									}					
								?></a></div>
								<h4><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
								<div class="clear"></div>
							</div>
						</div>
						<div class="widget-cell right"></div>
					</div>
				</aside>
				<?php
			endwhile;
		}
		
		wp_reset_query();
	
	}
	  
}
register_widget( 'WRNY_Bump_Envy_Widget' );

// Tips By Trimester
class WRNY_Trimester_Widget extends WP_Widget {  
	
	function WRNY_Trimester_Widget() {  
		parent::WP_Widget( false, 'WRNY: Trimester Widget' );
		
		parent::__construct(
			'WRNY_Trimester_Widget',
			'WRNY: Trimester Widget',
			array( 'description' => 'Displays links to Trimester archives' )
		);
		
	}  
	
	function form( $instance ) {  
		// outputs the options form on admin  
	}  
	
	function update( $new_instance, $old_instance ) {
		// processes widget options to be saved  
		return $new_instance;  
	}  
	
	function widget( $args, $instance ) {  
		// outputs the content of the widget		
		?>		
		<aside class="widget widget_text trimester" id="trimester-widget">
			<div class="widget-table">
				<div class="widget-cell left"></div>
				<div class="widget-cell middle">
					<h3 class="widget-title"><a href="<?php echo esc_url( home_url( '/category/1st-trimester/' ) ); ?>">Tips By Trimester</a></h3>
					<div class="textwidget" id="trimester-numbers">
						<a href="<?php echo esc_url( home_url( '/category/1st-trimester/' ) ); ?>">1</a>
						<a href="<?php echo esc_url( home_url( '/category/2nd-trimester/' ) ); ?>">2</a>
						<a href="<?php echo esc_url( home_url( '/category/3rd-trimester/' ) ); ?>">3</a>
					</div>
					<div class="clear"></div>
				</div>
				<div class="widget-cell right"></div>
			</div>
		</aside>		
		<?php	
	}
	  
}
register_widget( 'WRNY_Trimester_Widget' );

// Giveaways
class WRNY_Giveaways_Widget extends WP_Widget {  
	
	function WRNY_Giveaways_Widget() {  
		parent::WP_Widget( false, 'WRNY: Giveaways Widget' );
		
		parent::__construct(
			'WRNY_Giveaways_Widget',
			'WRNY: Giveaways Widget',
			array( 'description' => 'Displays the latest Giveaways article' )
		);
		
	}  
	
	function form( $instance ) {  
		// outputs the options form on admin  
	}  
	
	function update( $new_instance, $old_instance ) {
		// processes widget options to be saved  
		return $new_instance;  
	}  
	
	function widget( $args, $instance ) {  
		// outputs the content of the widget		
		$args = array(
			'category_name' => 'giveaways',
			'post_type' => 'post',
			'post_status' => 'publish',
			'posts_per_page' => 1,
		);
		
		$latest_giveaway = new WP_Query( $args );
		
		if( $latest_giveaway->have_posts() ) {
			while( $latest_giveaway->have_posts()) : $latest_giveaway->the_post();
				?>
				<aside class="widget widget_text giveaways">
					<div class="widget-table">
						<div class="widget-cell left"></div>
						<div class="widget-cell middle">
							<h3 class="widget-title"><a href="<?php echo esc_url( home_url( '/category/giveaways' ) ); ?>">Giveaways</a></h3>
							<div class="textwidget">						
								<div class="widget-image"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php
									if( has_post_thumbnail() ) {
										$image_src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'widget' );
										echo '<img src="' . $image_src[0]  . '" width="100%" />';
									} else {
										echo '<div class="no-image"></div>';
									}					
								?></a></div>
								<h4><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
								<div class="clear"></div>
							</div>
						</div>
						<div class="widget-cell right"></div>
					</div>
				</aside>
				<?php
			endwhile;
		}
		
		wp_reset_query();
	
	}
	  
}
register_widget( 'WRNY_Giveaways_Widget' );