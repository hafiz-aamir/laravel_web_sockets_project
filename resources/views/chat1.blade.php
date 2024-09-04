<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Chat - User 1</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f0f2f5;
            margin: 0;
        }

        .chat-container {
            width: 100%;
            max-width: 600px;
            height: 80vh;
            background-color: white;
            display: flex;
            flex-direction: column;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        .chat-messages {
            flex: 1;
            padding: 10px;
            overflow-y: auto;
            background-color: #e9ebee;
        }

        .chat-message {
            margin: 5px 0;
            padding: 10px;
            border-radius: 10px;
            max-width: 75%;
        }

        .chat-message.user1 {
            background-color: #007bff;
            color: white;
            align-self: flex-start;
        }

        .chat-message.user2 {
            background-color: #28a745;
            color: white;
            align-self: flex-end;
        }

        .chat-input {
            display: flex;
            border-top: 1px solid #ddd;
            padding: 5px;
            justify-content: space-between;
        }

        .chat-input input {
            flex: 1;
            padding: 10px;
            border: none;
            outline: none;
            font-size: 16px;
        }

        .chat-input button {
            padding: 10px 20px;
            border: none;
            background-color: #007bff;
            color: white;
            cursor: pointer;
            font-size: 16px;
            margin-left: 5px;
        }
    </style>
</head>
<body>

    @vite('resources/js/app.js')

    <div class="chat-container">
        <!-- Messages Container -->
        <div class="chat-messages" id="message">
            <!-- Messages will be appended here -->
        </div>

        <!-- User 1 Input Container -->
        <form id="chat1form">

            <div class="chat-input">
                <input type="text" id="chat-input-user1" placeholder="User 1: Type a message..." />
                <button type="button" id="chat1">Send</button>
            </div>

        </form>
        
    </div>

    <script>
        setTimeout(() => {
            window.Echo.channel('example-channel')
                .listen('testingEvent', (e) => {
                    let messageDiv = document.createElement('div');
                    messageDiv.className = e.user === 'user1' ? 'chat-message user1' : 'chat-message user2';
                    messageDiv.innerText = e.message;
                    document.getElementById('message').appendChild(messageDiv);

                    // Scroll to the bottom
                    document.getElementById('message').scrollTop = document.getElementById('message').scrollHeight;
                });
        }, 200);

        document.getElementById('send-button-user1').addEventListener('click', function() {
            sendMessage('user1');
        });

        function sendMessage(user) {
            let messageInput = document.getElementById('chat-input-user1');
            let userMessage = messageInput.value;

            if (userMessage.trim() !== '') {
                let userDiv = document.createElement('div');
                userDiv.className = `chat-message ${user}`;
                userDiv.innerText = userMessage;
                document.getElementById('message').appendChild(userDiv);

                // Clear input
                messageInput.value = '';

                // Scroll to the bottom
                document.getElementById('message').scrollTop = document.getElementById('message').scrollHeight;

                // Emit the event to others
                window.Echo.channel('example-channel').whisper('client-message', { message: userMessage, user: 'user1' });
            }
        }
    </script>

</body>
</html>

<!-- Include jQuery (if not already included in your project) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {

        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        $('#chat1').click(function () {
            $.ajax({
                url: "{{ URL('send_chat2') }}", // The URL to send the request to
                type: 'POST', // The request type
                data: $('#chat1form').serialize(), // Serialize form data for submission
                headers: {
                    'X-CSRF-TOKEN': csrfToken // Add CSRF token to the request header
                },
                success: function (response) {
                    // Handle success response
                    // alert('Message sent successfully!');
                }
            });
        });
    });
</script>