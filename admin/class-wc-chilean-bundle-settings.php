<?php

/**
 * The settings of the plugin.
 *
 * @link       http://devinvinson.com
 * @since      1.0.0
 *
 * @package    Wppb_Demo_Plugin
 * @subpackage Wppb_Demo_Plugin/admin
 */

/**
 * Class WordPress_Plugin_Template_Settings
 *
 */

class Wc_Chilean_Bundle_Admin_Settings {
    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $plugin_name    The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $version    The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string    $plugin_name       The name of this plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct( $plugin_name, $version ) {

        $this->plugin_name = $plugin_name;
        $this->version = $version;

    }

    public function setup_plugin_options_menu() {

        //Add the menu to the Plugins set of menu items
        add_management_page(
            'Rut Chileno',
            'Rut Chileno para WooCommerce',
            'manage_options',
            'wc_chilean_bundle',
            array( $this, 'render_settings_page_content')
        );

    }

    /**
     * Provides default values for the Display Options.
     *
     * @return array
     */
    public function default_configuration_options() {

        $defaults = array(
            'show_header'		=>	'',
            'show_content'		=>	'',
            'show_footer'		=>	'',
        );

        return $defaults;

    }

    /**
     * Provide default values for the Social Options.
     *
     * @return array
     */
    public function default_social_options() {

        $defaults = array(
            'twitter'		=>	'twitter',
            'facebook'		=>	'',
            'googleplus'	=>	'',
        );

        return  $defaults;

    }

    /**
     * Provides default values for the Input Options.
     *
     * @return array
     */
    public function default_input_options() {

        $defaults = array(
            'input_example'		=>	'default input example',
            'textarea_example'	=>	'',
            'checkbox_example'	=>	'',
            'radio_example'		=>	'2',
            'time_options'		=>	'default'
        );

        return $defaults;

    }

    /**
     * Renders a simple page to display for the theme menu defined above.
     */
    public function render_settings_page_content( $active_tab = '' ) {
        ?>
        <div class="wrap">

            <h2><?php _e( 'Ajustes de Rut Chileno', 'wc-chilean-bundle' ); ?></h2>
            <?php settings_errors(); ?>

            <?php if( isset( $_GET[ 'tab' ] ) ) {
                $active_tab = $_GET[ 'tab' ];
            } else if( $active_tab == 'social_options' ) {
                $active_tab = 'social_options';
            } else if( $active_tab == 'about_us_options' ) {
                $active_tab = 'about_us_options';
            } else {
                $active_tab = 'configuration_options';
            } // end if/else ?>

            <h2 class="nav-tab-wrapper">
                <a href="?page=wc_chilean_bundle&tab=configuration_options" class="nav-tab <?php echo $active_tab == 'configuration_options' ? 'nav-tab-active' : ''; ?>"><?php _e( 'Ajustes de Plugin', 'wc-chilean-bundle' ); ?></a>
                <a href="?page=wc_chilean_bundle&tab=about_us_options" class="nav-tab <?php echo $active_tab == 'about_us_options' ? 'nav-tab-active' : ''; ?>"><?php _e( 'Ajustes Adicionales', 'wc-chilean-bundle' ); ?></a>
            </h2>

            <form method="post" action="options.php">
                <?php

                if( $active_tab == 'configuration_options' ) {

                    settings_fields( 'wc_chilean_bundle_configuration_options' );
                    do_settings_sections( 'wc_chilean_bundle_configuration_options' );

                } else {

                    settings_fields( 'wc_chilean_bundle_about_us_options' );
                    do_settings_sections( 'wc_chilean_bundle_about_us_options' );

                }

                submit_button();

                ?>
            </form>

        </div><!-- /.wrap -->
        <?php
    }


