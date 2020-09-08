<?php
namespace BooklyPro\Backend\Modules\Customers\ProxyProviders;

use Bookly\Backend\Modules\Customers\Proxy;
use Bookly\Lib as BooklyLib;
use Bookly\Backend\Components\Controls\Buttons;

/**
 * Class Local
 * @package BooklyPro\Backend\Modules\Customers\ProxyProviders
 */
class Local extends Proxy\Pro
{
    /**
     * @inheritDoc
     */
    public static function importCustomers()
    {
        @ini_set( 'auto_detect_line_endings', true );
        $fields = array();
        foreach ( array( 'full_name', 'first_name', 'last_name', 'phone', 'email', 'birthday' ) as $field ) {
            if ( self::parameter( $field ) ) {
                $fields[] = $field;
            }
        }
        if ( file_exists( $_FILES['import_customers_file']['tmp_name'] ) ) {
            $file = fopen( $_FILES['import_customers_file']['tmp_name'], 'r' );
            if ( $file ) {
                while ( $line = fgetcsv( $file, null, self::parameter( 'import_customers_delimiter' ) ) ) {
                    if ( $line[0] != '' ) {
                        $customer = new BooklyLib\Entities\Customer();
                        foreach ( $line as $number => $value ) {
                            if ( $number < count( $fields ) ) {
                                if ( $fields[ $number ] == 'birthday' ) {
                                    $dob = date_create( $value );
                                    if ( $dob !== false ) {
                                        $customer->setBirthday( $dob->format( 'Y-m-d' ) );
                                    }
                                } else {
                                    $method = 'set' . implode( '', array_map( 'ucfirst', explode( '_', $fields[ $number ] ) ) );
                                    $customer->$method( $value );
                                }
                            }
                        }
                        $customer->save();
                    }
                }
            }
        }
    }

    /**
     * @inheritDoc
     */
    public static function renderImportButton()
    {
        echo '<div class="form-group">';
        Buttons::renderModalActivator( 'bookly-import-customers-dialog', 'btn-default bookly-btn-block-xs', esc_html__( 'Import', 'bookly' ), array(), '<i class="glyphicon glyphicon-import"></i> {caption}' );
        echo '</div>';
    }

    /**
     * @inheritDoc
     */
    public static function renderExportButton()
    {
        echo '<div class="form-group">';
        Buttons::renderModalActivator( 'bookly-export-customers-dialog', 'btn-default bookly-btn-block-xs', esc_html__( 'Export to CSV', 'bookly' ), array(), '<i class="glyphicon glyphicon-export"></i> {caption}' );
        echo '</div>';
    }

    /**
     * @inheritDoc
     */
    public static function renderImportDialog()
    {
        self::renderTemplate( 'import_dialog' );
    }

    /**
     * @inheritDoc
     */
    public static function renderExportDialog( $settings, $columns )
    {
        self::renderTemplate( 'export_dialog', compact( 'settings', 'columns' ) );
    }
}