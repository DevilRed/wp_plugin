<?php
	/*
	Plugin Name: Menu plugin
	version: 1.0
	Description: Make a menu to show Ukranian cities
	Author: Xperius
	*/

class Menu_plugin{
	public function __construct() {
		add_action('admin_menu',array($this,"add_admin_menu"));
	}

	public function add_admin_menu(){
		add_management_page('MenuPlugin', 'MenuPlugin', 'manage_options', 'my-super-awesome-plugin', array($this, 'admin_page'));
	}

	//callback function
	public function admin_page(){
		$this->create_schema();
		if($_POST['menu_hidden'] == 'Y'):
			$this->handle_form($_POST);
		else:
		$html = "A WordPress plugin for showing a three vertical menu";
		$html .= "<h2>" . __( 'Menu Display Options', 'menu_trdom' ) . "</h2>";
		$html .= '<form name="menu_form" method="post" action="'. str_replace( '%7E', '~', $_SERVER['REQUEST_URI']) .'">';
		$html .= '<label for="location_name">Enter the location name: </label>';
		$html .= '<input type="text" name="location_name" placeholder="Enter the name of the location"><br><br>';
		$html .= '<label for="location_name">Select the location type: </label>';
		$html .= '<select name="location_type"><option value="region">Region</option><option value="city">City</option><option value="village">Village</option></select><br><br>';
		$html .= '<input type="hidden" name="menu_hidden" value="Y">';
		$html .= '<input type="submit" name="Submit" value="Update Options" class="button button-primary button-large" />';
		$html .= '</form>';
		echo $html;
		endif;
	}

	public function handle_form($data){
		var_dump($data);
	}

	private function create_schema(){
		global $wpdb;
		$db_name = $wpdb->prefix . $wpdb->dbname;
		$db_table_name = $wpdb->prefix . 'custom_location';
		if($wpdb->get_var( "SHOW TABLES LIKE '$db_table_name'" ) != $db_table_name) {
			if ( ! empty( $wpdb->charset ) )
				$charset_collate = "DEFAULT CHARACTER SET $wpdb->charset";
			if ( ! empty( $wpdb->collate ) )
				$charset_collate .= " COLLATE $wpdb->collate";

			$sql = "CREATE TABLE " . $db_table_name . " (
			`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
			`type` varchar(45) DEFAULT NULL,
			`name` varchar(45) DEFAULT NULL,
			`location_id` int(11) DEFAULT NULL,
			PRIMARY KEY  (`id`)
			) $charset_collate;";
			require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
			dbDelta( $sql );
		}
	}
}
$miplugin = new Menu_plugin();