    /**
     * This function provides a simple description for the General Options page.
     *
     * It's called from the 'wc-chilean-bundle_initialize_theme_options' function by being passed as a parameter
     * in the add_settings_section function.
     */
    public function general_options_callback() {
        $options = get_option('wc_chilean_bundle_configuration_options');
        echo '<p>' . __( 'Seleccione las opciones adecuadas para su sitio web.', 'wc-chilean-bundle' ) . '</p>';
    } // end general_options_callback

    /**
     * This function provides a simple description for the Input Examples page.
     *
     * It's called from the 'wc-chilean-bundle_theme_initialize_about_us_options_options' function by being passed as a parameter
     * in the add_settings_section function.
     */
    public function wc_chilean_bundle_about_me_section_callback() {
        $options = get_option('wc_chilean_bundle_about_us_options');
        echo '<p>' . __( 'Configure opciones adicionales para el plugin.', 'wc-chilean-bundle' ) . '</p>';
        echo '<hr />';
        echo '<div class="wc-chilean-bundle_about-us"><p>Mi nombre es <a href="//andres.reyes.dev" target="_blank">Andrés Reyes Galgani</a> y soy el desarrollador de este plugin que espero sea de utilidad para tu sitio web.</p>';
        echo '<p>Si bien este plugin es gratis y puedes usarlo el tiempo que quieras y en los sitios web que tu estimes, tomó tiempo en ser desarrollado y a cambio sólo pido que incluyas en el pie de página de tu sitio web un pequeño enlace a mi web para que así otras empresas puedan conocer mi trabajo y llegar a potenciales clientes ¿te parece?.</p>';
        echo '<p>Por el contrario, si deseas eliminarlo puedes hacerlo sin problemas, sin embargo, agradecería pudieras dejar un comentario y nota en <a href="https://wordpress.org/plugins/rut-chileno-con-validacion/" target="_blank">la web del plugin</a> para que otros puedan conocer el trabajo. Te tomará 1 minuto.</p>';
        echo '<p>¡Muchas gracias de antemano!</p></div>';
    } // end general_options_callback


    /**
     * Initializes the theme's display options page by registering the Sections,
     * Fields, and Settings.
     *
     * This function is registered with the 'admin_init' hook.
     */
    public function initialize_configuration_options() {

        // If the theme options don't exist, create them.
        if( false == get_option( 'wc_chilean_bundle_configuration_options' ) ) {
            $default_array = $this->default_configuration_options();
            add_option( 'wc_chilean_bundle_configuration_options', $default_array );
        }


        add_settings_section(
            'general_settings_section',			            // ID used to identify this section and with which to register options
            __( 'Ajustes de Plugin', 'wc-chilean-bundle' ),		        // Title to be displayed on the administration page
            array( $this, 'general_options_callback'),	    // Callback used to render the description of the section
            'wc_chilean_bundle_configuration_options'		                // Page on which to add this section of options
        );

        // Next, we'll introduce the fields for toggling the visibility of content elements.
        add_settings_field(
            'show_dte',						        // ID used to identify the field throughout the theme
            __( 'Eliminar texto DTE', 'wc-chilean-bundle' ),					// The label to the left of the option interface element
            array( $this, 'toggle_show_dte_callback'),	// The name of the function responsible for rendering the option interface
            'wc_chilean_bundle_configuration_options',	            // The page on which this option will be displayed
            'general_settings_section',			        // The name of the section to which this field belongs
            array(								        // The array of arguments to pass to the callback. In this case, just a description.
                __( 'Active esta opción si no desea que aparezca el texto DTE en el campo.', 'wc-chilean-bundle' ),
            )
        );

        add_settings_field(
            'rut_not_required',
            __( 'Rut No Obligatorio', 'wc-chilean-bundle' ),
            array( $this, 'toggle_rut_not_required_callback'),
            'wc_chilean_bundle_configuration_options',
            'general_settings_section',
            array(
                __( 'Activa esta opción si no quieres que el rut sea obligatorio (sólo se valida su sintaxis).', 'wc-chilean-bundle' ),
            )
        );

        // Finally, we register the fields with WordPress
        register_setting(
            'wc_chilean_bundle_configuration_options',
            'wc_chilean_bundle_configuration_options'
        );

    } // end wc-chilean-bundle_initialize_theme_options


