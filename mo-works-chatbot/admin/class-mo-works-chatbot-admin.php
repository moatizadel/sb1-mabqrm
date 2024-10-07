<?php
class Mo_Works_Chatbot_Admin {
    private $plugin_name;
    private $version;

    public function __construct($plugin_name, $version) {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }

    public function enqueue_styles() {
        wp_enqueue_style($this->plugin_name, MO_WORKS_CHATBOT_PLUGIN_URL . 'admin/css/mo-works-chatbot-admin.css', array(), $this->version, 'all');
    }

    public function enqueue_scripts() {
        wp_enqueue_script($this->plugin_name, MO_WORKS_CHATBOT_PLUGIN_URL . 'admin/js/mo-works-chatbot-admin.js', array('jquery'), $this->version, false);
    }

    public function add_options_page() {
        add_options_page(
            'Mo Works Chatbot Settings',
            'Mo Works Chatbot',
            'manage_options',
            $this->plugin_name,
            array($this, 'display_options_page')
        );
    }

    public function display_options_page() {
        include_once 'partials/mo-works-chatbot-admin-display.php';
    }

    public function register_settings() {
        register_setting($this->plugin_name, $this->plugin_name . '_options', array($this, 'validate_options'));

        add_settings_section(
            $this->plugin_name . '_general',
            __('General Settings', 'mo-works-chatbot'),
            array($this, 'general_settings_section_callback'),
            $this->plugin_name
        );

        add_settings_field(
            'chatbot_title',
            __('Chatbot Title', 'mo-works-chatbot'),
            array($this, 'chatbot_title_field_callback'),
            $this->plugin_name,
            $this->plugin_name . '_general'
        );

        add_settings_field(
            'initial_message',
            __('Initial Message', 'mo-works-chatbot'),
            array($this, 'initial_message_field_callback'),
            $this->plugin_name,
            $this->plugin_name . '_general'
        );

        // Add more settings fields as needed
    }

    public function general_settings_section_callback() {
        echo '<p>' . __('Configure the general settings for the Mo Works Chatbot.', 'mo-works-chatbot') . '</p>';
    }

    public function chatbot_title_field_callback() {
        $options = get_option($this->plugin_name . '_options');
        $value = isset($options['chatbot_title']) ? $options['chatbot_title'] : '';
        echo '<input type="text" name="' . $this->plugin_name . '_options[chatbot_title]" value="' . esc_attr($value) . '" />';
    }

    public function initial_message_field_callback() {
        $options = get_option($this->plugin_name . '_options');
        $value = isset($options['initial_message']) ? $options['initial_message'] : '';
        echo '<textarea name="' . $this->plugin_name . '_options[initial_message]">' . esc_textarea($value) . '</textarea>';
    }

    public function validate_options($input) {
        $valid = array();
        $valid['chatbot_title'] = sanitize_text_field($input['chatbot_title']);
        $valid['initial_message'] = sanitize_textarea_field($input['initial_message']);
        return $valid;
    }
}