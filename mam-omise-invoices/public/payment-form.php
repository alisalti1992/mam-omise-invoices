<form name="checkoutForm" method="post" name="mam-omise-invoice-form" id="mam-omise-invoice-form"
      action="<?php echo get_permalink(); ?>">
    <div>
        <label for="mam-invoice" class="form-label"><?php _e('Invoice Number'); ?></label>
        <input type="text" class="form-control" id="mam-invoice" name="mam-invoice" required
               placeholder="INV-1234"/>
    </div>
    <div>
        <label for="mam-name" class="form-label"><?php _e('Name'); ?></label>
        <input type="text" class="form-control" id="mam-name" name="mam-name" required placeholder="John Smith"/>
    </div>
    <div>
        <label for="mam-amount" class="form-label"><?php _e('Amount'); ?></label>
        <input type="number" class="form-control" id="mam-amount" name="mam-amount" required placeholder="100"/>
    </div>
    <p class="text text-danger mam-omise-invoice-error"><?php _e('Fill in the details above!'); ?></p>
    <input type="hidden" name="action" value="mam_invoice_send_form"/>
    <input type="hidden" name="omiseToken" value=""/>
    <button type="button" id="checkout-button-1"><?php _e('Pay Now'); ?></button>
</form>
<div class="mam-omise-invoice-form-message"></div>
<!-- Config the card.js library -->
<script type="text/javascript">
    jQuery(document).ready(function ($) {
        function mam_omise_invoices_form_change() {
            var _invoice = $('#mam-invoice').val();
            var _name = $('#mam-name').val();
            var _amount = $('#mam-amount').val();
            if (!_invoice || !_name || !_amount) {
                $('#checkout-button-1').prop('disabled', true).addClass('disabled');
                $('.mam-omise-invoice-error').removeClass('d-none');
                return;
            }
            $('#checkout-button-1').prop('disabled', false).removeClass('disabled');
            $('.mam-omise-invoice-error').addClass('d-none');

            OmiseCard.configure({
                publicKey: '<?php echo OMISE_PUBLIC_KEY; ?>',
                image: 'https://www.moveaheadmedia.com/wp-content/uploads/2021/02/favicon.png',
                submitFormTarget: '#mam-omise-invoice-form',
                amount: _amount + '00'
            });
            // Configuring your own custom button
            OmiseCard.configureButton('#checkout-button-1', {
                frameLabel: '<?php _e('Move Ahead Media'); ?>',
                submitLabel: '<?php _e('Pay Now'); ?>'
            });
            $('body').on('click', '#checkout-button-1', function () {
                OmiseCard.open({
                    amount: _amount + '00',
                    submitFormTarget: '#mam-omise-invoice-form',
                    image: 'https://www.moveaheadmedia.com/wp-content/uploads/2021/02/favicon.png',
                    frameLabel: '<?php _e('Move Ahead Media'); ?>',
                    submitLabel: '<?php _e('Pay Now'); ?>',
                    onCreateTokenSuccess: (nonce) => {
                        $('input[name="omiseToken"]').val(nonce);
                        var form_data = $('#mam-omise-invoice-form').serializeArray();
                        // Here we add our nonce (The one we created on our functions.php. WordPress needs this code to verify if the request comes from a valid source.
                        form_data.push({"name": "security", "value": ajax_nonce});

                        // Here is the ajax petition.
                        jQuery.ajax({
                            url: ajax_url, // Here goes our WordPress AJAX endpoint.
                            type: 'post',
                            data: form_data,
                            success: function (response) {
                                // You can craft something here to handle the message return
                                if(response.includes('Auth: ')){
                                    window.location.href = response.replace('Auth: ', '');
                                }else{
                                    $('.mam-omise-invoice-form-message').html(response);
                                }
                            }
                        });
                        // This return prevents the submit event to refresh the page.
                        return false;
                    }
                });
            })
        }

        $('#mam-omise-invoice-form input').change(function () {
            mam_omise_invoices_form_change();
        });
        $('#mam-omise-invoice-form input').keyup(function () {
            mam_omise_invoices_form_change();
        });
    });
</script>