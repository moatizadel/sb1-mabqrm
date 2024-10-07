(function($) {
    'use strict';

    $(document).ready(function() {
        $('.mo-works-chatbot-toggle').on('click', function() {
            $('.mo-works-chatbot-body').toggleClass('open');
        });

        $('#mo-works-chatbot-send').on('click', function() {
            sendMessage();
        });

        $('#mo-works-chatbot-user-input').on('keypress', function(e) {
            if (e.which === 13) {
                sendMessage();
            }
        });

        function sendMessage() {
            var userInput = $('#mo-works-chatbot-user-input').val().trim();
            if (userInput !== '') {
                appendMessage('user', userInput);
                $('#mo-works-chatbot-user-input').val('');

                $.ajax({
                    url: mo_works_chatbot.ajax_url,
                    type: 'POST',
                    data: {
                        action: 'mo_works_chatbot_request',
                        nonce: mo_works_chatbot.nonce,
                        message: userInput
                    },
                    success: function(response) {
                        if (response.success) {
                            appendMessage('bot', response.data.response);
                        } else {
                            appendMessage('bot', 'Sorry, there was an error processing your request.');
                        }
                    },
                    error: function() {
                        appendMessage('bot', 'Sorry, there was an error communicating with the server.');
                    }
                });
            }
        }

        function appendMessage(sender, message) {
            var messageClass = sender === 'user' ? 'user' : 'bot';
            var messageHtml = '<div class="mo-works-chatbot-message ' + messageClass + '">' + message + '</div>';
            $('.mo-works-chatbot-messages').append(messageHtml);
            $('.mo-works-chatbot-messages').scrollTop($('.mo-works-chatbot-messages')[0].scrollHeight);
        }
    });

})(jQuery);