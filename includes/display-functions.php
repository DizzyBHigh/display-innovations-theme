<?php
/**
 * cpt-display.php 
 * Created by: Dizzy B High 
 * Email: dizzy@base5designs.co.uk.
 * User: Dizzy
 * Display Innovations WP - 01, 2017
 */


/**
 * Get the bootstrap! If using as a plugin, REMOVE THIS!
 */
if ( file_exists( get_template_directory() . '/cmb2/init.php' ) ) {
	require_once get_template_directory() . '/cmb2/init.php';
}else{
	wp_die("CMB2 MetaBoxes is missing.");
};

if ( file_exists( get_template_directory() . '/cmb2-attached-posts/cmb2-attached-posts-field.php' ) ) {
	require_once get_template_directory() . '/cmb2-attached-posts/cmb2-attached-posts-field.php';
}else{
	wp_die("CMB2 MetaBoxes Attached Posts is missing.");
};

add_action( 'init',  'did_set_image_sizes' );

add_action( 'did_show_home_icon','did_show_home_icon' , 10, 1  );

add_action( 'did_show_banner','did_show_banner' , 10, 1  );

add_action( 'did_displays_menu','did_displays_menu' , 10, 1  );

add_action( 'did_display_icons','did_display_icons' , 10, 1  );

add_action( 'did_show_case_studies','did_show_case_studies' , 10, 1  );

add_action( 'did_show_images','did_show_images' , 10, 1  );

add_action( 'did_get_displays', 'did_get_displays', 10, 1 );

add_action( 'did_show_banner', 'did_show_banner', 10, 1 );

add_action( 'did_make_slider', 'did_make_slider', 10, 1 );

add_action( 'did_show_applications', 'did_show_applications', 10, 1 );

add_action( 'did_show_technical', 'did_show_technical', 10, 1 );

add_action( 'did_start_accordian_item', 'did_start_accordian_item', 10, 1 );

add_action( 'did_show_displays_footer', 'did_show_displays_footer', 10, 1 );

/**
 * Register Thumbnail sizes
 */
function did_set_image_sizes(){
	add_image_size( 'di_display_icon', '180', '143', false );
	add_image_size( 'di_banner_image', '978', '198', false );
	add_image_size( 'di_image_icon', '200', '170', false );
	add_image_size( 'di_image_icon_no_title', '210', '200', false );
	add_image_size( 'di_main_image', '730', '522', false );
}

function did_show_home_icon( $attachment_id) {
	$attachment = get_post( $attachment_id );
	$meta = did_get_post_meta($attachment_id);
	echo wp_get_attachment_image( $attachment_id , 'di_display_icon' ) .'<br>';
	echo $meta['title'];
}

function did_get_displays() {
	$args = array(
		'posts_per_page' => - 1, // -1 is for all
		'post_type'      => 'display', // or 'post', 'page'
		'orderby'        => 'menu_order',
		'order'          => 'ASC', // or 'DESC'
	);

	$query = new WP_Query( $args ); //
	return $query->posts;
}

function did_get_tech_specs() {
	$args = array(
		'posts_per_page' => - 1, // -1 is for all
		'post_type'      => 'technical', // or 'post', 'page'
		'orderby'        => 'menu_order',
		'order'          => 'ASC', // or 'DESC'
	);

	$query = new WP_Query( $args ); //
	return $query->posts;
}

function did_displays_menu(){
	$args = array(
		'posts_per_page'	=> -1, // -1 is for all
		'post_type'		=> 'display', // or 'post', 'page'
		'orderby'       => 'menu_order',
		'order' 		=> 'ASC', // or 'DESC'
	);

	$query = new WP_Query($args); //
	$last_cat = '';
	$cur_cat = '';
	$active_class = '';
	$current_page_url = did_current_url();
	$posts = $query->posts;
	if($posts) {
		foreach ( $posts as $post ) {
			$categories = get_the_category($post->ID);
			if ( ! empty( $categories ) ) {
				$last_cat = $categories[0]->name;
			}
			if($last_cat != $cur_cat){
				echo '<div class="display-button-header">' . $last_cat . '</div>';
			}
			if(get_permalink($post->ID) == $current_page_url){
				$active_class = '-active';
			}

			$menuLabel = get_post_meta($post->ID, '_did_menu_label');
			echo '<a href="' . get_permalink($post->ID) . '" class="display-menu-button'.$active_class.'">'.$menuLabel[0].'</a>';

			$cur_cat = $last_cat;
			$active_class = '';
		}
	}else{
		echo 'No Displays Installed';
	}
}

