<?php

/**
 * Fired during plugin activation
 *
 * @link       https://github.com/moveaheadmedia/
 * @since      1.0.0
 *
 * @package    Mam_Omise_Invoices
 * @subpackage Mam_Omise_Invoices/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Mam_Omise_Invoices
 * @subpackage Mam_Omise_Invoices/includes
 * @author     Move Ahead Media <ali@moveaheadmedia.co.uk>
 */
class Mam_Omise_Invoices_Activator
{

    /**
     * On plugin activate add mam_omise_post type and flush permalinks
     *
     * @since    1.0.0
     */
    public static function activate()
    {
        Mam_Omise_Invoices_Admin::mam_omise_invoices();
        flush_rewrite_rules();
    }

}
