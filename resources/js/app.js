import './bootstrap';

document.addEventListener("DOMContentLoaded", function () {

    const userId = document.querySelector("meta[name='user-id']").getAttribute("content");
    const convoId = document.querySelector("meta[name='current-convo-id']").getAttribute("content");

    window.Echo.private(`user.${userId}`).listen('.private-message', (event) => {

        const senderId = event.sender_id; 
        const convo_id = event.convo_id;

        let lastMessageElemBase = document.querySelector(`#last_message_base-${convo_id}`);
        if (lastMessageElemBase) {
            lastMessageElemBase.innerHTML = event.message;
        }

        let lastMessageTimeElem = document.querySelector(`#last_message_time-${convo_id}`);
        if (lastMessageTimeElem) {
            lastMessageTimeElem.innerHTML = "⋅ " + formatMessageTime(event.created_at);
        }

        let messageContainer = document.getElementById('messages-container');
        if (!messageContainer) {
            return;
        }

        let lastMessageElem = document.querySelector(`#last_message-${parseInt(convo_id)}`);
        if (lastMessageElem) {
            lastMessageElem.innerHTML = event.message;  // Update the preview message
        } 

        if (senderId == userId || parseInt(convoId) != parseInt(convo_id)) {
            return; 
        }

        // update preview message of current transaction
        let lastMessageElemCurrent = document.querySelector(`#last_message_current-${convo_id}`);
        if (lastMessageElemCurrent) {
            lastMessageElemCurrent.innerHTML = event.message;
        }

        // Create a new message element
        let newMessage = document.createElement("div");
        newMessage.classList.add("p-3", "rounded-lg", "ml-2");

        newMessage.innerHTML = `
            <div class="flex flex-row items-center" x-data="{ showDateOpen: false }">
                <div class="flex items-center justify-center h-10 w-10 rounded-full bg-indigo-500 flex-shrink-0">
                    <img src="${event.image_url}" alt="" class="h-10 w-10 rounded-full flex-shrink-0 border shadow">
                </div>
                <div class="relative ml-3 text-sm bg-white py-1.5 px-4 shadow rounded-xl max-w-[250px] md:max-w-[500px]"
                    @mouseenter="showDateOpen = true" @mouseleave="showDateOpen = false">
                    <div class="break-all relative">${event.message}</div>
                    <div class="absolute -top-8 left-0 bg-gray-100 p-1.5 opacity-90 font-medium text-xs border rounded-md shadow w-fit whitespace-nowrap inline-flex"
                        x-show="showDateOpen">
                        ${formatMessageTime(event.created_at)}
                    </div>
                </div>
            </div>
        `;

        // Append the new message at the **bottom**
        messageContainer.insertBefore(newMessage, messageContainer.firstChild);

        // Auto-scroll to the bottom
        messageContainer.scrollTo(0, messageContainer.scrollHeight);

        function formatMessageTime(timestamp) {
            let date = new Date(timestamp);
            let now = new Date();
            
            let options = { hour: 'numeric', minute: 'numeric', hour12: true };
        
            if (date.toDateString() === now.toDateString()) {
                return date.toLocaleTimeString('en-SG', options);
            } else {
                let yesterday = new Date();
                yesterday.setDate(yesterday.getDate() - 1);
        
                if (date.toDateString() === yesterday.toDateString()) {
                    return `Yesterday at ${date.toLocaleTimeString('en-SG', options)}`;
                } else {
                    return date.toLocaleDateString('en-SG', { month: 'short', day: 'numeric', year: 'numeric' }) + 
                           ` ${date.toLocaleTimeString('en-SG', options)}`;
                }
            }
        }
    });
});

