<?php get_header(); ?>
	<?php
	$content_css = '';
	$sidebar_css = '';
	$content_class = '';
	$sidebar_exists = true;
	if(get_post_meta($post->ID, 'pyre_full_width', true) == 'yes') {
		$content_css = 'width:100%';
		$sidebar_css = 'display:none';
		$content_class = 'full-width';
		$sidebar_exists = false;
	}
	elseif(get_post_meta($post->ID, 'pyre_sidebar_position', true) == 'left') {
		$content_css = 'float:right;';
		$sidebar_css = 'float:left;';
	} elseif(get_post_meta($post->ID, 'pyre_sidebar_position', true) == 'right') {
		$content_css = 'float:left;';
		$sidebar_css = 'float:right;';
	} elseif(get_post_meta($post->ID, 'pyre_sidebar_position', true) == 'default') {
		if($zdata['default_sidebar_pos'] == 'Left') {
			$content_css = 'float:right;';
			$sidebar_css = 'float:left;';
		} elseif($zdata['default_sidebar_pos'] == 'Right') {
			$content_css = 'float:left;';
			$sidebar_css = 'float:right;';
		}
	}

	if($zdata['single_post_full_width']) {
		$content_css = 'width:100%';
		$sidebar_css = 'display:none';
		$content_class= 'full-width';
		$sidebar_exists = false;
	}
	?>
	<div id="content" class="<?php echo $content_class; ?>" style="<?php echo $content_css; ?>">
		<?php if(!$zdata['blog_pn_nav']): ?>
		<div class="single-navigation clearfix">
			<?php previous_post_link('%link', __('Previous', 'Zhane')); ?>
			<?php next_post_link('%link', __('Next', 'Zhane')); ?>
		</div>
		<?php endif; ?>
		<?php if(have_posts()): the_post(); ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>
			<?php
			global $zdata;
			if( ! post_password_required($post->ID) ):
			if((!$zdata['legacy_posts_slideshow'] && !$zdata['posts_slideshow']) && get_post_meta($post->ID, 'pyre_video', true)): ?>
			<!--<div class="flexslider post-slideshow">
				<ul class="slides">
					<li class="full-video">
						<?php echo get_post_meta($post->ID, 'pyre_video', true); ?>
					</li>
				</ul>
			</div>-->
			<?php endif;
			if($zdata['featured_images_single']):
			if($zdata['legacy_posts_slideshow']):
			$args = array(
			    'post_type' => 'attachment',
			    'numberposts' => $zdata['posts_slideshow_number']-1,
			    'post_status' => null,
			    'post_parent' => $post->ID,
				'orderby' => 'menu_order',
				'order' => 'ASC',
				'post_mime_type' => 'image',
				'exclude' => get_post_thumbnail_id()
			);
			$attachments = get_posts($args);
			if((has_post_thumbnail() || get_post_meta($post->ID, 'pyre_video', true))):
			?>
			<div class="fusion-flexslider flexslider post-slideshow">
				<ul class="slides">
					<?php if(!$zdata['posts_slideshow']): ?>
					<?php if(get_post_meta($post->ID, 'pyre_video', true)): ?>
					<li>
						<div class="full-video">
							<?php echo get_post_meta($post->ID, 'pyre_video', true); ?>
						</div>
					</li>
					<?php elseif(has_post_thumbnail() ): ?>
					<?php $attachment_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); ?>
					<?php $full_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); ?>
					<?php $attachment_data = wp_get_attachment_metadata(get_post_thumbnail_id()); ?>
					<li>
						<?php if( ! $zdata['status_lightbox'] && ! $zdata['status_lightbox_single'] ): ?>
						<a href="<?php echo $full_image[0]; ?>" rel="prettyPhoto[gallery<?php the_ID(); ?>]" title="<?php echo get_post_field('post_excerpt', get_post_thumbnail_id()); ?>"><img src="<?php echo $attachment_image[0]; ?>" alt="<?php echo get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true); ?>" /></a>
						<?php else: ?>
						<img src="<?php echo $attachment_image[0]; ?>" alt="<?php echo get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true); ?>" />
						<?php endif; ?>
					</li>
					<?php endif; ?>
					<?php else: ?>
					<?php if(get_post_meta($post->ID, 'pyre_video', true)): ?>
					<li>
						<div class="full-video">
							<?php echo get_post_meta($post->ID, 'pyre_video', true); ?>
						</div>
					</li>
					<?php endif; ?>
					<?php if(has_post_thumbnail() && !get_post_meta($post->ID, 'pyre_video', true)): ?>
					<?php $attachment_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); ?>
					<?php $full_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); ?>
					<?php $attachment_data = wp_get_attachment_metadata(get_post_thumbnail_id()); ?>
					<li>
						<?php if( ! $zdata['status_lightbox'] && ! $zdata['status_lightbox_single'] ): ?>
						<a href="<?php echo $full_image[0]; ?>" rel="prettyPhoto[gallery<?php the_ID(); ?>]" title="<?php echo get_post_field('post_excerpt', get_post_thumbnail_id()); ?>"><img src="<?php echo $attachment_image[0]; ?>" alt="<?php echo get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true); ?>" /></a>
						<?php else: ?>
						<img src="<?php echo $attachment_image[0]; ?>" alt="<?php echo get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true); ?>" />
						<?php endif; ?>
					</li>
					<?php endif; ?>
					<?php foreach($attachments as $attachment): ?>
					<?php $attachment_image = wp_get_attachment_image_src($attachment->ID, 'full'); ?>
					<?php $full_image = wp_get_attachment_image_src($attachment->ID, 'full'); ?>
					<?php $attachment_data = wp_get_attachment_metadata($attachment->ID); ?>
					<li>
						<?php if( ! $zdata['status_lightbox'] && ! $zdata['status_lightbox_single'] ): ?>
						<a href="<?php echo $full_image[0]; ?>" rel="prettyPhoto[gallery<?php the_ID(); ?>]" title="<?php echo get_post_field('post_excerpt', $attachment->ID); ?>"><img src="<?php echo $attachment_image[0]; ?>" alt="<?php echo get_post_meta($attachment->ID, '_wp_attachment_image_alt', true); ?>" /></a>
						<?php else: ?>
						<img src="<?php echo $attachment_image[0]; ?>" alt="<?php echo get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true); ?>" />
						<?php endif; ?>
					</li>
					<?php endforeach; ?>
					<?php endif; ?>
				</ul>
			</div>
			<?php endif; ?>
			<?php else: ?>
			<?php
			if((has_post_thumbnail() || get_post_meta($post->ID, 'pyre_video', true))):
			?>
			<div class="fusion-flexslider flexslider post-slideshow">
				<ul class="slides">
					<?php if(!$zdata['posts_slideshow']): ?>
					<?php if(get_post_meta($post->ID, 'pyre_video', true)): ?>
					<li>
						<div class="full-video">
							<?php echo get_post_meta($post->ID, 'pyre_video', true); ?>
						</div>
					</li>
					<?php elseif(has_post_thumbnail() ): ?>
					<?php $attachment_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); ?>
					<?php $full_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); ?>
					<?php $attachment_data = wp_get_attachment_metadata(get_post_thumbnail_id()); ?>
					<li>
						<?php if( ! $zdata['status_lightbox'] && ! $zdata['status_lightbox_single'] ): ?>
						<a href="<?php echo $full_image[0]; ?>" rel="prettyPhoto[gallery<?php the_ID(); ?>]" title="<?php echo get_post_field('post_excerpt', get_post_thumbnail_id()); ?>"><img src="<?php echo $attachment_image[0]; ?>" alt="<?php echo get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true); ?>" /></a>
						<?php else: ?>
						<img src="<?php echo $attachment_image[0]; ?>" alt="<?php echo get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true); ?>" />
						<?php endif; ?>
					</li>
					<?php endif; ?>
					<?php else: ?>
					<?php if(get_post_meta($post->ID, 'pyre_video', true)): ?>
					<li>
						<div class="full-video">
							<?php echo get_post_meta($post->ID, 'pyre_video', true); ?>
						</div>
					</li>
					<?php endif; ?>
					<?php if(has_post_thumbnail() ): ?>
					<?php $attachment_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); ?>
					<?php $full_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); ?>
					<?php $attachment_data = wp_get_attachment_metadata(get_post_thumbnail_id()); ?>
					<li>
						<?php if( ! $zdata['status_lightbox'] && ! $zdata['status_lightbox_single'] ): ?>
						<a href="<?php echo $full_image[0]; ?>" rel="prettyPhoto[gallery<?php the_ID(); ?>]" title="<?php echo get_post_field('post_excerpt', get_post_thumbnail_id()); ?>"><img src="<?php echo $attachment_image[0]; ?>" alt="<?php echo get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true); ?>" /></a>
						<?php else: ?>
						<img src="<?php echo $attachment_image[0]; ?>" alt="<?php echo get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true); ?>" />
						<?php endif; ?>
					</li>
					<?php endif; ?>
					<?php
					$i = 2;
					while($i <= $zdata['posts_slideshow_number']):
					$attachment_new_id = kd_mfi_get_featured_image_id('featured-image-'.$i, 'post');
					if($attachment_new_id):
					?>
					<?php $attachment_image = wp_get_attachment_image_src($attachment_new_id, 'full'); ?>
					<?php $full_image = wp_get_attachment_image_src($attachment_new_id, 'full'); ?>
					<?php $attachment_data = wp_get_attachment_metadata($attachment_new_id); ?>
					<li>
						<?php if( ! $zdata['status_lightbox'] && ! $zdata['status_lightbox_single'] ): ?>
						<a href="<?php echo $full_image[0]; ?>" rel="prettyPhoto[gallery<?php the_ID(); ?>]" title="<?php echo get_post_field('post_excerpt', $attachment_new_id); ?>"><img src="<?php echo $attachment_image[0]; ?>" alt="<?php echo get_post_meta($attachment_new_id, '_wp_attachment_image_alt', true); ?>" /></a>
						<?php else: ?>
						<img src="<?php echo $attachment_image[0]; ?>" alt="<?php echo get_post_meta($attachment_new_id, '_wp_attachment_image_alt', true); ?>" />
						<?php endif; ?>
					</li>
					<?php endif; $i++; endwhile; ?>
					<?php endif; ?>
				</ul>
			</div>
			<?php endif; ?>
			<?php endif; ?>
			<?php endif; ?>
			<?php endif; ?>
			<?php if($zdata['blog_post_title']): ?>
			<h2 class="entry-title"><?php the_title(); ?></h2>
			<?php else: ?>
			<span class="entry-title" style="display: none;"><?php the_title(); ?></span>
			<?php endif; ?>
			<div class="post-content">
				<?php the_content(); ?>
				<?php wp_link_pages(); ?>
			</div>
			<?php if( ! post_password_required($post->ID) ): ?>
			<?php if($zdata['post_meta'] && ( (!$zdata['post_meta_author']) || (!$zdata['post_meta_date']) || (!$zdata['post_meta_cats']) || (!$zdata['post_meta_comments']) || (!$zdata['post_meta_tags']) ) ): ?>
			<div class="meta-info">
				<div class="vcard">
