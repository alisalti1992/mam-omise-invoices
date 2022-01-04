<?php

/**
 * Fired during plugin deactivation
 *
 * @link       https://github.com/moveaheadmedia/
 * @since      1.0.0
 *
 * @package    Mam_Omise_Invoices
 * @subpackage Mam_Omise_Invoices/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Mam_Omise_Invoices
 * @subpackage Mam_Omise_Invoices/includes
 * @author     Move Ahead Media <ali@moveaheadmedia.co.uk>
 */
class Mam_Omise_Invoices_Deactivator
{

    /**
     * On plugin deactivate flush permalinks
     *
     * @since    1.0.0
     */
    public static function deactivate()
    {
        flush_rewrite_rules();
    }

}