function did_display_icons(){
	$args = array(
		'posts_per_page'	=> -1, // -1 is for all
		'post_type'		=> 'display', // or 'post', 'page'
		'orderby'       => 'menu_order',
		'order' 		=> 'ASC', // or 'DESC'
	);

	$query = new WP_Query($args); //
	$last_cat = '';
	$cur_cat = '';
	$posts = $query->posts;
	$opened = false;
	if($posts) {
		foreach ( $posts as $post ) {
			$categories = get_the_category($post->ID);
			if ( ! empty( $categories ) ) {
				$cur_cat = $categories[0]->name;
			}
			if($last_cat != $cur_cat){
				if ( $opened ) {
					echo '</div>';
					$opened = false;
				}
				echo '<div class="icon-header">' . $cur_cat . '</div>';
			}
			$post_meta = get_post_meta( $post->ID, '', 0 ); //array of all data
			//get the post id of the icon image
			$iconID = $post_meta['_did_icon_id'][0];
			if ( ! $opened ) {
				echo '<div class="icon-area" data-equalizer>';
				$opened = true;
			}
			echo '<div class="icon-area-item" >';
			echo '<div class="di-base-border" data-equalizer-watch>';
			echo '<a class="" href="' . get_the_permalink($post->ID) .'">';
			do_action('did_show_home_icon', $iconID);
			echo '</a>';
			echo '</div>';
			echo '</div>';

			$last_cat = $cur_cat;
		}
	}else{
		echo 'No Displays Installed';
	}
}

function did_show_case_studies($id) {
	//get list of case study images
	$url = get_post_meta( $id, '_did_csurl', 1 );
	$buttonData = get_post_meta( $id, '_did_buttonlabel', 0 );
	$buttonText = $buttonData[0];
	if ( $url ) {
		echo '<div class="did-case-study">';
		echo '<a href="' . $url . '" target="_blank" alt="Case Studies">';
		echo '<div class="case-studies-button">' . $buttonText . '</div>';
		echo '</a>';
		echo '</div>';

		return;
	} else {
		$data       = get_post_meta( $id, '_did_images', 0 ); //array of case study images
		$image_list = $data[0];
		$count      = 1;
		if ( $image_list ) {
			echo '<div class="did-case-study">';
			foreach ( $image_list as $image_url ) {
				$attachment_id = did_get_attachment_id( $image_url );
				$image_meta    = did_get_post_meta( $attachment_id );
				//var_dump($image_meta);
				if ( $count < 2 ) {
					echo '<a class="fancybox" rel="casestudy" data-cs-title="' . $count . '" href="' . $image_url . '" alt="' . $image_meta['alt'] . '">';
					echo '<div class="case-studies-button">' . $buttonText . '</div>';
					echo '</a>';

					echo '<div class="fancybox-hidden">';// add hidden div to store titles html
					echo '<div id="cs-title-' . $count . '">';
						echo '<b>' . $image_meta['title'] . '<br>' . $image_meta['description'].'</b>';
					echo '</div>';

				} else {
					echo '<a class="fancybox" rel="casestudy" data-cs-title="' . $count . '" href="' . $image_url . '" alt="' . $image_meta['alt'] . '">';
					echo '<img src="' . $image_url . '" />';
					echo '</a>';
					// add hidden div to store titles html
					echo '<div class="fancybox-hidden">';// add hidden div to store titles html
					echo '<div id="cs-title-' . $count . '">';
					echo '<b>' . $image_meta['title'] . '<br>' . $image_meta['description'] . '</b>';
					echo '</div>';
					echo '</div>';// end hidden div to store titles html
				}
				$count ++;
			}
				echo '</div>';// end hidden div to store titles html
			echo '</div>';
		}

	}
}

