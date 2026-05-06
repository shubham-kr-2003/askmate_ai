let prompt=document.querySelector(".prompt") 
let container=document.querySelector(".container") 
let chatContainer=document.querySelector(".chat-container") 
let btn=document.querySelector(".btn") 
const wrapper = document.querySelector('.wrapper'); 
 
let userMessage=null; 
 
 
let  API_URL="https://generativelanguage.googleapis.com/v1beta/models/gemini-3-flash-preview:generateContent?key=AIzaSyD0iCIqSubqK98e4qd25pVxMw9iQaGS_3M"
 function createChatBox(html,className){ 
const div=document.createElement("div") 
div.classList.add(className) 
div.innerHTML=html; 
return div 
}

async function saveChat(message, role) {
    const formData = new FormData();
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
        const historyList = document.getElementById('chat-history');
        if (!historyList) return;
        historyList.innerHTML = '';
        history.forEach(item => {
            const li = document.createElement('li');
            li.classList.add('history-item');
            li.innerText = item.message;
            li.title = item.message;
            li.addEventListener('click', () => {
                prompt.value = item.message;
                btn.click();
            });
            historyList.appendChild(li);
        });
    } catch (error) {
        console.error('Error loading history:', error);
    }
}

window.addEventListener('DOMContentLoaded', loadHistory);
async function generateApiResponse(aiChatBox){ 
const textElement=aiChatBox.querySelector(".text") 
try{ 
const response=await fetch(API_URL,{ 

 
  method:"POST", 
  headers:{"Content-Type": "application/json"}, 
  body:JSON.stringify({ 
    contents:[{ 
      "role": "user", 
      "parts":[{text:`${userMessage} in words`}]
    }] 
  }) 
}) 
const data=await response.json() 
const apiResponse=data?.candidates[0].content.parts[0].text.trim(); 
textElement.innerText=apiResponse 
saveChat(apiResponse, 'ai'); 
 
} 
catch(error){ 
  console.log(error) 
} 
finally{ 
  aiChatBox.querySelector(".loading").style.display="none" 
} 
} 
function showLoading(){ 
  const html=` <div id="img"> 
        <img src="ai.png" alt=""> 
    </div> 
    <div class="text"> 
    </div> 
    <img src="loading.gif" alt="" height="50" class="loading">` 
    let aiChatBox=createChatBox(html,"ai-chat-box") 
 chatContainer.appendChild(aiChatBox) 
generateApiResponse(aiChatBox) 
 

 
} 
 
btn.addEventListener("click",()=>{ 
    userMessage=prompt.value; 
    if(prompt.value ===""){ 
      container.style.display="flex" 
    }else{ 
       container.style.display="none" 
    } 
    if(!userMessage)return; 
    saveChat(userMessage, 'user');
  const html=` <div id="img"> 
        <img src="user.png" alt=""> 
    </div> 
    <div class="text"> 
    </div>` 
 let userChatBox=createChatBox(html,"user-chat-box") 
 userChatBox.querySelector(".text").innerText=userMessage 
 chatContainer.appendChild(userChatBox) 
 prompt.value="" 
 setTimeout(showLoading,1000) 
 
 const loginLink = document.querySelector('.login-link'); 
const registerlink = document.querySelector('.register-link'); 
const btnPopup= document.querySelector('.btnLogin-popup'); 
const iconClose= document.querySelector('.icon-close'); 
 
registerlink?.addEventListener('click',() => {wrapper.classList.add('active');}); 
loginLink?.addEventListener('click', () => {wrapper.classList.remove('active');}); 
btnPopup?.addEventListener('click', () => {wrapper.classList.add('active-popup');}); 
iconClose?.addEventListener('click', () => {wrapper.classList.remove('active-popup');}); 
 
 
 
// Theme Toggle 
const themeSwitch = document.getElementById('theme-switch'); 
themeSwitch.addEventListener('change', () => { 
    document.body.classList.toggle('dark-mode'); 
}); 
 
// Contact Form Submission 
const contactForm = document.getElementById('contact-form'); 
contactForm.addEventListener('submit', (e) => { 
    e.preventDefault(); 
    alert('Thank you for contacting us!'); 
    contactForm.reset(); 
});  });