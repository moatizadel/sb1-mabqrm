<div class="wrap">
    <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
    <form action="options.php" method="post">
    <?php
        settings_fields($this->plugin_name);
        do_settings_sections($this->plugin_name);
        submit_button();
    ?>
    </form>
</div>