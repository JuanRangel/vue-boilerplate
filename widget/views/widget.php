<?php

$slides = get_option( 'home_slider' );
?>

<div class="vsellis-slider">
	<?php foreach ( $slides as $slide ) : ?>
		<div class='slide-type-<?php echo $slide['type']; ?>' style="background-image: url(<?php echo $slide['img']; ?>)">
			<div class="slide-content">
				<h3><?php echo $slide['title'] ?></h3>
				<p><?php echo $slide['content']; ?></p>
				<a class="btn" href="<?php echo $slide['link']; ?>">See More</a>
			</div>

			<?php if ( 'video' == $slide['type'] ) : ?>
				<a href="<?php echo $slide['link']; ?>">
					<div class="slider-video-overlay"></div>
				</a>
			<?php endif; ?>

		</div>
	<?php endforeach; ?>
</div>