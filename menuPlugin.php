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
		if($_POST['menu_hidden'] == 'Y'):
			$this->handleForm($_POST);
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

	public function handleForm($data){
		var_dump($data);
	}

}
$miplugin = new Menu_plugin();
?>