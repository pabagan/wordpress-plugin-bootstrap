<?php
/*-----------------------------------------------------------------------------------*/
/* FORMATER  // thanks to TheBinaryPenguin from wordpress.org */
/*-----------------------------------------------------------------------------------*/
function my_formatter($content) {
	$new_content = '';
	$pattern_full = '{(\[raw\].*?\[/raw\])}is';
	$pattern_contents = '{\[raw\](.*?)\[/raw\]}is';
	$pieces = preg_split($pattern_full, $content, -1, PREG_SPLIT_DELIM_CAPTURE);

	foreach ($pieces as $piece) {
		if (preg_match($pattern_contents, $piece, $matches)) {
			$new_content .= $matches[1];
		} else {
			$new_content .= wptexturize(wpautop($piece));
		}
	}

	return $new_content;
}
	
remove_filter('the_content', 'wpautop');
remove_filter('the_content', 'wptexturize');

add_filter('the_content', 'my_formatter', 99);



/*-----------------------------------------------------------------------------------*/
/* DropCap */
/*-----------------------------------------------------------------------------------*/
add_shortcode('dropcap', 'shortcode_dropcap');

function shortcode_dropcap($atts, $content ="") {

	
	$html = '<span class="dropcap">' . do_shortcode($content) . '</span>';
	
	return $html;
	
}


/*-----------------------------------------------------------------------------------*/
/* Toggles */
/*-----------------------------------------------------------------------------------*/
add_shortcode('toggle', 'shortcode_toggle');

function shortcode_toggle($atts, $content = "") {

	extract(shortcode_atts(

		array(

			'title' => '',
			'opened' => 'no',
			
		), $atts));

			
			$html = '<div class="toggle">';
			
				if($atts['opened'] == 'yes'){
				
					$html .= '<h5 class="toggler opened"><span aria-hidden="true" data-icon="&#10133;" data-icon-close="&#10134;"></span>' .$atts['title']. '</h5>';
					
				} else {
				
					$html .= '<h5 class="toggler"><span aria-hidden="true" data-icon="&#10133;" data-icon-close="&#10134;"></span>' .$atts['title']. '</h5>';
				
				}
					
			
				$html .= '<div class="toggled">' . do_shortcode($content) . '</div>';
		
			$html .= '</div>';

		return $html;
		
}


/*-----------------------------------------------------------------------------------*/
/* Personas */
/*-----------------------------------------------------------------------------------*/
add_shortcode('persona', 'shortcode_persona');

