<?php
/**
 * Template Name: Shop Page
 */

get_header(); ?>

	<?php the_post(); ?>
	<div id="primary" class="site-content full-width">
		<div id="content" role="main">
			<div class="content-shop">
				<?php the_title('<h1>' ,'</h1>'); ?>

				<?php if ($sub_title = get_post_meta( get_the_ID(), 'sub_title', true )) : ?>
				<h2><?php echo $sub_title; ?></h2>
				<?php endif; ?>

				<?php
					query_posts(array(
						'posts_per_page' => -1,
						'post_type' => 'product',
					));
				?>
				<?php if (have_posts()) : ?>
				<div class="cols-shop-holder">
					<?php while (have_posts()) : the_post(); ?>
					<article class="col">
						<?php $url = get_post_meta( get_the_ID(), 'url', true ); ?>

						<?php if (has_post_thumbnail()) : ?>
						<div class="img-box">
							<?php if ($url) : ?>
							<a href="<?php echo $url; ?>">
							<?php endif; ?>

								<?php the_post_thumbnail(); ?>

							<?php if ($url) : ?>
							</a>
							<?php endif; ?>
						</div>
						<?php endif; ?>

						<p>
							<?php if ($url) : ?>
							<a href="<?php echo $url; ?>">
							<?php endif; ?>
								<?php 
								echo get_the_title();
								//echo get_the_excerpt();
								?>
							<?php if ($url) : ?>
							</a>
							<?php endif; ?>
						</p>
					</article>
					<?php endwhile; ?>
				</div>
				<?php endif; ?>
				<?php wp_reset_query(); ?>
			</div>
		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>