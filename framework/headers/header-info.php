<?php global $zdata; ?>
<?php if($zdata['header_number'] || $zdata['header_email']): ?>
<div class="header-info"><?php echo $zdata['header_number']; ?><?php if($zdata['header_number'] && $zdata['header_email']): ?><span class="sep">|</span><?php endif; ?><a href="mailto:<?php echo $zdata['header_email']; ?>"><?php echo $zdata['header_email']; ?></a></div>
<?php endif; ?>