function shortcode_persona($atts, $content = "") {

	extract(shortcode_atts(

		array(

			'name' => '',
			'position' => '',
			'img' => '',
			'facebook' => '',
			'twitter' => '',
			'linkedin' => '',
			'google' => '',
			'pinterest' => '',
			'youtube' => '',
			'vimeo' => '',
			'dribbble' => '',
			'soundcloud' => '',
			'flickr' => '',
			'email' => ''

		), $atts));

					
			$html = '<div class="persona full box">';
			
				$html .= '<div class="rel">';
					
					$html .= '<img src="' . $atts['img'] . '" alt="' . $atts['name'] . '" />';
					
					$html .= '<div class="curtain hide">';
					
						$html .= '<ul class="social hide circled white">';
						
						if($atts['facebook'] != "") {
							$html .= '<li><a class="fb" target="__blank" href="' .$atts['facebook']. '" title="Facebook"><span>Red</span></a></li>';
						}
						
						if($atts['twitter'] != "") {
							$html .= '<li><a class="twitter" target="__blank" href="' .$atts['twitter']. '" title="Twitter"><span>Red</span></a></li>';
						}
						if($atts['linkedin'] != "") {
							$html .= '<li><a class="linkedin" target="__blank" href="' .$atts['linkedin']. '" title="Linkedin"><span>Red</span></a></li>';
						}
						if($atts['google'] != "") {
							$html .= '<li><a class="google" target="__blank" href="' .$atts['google']. '" title="Google Plus"><span>Red</span></a></li>';
						}
						if($atts['pinterest'] != "") {
							$html .= '<li><a class="pinterest" target="__blank" href="' .$atts['pinterest']. '" title="Pinterest"><span>Red</span></a></li>';
						}
						if($atts['youtube'] != "") {
							$html .= '<li><a class="youtube" target="__blank" href="' .$atts['youtube']. '" title="Youtube"><span>Red</span></a></li>';
						}
						if($atts['vimeo'] != "") {
							$html .= '<li><a class="vimeo" target="__blank" href="' .$atts['vimeo']. '" title="Vimeo"><span>Red</span></a></li>';
						}
						if($atts['dribbble'] != "") {
							$html .= '<li><a class="dribbble" target="__blank" href="' .$atts['dribbble']. '" title="Dribbble"><span>Red</span></a></li>';
						}
						if($atts['soundcloud'] != "") {
							$html .= '<li><a class="soundcloud" target="__blank" href="' .$atts['soundcloud']. '" title="SoundCloud"><span>Red</span></a></li>';
						}
						if($atts['flickr'] != "") {
							$html .= '<li><a class="flickr" target="__blank" href="' .$atts['flickr']. '" title="Flickr"><span>Red</span></a></li>';
						}
						if($atts['email'] != "") {
							$html .= '<li><a class="email" target="__blank" href="mailto:' .$atts['email']. '" title="e-mail"><span>Red</span></a></li>';
						}

						$html .= '</ul>';

					$html .= '</div>';
					
				$html .= '</div>';
				
			$html .= '<h5>' .$atts['name']. '</h5>';
			
			$html .= '<h6>' .$atts['position']. '</h6>';
			
			$html .= do_shortcode($content);
		
		$html .= '</div>';

		return $html;

}

/*-----------------------------------------------------------------------------------*/
/* One half column */
/*-----------------------------------------------------------------------------------*/
add_shortcode('g1_2', 'short_g1_2');

function short_g1_2($atts, $content = "") {

	extract(shortcode_atts( array(

			'last' => 'no',

		), $atts));


		if($atts['last'] == 'yes') {

			return '<div class="g1_2 last">' .do_shortcode($content). '</div><div class="clearboth"></div>';

		} else {

			return '<div class="g1_2">' .do_shortcode($content). '</div>';

		}

}


/*-----------------------------------------------------------------------------------*/
/* One third column */
/*-----------------------------------------------------------------------------------*/
add_shortcode('g1_3', 'short_g1_3');

function short_g1_3($atts, $content = "") {

	extract(shortcode_atts( array(

			'last' => 'no',

		), $atts));
		

		if($atts['last'] == 'yes') {

			return '<div class="g1_3 last">' .do_shortcode($content). '</div><div class="clearboth"></div>';

		} else {

			return '<div class="g1_3">' .do_shortcode($content). '</div>';

		}

}


/*-----------------------------------------------------------------------------------*/
/* One fourth column */
/*-----------------------------------------------------------------------------------*/
add_shortcode('g1_4', 'short_g1_4');

function short_g1_4($atts, $content = "") {

	extract(shortcode_atts( array(

			'last' => 'no',

		), $atts));		

		if($atts['last'] == 'yes') {

			return '<div class="g1_4 last">' .do_shortcode($content). '</div><div class="clearboth"></div>';

		} else {

			return '<div class="g1_4">' .do_shortcode($content). '</div>';

		}

}


/*-----------------------------------------------------------------------------------*/
/* Two third column */
/*-----------------------------------------------------------------------------------*/
add_shortcode('g2_3', 'short_g2_3');

function short_g2_3($atts, $content = "") {

	extract(shortcode_atts( array(

			'last' => 'no',

		), $atts));

		
		if($atts['last'] == 'yes') {

			return '<div class="g2_3 last">' .do_shortcode($content). '</div><div class="clearboth"></div>';

		} else {

			return '<div class="g2_3">' .do_shortcode($content). '</div>';

		}

}



