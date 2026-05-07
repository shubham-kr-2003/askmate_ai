const promptInput = document.getElementById("user-input");
const chatContainer = document.getElementById("chat-container");
const sendBtn = document.getElementById("send-btn");
const welcomeMessage = document.getElementById("welcome-message");
const historyList = document.getElementById("chat-history");

let userMessage = null;
let currentConversationId = localStorage.getItem("currentConversationId") || Date.now().toString();

const API_URL = "https://generativelanguage.googleapis.com/v1beta/models/gemini-3-flash-preview:generateContent?key=AIzaSyDg5NssNORAmcxFJOtgARqQ8Z5OXJKvVAA";

function createChatBox(html, className) {
    const div = document.createElement("div");
    div.classList.add("chat-box", className);
    div.innerHTML = html;
    return div;
}

// Naya conversation shuru karne ke liye
function startNewChat() {
    currentConversationId = Date.now().toString();
    localStorage.setItem("currentConversationId", currentConversationId);
    chatContainer.innerHTML = `
        <div class="welcome-container" id="welcome-message">
            <h1>Hello There!</h1>
            <p>How can I help you today?</p>
        </div>`;
}

async function saveChat(message, role) {
    const formData = new FormData();
    formData.append('conversation_id', currentConversationId);
    formData.append('message', message);
    formData.append('role', role);
    try {
        await fetch('save_chat.php', {
            method: 'POST',
            body: formData
        });
        loadHistory();
    } catch (error) {
        console.error('Error saving chat:', error);
    }
}

async function loadHistory() {
    try {
        const response = await fetch('get_history.php');
        const history = await response.json();
        if (!historyList) return;
        historyList.innerHTML = '';
        history.forEach(item => {
            const li = document.createElement('li');
            li.classList.add('history-item');
            if (item.conversation_id === currentConversationId) li.classList.add('active');
            li.innerHTML = `<span>💬</span> ${item.title}`;
            li.title = item.title;
            li.addEventListener('click', () => loadChatDetails(item.conversation_id));
            historyList.appendChild(li);
        });
    } catch (error) {
        console.error('Error loading history:', error);
    }
}

async function loadChatDetails(conversationId) {
    currentConversationId = conversationId;
    localStorage.setItem("currentConversationId", conversationId);
    
    try {
        const response = await fetch(`get_chat_details.php?conversation_id=${conversationId}`);
        const messages = await response.json();
        
        chatContainer.innerHTML = ''; // Clear current chat
        messages.forEach(msg => {
            const html = `
                <img src="${msg.role === 'user' ? 'user.png' : 'ai.png'}" alt="${msg.role}">
                <div class="chat-text">${msg.role === 'ai' ? msg.message : msg.message}</div>`;
            const chatBox = createChatBox(html, msg.role === 'user' ? "user-chat-box" : "ai-chat-box");
            chatContainer.appendChild(chatBox);
        });
        
        loadHistory(); // Sidebar update karne ke liye
        chatContainer.scrollTo(0, chatContainer.scrollHeight);
    } catch (error) {
        console.error('Error loading chat details:', error);
    }
}

async function generateApiResponse(aiChatBox) {
    const textElement = aiChatBox.querySelector(".chat-text");
    try {
        const response = await fetch(API_URL, {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({
                contents: [{
                    "role": "user",
                    "parts": [{ text: userMessage }]
                }]
            })
        });
        const data = await response.json();
        const apiResponse = data?.candidates[0].content.parts[0].text.trim();
        
        // Typing effect simulate
        textElement.innerText = apiResponse;
        saveChat(apiResponse, 'ai');
    } catch (error) {
        textElement.innerText = "Oops! Something went wrong. Please try again.";
        console.log(error);
    } finally {
        const loadingImg = aiChatBox.querySelector(".loading-dots");
        if (loadingImg) loadingImg.remove();
        chatContainer.scrollTo(0, chatContainer.scrollHeight);
    }
}

function handleChat() {
    userMessage = promptInput.value.trim();
    if (!userMessage) return;

    if (welcomeMessage) welcomeMessage.style.display = "none";

    // User Message UI
    const userHtml = `
        <img src="user.png" alt="user">
        <div class="chat-text">${userMessage}</div>`;
    const userChatBox = createChatBox(userHtml, "user-chat-box");
    chatContainer.appendChild(userChatBox);
    
    promptInput.value = "";
    saveChat(userMessage, 'user');
    chatContainer.scrollTo(0, chatContainer.scrollHeight);

    // AI Loading UI
    setTimeout(() => {
        const aiHtml = `
            <img src="ai.png" alt="ai">
            <div class="chat-text">
                <span class="loading-dots">Thinking...</span>
            </div>`;
        const aiChatBox = createChatBox(aiHtml, "ai-chat-box");
        chatContainer.appendChild(aiChatBox);
        generateApiResponse(aiChatBox);
        chatContainer.scrollTo(0, chatContainer.scrollHeight);
    }, 600);
}

sendBtn.addEventListener("click", handleChat);

promptInput.addEventListener("keydown", (e) => {
    if (e.key === "Enter") handleChat();
});

window.addEventListener('DOMContentLoaded', loadHistory);