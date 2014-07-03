<?php global $zdata; ?>
<div class="header-v2">
	<?php if($zdata['header_left_content'] != 'Leave Empty' || $zdata['header_right_content'] != 'Leave Empty'): ?>
	<div class="header-social">
		<div class="zhane-row">
			<div class="alignleft">
				<?php
				if($zdata['header_left_content'] == 'Contact Info') {
					get_template_part('framework/headers/header-info');
				} elseif($zdata['header_left_content'] == 'Social Links') {
					get_template_part('framework/headers/header-social');
				} elseif($zdata['header_left_content'] == 'Navigation') {
					get_template_part('framework/headers/header-menu');
				}
				?>
			</div>
			<div class="alignright">
				<?php
				if($zdata['header_right_content'] == 'Contact Info') {
					get_template_part('framework/headers/header-info');
				} elseif($zdata['header_right_content'] == 'Social Links') {
					get_template_part('framework/headers/header-social');
				} elseif($zdata['header_right_content'] == 'Navigation') {
					get_template_part('framework/headers/header-menu');
				}
				?>
			</div>
		</div>
	</div>
	<?php endif; ?>
	<header id="header">
		<div class="zhane-row" style="padding-top:<?php echo $zdata['margin_header_top']; ?>;padding-bottom:<?php echo $zdata['margin_header_bottom']; ?>;">
			<div class="logo" data-margin-right="<?php echo $zdata['margin_logo_right']; ?>" data-margin-left="<?php echo $zdata['margin_logo_left']; ?>" data-margin-top="<?php echo $zdata['margin_logo_top']; ?>" data-margin-bottom="<?php echo $zdata['margin_logo_bottom']; ?>" style="margin-right:<?php echo $zdata['margin_logo_right']; ?>;margin-top:<?php echo $zdata['margin_logo_top']; ?>;margin-left:<?php echo $zdata['margin_logo_left']; ?>;margin-bottom:<?php echo $zdata['margin_logo_bottom']; ?>;">
				<a href="<?php bloginfo('url'); ?>">
					<img src="<?php echo $zdata['logo']; ?>" alt="<?php bloginfo('name'); ?>" class="normal_logo" />
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
			<nav id="nav" class="nav-holder">
			<?php endif; ?>
				<?php get_template_part('framework/headers/header-main-menu'); ?>
			</nav>
			<?php if(tf_checkIfMenuIsSetByLocation('main_navigation')): ?>
			<div class="mobile-nav-holder main-menu"></div>
			<?php endif; ?>
		</div>
	</header>
</div>