<<<<<<< HEAD
					<?php if(!$smof_data['post_meta_author']): ?><?php echo __('By', 'Zhane'); ?> <span class="fn"><?php the_author_posts_link(); ?></span><span class="sep">|</span><?php endif; ?><?php if(!$smof_data['post_meta_date']): ?><span class="updated" style="display:none;"><?php the_modified_time( 'c' ); ?></span><span class="published"><?php the_time($smof_data['date_format']); ?></span><span class="sep">|</span><?php endif; ?><?php if(!$smof_data['post_meta_cats']): ?><?php if(!$smof_data['post_meta_tags']){ echo __('Categories:', 'Zhane') . ' '; } ?><?php the_category(', '); ?><span class="sep">|</span><?php endif; ?><?php if(!$smof_data['post_meta_tags']): ?><span class="meta-tags"><?php echo __('Tags:', 'Zhane') . ' '; the_tags( '' ); ?></span><span class="sep">|</span><?php endif; ?><?php if(!$smof_data['post_meta_comments']): ?><?php comments_popup_link(__('0 Comments', 'Zhane'), __('1 Comment', 'Zhane'), '% '.__('Comments', 'Zhane')); ?><?php endif; ?>
=======
					<?php if(!$zdata['post_meta_author']): ?><?php echo __('By', 'Zhane'); ?> <span class="fn"><?php the_author_posts_link(); ?></span><span class="sep">|</span><?php endif; ?><?php if(!$zdata['post_meta_date']): ?><span class="updated" style="display:none;"><?php the_modified_time( 'c' ); ?></span><span class="published"><?php the_time($zdata['date_format']); ?></span><span class="sep">|</span><?php endif; ?><?php if(!$zdata['post_meta_cats']): ?><?php if(!$zdata['post_meta_tags']){ echo __('Categories:', 'Zhane') . ' '; } ?><?php the_category(', '); ?><span class="sep">|</span><?php endif; ?><?php if(!$zdata['post_meta_tags']): ?><span class="meta-tags"><?php echo __('Tags:', 'Zhane') . ' '; the_tags( '' ); ?></span><span class="sep">|</span><?php endif; ?><?php if(!$zdata['post_meta_comments']): ?><?php comments_popup_link(__('0 Comments', 'Zhane'), __('1 Comment', 'Zhane'), '% '.__('Comments', 'Zhane')); ?><?php endif; ?>
