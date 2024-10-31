<?php
/*
Quick View Products ( Admin functions  )
©2020 Daniel Esparza, inspirado por #openliveit #dannydshore | Consultoría en servicios y soluciones de entorno web - https://danielesparza.studio/
*/


if( function_exists( 'admin_menu_desparza' ) ) { 
    //( do nothing... )
} else {
	add_action( 'admin_menu', 'admin_menu_desparza' );
	function admin_menu_desparza(){
		add_menu_page( 'DE Plugins', 'DE Plugins', 'manage_options', 'desparza-menu', 'dewp_desparza_function', 'dashicons-editor-code', 90 );
		add_submenu_page( 'desparza-menu', 'Sobre Daniel Esparza', 'Sobre Daniel Esparza', 'manage_options', 'desparza-menu' );
	
    function dewp_desparza_function(){
		ob_start();	
	?>
		<div class="wrap">
            <h2>Daniel Esparza</h2>
            <p>Consultoría en servicios y soluciones de entorno web.<br>¿Qué tipo de servicio o solución necesita tu negocio?</p>
            <h4>Contact info:</h4>
            <p>
                Sitio web: <a href="https://danielesparza.studio/" target="_blank">https://danielesparza.studio/</a><br>
                Contacto: <a href="mailto:hi@danielesparza.studio" target="_blank">hi@danielesparza.studio</a><br>
                Messenger: <a href="https://www.messenger.com/t/danielesparza.studio" target="_blank">enviar mensaje</a><br>
                Información acerca del plugin: <a href="https://danielesparza.studio/breadcrumbs-anywhere/" target="_blank">sitio web del plugin</a><br>
                Daniel Esparza | Consultoría en servicios y soluciones de entorno web.<br>
                ©2020 Daniel Esparza, inspirado por #openliveit #dannydshore
            </p>
		</div>
	<?php 
		$output_string = ob_get_contents();
		ob_end_clean();
		echo $output_string;
	}
    }	
    
    add_action( 'admin_enqueue_scripts', 'dewp_register_adminstyle' );
    function dewp_register_adminstyle() {
        wp_register_style( 'dewp_register_adminstyle', plugin_dir_url( __FILE__ ) . '../css/dewp_style_admin.css', array(), '1.0' );
        wp_enqueue_style( 'dewp_register_adminstyle' );
    }
    
}

if ( !function_exists( 'dewp_wqp_register_settings' ) ) {
    add_action( 'admin_init', 'dewp_wqp_register_settings' );
    function dewp_wqp_register_settings (){
        register_setting( 'dewp_settings_group' , 'dewp_settings' );
    }
}

if ( !function_exists( 'dewp_wqp_admin_add' ) ) {
	
	add_action( 'admin_menu', 'dewp_wqp_admin_add' );
	function dewp_wqp_admin_add() {
		add_submenu_page( 'desparza-menu', 'Quick View Products', 'Quick View Products', 'manage_options', 'dewp-omn-admin-settings', 'dewp_wqp_admin_settings' );
	}
    
	function dewp_wqp_admin_settings(){
		global $wpdb;
        global $dewp_options;
        ob_start();
		
		if( isset($_GET['settings-updated']) ) {
        ?>
            <div id="message" class="updated" style="margin:15px 15px 0 0;">
            <p><strong><?php _e('Settings saved.') ?></strong></p>
            </div>
		<?php }

		if ( isset($_REQUEST['dewp_settings[wqp_enable]']) ){
			if ( ! wp_verify_nonce(  $_REQUEST['dewp_noncefield'], 'dewp_nonceaction' ) ) {
				wp_die( "Error - Verificación nonce no válida" );
			} else {
				update_option( $data['dewp_settings[wqp_enable]'] = sanitize_text_field( $_REQUEST['dewp_settings[wqp_enable]'] ) );
                update_option( $data['dewp_settings[wqp_boton_text]'] = sanitize_text_field( $_REQUEST['dewp_settings[wqp_boton_text]'] ) );
				$wpdb->insert( 'dewp_noncedata' , $data );
			}
		}
    	?>

        <h2><?php _e( 'Quick View Products', 'text-dewp' ); ?></h2>

        <ul>
            <li><strong>= Instrucciones básicas: =</strong></li>
            <li>• Habilitar el Plugin.</li>
            <li>• Agregar un nombre al botón.</li>
            <li>• Disfrutar.</li>
        </ul>

		
        <form id="dewp_settings_form" action="options.php" method="post">
            
            <?php settings_fields( 'dewp_settings_group' ); ?>

            <p>
                <input id="dewp_settings[wqp_enable]" name="dewp_settings[wqp_enable]" type="checkbox" value="1" <?php esc_attr( checked( '1' , isset($dewp_options['wqp_enable']) )); ?>  />
                <label for="dewp_settings[wqp_enable]"><?php _e( 'Habilitar Quick View Products', 'text-dewp' ); ?></label>
            </p>
            
            <p>
				<strong><?php _e( 'Configuración del botón Quick View Products', 'text-dewp' ); ?></strong>
			</p>
            
            <div class="dewp_settings-block">
                <label for="dewp_settings[wqp_boton_text]"><?php _e( 'Agregar texto del botón:', 'text-dewp' ); ?></label>
				<input id="dewp_settings[wqp_boton_text]" name="dewp_settings[wqp_boton_text]" type="text" value="<?php echo esc_attr( $dewp_options['wqp_boton_text'] ); ?>" />
            </div>
			
            <p>
				<button type="submit" name="submit" form="dewp_settings_form" value="Submit"><?php _e( 'Guardar', 'text-dewp' ); ?></button>
				<?php wp_nonce_field( 'dewp_nonceaction', 'dewp_noncefield' ); ?>
			</p>
            
        </form>

    	<?php 
		$output_string = ob_get_contents();
		ob_end_clean();
		echo $output_string;    
	}
	
}