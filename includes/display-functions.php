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

add_action( 'did_related_displays', 'did_related_displays', 10, 2 );

add_action( 'did_show_case_studies','did_show_case_studies' , 10, 1  );

add_action( 'did_show_images','did_show_images' , 10, 1  );

add_action( 'did_get_displays', 'did_get_displays', 10, 1 );

add_action( 'did_show_banner', 'did_show_banner', 10, 1 );

add_action( 'did_make_slider', 'did_make_slider', 10, 1 );

add_action( 'did_show_applications', 'did_show_applications', 10, 1 );

add_action( 'did_show_technical', 'did_show_technical', 10, 1 );

add_action( 'did_start_accordian_item', 'did_start_accordian_item', 10, 1 );

add_action( 'did_show_displays_footer', 'did_show_displays_footer', 10, 1 );

add_action( 'did_show_displays_sitemap', 'did_show_displays_sitemap', 10, 1 );

add_action( 'did_start_row', 'did_start_row', 10, 1 );

add_action( 'did_end_row', 'did_end_row', 10, 1 );

add_action( 'did_show_additional_text', 'did_show_additional_text', 10, 2 );

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

function did_start_row( $withSpace = 'space-below' ) {
	echo ' <div class="row ' . $withSpace . '">';
	echo ' <div class="small-12 medium-12 container">';
}

function did_end_row() {
	echo ' </div>';
	echo ' </div>';
}

function did_show_additional_text( $id, $area ) {
	$textField = '_did_additional_text_' . $area;
	//var_dump($textField);
	$postData = get_post_meta( $id );
	$data     = $postData[0];
	$text     = $postData[ $textField ];
	//var_dump($text);
	if ( $text[0] ) {
		did_start_row();
		echo $text[0];
		did_end_row();
	}
}

