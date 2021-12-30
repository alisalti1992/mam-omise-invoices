<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://github.com/moveaheadmedia/
 * @since      1.0.0
 *
 * @package    Mam_Omise_Invoices
 * @subpackage Mam_Omise_Invoices/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Mam_Omise_Invoices
 * @subpackage Mam_Omise_Invoices/admin
 * @author     Move Ahead Media <ali@moveaheadmedia.co.uk>
 */
class Mam_Omise_Invoices_Admin {

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

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Mam_Omise_Invoices_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Mam_Omise_Invoices_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/mam-omise-invoices-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Mam_Omise_Invoices_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Mam_Omise_Invoices_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/mam-omise-invoices-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Add Options Page
	 *
	 * @since    1.0.0
	 */
	public function mam_omise_invoices_options_page()
    {
        // Check function exists.
        if (function_exists('acf_add_options_page')) {

            // Register options page.
            $option_page = acf_add_options_page(array(
                'page_title' => __('Omise Invoices'),
                'menu_title' => __('Omise Invoices'),
                'menu_slug' => 'mam-omise-invoices-options',
                'capability' => 'edit_posts',
                'redirect' => false
            ));
        }

        // Add Options Page Custom Fields
        if (function_exists('acf_add_local_field_group')){
            acf_add_local_field_group(array(
                'key' => 'group_61cd6d3873bb7',
                'title' => 'Omise Invoices Settings',
                'fields' => array(
                    array(
                        'key' => 'field_61cd6d4f2148a',
                        'label' => 'Mode',
                        'name' => 'mode',
                        'type' => 'select',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'choices' => array(
                            'Test' => 'Test',
                            'Live' => 'Live',
                        ),
                        'default_value' => false,
                        'allow_null' => 0,
                        'multiple' => 0,
                        'ui' => 0,
                        'return_format' => 'value',
                        'ajax' => 0,
                        'placeholder' => '',
                    ),
                    array(
                        'key' => 'field_61cd6de92148b',
                        'label' => 'Test Public Key',
                        'name' => 'test_public_key',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_61cd6d4f2148a',
                                    'operator' => '==',
                                    'value' => 'Test',
                                ),
                            ),
                        ),
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                    ),
                    array(
                        'key' => 'field_61cd6e092148c',
                        'label' => 'Test Secret Key',
                        'name' => 'test_secret_key',
                        'type' => 'password',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_61cd6d4f2148a',
                                    'operator' => '==',
                                    'value' => 'Test',
                                ),
                            ),
                        ),
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                    ),
                    array(
                        'key' => 'field_61cd6e332148d',
                        'label' => 'Live Public Key',
                        'name' => 'live_public_key',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_61cd6d4f2148a',
                                    'operator' => '==',
                                    'value' => 'Live',
                                ),
                            ),
                        ),
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                    ),
                    array(
                        'key' => 'field_61cd6e382148e',
                        'label' => 'Live Secret Key',
                        'name' => 'live_secret_key',
                        'type' => 'password',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_61cd6d4f2148a',
                                    'operator' => '==',
                                    'value' => 'Live',
                                ),
                            ),
                        ),
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                    ),
                ),
                'location' => array(
                    array(
                        array(
                            'param' => 'options_page',
                            'operator' => '==',
                            'value' => 'mam-omise-invoices-options',
                        ),
                    ),
                ),
                'menu_order' => 0,
                'position' => 'normal',
                'style' => 'default',
                'label_placement' => 'top',
                'instruction_placement' => 'label',
                'hide_on_screen' => '',
                'active' => true,
                'description' => '',
            ));
        }
	}


}