>>>>>>> c581f49f3d8b06169e9c9bfa25ca3e30db15ac0e
				</div>
			</div>
			<?php endif; ?>
			<?php if( $zdata['social_sharing_box'] ):
				$full_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
				$sharingbox_soical_icon_options = array (
					'sharingbox'		=> 'yes',
					'icon_colors' 		=> $zdata['sharing_social_links_icon_color'],
					'box_colors' 		=> $zdata['sharing_social_links_box_color'],
					'icon_boxed' 		=> $zdata['sharing_social_links_boxed'],
					'icon_boxed_radius' => $zdata['sharing_social_links_boxed_radius'],
					'tooltip_placement'	=> $zdata['sharing_social_links_tooltip_placement'],
					'linktarget'		=> '_blank',
					'title'				=> urlencode( $post->post_title ),
					'description'		=> get_the_title( $post->ID ),
					'link'				=> get_the_permalink( $post->ID ),
					'pinterest_image'	=> urlencode( $full_image[0] ),
				);
				?>
				<div class="fusion-sharing-box share-box">
					<h4><?php echo __('Share This Story, Choose Your Platform!', 'Zhane'); ?></h4>
					<?php echo $social_icons->render_social_icons( $sharingbox_soical_icon_options ); ?>
				</div>
			<?php endif; ?>
			<?php if($zdata['author_info']): ?>
			<div class="about-author">
				<div class="fusion-title title"><h2 class="title-heading-left"><?php echo __('About the Author:', 'Zhane'); ?> <?php the_author_posts_link(); ?></h2><div class="title-sep-container"><div class="title-sep sep-double"></div></div></div>
				<div class="about-author-container">
					<div class="avatar">
						<?php echo get_avatar(get_the_author_meta('email'), '72'); ?>
					</div>
					<div class="description">
						<?php the_author_meta("description"); ?>
					</div>
				</div>
			</div>
			<?php endif; ?>

			<?php if( ($zdata['related_posts'] && get_post_meta($post->ID, 'pyre_related_posts', true ) != 'no' ) ||
					  ( ! $zdata['related_posts'] && get_post_meta($post->ID, 'pyre_related_posts', true) == 'yes' ) ): ?>
			<?php $related = get_related_posts($post->ID, $zdata['number_related_posts']); ?>
			<?php if($related->have_posts()): ?>
			<div class="related-posts single-related-posts">
				<div class="fusion-title title"><h2 class="title-heading-left"><?php echo __('Related Posts', 'Zhane'); ?></h2><div class="title-sep-container"><div class="title-sep sep-double"></div></div></div>
				<div id="carousel" class="es-carousel-wrapper fusion-carousel-large">
					<div class="es-carousel">
						<ul>
							<?php while($related->have_posts()): $related->the_post(); ?>
							<?php if(has_post_thumbnail()): ?>
							<li>
								<div class="image" aria-haspopup="true">
									<?php if($zdata['image_rollover']): ?>
									<?php the_post_thumbnail('related-img'); ?>
									<?php else: ?>
									<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail('related-img'); ?></a>
									<?php endif; ?>
									<?php
									if(get_post_meta($post->ID, 'pyre_image_rollover_icons', true) == 'link') {
										$link_icon_css = 'display:inline-block;';
										$zoom_icon_css = 'display:none;';
									} elseif(get_post_meta($post->ID, 'pyre_image_rollover_icons', true) == 'zoom') {
										$link_icon_css = 'display:none;';
										$zoom_icon_css = 'display:inline-block;';
									} elseif(get_post_meta($post->ID, 'pyre_image_rollover_icons', true) == 'no') {
										$link_icon_css = 'display:none;';
										$zoom_icon_css = 'display:none;';
									} else {
										$link_icon_css = 'display:inline-block;';
										$zoom_icon_css = 'display:inline-block;';
									}

									$icon_url_check = get_post_meta(get_the_ID(), 'pyre_link_icon_url', true); if(!empty($icon_url_check)) {
										$icon_permalink = get_post_meta($post->ID, 'pyre_link_icon_url', true);
									} else {
										$icon_permalink = get_permalink($post->ID);
									}
									?>
									<div class="image-extras">
										<div class="image-extras-content">
											<?php $full_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full'); ?>
											<a style="<?php echo $link_icon_css; ?>" class="icon link-icon" href="<?php echo $icon_permalink; ?>">Permalink</a>
											<?php
											if(get_post_meta($post->ID, 'pyre_video_url', true)) {
												$full_image[0] = get_post_meta($post->ID, 'pyre_video_url', true);
											}
											?>
											<a style="<?php echo $zoom_icon_css; ?>" class="icon gallery-icon" href="<?php echo $full_image[0]; ?>" rel="prettyPhoto[gallery]">Gallery</a>
											<h3><a href="<?php echo $icon_permalink; ?>"><?php the_title(); ?></a></h3>
										</div>
									</div>
								</div>
							</li>
							<?php endif; endwhile; ?>
						</ul>
					</div>
					<div class="es-nav"><span class="es-nav-prev"></span><span class="es-nav-next"></span></div>
				</div>
			</div>
			<?php wp_reset_postdata(); endif; ?>
			<?php endif; ?>
			<?php if($zdata['blog_comments']): ?>
				<?php
				wp_reset_query();
				comments_template();
				?>
			<?php endif; ?>
			<?php endif; ?>
		</div>
		<?php endif; ?>
	</div>
	<?php if( $sidebar_exists == true ): ?>
	<?php wp_reset_query(); ?>
	<div id="sidebar" style="<?php echo $sidebar_css; ?>">
	<?php generated_dynamic_sidebar(); ?>
	</div>
	<?php endif; ?>
<?php get_footer(); ?>