/*-----------------------------------------------------------------------------------*/
/* three fourth column */
/*-----------------------------------------------------------------------------------*/
add_shortcode('g3_4', 'short_g3_4');

function short_g3_4($atts, $content = "") {

	extract(shortcode_atts( array(

			'last' => 'no',

		), $atts));

		
		if($atts['last'] == 'yes') {

			return '<div class="g3_4 last">' .do_shortcode($content). '</div><div class="clearboth"></div>';

		} else {

			return '<div class="g3_4">' .do_shortcode($content). '</div>';

		}

}


/*-----------------------------------------------------------------------------------*/
/* Soundcloud */
/*-----------------------------------------------------------------------------------*/
add_shortcode('soundcloud', 'short_soundcloud');

function short_soundcloud($atts) {

	extract(shortcode_atts(

		array(
			'url' => ''
		), $atts));

        $html = '<div class="embed-responsive embed-responsive-16by9">';
            $html .= '<iframe id="sc-widget" width="640" height="166" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=' . esc_url($atts['url']) . '&amp;auto_play=false&amp;hide_related=false&amp;visual=true"></iframe>';
		$html .= '</div>';

        return $html;

}


/*-----------------------------------------------------------------------------------*/
/* Youtube */
/*-----------------------------------------------------------------------------------*/
add_shortcode('youtube', 'shortcode_youtube');

function shortcode_youtube($atts) {

	extract(shortcode_atts(

		array(

			'id' => '',

		), $atts));

        $html = '<div class="embed-responsive embed-responsive-16by9">';
            $html .= '<iframe title="YouTube video player" class="youtube-player" type="text/html"  width="420" height="315" src="http://www.youtube.com/embed/' . $atts['id'] . '?autohide=1&amp;showinfo=0&amp;rel=0&amp;wmode=opaque"></iframe>';
        $html .= '</div>';
    
        return $html;

}
    

/*-----------------------------------------------------------------------------------*/
/* VIMEO */
/*-----------------------------------------------------------------------------------*/
add_shortcode('vimeo', 'shortcode_vimeo');

function shortcode_vimeo($atts) {

    extract(shortcode_atts(

        array(

            'id' => '',

        ), $atts));
        
        $html = '<div class="embed-responsive embed-responsive-16by9">';
			$html .= '<iframe title="Vimeo video player" width="" height="" src="http://player.vimeo.com/video/' . $atts['id'] . '" frameborder="0" allowfullscreen></iframe>';
		$html .= '</div>';
	
		return $html;
}


/*-----------------------------------------------------------------------------------*/
/* Price table */
/*-----------------------------------------------------------------------------------*/
add_shortcode('pricing_table', 'shortcode_pricing_table');

function shortcode_pricing_table($atts, $content = "") {

	extract(shortcode_atts(
		array(

			'type' => ''

		), $atts));

	$html = '<div class="price-table '.$attr['type'] .'">';

	$html .= do_shortcode($content);

	$html .= '</div>';

	return $html;

}

			

/*-----------------------------------------------------------------------------------*/
/* Price Column */
/*-----------------------------------------------------------------------------------*/			
add_shortcode('table_column', 'shortcode_table_column');

function shortcode_table_column($atts, $content = "") {

	extract(shortcode_atts(
	
		array(

			'title' => ''

		), $atts));
	
	$html = '<div class="price-column">';

		$html .= '<ul>';

		$html .= '<li class="price-title">' . $atts['title'] . '</li>';

			$html .= do_shortcode($content);

		$html .= '</ul>';

	$html .= '</div>';

return $html;

}


/*-----------------------------------------------------------------------------------*/
/* Price Row */
/*-----------------------------------------------------------------------------------*/
add_shortcode('table_price', 'shortcode_table_price');

