		</div>
	</div>
	<?php global $zdata, $social_icons; ?>
	<?php
	$object_id = get_queried_object_id();
	if((get_option('show_on_front') && get_option('page_for_posts') && is_home()) ||
	    (get_option('page_for_posts') && is_archive() && !is_post_type_archive()) && !(is_tax('product_cat') || is_tax('product_tag')) || (get_option('page_for_posts') && is_search())) {
		$c_pageID = get_option('page_for_posts');
	} else {
		if(isset($object_id)) {
			$c_pageID = $object_id;
		}

		if(class_exists('Woocommerce')) {
			if(is_shop() || is_tax('product_cat') || is_tax('product_tag')) {
				$c_pageID = get_option('woocommerce_shop_page_id');
			}
		}
	}
	?>
	<?php if(!is_page_template('blank.php')): ?>
	<?php if( ($zdata['footer_widgets'] && get_post_meta($c_pageID, 'pyre_display_footer', true) != 'no') ||
			  ( ! $zdata['footer_widgets'] && get_post_meta($c_pageID, 'pyre_display_footer', true) == 'yes') ): ?>
	<footer class="footer-area">
		<div class="zhane-row">
<<<<<<< HEAD
			<section class="fusion-columns row fusion-columns-<?php echo $smof_data['footer_widgets_columns']; ?> columns columns-<?php echo $smof_data['footer_widgets_columns']; ?>">
				<?php $column_width = 12 / $smof_data['footer_widgets_columns']; ?>
=======
			<section class="fusion-columns row fusion-columns-<?php echo $zdata['footer_widgets_columns']; ?> columns columns-<?php echo $zdata['footer_widgets_columns']; ?>">
				<?php $column_width = 12 / $zdata['footer_widgets_columns']; ?>
>>>>>>> c581f49f3d8b06169e9c9bfa25ca3e30db15ac0e
			
				<?php if( $zdata['footer_widgets_columns'] >= 1 ): ?>
				<article class="fusion-column col <?php echo sprintf( 'col-lg-%s col-md-%s col-sm-%s', $column_width, $column_width, $column_width ); ?> ">
				<?php
				if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Widget 1')):
				endif;
				?>
				</article>
				<?php endif; ?>
				
				<?php if( $zdata['footer_widgets_columns'] >= 2 ): ?>
				<article class="fusion-column col <?php echo sprintf( 'col-lg-%s col-md-%s col-sm-%s', $column_width, $column_width, $column_width ); ?>">
				<?php
				if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Widget 2')):
				endif;
				?>
				</article>
				<?php endif; ?>
				
				<?php if( $zdata['footer_widgets_columns'] >= 3 ): ?>
				<article class="fusion-column col <?php echo sprintf( 'col-lg-%s col-md-%s col-sm-%s', $column_width, $column_width, $column_width ); ?>">
				<?php
				if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Widget 3')):
				endif;
				?>
				</article>
				<?php endif; ?>
				
				<?php if( $zdata['footer_widgets_columns'] >= 4 ): ?>
				<article class="fusion-column col last <?php echo sprintf( 'col-lg-%s col-md-%s col-sm-%s', $column_width, $column_width, $column_width ); ?>">
				<?php
				if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Widget 4')):
				endif;
				?>
				</article>
				<?php endif; ?>
				<div class="fusion-clearfix"></div>
			</section>
		</div>
	</footer>
	<?php endif; ?>
	<?php if( ($zdata['footer_copyright'] && get_post_meta($c_pageID, 'pyre_display_copyright', true) != 'no') ||
			  ( ! $zdata['footer_copyright'] && get_post_meta($c_pageID, 'pyre_display_copyright', true) == 'yes') ): ?>
	<footer id="footer">
		<div class="zhane-row">
			<div class="copyright-area-content">
				<div class="copyright">
					<div><?php echo $zdata['footer_text'] ?></div>
				</div>
				<div class="fusion-social-links-footer">
				<?php if($zdata['icons_footer']) {

					$footer_soical_icon_options = array (
						'icon_colors' 		=> $zdata['footer_social_links_icon_color'],
						'box_colors' 		=> $zdata['footer_social_links_box_color'],
						'icon_boxed' 		=> $zdata['footer_social_links_boxed'],
						'icon_boxed_radius' => $zdata['footer_social_links_boxed_radius'],
						'tooltip_placement'	=> $zdata['footer_social_links_tooltip_placement'],
						'linktarget'		=> $zdata['social_icons_new']
					);

					//$footer_social_icons = new Zhane_SocialIcons( $footer_soical_icon_options );
					echo $social_icons->render_social_icons($footer_soical_icon_options);

				} ?>
				</div>
			</div>
		</div>
	</footer>
	<?php endif; ?>
	<?php endif; ?>
	</div><!-- wrapper -->
	<?php //include_once('style_selector.php'); ?>
	
	<!-- W3TC-include-js-head -->

	<?php wp_footer(); ?>

	<?php echo $zdata['space_body']; ?>

	<!--[if lte IE 8]>
	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/respond.js"></script>
	<![endif]-->
</body>
</html>