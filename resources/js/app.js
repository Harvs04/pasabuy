import './bootstrap';

// const userId = document.querySelector("meta[name='user-id']").getAttribute("content");
// window.Echo.private(`user.${userId}`).listen('.private-notification', (event) => {
//     console.log(event.message)
// })
document.addEventListener("DOMContentLoaded", function () {
    const userId = document.querySelector("meta[name='user-id']").getAttribute("content");

    window.Echo.private(`user.${userId}`).listen('.private-message', (event) => {
        let messageContainer = document.getElementById('messages-container');

        if (!messageContainer) {
            console.error("Message container not found!");
            return;
        }

        // Get the sender's ID from the event (make sure your event includes sender_id)
        const senderId = event.sender_id; 
        // Prevent duplication: Only append messages **not** from the current user
        if (senderId == userId) {
            return; // Exit the function 
        }

        // Create a new message element
        let newMessage = document.createElement("div");
        newMessage.classList.add("flex", "items-center", "gap-2");
        newMessage.innerHTML = `
            <img src="https://c0.wallpaperflare.com/preview/344/599/609/pet-dog-animals-cute.jpg" 
                 alt="" class="h-20 w-20 object-contain rounded-full">
            ${event.message}
        `;

        // Append the new message aet the **bottom**
        messageContainer.appendChild(newMessage);

        // Auto-scroll to the bottom
        messageContainer.scrollTop = messageContainer.scrollHeight;
    });
});