function shortcode_table_price($atts, $content = "") {

	extract(shortcode_atts(
		array(

			'period' => ''

		), $atts));

	$html = '<li class="price-row">' . do_shortcode($content) . '/ <span class="price-period">' . $atts['period'] . '</span></li>';

return $html;

}



/*-----------------------------------------------------------------------------------*/
/* Common Row */
/*-----------------------------------------------------------------------------------*/
add_shortcode('table_row', 'shortcode_table_row');

function shortcode_table_row($atts, $content = "") {


	$html = '<li class="common-row">' . do_shortcode($content) . '</li>';

	return $html;

}



/*-----------------------------------------------------------------------------------*/
/* Price Footer */
/*-----------------------------------------------------------------------------------*/
add_shortcode('table_footer', 'shortcode_table_footer');

function shortcode_table_footer($atts, $content = "") {


	$html = '<li class="footer-row">' . do_shortcode($content). '</li>';

	return $html;

}


/*-----------------------------------------------------------------------------------*/
/* Pretty List */
/*-----------------------------------------------------------------------------------*/
add_shortcode('style_list', 'shortcode_style_list');

function shortcode_style_list($atts, $content = "") {


	$html = '<ul class="style-list">';
	
		$html .= do_shortcode($content);
		
	$html .= '</ul>';

	return $html;

}


add_shortcode('list_item', 'shortcode_list_item');


/*-----------------------------------------------------------------------------------*/
/* LIST ITEM */
/*-----------------------------------------------------------------------------------*/
function shortcode_list_item($atts, $content = "") {


	$html = '<li><span class="icon-arrow-right"></span>';
	
		$html .= do_shortcode($content);
		
	$html .= '</li>';

	return $html;

}


/*-----------------------------------------------------------------------------------*/
/* Testimonial */
/*-----------------------------------------------------------------------------------*/
add_shortcode('testimonial', 'shortcode_testimonial');

function shortcode_testimonial($atts, $content = "") {

	extract(shortcode_atts(
		array(
			'other_info'=> '',
			'name' => '',
			'other_info_url'=>'',
			'style'=>'',
			'img'=>''

	), $atts));
	
	

	$html = '<div class="testimonial">';
	
		if($atts['style'] == "theme2"){
		
			$html .='<div class="testi-text2">';
		
				$html .='<img class="circled" src="' . $atts['img'] . '" alt="Testimonial"/>';
					
				$html .= do_shortcode($content);
					
				$html .='<p><b>' . $atts['name'] . '</b>';
				
				if($atts['other_info'] != ''){
					
					if($atts['other_info_url'] != ''){
					
						$html .=', <a href="' . $atts['other_info_url'] . '" title="' . $atts['other_info'] . '">' . $atts['other_info'] . '</a>';
					
					} else{
					
						$html .=', ' .$atts['other_info'];
					
					}
				}
				
				$html .='</p>';
			
			$html .='</div>';
		
		} else {
		
			$html .='<div class="testi-text1">';
		
			$html .= do_shortcode($content);
		
			$html .='</div>';
			
			$html .='<p class="testi-person"><span data-icon="&#128100;" aria-hidden="true"></span><b>' . $atts['name'] . '</b>';
			
			if($atts['other_info'] != ''){
				
				if($atts['other_info_url'] != ''){
				
					$html .=', <a href="' . $atts['other_info_url'] . '" title="' . $atts['other_info'] . '">' . $atts['other_info'] . '</a>';
				
				} else{
				
					$html .=', ' .$atts['other_info'];
				
				}
			}
			
			$html .='</p>';
					
		}
			
	$html .='</div>';

	return $html;

}


/*-----------------------------------------------------------------------------------*/
/* Note */
/*-----------------------------------------------------------------------------------*/
add_shortcode('note', 'shortcode_note');

function shortcode_note($atts) {

	extract(shortcode_atts(

		array(

			'content' => '',

		), $atts));
		

		return '<span class="note-wrap"><sup>*</sup><span class="note-content">' . $atts['content'] . '</span></span>';
}
?>