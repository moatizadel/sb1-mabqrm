<div id="mo-works-chatbot" class="mo-works-chatbot">
    <div class="mo-works-chatbot-header">
        <h3><?php echo esc_html($chatbot_title); ?></h3>
        <button class="mo-works-chatbot-toggle">Toggle</button>
    </div>
    <div class="mo-works-chatbot-body">
        <div class="mo-works-chatbot-messages">
            <div class="mo-works-chatbot-message bot">
                <?php echo esc_html($initial_message); ?>
            </div>
        </div>
        <div class="mo-works-chatbot-input">
            <input type="text" id="mo-works-chatbot-user-input" placeholder="Type your message...">
            <button id="mo-works-chatbot-send">Send</button>
        </div>
    </div>
</div>