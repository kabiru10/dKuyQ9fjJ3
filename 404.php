<?php get_header(); ?>
	<div id="content" class="full-width">
		<span class="vcard" style="display: none;"><span class="fn"><?php the_author_posts_link(); ?></span></span>
		<span class="updated" style="display:none;"><?php the_modified_time( 'c' ); ?></span>	
		<div id="post-404page">
			<div class="post-content">
				<div class="fusion-title title">
					<h2 class="title-heading-left"><?php echo __('Oops, This Page Could Not Be Found!', 'Zhane'); ?></h2><div class="title-sep-container"><div class="title-sep sep-double"></div></div>
				</div>
				<div class="fusion-clearfix"></div>
				<div class="error_page">
					<div class="one_third">
						<div class="error-message">404</div>
					</div>
					<div class="one_third useful_links">
						<h3><?php echo __('Here are some useful links:', 'Zhane'); ?></h3>

						<?php
						if( $zdata['checklist_circle'] ) {
							$circle_class = 'circle-yes';
						} else {
							$circle_class = 'circle-no';
						}
						wp_nav_menu(array('theme_location' => '404_pages', 'depth' => 1, 'container' => false, 'menu_id' => 'checklist-1', 'menu_class' => 'error-menu list-icon list-icon-arrow ' . $circle_class )); ?>
					</div>
					<div class="one_third last">
						<h3><?php echo __('Search Our Website', 'Zhane'); ?></a></h3>
						<p><?php echo __('Can\'t find what you need? Take a moment and do a search below!', 'Zhane'); ?></p>
						<div class="search-page-search-form">
							<form id="searchform" class="seach-form" role="search" method="get" action="<?php echo home_url( '/' ); ?>">
								<div class="search-table">
									<div class="search-field">
										<input type="text" value="" name="s" id="s" placeholder="<?php _e( 'Search ...', 'Zhane' ); ?>"/>
									</div>
									<div class="search-button">
										<input type="submit" id="searchsubmit" value="&#xf002;" />
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php get_footer(); ?>