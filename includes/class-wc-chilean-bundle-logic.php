<?php

class Wc_Chilean_Bundle_Logic
{

    public $cb_opts;
    public $cb_bl;

    public function __construct()
    {
        $this->cb_opts = get_option('wc_chilean_bundle_configuration_options');
        $this->cb_bl = get_option('wc_chilean_bundle_about_us_options');
    }
    public function checkout_fields($fields)
    {

        $placeholder = $this->cb_opts['show_dte'] ? 'Indique Rut' : 'Indique Rut para DTE';
        $is_required = ! $this->cb_opts['rut_not_required'];

        $fields['billing']['billing_rut'] = array(
            'label' => __('Rut', 'woocommerce'),
            'placeholder' => _x($placeholder, 'placeholder', 'woocommerce'),
            'required' => $is_required,
            'class' => array('form-row-wide'),
            'clear' => true,
            'priority' => 1,
        );

        return $fields;
    }

    public function checkout_update_order_meta($order_id)
    {
        {
            if (!empty($_POST['billing_rut'])) {
                update_post_meta($order_id, 'Rut', sanitize_text_field($_POST['billing_rut']));
            }
        }
    }

    public function email_order_meta_keys($keys)
    {
        {
            $keys[] = 'Rut';
            return $keys;
        }
    }

    public function admin_order_data_after_billing_address($order)
    {
        {
            if (get_post_meta($order->id, 'Rut', true))
                echo '<p><strong>' . __('Rut') . ':</strong> ' . get_post_meta($order->id, 'Rut', true) . '</p>';
        }
    }

    public function after_checkout_validation($fields, $errors)
    {
        $r = strtoupper(preg_replace('/[^k0-9]/i', '', $fields['billing_rut']));
        $sub_rut = substr($r, 0, strlen($r) - 1);
        $sub_dv = substr($r, -1);
        $x = 2;
        $s = 0;
        for ($i = strlen($sub_rut) - 1; $i >= 0; $i--) {
            if ($x > 7) {
                $x = 2;
            }
            $s += $sub_rut[$i] * $x;
            $x++;
        }
        $dv = 11 - ($s % 11);
        if ($dv == 10) {
            $dv = 'K';
        }
        if ($dv == 11) {
            $dv = '0';
        }


        if ($dv != $sub_dv) {
            $errors->add('validation', 'El rut ingresado no es válido');
        }
    }

    public function backlink()
    {
        $backlink = $this->cb_bl['hide_backlink'];
        if (!isset($backlink) || $backlink == "off") {
            if ( ! function_exists( 'arg_backlink_final' ) ) {
                function arg_backlink_final() { ?>
                    <div style="padding: 10px 0px; text-align: center; font-size: x-small">
                        Con el apoyo de <a href="//andres.reyes.dev" target="_blank" title="Diseño Web y Tiendas eCommerce con Webpay Plus en Chile" style="font-weight: bold">Andrés Reyes Galgani</a>
                    </div>
                <?php }
            }
            add_action( 'wp_footer', 'arg_backlink_final' );
        }
    }
}