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
class Mam_Omise_Invoices_Admin
{

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string $plugin_name The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string $version The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @param string $plugin_name The name of this plugin.
     * @param string $version The version of this plugin.
     * @since    1.0.0
     */
    public function __construct($plugin_name, $version)
    {

        $this->plugin_name = $plugin_name;
        $this->version = $version;

    }

    /**
     * Register the stylesheets for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_styles()
    {

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

        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/mam-omise-invoices-admin.css', array(), $this->version, 'all');

    }

    /**
     * Register the JavaScript for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts()
    {

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

        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/mam-omise-invoices-admin.js', array('jquery'), $this->version, false);

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
        if (function_exists('acf_add_local_field_group')) {
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

        // Add MAM Omise Invoices Post Type Custom Fields
        acf_add_local_field_group(array(
            'key' => 'group_61d3b2fb21eaa',
            'title' => 'Omise Invoice Details',
            'fields' => array(
                array(
                    'key' => 'field_61d3b30c5b6a0',
                    'label' => 'Status',
                    'name' => 'status',
                    'type' => 'text',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => 0,
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
                    'key' => 'field_61d3b3385b6a1',
                    'label' => 'Name',
                    'name' => 'name',
                    'type' => 'text',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => 0,
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
                    'key' => 'field_61d3b33e5b6a2',
                    'label' => 'Amount',
                    'name' => 'amount',
                    'type' => 'text',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => 0,
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
                    'key' => 'field_61d3b3485b6a3',
                    'label' => 'Payment Details',
                    'name' => 'payment_details',
                    'type' => 'textarea',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'placeholder' => '',
                    'maxlength' => '',
                    'rows' => '',
                    'new_lines' => '',
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'mam_omise_invoices',
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


    /**
     * Create MAM Omise Invoices Post Type
     *
     * @since    1.0.0
     */
    public static function mam_omise_invoices()
    {

        $labels = array(
            'name' => _x('MAM Omise Invoices', 'Post Type General Name', 'mam-omise-invoices'),
            'singular_name' => _x('MAM Omise Invoice', 'Post Type Singular Name', 'mam-omise-invoices'),
            'menu_name' => __('MAM Omise Invoices', 'mam-omise-invoices'),
            'name_admin_bar' => __('MAM Omise Invoice', 'mam-omise-invoices'),
            'archives' => __('Item Archives', 'mam-omise-invoices'),
            'attributes' => __('Item Attributes', 'mam-omise-invoices'),
            'parent_item_colon' => __('Parent Item:', 'mam-omise-invoices'),
            'all_items' => __('All Items', 'mam-omise-invoices'),
            'add_new_item' => __('Add New Item', 'mam-omise-invoices'),
            'add_new' => __('Add New', 'mam-omise-invoices'),
            'new_item' => __('New Item', 'mam-omise-invoices'),
            'edit_item' => __('Edit Item', 'mam-omise-invoices'),
            'update_item' => __('Update Item', 'mam-omise-invoices'),
            'view_item' => __('View Item', 'mam-omise-invoices'),
            'view_items' => __('View Items', 'mam-omise-invoices'),
            'search_items' => __('Search Item', 'mam-omise-invoices'),
            'not_found' => __('Not found', 'mam-omise-invoices'),
            'not_found_in_trash' => __('Not found in Trash', 'mam-omise-invoices'),
            'featured_image' => __('Featured Image', 'mam-omise-invoices'),
            'set_featured_image' => __('Set featured image', 'mam-omise-invoices'),
            'remove_featured_image' => __('Remove featured image', 'mam-omise-invoices'),
            'use_featured_image' => __('Use as featured image', 'mam-omise-invoices'),
            'insert_into_item' => __('Insert into item', 'mam-omise-invoices'),
            'uploaded_to_this_item' => __('Uploaded to this item', 'mam-omise-invoices'),
            'items_list' => __('Items list', 'mam-omise-invoices'),
            'items_list_navigation' => __('Items list navigation', 'mam-omise-invoices'),
            'filter_items_list' => __('Filter items list', 'mam-omise-invoices'),
        );
        $args = array(
            'label' => __('MAM Omise Invoice', 'mam-omise-invoices'),
            'description' => __('Move Ahead Media Omise Invoices', 'mam-omise-invoices'),
            'labels' => $labels,
            'supports' => array('title'),
            'taxonomies' => array(''),
            'hierarchical' => false,
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'menu_position' => 5,
            'menu_icon' => 'dashicons-money-alt',
            'show_in_admin_bar' => true,
            'show_in_nav_menus' => true,
            'can_export' => true,
            'has_archive' => true,
            'exclude_from_search' => true,
            'publicly_queryable' => false,
            'capability_type' => 'page',
        );
        register_post_type('mam_omise_invoices', $args);

    }
}
