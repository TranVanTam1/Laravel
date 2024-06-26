$(document).ready(function($) {    
    $(window).scroll(function(){
        if($(this).scrollTop()>150){
        $(".header-bottom").addClass('fixNav')
        }else{
            $(".header-bottom").removeClass('fixNav')
        }}
    )
})
// Simulate some messages for demonstration
var messages = [
    
];
// Function to display messages in chat history and scroll to the bottom
function displayMessages() {
    var chatHistory = document.getElementById('chat-history');
    var shouldScroll = chatHistory.scrollTop + chatHistory.clientHeight === chatHistory.scrollHeight;

    chatHistory.innerHTML = ''; // Clear previous messages

    messages.forEach(function(message) {
        var messageElement = document.createElement('div');
        messageElement.className = 'message';
        messageElement.innerHTML = '<strong>' + message.sender + ':</strong> ' + message.content;
        chatHistory.appendChild(messageElement);
    });

    // Scroll to the bottom if the chat was already scrolled to the bottom before
    if (shouldScroll) {
        chatHistory.scrollTop = chatHistory.scrollHeight;
    }
}

// Function to handle sending a message
document.getElementById('send-message').addEventListener('click', function() {
    var messageInput = document.getElementById('chat-input');
    var messageContent = messageInput.value.trim();

    if (messageContent !== '') {
        // Add your message to the chat history
        messages.push({ sender: 'Bạn', content: messageContent });
        displayMessages();

        // Simulate automatic reply after user's message is displayed
        setTimeout(function() {
            var lastMessage = messages[messages.length - 1];
            if (lastMessage.sender === 'Bạn') { // Check if the last message displayed is from the user
                messages.push({ sender: 'Admin', content: 'Tôi đang xem xét yêu cầu của bạn. Vui lòng đợi một chút.' });
                displayMessages();
            }
        }, 1000);

        // Clear input after sending message
        messageInput.value = '';
    }
});

// Event listener for opening the chat
document.getElementById("open-chat").addEventListener("click", function() {
    document.getElementById("chat-widget").style.display = "block";
});

// Event listener for closing the chat
document.getElementById("close-chat").addEventListener("click", function() {
    document.getElementById("chat-widget").style.display = "none";
});

// Event listener for sending a message
document.getElementById('send-message').addEventListener('click', function() {
    var messageInput = document.getElementById('chat-input');
    var messageContent = messageInput.value.trim();

    if (messageContent !== '') {
        // Add the message to the chat history
        messages.push({ sender: 'Bạn', content: messageContent });
        displayMessages(); // Display the updated chat history with the new message
        messageInput.value = ''; // Clear the input content
    }
});