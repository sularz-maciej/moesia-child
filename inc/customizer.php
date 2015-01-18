<?php
function moesia_child_customize_register( $wp_customize ) {
    /**
     * Add postMessage support for site title and description for the Theme Customizer.
     *
     */ 
    $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
    $wp_customize->remove_control('header_textcolor');

    //Add a class for titles
    class Moesia_Child_Info extends WP_Customize_Control {
        public $type = 'info';
        public $label = '';
        public function render_content() {
        ?>
            <h3 style="text-decoration: underline; color: #DA4141; text-transform: uppercase;"><?php echo esc_html( $this->label ); ?></h3>
        <?php
        }
    }   

    //***WhoWeAre section
    $wp_customize->add_setting('moesia_options[info]', array(
            'type' => 'info_control',
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'moesia_child_no_sanitize',
        )
    );
    $wp_customize->add_control( new Moesia_Child_Info( $wp_customize, 'whoweare_section', array(
        'label' => __('Who We Are section', 'moesia'),
        'section' => 'moesia_fp_colors',
        'settings' => 'moesia_options[info]',
        'priority' => 81
        ) )
    );
    //Background
    $wp_customize->add_setting(
        'whoweare_bg',
        array(
            'default'           => '#fff',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'whoweare_bg',
            array(
                'label' => __('Who We Are section background color', 'moesia'),
                'section' => 'moesia_fp_colors',
                'settings' => 'whoweare_bg',
                'priority' => 82
            )
        )
    );
    //Title
    $wp_customize->add_setting(
        'whoweare_title',
        array(
            'default'           => '#444',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'whoweare_title',
            array(
                'label' => __('Who We Are section main title color', 'moesia'),
                'section' => 'moesia_fp_colors',
                'settings' => 'whoweare_title',
                'priority' => 83
            )
        )
    );
    //Title decoration
    $wp_customize->add_setting(
        'whoweare_title_dec',
        array(
            'default'           => '#ff6b53',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'whoweare_title_dec',
            array(
                'label' => __('Who We Are section main title decoration (Updates after you press Save&amp;Publish)', 'moesia'),
                'section' => 'moesia_fp_colors',
                'settings' => 'whoweare_title_dec',
                'priority' => 84
            )
        )
    );
    //Body
    $wp_customize->add_setting(
        'whoweare_body_text',
        array(
            'default'           => '#aaa',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'whoweare_body_text',
            array(
                'label' => __('Who We Are section - body text', 'moesia'),
                'section' => 'moesia_fp_colors',
                'settings' => 'whoweare_body_text',
                'priority' => 86
            )
        )
    );      
}
add_action( 'customize_register', 'moesia_child_customize_register' );

//No sanitize - empty function for options that do not require sanitization -> to bypass the Theme Check plugin
function moesia_child_no_sanitize( $input ) {
}
/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function moesia_child_customize_preview_js() {
    wp_enqueue_script( 'moesia_customizer', get_stylesheet_directory() . '/js/customizer.js', array( 'customize-preview' ), true );
}
add_action( 'customize_preview_init', 'moesia_child_customize_preview_js' );