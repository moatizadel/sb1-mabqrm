<?php
class Mo_Works_Chatbot_Public {
    private $plugin_name;
    private $version;

    public function __construct($plugin_name, $version) {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }

    public function enqueue_styles() {
        wp_enqueue_style($this->plugin_name, MO_WORKS_CHATBOT_PLUGIN_URL . 'public/css/mo-works-chatbot-public.css', array(), $this->version, 'all');
    }

    public function enqueue_scripts() {
        wp_enqueue_script($this->plugin_name, MO_WORKS_CHATBOT_PLUGIN_URL . 'public/js/mo-works-chatbot-public.js', array('jquery'), $this->version, false);
        wp_localize_script($this->plugin_name, 'mo_works_chatbot', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('mo_works_chatbot_nonce')
        ));
    }

    public function display_chatbot() {
        $options = get_option($this->plugin_name . '_options');
        $chatbot_title = isset($options['chatbot_title']) ? $options['chatbot_title'] : 'Mo Works Chatbot';
        $initial_message = isset($options['initial_message']) ? $options['initial_message'] : 'How can I help you today?';

        include_once 'partials/mo-works-chatbot-public-display.php';
    }

    public function chatbot_shortcode($atts) {
        ob_start();
        $this->display_chatbot();
        return ob_get_clean();
    }

    // Add AJAX handler for chatbot interactions
    public function handle_chatbot_request() {
        check_ajax_referer('mo_works_chatbot_nonce', 'nonce');

        $message = sanitize_text_field($_POST['message']);
        // Process the message and generate a response
        // This is where you would integrate with your chatbot logic or API

        $response = "This is a sample response. Implement your chatbot logic here.";

        wp_send_json_success(array('response' => $response));
    }
}

add_action('wp_ajax_mo_works_chatbot_request', array('Mo_Works_Chatbot_Public', 'handle_chatbot_request'));
add_action('wp_ajax_nopriv_mo_works_chatbot_request', array('Mo_Works_Chatbot_Public', 'handle_chatbot_request'));