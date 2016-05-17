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
	}

	public function add_admin_menu(){
		add_management_page('MenuPlugin', 'MenuPlugin', 'manage_options', 'my-super-awesome-plugin', array($this, 'admin_page'));
	}

	//callback function
	public function admin_page(){
		$html = "A WordPress plugin for showing a three vertical menu";
		echo $html;
	}

}
$miplugin = new Menu_plugin();
?>