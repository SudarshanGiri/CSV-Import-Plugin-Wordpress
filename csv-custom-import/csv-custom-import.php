<?php
/**
 * Plugin Name: CSV Custom Import
 * Plugin URI: http://www.mywebsite.com/my-first-plugin
 * Description: The very first plugin that I have ever created.
 * Version: 1.0
 * Author: Your Name
 * Author URI: anchorpoints.com.np
 * License: GPL2
 */
global $tableName;
$tableName = $wpdb-> prefix."rubies";
function plugin_table(){
    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();
    $sql= "CREATE TABLE $tableName(
      id mediumint(11) NOT NULL AUTO_INCREMENT,
        name varchar(80) NOT NULL,
        shape varchar(80) NOT NULL,
        weight varchar(80) NOT NULL,
        treatment smallint(3) NOT NULL,
        price varchar(80) NOT NULL,
        Certificate varchar(80) NOT NULL,
        videos varchar(80) NOT NULL,
        PRIMARY KEY(id)  
    ) $charset_collate";
    require_once(ABSPATH."wp-admin/includes/upgrade.php");
    dbDelta($sql);
}
register_activation_hook( __FILE__, 'plugin_table' );

// create admin menu
add_action('admin_menu', 'plugin_menu');
 
function plugin_menu(){
    add_menu_page( 'Import Rubies', 'Import Rubies', 'manage_options', 'myplugin', 'displayList',  $icon_url='dashicons-superhero-alt' );
}


function displayList(){
    include "displaylist.php";
   
    
}
