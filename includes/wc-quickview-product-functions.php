<?php
/*
Quick View Products ( Plugin functions  )
©2020 Daniel Esparza, inspirado por #openliveit #dannydshore | Consultoría en servicios y soluciones de entorno web - https://danielesparza.studio/
*/


if ( !function_exists( 'dewp_wqp_pluging_code' ) && isset($dewp_options['wqp_enable']) == true ) {
    
    add_action('wp_enqueue_scripts', 'dewp_register_pluginfiles');
    function dewp_register_pluginfiles() {
        
        wp_register_style( 'dewp_register_pluginstyle', plugin_dir_url( __FILE__ ) . '../css/dewp_style_plugin.css', array(), '1.0' );
        wp_register_style( 'dewp_register_bootstrap', plugin_dir_url( __FILE__ ) . '../css/bootstrap.css', array(), '1.0' );
        wp_enqueue_style( 'dewp_register_pluginstyle' );
        wp_enqueue_style( 'dewp_register_bootstrap' );
        
        //scripts cdn
        wp_register_script( 'dewp_bootstrapcdn', plugin_dir_url( __FILE__ ) . '../js/bootstrap.min.js',  array( 'jquery'), '4.00.0', true );
        wp_enqueue_script( 'dewp_bootstrapcdn' );
    
        
    }
        
    add_action( 'woocommerce_after_shop_loop_item', 'dewp_wqp_pluging_code', 15 );
    function dewp_wqp_pluging_code() {
        global $dewp_options;
        global $product;
        $productID = $product->get_id();
        ob_start();
        ?>

        <button type="button" class="btn btn-primary btn-wqp" data-toggle="modal" data-target="#product-<?php echo $productID; ?>">
            <?php 
                if ( !empty( $dewp_options['wqp_boton_text'] ) ) { 
                    echo esc_html( $dewp_options['wqp_boton_text'] );
                } else {
                    echo esc_html( 'Quick View' );
                }  
            ?>
        </button>

        <!-- Modal -->
        <div class="modal fade modal-wqp" id="product-<?php echo $productID; ?>" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-dialog-wqp" role="document">
            <div class="modal-content">
              <div class="modal-header modal-header-wqp">
                <button type="button" class="close close-wqp" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body modal-body-wqp">
                <div class="modal-body-col-left-wqp" >
                    <?php echo $product->get_image(); ?>
                </div>
                <div class="modal-body-col-right-wqp">
                    <h4><b><?php echo $product->get_title(); ?></b></h4>
                    <p><?php echo $product->get_short_description(); ?></p>
                    <p><b><?php echo $product->get_price_html(); ?></b></p>
                    
                    <?php
                    if ( $product->get_type() == 'variable' ) {
                        do_action('woocommerce_variable_add_to_cart');
                    }else{
                        do_action('woocommerce_simple_add_to_cart');
                    }
                    ?>
                    
                </div>
              </div>
            </div>
          </div>
        </div>

        <?php 
        $output_string = ob_get_contents();
        ob_end_clean();
        echo $output_string;  
    }
}