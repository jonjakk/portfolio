<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
use Bookly\Backend\Components\Controls\Buttons;
use Bookly\Backend\Components\Controls\Inputs;
?>
<div id="bookly-export-dialog" class="modal fade" tabindex=-1 role="dialog">
    <div class="modal-dialog">
        <form action="<?php echo admin_url( 'admin-ajax.php?action=bookly_pro_export_appointments' ) ?>" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                    <div class="modal-title h2"><?php esc_html_e( 'Export to CSV', 'bookly' ) ?></div>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="bookly-csv-delimiter"><?php esc_html_e( 'Delimiter', 'bookly' ) ?></label>
                        <select id="bookly-csv-delimiter" class="form-control" name="delimiter">
                            <option value=","><?php esc_html_e( 'Comma (,)', 'bookly' ) ?></option>
                            <option value=";"><?php esc_html_e( 'Semicolon (;)', 'bookly' ) ?></option>
                        </select>
                    </div>
                    <div class="form-group">
                        <?php foreach ( $datatables['settings']['columns'] as $column => $show ) : ?>
                            <?php if ( $show ) : ?>
                                <div class="checkbox"><label><input name="exp[<?php echo $column ?>]" type="checkbox" checked /><?php echo $datatables['titles'][ $column ] ?></label></div>
                            <?php endif ?>
                        <?php endforeach ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="filter"/>
                    <?php Inputs::renderCsrf() ?>
                    <?php Buttons::renderSubmit( null, null, __( 'Export to CSV', 'bookly' ) ) ?>
                </div>
            </div>
        </form>
    </div>
</div>