<?php global $zdata; ?>
<div class="header-v1">
	<header id="header">
		<div class="zhane-row" style="padding-top:<?php echo $zdata['margin_header_top']; ?>;padding-bottom:<?php echo $zdata['margin_header_bottom']; ?>;" data-padding-top="<?php echo $zdata['margin_header_top']; ?>" data-padding-bottom="<?php echo $zdata['margin_header_bottom']; ?>">
			<div class="logo" data-margin-right="<?php echo $zdata['margin_logo_right']; ?>" data-margin-left="<?php echo $zdata['margin_logo_left']; ?>" data-margin-top="<?php echo $zdata['margin_logo_top']; ?>" data-margin-bottom="<?php echo $zdata['margin_logo_bottom']; ?>" style="margin-right:<?php echo $zdata['margin_logo_right']; ?>;margin-top:<?php echo $zdata['margin_logo_top']; ?>;margin-left:<?php echo $zdata['margin_logo_left']; ?>;margin-bottom:<?php echo $zdata['margin_logo_bottom']; ?>;">
				<a href="<?php bloginfo('url'); ?>">
					<?php $image_size = getimagesize( $zdata['logo'] ); ?>
					<img src="<?php echo $zdata['logo']; ?>" alt="<?php bloginfo('name'); ?>" class="normal_logo" data-width="<?php echo $image_size[0]; ?>" data-height="<?php echo $image_size[1]; ?>" />
					<?php if($zdata['logo_retina'] && $zdata['retina_logo_width'] && $zdata['retina_logo_height']): ?>
					<?php
					$pixels ="";
					if(is_numeric($zdata['retina_logo_width']) && is_numeric($zdata['retina_logo_height'])):
					$pixels ="px";
					endif; ?>
					<img src="<?php echo $zdata["logo_retina"]; ?>" alt="<?php bloginfo('name'); ?>" style="width:<?php echo $zdata["retina_logo_width"].$pixels; ?>;max-height:<?php echo $zdata["retina_logo_height"].$pixels; ?>; height: auto !important" class="retina_logo" />
					<?php endif; ?>
				</a>
			</div>
			<?php if($zdata['ubermenu']): ?>
			<nav id="nav-uber">
			<?php else: ?>
			<nav id="nav" class="nav-holder" data-height="<?php echo $zdata['nav_height']; ?>px">
			<?php endif; ?>
				<?php get_template_part('framework/headers/header-main-menu'); ?>
			</nav>
			<?php if(tf_checkIfMenuIsSetByLocation('main_navigation')): ?>
			<div class="mobile-nav-holder main-menu"></div>
			<?php endif; ?>
		</div>
	</header>
</div>