function did_show_images($id) {
	//get list of images
	$titlePosition = get_post_meta( $id, '_did_show_title'); //Title Position
	$popup = get_post_meta($id, '_did_popup'); //show popup check
	$align = get_post_meta( $id, '_did_align' ); //show popup check
	$iconData = get_post_meta( $id, 'icons'); //array of icons
	$icons = $iconData[0];
	$title = false;
	$count=1;
	$posData = get_post_meta( $id );
	//var_dump($iconData);
	if($icons){
		//we have Icons so check alignment
		$align_class = '';
		if ( $align[0] == 'center' ) {
			$align_class = '-center';
		}
		echo '<div class="flexbox-display-icons' . $align_class . '" data-equalizer data-equalize-on="medium">';
		foreach($icons as $icon) {
			$count ++; //increment counter
			$icon_meta = did_get_post_meta( $icon['icon_id'] );//get icon meta data
			$stretch   = $icon['stretch'];//get then check stretch option
			switch ( $stretch ) {
				case 'tall':
					$class = '-tall';
					break;
				case 'wide':
					$class = '-wide';
					break;
				default:
					$class = '';
			}
			$title = $icon_meta['title']; //get the icons title
			$image_meta = did_get_post_meta( $icon['image_id'] ); //grt the icons meta data
			//var_dump($image_meta['src']);
			//var_dump(did_check_if_video($image_meta['url']));
			if ( $popup[0] == 'on' ) { // if pop-ups are required
				if ( $icon['icon_id'] ) { //check to see if there is an icon to display, If there is no icon there still maybe hidden content...
					if ( did_check_if_video( $image_meta['src'] ) ) { // if we have a video
						echo '<a class="fancybox flexbox-display-icon-page' . $class . '" rel="images" data-v-title="' . $count . '" href="#video-' . $count . '" data-equalizer-watch>';
					} else { //show image
						echo '<a class="fancybox flexbox-display-icon-page' . $class . '" rel="images" data-i-title="' . $count . '" href="' . $image_meta['src'] . '" alt="' . $image_meta['alt'] . '" data-equalizer-watch>';
					}
				} else {
					if ( did_check_if_video( $image_meta['src'] ) ) { // if a video shortCode has been entered show video
						echo '<a class="fancybox fancybox-hidden" rel="video" data-i-video="' . $count . '" href="#video-' . $count . '" alt="' . $image_meta['alt'] . '">';

					} else {
						echo '<a class="fancybox fancybox-hidden" rel="images" data-i-title="' . $count . '" href="' . $image_meta['src'] . '" alt="' . $image_meta['alt'] . '">';
					}
				}
				//show title if top or bottom is selected
				if ( $titlePosition != 'none' ) {
					if ( $titlePosition[0] == 'top' ) {
						echo $title . '<br>';
					}
					echo '<img class="di-image-icon' . $class . '" src="' . $icon_meta['src'] . '" />';

					if ( $titlePosition[0] == 'bottom' ) {
						echo '<br>' . $title;
					}
					if ( did_check_if_video( $image_meta['src'] ) ) {//add video icon if its a video
						echo '<span class="vid-icon"></span>';
					}
				} else {
					//show the slightly larger image as there's no title
					echo '<img class="di-image-icon_no_title' . $class . '" src="' . $icon_meta['src'] . '" />';
				}
				if ( $icon['icon_id'] ) {
					echo '</a>';
				} else {
					echo '</a>';
				}

				// add hidden div to store titles html
				if ( did_check_if_video( $image_meta['src'] ) ) {
					echo '<div id="video-' . $count . '" class="fancybox-hidden">';
					echo '<div  class="row">';
					echo '<div class="small-12 medium-12 medium-push-1 medium-pull-1 medium-centered">';
					$shortCode = '[hvp-video url="' . $image_meta['src'] . '" width="700" poster="' . $icon_meta['src'] . '" class="videoItem' . $count . ' float-center" template="basic-skin" controls="true" autoplay="false" loop="false" muted="false" ytcontrol="false"][/hvp-video]';
					echo do_shortcode( $shortCode );
					echo '</div>';
					echo '</div>';
					echo '</div>';
					echo '<div class="fancybox-hidden">';
					echo '<div id="v-title-' . $count . '">';
					echo '<b>' . $image_meta['title'] . '<br>' . $image_meta['description'] . '</b>';
					echo '</div>';
					echo '</div>';
				} else {
					echo '<div class="fancybox-hidden">';
					echo '<div id="i-title-' . $count . '">';
					echo '<b>' . $image_meta['title'] . '<br>' . $image_meta['description'] . '</b>';
					echo '</div>';
					echo '</div>';

				}
			} else { //No pop-ups required
				if ( $icon['icon_id'] ) {
					if ( $titlePosition[0] != 'none' ) {
						echo '<div class="flexbox-display-icon-static' . $class . '">';
						//Title at Top
						if ( $titlePosition[0] == 'top' ) {
							echo $title . '<br>';
						}
						echo '<img class="di-image-icon' . $class . '" src="' . $icon_meta['src'] . '" />';
						//Title at Bottom
						if ( $titlePosition[0] == 'bottom' ) {
							echo '<br>' . $title;
						}
						echo '</div>';
					} else {
						//show the slightly larger image as there's no title
						echo '<div class="flexbox-display-icon-static' . $class . '">';
						echo '<img class="di-image-icon-no-title' . $class . '" src="' . $icon_meta['src'] . '" />';
						echo '</div>';
					}
				}
			}
		}
		echo '</div>';
	}
}