function did_show_home_icon( $attachment_id) {
	$alt = get_post_meta( $attachment_id, '_wp_attachment_image_alt', true );
	$attachment = get_post( $attachment_id );
	$meta = did_get_post_meta($attachment_id);
	//var_dump($meta);
	$url = $meta['src'];
	//var_dump($url);
	if ( did_check_if_gif( $url ) ) {
		echo wp_get_attachment_image( $attachment_id, 'full', false, array( "alt" => $alt ) ) . '<br>';
	} else {
		echo wp_get_attachment_image( $attachment_id, 'di_display_icon', false, array( "alt" => $alt ) ) . '<br>';
	}

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

function did_displays_menu( $parentMenu = null ) {
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
			$meta = get_post_meta( $post->ID );
			if ( ! $meta['_did_sub_display'] ) {
				$categories = get_the_category( $post->ID );
				if ( ! empty( $categories ) ) {
					$last_cat = $categories[0]->name;
				}
				if ( $last_cat != $cur_cat ) {
					echo '<div class="display-button-header">' . $last_cat . '</div>';
				}
				if ( get_permalink( $post->ID ) == $current_page_url || get_permalink( $post->ID ) == $parentMenu ) {
					$active_class = '-active';
				}


				$menuLabel = get_post_meta( $post->ID, '_did_menu_label' );
				echo '<a href="' . get_permalink( $post->ID ) . '" class="display-menu-button' . $active_class . '">' . $menuLabel[0] . '</a>';

				$cur_cat      = $last_cat;
				$active_class = '';
			}
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
		echo '<div class="icon-area" data-equalizer>';
		foreach ( $posts as $post ) {
			$meta = get_post_meta( $post->ID );
			//var_dump($meta);
			if ( ! $meta['_did_sub_display'] ) {
				$categories = get_the_category( $post->ID );
				if ( ! empty( $categories ) ) {
					$cur_cat = $categories[0]->name;
				}
				if ( $last_cat != $cur_cat ) {
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
				echo '<a class="" href="' . get_the_permalink( $post->ID ) . '">';
				do_action( 'did_show_home_icon', $iconID );
				echo '</div>';
				echo '</a>';
				echo '</div>';
			}


			$last_cat = $cur_cat;
		}
		if ( $opened ) {
			echo '</div>';
		}
	}else{
		echo 'No Displays Installed';
	}
}

function did_related_displays( $id, $type = 'top' ) {
	$related = get_post_meta( $id );

	$posts = get_post_meta( $id, 'related_' . $type );
	//var_dump($posts);
	$opened = false;
	if ( $posts ) {
		do_action( 'did_start_row' );
		if ( $type == 'bottom' ) {
			echo '<b>Related Products:</b>';
			echo '<div class="icon-area" data-equalizer>';
		} else {
			echo '<div class="icon-area" data-equalizer>';
		}

		foreach ( $posts as $post ) {
			foreach ( $post as $displayNum ) {
				//var_dump( $displayNum );
				$thisPost = get_post( $displayNum );
				$display = get_post_meta( $displayNum );
				if ( $thisPost->post_title != 'blank spacer' ) {
					$iconID = $display['_did_icon_id'][0];
					echo '<div class="icon-area-item" >';
					echo '<div class="di-base-border" data-equalizer-watch>';
					echo '<a class="" href="' . get_the_permalink( $displayNum ) . '">';
					do_action( 'did_show_home_icon', $iconID );
					echo '</a>';
					echo '</div>';
					echo '</div>';
				} else {
					echo '<div class="flexbox-display-icon-static-placeholder" data-equalizer-watch"></div>';
				};
			}
		}
		echo '</div>';
		do_action( 'did_end_row' );
	} else {
		//echo 'No Displays Installed';
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
	$showImages = get_post_meta( $id, '_did_show_page_images' );
	//var_dump($showImages);
	$iconData = get_post_meta( $id, 'icons'); //array of icons
	$icons = $iconData[0];
	$title = false;
	$count=1;
	$posData = get_post_meta( $id );
	//var_dump($posData);
	if ( $showImages ) {
		do_action( 'did_start_row' );
		//we have Icons so check alignment
		$align_class = '';
		if ( $align[0] ) {
			$align_class = '-' . $align[0];
		}
		echo '<div class="flexbox-display-icons' . $align_class . '" data-equalizer>';
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
				case 'quarter':
					$class = '-quarter';
					break;
				case 'half':
					$class = '-half';
					break;
				case 'third':
					$class = '-third';
					break;
				case 'two-third':
					$class = '-two-third';
					break;
				case 'placeholder':
					$class = '-placeholder';
					break;
				default:
					$class = '';
			}
			$title = $icon_meta['title']; //get the icons title
			$image_meta = did_get_post_meta( $icon['image_id'] ); //grt the icons meta data
			if ( $popup[0] == 'on' ) { // if pop-ups are required
				if ( $icon['icon_id'] ) { //check to see if there is an icon to display, If there is no icon there still maybe hidden content...
					if ( did_check_if_video( $image_meta['src'] ) ) { // if we have a video
						echo '<a class="fancybox di-base-border' . $class . '" rel="images" data-v-title="' . $count . '" href="#video-' . $count . '" data-equalizer-watch>';
					} else { //show image
						echo '<a class="fancybox di-base-border' . $class . '" rel="images" data-i-title="' . $count . '" href="' . $image_meta['src'] . '" alt="' . $image_meta['alt'] . '" data-equalizer-watch>';
					}
				} else {
					if ( $class != '-placeholder' ) {// not a placeholder show the hidden content
						if ( did_check_if_video( $image_meta['src'] ) ) { // if a video shortCode has been entered show video
							echo '<a class="fancybox fancybox-hidden" rel="video" data-i-video="' . $count . '" href="#video-' . $count . '" alt="' . $image_meta['alt'] . '">';
						} else {
							echo '<a class="fancybox fancybox-hidden" rel="images" data-i-title="' . $count . '" href="' . $image_meta['src'] . '" alt="' . $image_meta['alt'] . '">';
						}
					} else { //add a placeholder
						echo '<div class="flexbox-display-icon-static' . $class . ' data-equalizer-watch"></div>';
						//echo '<img class="di-image-icon-no-title' . $class . '" src="" />';

					}

				}
				if ( $class != '-placeholder' ) {
					//show title if top or bottom is selected
					if ( $titlePosition != 'none' ) {
						if ( $titlePosition[0] == 'top' ) {
							echo '' . $title . '<br>';
						}
						echo '<img class="di-image-icon' . $class . '" src="' . $icon_meta['src'] . '" alt="' . $image_meta['alt'] . '"/>';

						if ( $titlePosition[0] == 'bottom' ) {
							echo '<br>' . $title . '';
						}
						if ( did_check_if_video( $image_meta['src'] ) ) {//add video icon if its a video
							echo '<span class="vid-icon"></span>';
						}
					} else {
						//show the slightly larger image as there's no title
						echo '<img class="di-image-icon_no_title' . $class . '" src="' . $icon_meta['src'] . '" alt="' . $image_meta['alt'] . '"/>';
					}
					if ( $icon['icon_id'] ) {
						echo '</a>';
					} else {
						echo '</a>';
					}
				}

				// add hidden div to store titles html
				if ( did_check_if_video( $image_meta['src'] ) ) {
					echo '<div id="video-' . $count . '" class="fancybox-hidden">';
					echo '<div  class="row">';
					echo '<div class="small-12 medium-12 medium-push-1 medium-pull-1 medium-centered">';
					echo '<div class="flexbox-display-icons-center">';
					//$shortCode = '[hvp-video url="' . $image_meta['src'] . '" height="400" poster="' . $icon_meta['src'] . '" class="videoItem' . $count . ' float-center" template="basic-skin" controls="true" autoplay="false" loop="false" muted="false" ytcontrol="false"][/hvp-video]';
					$shortCode = '[video mp4="' . $image_meta['src'] . '" ][/video]';
					echo do_shortcode( $shortCode );
					echo '</div>';
					echo '</div>';
					echo '</div>';
					echo '</div>';
					echo '<div class="fancybox-hidden">';
					echo '<div id="v-title-' . $count . '">';
					echo '<b>' . $image_meta['title'] . '<br>' . $image_meta['description'] . '</b>';
					echo '</div>';
					echo '</div>';
				} else {
					if ( $class != '-placeholder' ) {
						echo '<div class="fancybox-hidden">';
						echo '<div id="i-title-' . $count . '">';
						echo '<b>' . $image_meta['title'] . '<br>' . $image_meta['description'] . '</b>';
						echo '</div>';
						echo '</div>';
					}
				}
			} else { //No pop-ups required
				if ( $icon['icon_id'] ) {
					if ( $titlePosition[0] != 'none' ) {
						echo '<div class="flexbox-display-icon-static' . $class . '" data-equalizer-watch>';
						if ( $class != '-placeholder' ) {
							//Title at Top
							if ( $titlePosition[0] == 'top' ) {
								echo '<b>' . $title . '</b><br>';
							}
							echo '<img class="di-image-icon' . $class . '" src="' . $icon_meta['src'] . '" alt="' . $icon_meta['alt'] . '"/>';
							//Title at Bottom
							if ( $titlePosition[0] == 'bottom' ) {
								echo '<br><b>' . $title . '</b>';
							}
						}

						echo '</div>';
					} else {
						//show the slightly larger image as there's no title
						echo '<div class="flexbox-display-icon-static' . $class . ' data-equalizer-watch">';
						echo '<img class="di-image-icon-no-title' . $class . '" src="' . $icon_meta['src'] . '" alt="' . $icon_meta['alt'] . '"/>';
						echo '</div>';
					}
				} else {
					if ( $class == '-placeholder' ) {
						echo '<div class="flexbox-display-icon-static' . $class . ' data-equalizer-watch"></div>';
					}
				}
			}
		}
		echo '</div>';
		do_action( 'did_end_row' );
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
	//$isActive = 'is-active';
	if ( $displays ) {
		echo '<div class="owl-carousel owl-theme">';

		foreach ( $displays as $display ) {
			$banner = get_post_meta( $display->ID, '_did_banner' );
			$meta = get_post_meta( $display->ID );

			if ( ! $meta['_did_sub_display'] ) {
				//var_dump($display->ID);
				echo '<div class="">';
				echo '<a href="' . get_permalink( $display->ID ) . '">';
				echo '<img src="' . $banner[0] . '" width="978" height="198" >';
				echo '</a>';
				echo '</div>';
			}
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
	$front_static_wrap = '<div class="row"><div class="small-1 medium-1 large-1 "></div><div class="small-10 medium-10 large-10 ">';
	$back_static_wrap  = '</div><div class="small-1 medium-1 large-1 "></div></div><div class="bottom-blue"></div>';
	if ( $bannerOption ) {
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
				echo '<div class="row">';
				echo '<div class="small-1 medium-1 large-1"><div class="di-slider-nav di-prev-slide hide-for-small-only"><h2> < </h2></div></div>';
				echo '<div class="small-10 medium-10 ">';
				did_make_slider();
				echo '</div>';
				echo '<div class=" medium-1"><div class="di-slider-nav di-next-slide hide-for-small-only"><h2> > </h2></div> </div>';
				echo '</div>';
				echo '<div class="bottom-blue"></div>';
				break;
			case 'none':
				//echo 'none option';
				// dont show no banner!
				return;
				break;
			default:
				echo $front_static_wrap . '<img class="flexbox-banner-item" src="' . get_theme_mod( 'di_default_banner' ) . '" width="978" height="198">' . $back_static_wrap;
		}
	} else {
		//echo 'custom option';
		// get the custom banner
		$banner = get_post_meta( $post->ID, '_did_banner' );
		echo $front_static_wrap . '<img class="flexbox-banner-item" src="' . $banner[0] . '" width="978" height="198">' . $back_static_wrap;
	}


}

function did_show_applications( $id ) {
	$appData = get_post_meta( $id, 'applications' ); //array of icons
	$apps    = $appData[0];
	if ( $apps ) {
		echo '<div class="row space-below">';
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
	$openHtml = '<br><br><div class="row space-below"><div class="small-12 medium 12"> <span class="tech-header">Technical Specifications</span><br>';
	$closeHtml = '</div></div><br>';
	$opened = false;
	$showtech = get_post_meta( $id, '_did_showtech' );
	if ( $showtech ) {
		//first get the list of attached specs (each spec is a post id linking to a cpt Technical Specification)
		$techSpecBtnText = get_post_meta( $id, '_did_tech_btn_text', 0 );
		//var_dump($techSpecBtnText);
		$techSpecID   = get_post_meta( $id, '_did_tech_url', 0 );
		$techSpecData = did_get_post_meta( $techSpecID[0] );
		$techSpecURL  = $techSpecData['href'];

		do_action( 'did_start_row' );
		echo '<div class="did-case-study">';
		echo '<a href="' . $techSpecURL . '" alt="' . $techSpecBtnText[0] . '">';
		echo '<div class="case-studies-button">' . $techSpecBtnText[0] . '</div>';
		echo '</a>';
		echo '</div>';
		do_action( 'did_end_row' );
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

function did_check_if_gif( $url ) {
	//var_dump($url);
	$gifArray = array( "gif" );
	$path     = parse_url( $url, PHP_URL_PATH );
	$ext      = pathinfo( $path, PATHINFO_EXTENSION );
	//var_dump($ext);
	if ( in_array( $ext, $gifArray ) ) {
		return true;
	} else {
		return false;
	}

}

function did_show_displays_footer( $class = "" ) {
	$displays = did_get_displays();
	if ( $displays ) {
		foreach ( $displays as $display ) {
			$meta = get_post_meta( $display->ID );
			if ( ! $meta['_did_sub_display'] ) {
				$categories = get_the_category( $display->ID );

				$menuLabel = get_post_meta( $display->ID, '_did_menu_label' );

				echo '<li><a href="' . get_permalink( $display->ID ) . '" class="' . $class . '">' . $menuLabel[0] . '</a></li>';
			}

		}
	} else {

	}
}

function did_show_displays_sitemap() {
	$displays = did_get_displays();
	if ( $displays ) {
		$count        = 0;
		$displayCount = 0;
		foreach ( $displays as $display ) {
			$meta = get_post_meta( $display->ID );
			if ( ! $meta['_did_sub_display'] ) {
				$displayCount ++;
			}
		}
		$half = $displayCount / 2;
		echo '<div class="medium-4 border-left">';

		foreach ( $displays as $display ) {
			$meta = get_post_meta( $display->ID );
			if ( ! $meta['_did_sub_display'] ) {
				$categories = get_the_category( $display->ID );
				$menuLabel  = get_post_meta( $display->ID, '_did_menu_label' );
				echo '<div><a href="' . get_permalink( $display->ID ) . '" class="' . $class . '">' . $menuLabel[0] . '</a></div>';
				$count ++;
				if ( $count == $half ) {
					echo '</div><div class="medium-4 border-left"> ';
				}
			}
		}
		echo '</div>';
	} else {

	}
}

function img_unautop( $pee ) {
	$pee = preg_replace( '/<p>\\s*?(<a .*?><img.*?><\\/a>|<img.*?>)?\\s*<\\/p>/s',
		'<div class="figure">$1</div>',
		$pee );

	return $pee;
}

add_filter( 'the_content', 'img_unautop', 30 );