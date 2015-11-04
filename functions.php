<?php

// enqueue the child theme stylesheet

Function gofix_enqueue_scripts() {
	wp_enqueue_style( 'tipso', get_stylesheet_directory_uri() . '/css/tipso.min.css'  );
	wp_enqueue_script( 'tipso', get_stylesheet_directory_uri() . '/js/tipso.min.js', array(), '1.0.0', true );
	wp_enqueue_style( 'autcomplete', get_stylesheet_directory_uri() . '/css/jquery.auto-complete.css'  );
	wp_enqueue_script( 'autcomplete', get_stylesheet_directory_uri() . '/js/jquery.auto-complete.min.js', array(), '1.0.0', true );
	wp_enqueue_style( 'sweetalert', get_stylesheet_directory_uri() . '/css/sweetalert.css'  );
	wp_enqueue_script( 'sweetalert', get_stylesheet_directory_uri() . '/js/sweetalert.min.js', array(), '1.0.0', true );
	wp_enqueue_style( 'childstyle', get_stylesheet_directory_uri() . '/style.css'  );
	wp_enqueue_script( 'childscript', get_stylesheet_directory_uri() . '/js/custom.js', array(), '1.0.0', true );
	wp_localize_script( 'childscript', 'gofix', array('data_link' => get_stylesheet_directory_uri() . '/data.json') );
}
add_action( 'wp_enqueue_scripts', 'gofix_enqueue_scripts', 11);


function sentenceblock( $atts ) {
	ob_start();
?>
	
	<div class="sentenceblock-container"><div class="sentenceblock-inner">
		<h2>Local expert repairers</h2>
		<div class="sentence clearfix">
			<div class="part1 clearfix">
				<div class="brand">My <input type="text" name="brand" placeholder="Your Brand" value="" /></div>
				<div class="what clearfix">
					<ul class="option-list">
						<li>washing machine</li>
						<li>fridge/freezer</li>
						<li>dish washer</li>
						<li>oven/hob</li>
						<li>tumble dryer</li>
						<li>cooker</li>
					</ul> is broken.
				</div>
			</div>
			<div class="part2 clearfix">
				<div class="des">I'd like a repair</div>
				<div class="when clearfix">
					<ul class="option-list">
						<li>today</li>
						<li>tomorrow</li>
						<li>this week</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="result">
			<div class="price">
				<div class="tick-icon"></div>
			    Fixed price: £<i>0</i>
			</div>
			<div class="desc"><span class="desc1">no hidden cost:</span> <span class="desc2">call out, parts and labour included</span></div>
			<a class="qbutton small get-in-touch disabled">Get in touch with Jenny</a>
		</div>
	</div></div>

<?php
	$output = ob_get_contents();
	ob_end_clean();
	return $output;
}
add_shortcode( 'sentenceblock', 'sentenceblock' );