// retrieves the attachment ID from the file URL
function did_get_attachment_id($image_url) {
	global $wpdb;
	$attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid='%s';", $image_url ));
	return $attachment[0];
}

function did_current_url() {
	$pageURL = 'http';
	if( isset($_SERVER["HTTPS"]) ) {
		if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
	}
	$pageURL .= "://";
	if ($_SERVER["SERVER_PORT"] != "80") {
		$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	} else {
		$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	}

	return $pageURL;
}

function did_get_post_meta( $attachment_id){
	$attachment = get_post( $attachment_id );
	$meta = array(
		'alt' => get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
		'caption' => $attachment->post_excerpt,
		'description' => $attachment->post_content,
		'href' => get_permalink( $attachment->ID ),
		'src' => $attachment->guid,
		'title' => $attachment->post_title
	);
	return $meta;
}

function did_make_slider() {
	//first get a list of the displays in order
	$displays = did_get_displays();
	//var_dump($displays);
	$isActive = 'is-active';
	if ( $displays ) {
		echo '<div class="owl-carousel owl-theme">';

		foreach ( $displays as $display ) {
			$banner = get_post_meta( $display->ID, '_did_banner' );
			echo '<div class="">';
			echo '<a href="' . get_permalink( $display->ID ) . '">';
			echo '<img src="' . $banner[0] . '" width="978" height="198">';
			echo '</a>';
			echo '</div>';
		}

		echo '</div>';
	} else {
		echo 'No Displays Installed';
	}
}

function did_show_banner() {
	global $post;
	$bannerOption = get_post_meta( $post->ID, 'banneroption' );
	$meta         = get_post_meta( $post->ID );
	//var_dump($meta);
	$front_static_wrap = '<div class="row bottom-blue"><div class="column hide-for-small-only medium-2 medium-centered"></div><div class="small-12 medium-8 ">';
	$back_static_wrap  = '</div><div class="hide-for-small-only medium-2"></div></div>';
	switch ( $bannerOption[0] ) {
		case 'custom':
			//echo 'custom option';
			// get the custom banner
			$banner = get_post_meta( $post->ID, '_did_banner' );
			echo $front_static_wrap . '<img class="flexbox-banner-item" src="' . $banner[0] . '" width="978" height="198">' . $back_static_wrap;
			break;

		case 'slider':
			// add the slider call here
			//echo 'slider option';
			echo '<div class="row bottom-blue">';
			echo '<div class="column hide-for-small-only medium-2 medium-centered"><div class="di-slider-nav di-prev-slide"><h2> < </h2></div></div>';
			echo '<div class="small-12 medium-8 ">';
			did_make_slider();
			echo '</div>';
			echo '<div class="hide-for-small-only medium-2"><div class="di-slider-nav di-next-slide"><h2> > </h2></div> </div>';
			echo '</div>';
			break;
		case 'none':
			//echo 'none option';
			// dont show no banner!
			return;
			break;
		default:
			echo $front_static_wrap . '<img class="" src="' . get_theme_mod( 'di_default_banner' ) . '" width="978" height="198">' . $back_static_wrap;

	}

}

