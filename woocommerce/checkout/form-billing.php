<?php
/**
 * Checkout billing information form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-billing.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 * @global WC_Checkout $checkout
 */

defined('ABSPATH') || exit;
?>
<div class="order-contact-information">
    <div class="h6 title"><?php esc_html_e('Contact Info', 'wildkidzz') ?></div>
    <div class="contact-information-form" id="customer_details">
        <div class="woocommerce-billing-fields">
            <!--<?php if (wc_ship_to_billing_address_only() && WC()->cart->needs_shipping()) : ?>

		<h3><?php esc_html_e('Billing &amp; Shipping', 'woocommerce'); ?></h3>

	<?php else : ?>

		<h3><?php esc_html_e('Billing details', 'woocommerce'); ?></h3>

	<?php endif; ?>-->

            <?php do_action('woocommerce_before_checkout_billing_form', $checkout); ?>

            <div class="woocommerce-billing-fields__field-wrapper">
                <?php
                $fields = $checkout->get_checkout_fields('billing');

                foreach ($fields as $key => $field) {

                    switch ($key){
                        case 'billing_country':

                            $countryValueDefault = $checkout->get_value($key);
                            echo '<div class="form-row input-field-wrapp update_totals_on_change validate-required" id="'.$key.'_field" data-priority="'.$field['priority'].'" > ';
                            echo '<label for="'.$key.'_field" class="input-label">'.$field['label'].' '.($field['required'] ? '<abbr class="required" title="required">*</abbr>' : '').'</label>';
                            echo '<div class="row row-16">';
                                echo '<input type="hidden" name="'.$key.'" id="'.$key.'" value="'.$countryValueDefault.'">';
                            foreach (WC()->countries->get_allowed_countries() as $countryValue=>$country){
                                echo '<div class="col-6"> <span class="custom-control custom-radio"> <input type="radio" id="customInput_'.$countryValue.'" class="js-custom-change-building-country custom-control-input '.(implode(' ', $field['class'] )).'"  value="'.$countryValue.'" name="'.$key.'_dup"  '.($countryValue==$countryValueDefault ? 'checked' : '').'>   <label class="custom-control-label" for="customInput_'.$countryValue.'">'.$country.($countryValue == "BE" ? ' <b class="choose-country-price">+€20</b>' : '').'</label></span></div>';
                            }
                            echo '</div>';
                            echo '</div>';

                            //woocommerce_form_field($key, $field, $checkout->get_value($key));

                            break;

                        default:
                            woocommerce_form_field($key, $field, $checkout->get_value($key));
                            break;
                    }

                }
                ?>
            </div>

            <?php do_action('woocommerce_after_checkout_billing_form', $checkout); ?>
        </div>

        <?php if (!is_user_logged_in() && $checkout->is_registration_enabled()) : ?>
            <div class="woocommerce-account-fields">
                <?php if (!$checkout->is_registration_required()) : ?>

                    <p class="form-row form-row-wide create-account">
                        <label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox">
                            <input class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox"
                                   id="createaccount" <?php checked((true === $checkout->get_value('createaccount') || (true === apply_filters('woocommerce_create_account_default_checked', false))), true); ?>
                                   type="checkbox" name="createaccount" value="1"/>
                            <span><?php esc_html_e('Create an account?', 'woocommerce'); ?></span>
                        </label>
                    </p>

                <?php endif; ?>

                <?php do_action('woocommerce_before_checkout_registration_form', $checkout); ?>

                <?php if ($checkout->get_checkout_fields('account')) : ?>

                    <div class="create-account">
                        <?php foreach ($checkout->get_checkout_fields('account') as $key => $field) : ?>
                            <?php woocommerce_form_field($key, $field, $checkout->get_value($key)); ?>
                        <?php endforeach; ?>
                        <div class="clear"></div>
                    </div>

                <?php endif; ?>

                <?php do_action('woocommerce_after_checkout_registration_form', $checkout); ?>
            </div>
        <?php endif; ?>
    </div>
</div>
