<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://github.com/moveaheadmedia/
 * @since      1.0.0
 *
 * @package    Mam_Omise_Invoices
 * @subpackage Mam_Omise_Invoices/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Mam_Omise_Invoices
 * @subpackage Mam_Omise_Invoices/public
 * @author     Move Ahead Media <ali@moveaheadmedia.co.uk>
 */
class Mam_Omise_Invoices_Public
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
     * @param string $plugin_name The name of the plugin.
     * @param string $version The version of this plugin.
     * @since    1.0.0
     */
    public function __construct($plugin_name, $version)
    {

        $this->plugin_name = $plugin_name;
        $this->version = $version;

    }

    /**
     * Register the stylesheets for the public-facing side of the site.
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

        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/mam-omise-invoices-public.css', array(), $this->version, 'all');

        // bootstrap css
        wp_enqueue_style('boostrap', 'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css', array(), '5.1.3', 'all');

    }

    /**
     * Register the JavaScript for the public-facing side of the site.
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

        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/mam-omise-invoices-public.js', array('jquery'), $this->version, false);
        wp_enqueue_script('omise.js', 'https://cdn.omise.co/omise.js', array('jquery'), $this->version);

    }

    /**
     * [mam-omise-invoices] callback function
     *
     * @since    1.0.0
     */
    public static function mam_omise_invoices_shortcode($attr)
    {
        ob_start();
        include 'payment-form.php';
        return ob_get_clean();
    }

    /**
     * add javascript variables to the website head
     */
    public function add_javascript_variables()
    {
        echo '
        <script type="text/javascript">
            var ajax_url = "' . admin_url("admin-ajax.php") . '";
            var ajax_nonce = "' . wp_create_nonce("mam_invoice_send_form") . '";
        </script>
        ';
    }

    /**
     * Handle form submissions
     */
    public function mam_invoice_send_form()
    {
        // This is a secure process to validate if this request comes from a valid source.
        check_ajax_referer('mam_invoice_send_form', 'security');

        $mam_invoice = '';
        if (isset($_POST['mam-invoice']) && $_POST['mam-invoice'] != '') {
            $mam_invoice = $_POST['mam-invoice'];
        }
        $mam_name = '';
        if (isset($_POST['mam-name']) && $_POST['mam-name'] != '') {
            $mam_name = $_POST['mam-name'];
        }
        $mam_amount = '';
        if (isset($_POST['mam-amount']) && $_POST['mam-amount'] != '') {
            $mam_amount = $_POST['mam-amount'];
        }
        $omiseToken = '';
        if (isset($_POST['omiseToken']) && $_POST['omiseToken'] != '') {
            $omiseToken = $_POST['omiseToken'];
        }
        if (!$mam_amount || !$mam_invoice || !$mam_name || !$omiseToken) {
            echo 'Missing Fields!';
            die();
        }
        if (!function_exists('post_exists')) {
            require_once(ABSPATH . 'wp-admin/includes/post.php');
        }

        if (post_exists($mam_invoice)) {
            $post_id = post_exists($mam_invoice);
            if (get_field('status', $post_id) == 'Paid') {
                echo sprintf("<p class=\"text text-danger mam-omise-invoice-error\">%s</p>", _("This invoice is already Paid!"));
                die();
            } else {
                $charge = $this->mam_omise_invoices_process_payment($mam_name, $mam_amount, $mam_invoice, $omiseToken);
                if (!$charge->offsetGet('authorized')) {
                    echo 'Auth: ' . $charge->offsetGet('authorize_uri');
                    die();
                }
                $update_invoice = array(
                    'ID' => $post_id,
                    'post_title' => $mam_invoice,
                    'post_type' => 'mam_omise_invoices',
                    'meta_input' => array(
                        'status' => $charge->offsetGet('status'),
                        'name' => $mam_name,
                        'amount' => $mam_amount,
                        'payment_details' => $charge->offsetGet('id')
                    )
                );
                wp_update_post($update_invoice);
                if (!$charge->offsetGet('authorized')) {
                    echo 'Auth: ' . $charge->offsetGet('authorize_uri');
                    die();
                }
            }
        } else {
            $charge = $this->mam_omise_invoices_process_payment($mam_name, $mam_amount, $mam_invoice, $omiseToken);
            $new_invoice = array(
                'post_title' => $mam_invoice,
                'post_status' => 'publish',
                'post_date' => date('Y-m-d H:i:s'),
                'post_type' => 'mam_omise_invoices',
                'meta_input' => array(
                    'status' => $charge->offsetGet('status'),
                    'name' => $mam_name,
                    'amount' => $mam_amount,
                    'payment_details' => $charge->offsetGet('id')

                )
            );
            $post_id = wp_insert_post($new_invoice);
            update_post_meta($post_id, 'times', '1');
            if (!$charge->offsetGet('authorized')) {
                echo 'Auth: ' . $charge->offsetGet('authorize_uri');
                die();
            }
        }
    }

    public function mam_omise_invoices_process_payment($mam_name, $mam_amount, $mam_invoice, $omiseToken)
    {
        try {
            return OmiseCharge::create(array(
                'amount' => $mam_amount . '00',
                'currency' => 'thb',
                'return_uri' => site_url() . '/mam-omise-payment-complete?order=' . $mam_invoice,
                'description' => 'Payment for ' . $mam_invoice . ' , Made by ' . $mam_name,
                'card' => $omiseToken
            ));
        } catch (Exception $e) {
            echo '<p class="text text-info mam-omise-invoice-error">' . $e->getMessage() . '</p>';;
            die();
        }
    }

    /**
     * Handle form submissions
     */
    public function add_rewrite_endpoints()
    {
        add_rewrite_endpoint('mam-omise-payment-complete', EP_ROOT);
        flush_rewrite_rules();
    }

    /**
     * Handle form submissions
     */
    public function render_template()
    {
        global $wp_query;
        if (isset($wp_query->query_vars['mam-omise-payment-complete'])) {
            /** @noinspection PhpIncludeInspection */
            include plugin_dir_path(dirname(__FILE__)) . 'templates/mam-omise-payment-complete.php';
            exit();
        }
    }
}
