<div id="<?php echo $idd; ?>" class="ifeatureslider ifeatureslider-<?php echo $id . ' ' . $auto; ?> ifslider-cover">
	<div class="if-wrapper">
		<ul class="if-slides">
			<?php foreach ( $slides as $i => $slide ) {
				if ( $i === 0 ) {
					$class = '';
					$cur   = 'current';
					$mrtop = floor( $slide['height'] / 2 );
				} else {
					$class = 'hide-slide';
					$cur   = '';
				}
				?>
				<li class="slide slide-<?php echo $i . ' ' . $class . ' ' . $cur; ?>">
					<img src="<?php echo $slide['img'] ?>" width="<?php echo $slide['width'] ?>" height="<?php echo $slide['height'] ?>"/>
				</li>
			<?php } ?>
		</ul>
		<div class="if-buttons" data-slide="<?php echo $this->slider_count; ?>">
			<div class="if-floater"></div>
			<a class="if-prev-btn">
				<span class="if-arrow prev">&laquo;</span>
			</a>
			<a class="if-next-btn">
				<span class="if-arrow next">&raquo;</span>
			</a>
		</div>
	</div>
</div>