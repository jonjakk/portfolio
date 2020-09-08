<?php
namespace BooklyPro\Backend\Modules\Appointments\ProxyProviders;

use Bookly\Backend\Modules\Appointments\Proxy;
use Bookly\Backend\Components\Controls\Buttons;

/**
 * Class Local
 * @package BooklyPro\Backend\Modules\Appointments\ProxyProviders
 */
class Local extends Proxy\Pro
{
    /**
     * @inheritDoc
     */
    public static function renderExportButton()
    {
        print '<div class="form-group">';
        Buttons::renderModalActivator( 'bookly-export-dialog', 'btn-default bookly-btn-block-xs', esc_html__( 'Export to CSV', 'bookly' ), array(), '<i class="glyphicon glyphicon-export"></i> {caption}' );
        print '</div>';
    }

    /**
     * @inheritDoc
     */
    public static function renderExportDialog( $datatables )
    {
        self::renderTemplate( 'export_dialog', compact( 'datatables' ) );
    }

    /**
     * @inheritDoc
     */
    public static function renderPrintButton()
    {
        print '<div class="form-group">';
        Buttons::renderModalActivator( 'bookly-print-dialog', 'btn-default bookly-btn-block-xs', esc_html__( 'Print', 'bookly' ), array(), '<i class="glyphicon glyphicon-print"></i> {caption}' );
        print '</div>';
    }

    /**
     * @inheritDoc
     */
    public static function renderPrintDialog( $datatables )
    {
        self::renderTemplate( 'print_dialog', compact( 'datatables' ) );
    }
}