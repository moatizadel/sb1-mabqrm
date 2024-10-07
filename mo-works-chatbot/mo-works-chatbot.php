<?php
/**
 * Plugin Name: Mo Works Chatbot
 * Description: A customizable chatbot plugin for easy integration into WordPress sites.
 * Version: 1.0.0
 * Author: Mo Works
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Define plugin constants
define('MO_WORKS_CHATBOT_VERSION', '1.0.0');
define('MO_WORKS_CHATBOT_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('MO_WORKS_CHATBOT_PLUGIN_URL', plugin_dir_url(__FILE__));

// Include necessary files
require_once MO_WORKS_CHATBOT_PLUGIN_DIR . 'includes/class-mo-works-chatbot.php';
require_once MO_WORKS_CHATBOT_PLUGIN_DIR . 'admin/class-mo-works-chatbot-admin.php';
require_once MO_WORKS_CHATBOT_PLUGIN_DIR . 'public/class-mo-works-chatbot-public.php';

// Initialize the plugin
function mo_works_chatbot_init() {
    $plugin = new Mo_Works_Chatbot();
    $plugin->run();
}
mo_works_chatbot_init();