    /**
     * Initializes the theme's input example by registering the Sections,
     * Fields, and Settings. This particular group of options is used to demonstration
     * validation and sanitization.
     *
     * This function is registered with the 'admin_init' hook.
     */
    public function initialize_about_us_options() {
        //delete_option('wc_chilean_bundle_about_us_options');
        if( false == get_option( 'wc_chilean_bundle_about_us_options' ) ) {
            $default_array = $this->default_input_options();
            update_option( 'wc_chilean_bundle_about_us_options', $default_array );
        } // end if

        add_settings_section(
            'wc_chilean_bundle_about_me_section',
            __( 'Acerca del Plugin', 'wc-chilean-bundle' ),
            array( $this, 'wc_chilean_bundle_about_me_section_callback'),
            'wc_chilean_bundle_about_us_options'
        );

        add_settings_field(
            'hide_backlink',
            __( 'Backlink', 'wc-chilean-bundle' ),
            array( $this, 'checkbox_element_callback'),
            'wc_chilean_bundle_about_us_options',
            'wc_chilean_bundle_about_me_section'
        );

        register_setting(
            'wc_chilean_bundle_about_us_options',
            'wc_chilean_bundle_about_us_options',
            array( $this, 'validate_about_us_options')
        );

    }

    /**
     * This function renders the interface elements for toggling the visibility of the header element.
     *
     * It accepts an array or arguments and expects the first element in the array to be the description
     * to be displayed next to the checkbox.
     */
    public function toggle_show_dte_callback($args) {
        $options = get_option('wc_chilean_bundle_configuration_options');
        $html = '<input type="checkbox" id="show_header" name="wc_chilean_bundle_configuration_options[show_dte]" value="1" ' . checked( 1, isset( $options['show_dte'] ) ? $options['show_dte'] : 0, false ) . '/>';
        $html .= '<label for="show_dte">&nbsp;'  . $args[0] . '</label>';

        echo $html;

    } // end toggle_show_dte_callback

    public function toggle_rut_not_required_callback($args) {

        $options = get_option('wc_chilean_bundle_configuration_options');

        $html = '<input type="checkbox" id="show_footer" name="wc_chilean_bundle_configuration_options[rut_not_required]" value="1" ' . checked( 1, isset( $options['rut_not_required'] ) ? $options['rut_not_required'] : 0, false ) . '/>';
        $html .= '<label for="rut_not_required">&nbsp;'  . $args[0] . '</label>';

        echo $html;

    } // end toggle_rut_not_required_callback

    public function checkbox_element_callback() {

        $options = get_option( 'wc_chilean_bundle_about_us_options' );

        $html = '<input type="checkbox" id="hide_backlink" name="wc_chilean_bundle_about_us_options[hide_backlink]" value="1"' . checked( 1, $options['hide_backlink'], false ) . '/>';
        $html .= '&nbsp;';
        $html .= '<label for="hide_backlink">Deseo desactivar el backlink</label>';

        echo $html;

    } // end checkbox_element_callback

    public function validate_about_us_options( $input ) {

        // Create our array for storing the validated options
        $output = array();

        // Loop through each of the incoming options
        foreach( $input as $key => $value ) {

            // Check to see if the current option has a value. If so, process it.
            if( isset( $input[$key] ) ) {

                // Strip all HTML and PHP tags and properly handle quoted strings
                $output[$key] = strip_tags( stripslashes( $input[ $key ] ) );

            } // end if

        } // end foreach

        // Return the array processing any additional functions filtered by this action
        return apply_filters( 'validate_about_us_options', $output, $input );

    } // end validate_about_us_options

}