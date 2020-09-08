<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
use Bookly\Backend\Modules\Appointments\Proxy as AppointmentsProxy;
use Bookly\Lib\Config;
use Bookly\Lib\Utils\Common;
?>
<div id="bookly-print-dialog" class="modal fade" tabindex=-1 role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                <h4 class="modal-title"><?php _e( 'Print', 'bookly' ) ?></h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <?php $column_num = 0 ?>
                    <?php foreach ( $datatables['settings']['columns'] as $column => $show ) : ?>
                        <?php if ( $show ) : ?>
                            <div class="checkbox"><label><input value="<?php echo $column_num ++ ?>" type="checkbox" checked /><?php echo $datatables['titles'][ $column ] ?></label></div>
                        <?php endif ?>
                    <?php endforeach ?>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-lg btn-success" id="bookly-print" data-dismiss="modal">
                    <?php _e( 'Print', 'bookly' ) ?>
                </button>
            </div>
        </div>
    </div>
</div>