function did_show_applications( $id ) {
	$appData = get_post_meta( $id, 'applications' ); //array of icons
	$apps    = $appData[0];
	if ( $apps ) {
		echo '<div class="row">';
		echo '<b>Applications</b>';
		echo '</div>';
		echo '<div class="row"><div class="small-12 medium-12">';
		echo '<ul class="flexbox-display-icons">';
		foreach ( $apps as $app ) {
			echo '<li class="appItem">' . $app['app'] . '</li>';
			//var_dump($app['app']);
		}
		echo '</ul>';
		echo '</div></div>';
	}
}

function did_show_technical( $id ) {
	$techType = get_post_meta( $id, '_did_techtype', 1 );
	$openHtml = '<div class="row"><div class="small-12 medium 12"> <b><h6>Technical Specifications</h6></b>';
	$closeHtml = '</div></div>';
	$opened = false;
	switch ( $techType ) {
		case 'none':
			// don't display text, there may still be a list to display though!
			$opened = false;
			break;

		case 'default':
			//get the default text
			$defaultText = wp_kses_post( get_theme_mod( 'di_default_tech_specs' ) );
			echo $openHtml . $defaultText;
			$opened = true;
			break;

		case 'custom':
			// get the custom text for Tech Specs
			$customText = get_post_meta( $id, '_did_custom', 1 );
			echo $openHtml . $customText;
			$opened = true;
			break;
	}
	$showtech = get_post_meta( $id, '_did_showtech' );
	if ( $showtech ) {
		//first get the list of attached specs (each spec is a post id linking to a cpt Technical Specification)
		$techSpecs = get_post_meta( $id, 'techspecs', true );
		$first     = true;
		if ( $techSpecs ) {
			if ( ! $opened ) {
				$opened = true;
				echo $openHtml;
			}
			$openRow  = '<ul class="accordion" data-accordion data-multi-expand="false" data-slide-speed="500" data-allow-all-closed="true">';
			$closeRow = '</ul>';
			echo $openRow; //create row
			foreach ( $techSpecs as $techSpec ) {
				$specTitle = get_the_title( $techSpec );
				$specMeta  = get_post_meta( $techSpec, 0 );
				echo '<li class="accordion-item " data-accordion-item>';
				echo '<a href="#" class="accordion-title ">' . $specTitle . '</a>';
				echo '<div class="accordion-content" data-tab-content>';
				if ( $specMeta['tech'] ) {
					// start the accordian markup
					foreach ( $specMeta['tech'] as $specs ) {
						$specs = unserialize( $specs );
						if ( $specs ) {
							//create a table to hold the data
							echo '<table><tbody>';
							foreach ( $specs as $spec ) {
								echo '<tr><td>';
								echo $spec['spec_name'];
								echo '</td><td>';
								echo $spec['spec_value'];
								echo '</td></tr>';
							}
							echo '</tbody></table>';
						}
					}
				}
				echo '</div>';
				echo '</li>';
			}
			echo $closeRow; //close the html for the row
		}
	};

	if ( $opened ) {
		echo $closeHtml;
	}
}

function did_start_accordian_item( $title ) {
	echo '<li class="accordion-item" data-accordion-item>';
	echo '<a href="#" class="accordion-title">' . $title . '</a>;';
	echo '<div class="accordion-content" data-tab-content>';
}

function did_check_if_video( $url ) {
	//var_dump($url);
	$vidArray = array( "mpg", "mpeg", "mp4" );
	$path     = parse_url( $url, PHP_URL_PATH );
	$ext      = pathinfo( $path, PATHINFO_EXTENSION );
	//var_dump($ext);
	if ( in_array( $ext, $vidArray ) ) {
		return true;
	} else {
		return false;
	}

}

function did_show_displays_footer() {
	$displays = did_get_displays();
	if ( $displays ) {
		foreach ( $displays as $display ) {
			$categories = get_the_category( $display->ID );

			$menuLabel = get_post_meta( $display->ID, '_did_menu_label' );

			echo '<li><a href="' . get_permalink( $display->ID ) . '" class="">' . $menuLabel[0] . '</a></li>';


		}
	} else {

	}
}

;