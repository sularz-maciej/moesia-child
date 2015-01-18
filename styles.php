<?php

//Dynamic styles
function moesia_child_custom_styles($custom) {
    //whoweare section
	$whoweare_bg = esc_html(get_theme_mod( 'whoweare_bg' ));
	$whoweare_title = esc_html(get_theme_mod( 'whoweare_title' ));
	$whoweare_title_dec = esc_html(get_theme_mod( 'whoweare_title_dec' ));
	$whoweare_body_text = esc_html(get_theme_mod( 'whoweare_body_text' ));	

	if ( isset($whoweare_bg) && ( $whoweare_bg != '#fff' ) ) {
		$custom .= ".whoweare-area { background-color: {$whoweare_bg} !important; }"."\n";
	}
	if ( isset($whoweare_title) && ( $whoweare_title != '#444' ) ) {
		$custom .= ".whoweare-area .widget-title { color: {$whoweare_title}; }"."\n";
	}
	if ( isset($whoweare_title_dec) && ( $whoweare_title_dec != '#ff6b53' ) ) {
		$custom .= ".whoweare-area .widget-title:after { border-color: {$whoweare_title_dec}; }"."\n";
	}
	if ( isset($whoweare_body_text) && ( $whoweare_body_text != '#aaa' ) ) {
		$custom .= ".whoweare-area div.whoweare { color: {$whoweare_body_text}; }"."\n";
	}

	//Menu links
	$menu_links_color = esc_html(get_theme_mod( 'menu_links_color' ));
	if ( isset($menu_links_color) && ( $menu_links_color != '#ffffff' )) {
		$custom .= ".navbar-custom .navbar-nav > li > a { color: {$menu_links_color}; }"."\n";
		$custom .= ".navbar-custom .navbar-toggle { border-color: {$menu_links_color}; }"."\n";
		$custom .= ".navbar-custom .navbar-toggle .icon-bar { background-color: {$menu_links_color}; }"."\n";
	}

	//Menu links font size
    $menu_size = get_theme_mod( 'menu_size' );
    if ( get_theme_mod( 'menu_size' )) {
        $custom .= ".navbar-custom .navbar-nav > li { font-size:" . intval($menu_size) . "px; }"."\n";
    }

    //Fonts
	$headings_font = esc_html(get_theme_mod('headings_fonts'));
	
	if ( $headings_font ) {
		$font_pieces = explode(":", $headings_font);
		$custom .= ".navbar-custom { font-family: {$font_pieces[0]}; }"."\n";
	}

	//Output all the styles
	wp_add_inline_style( 'moesia-style', $custom );	
}
add_action( 'wp_enqueue_scripts', 'moesia_child_custom_styles', 20 );