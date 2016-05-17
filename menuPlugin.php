<?php
	/*
	Plugin Name: Menu plugin
	version: 1.0
	Description: Show menu to show Ukranian cities
	Author: Xperius
	*/

class Menu_plugin{
	public function __construct() {
		add_action('admin_menu',array($this,"add_admin_menu"));
		register_activation_hook(__FILE__, array($this, "create_schema"));
	}

	public function add_admin_menu(){
		add_management_page('MenuPlugin', 'MenuPlugin', 'manage_options', 'my-super-awesome-plugin', array($this, 'admin_page'));
	}

	//callback function
	public function admin_page(){
		if($_POST['menu_hidden'] == 'Y'):
			$this->handle_form($_POST);
		else:
		$html = "A WordPress plugin for showing a three vertical menu";
		$html .= "<h2>" . __( 'Menu Display Options', 'menu_trdom' ) . "</h2>";
		$html .= '<form name="menu_form" method="post" action="'. str_replace( '%7E', '~', $_SERVER['REQUEST_URI']) .'">';
		$html .= '<input type="hidden" name="menu_hidden" value="Y">';
		$html .= '<input type="submit" name="Submit" value="Update Options" />';
		$html .= '</form>';
		echo $html;
		endif;
	}

	public function handle_form($data){
		//var_dump($data);
		//$this->create_schema();
	}

	private function create_schema(){
		global $wpdb;
		$db_name = $wpdb->prefix . $wpdb->dbname;
		$db_table_name = $wpdb->prefix . 'custom_location';
		//var_dump($wpdb->get_var( "SHOW TABLES LIKE '$db_table_name'" ) != $db_table_name);
		if($wpdb->get_var( "SHOW TABLES LIKE '$db_table_name'" ) != $db_table_name) {
			if ( ! empty( $wpdb->charset ) )
				$charset_collate = "DEFAULT CHARACTER SET $wpdb->charset";
			if ( ! empty( $wpdb->collate ) )
				$charset_collate .= " COLLATE $wpdb->collate";

			$sql = "CREATE TABLE " . $db_table_name . " (
			`id` INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
			`type` VARCHAR DEFAULT NULL,
			`name` VARCHAR DEFAULT NULL,
			`location_id` INTEGER DEFAULT NULL,
			PRIMARY KEY (`id`)
			) $charset_collate;";
			dbDelta( $sql );
		}
	}
}
$miplugin = new Menu_plugin();
?>