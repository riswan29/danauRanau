// // fungsi untuk menampilkan/menyembunyikan popup chatbot
// var chatIcon = document.querySelector('.chat-icon');
// var chatPopup = document.querySelector('.chat-popup');
// chatIcon.addEventListener('click', function() {
// chatPopup.style.display = chatPopup.style.display === 'none' ? 'block' : 'none';
// });

// // fungsi untuk mengirim pesan dan menerima respons dari chatbot
// function submitForm(event) {
// event.preventDefault();
// var input = document.getElementById('chat-input');
// var response = document.getElementById('chat-response');
// // mengambil pesan dari input dan menambahkan pada div response
// var message = input.value;
// var p = document.createElement('p');
// p.innerHTML = '<b>You:</b> ' + message;
// p.classList.add("user-message");
// response.appendChild(p);
// input.value = ''; //membersihkan input

// // mengirim pesan ke chatbot dan menerima respons
// fetch('https://node.depth-g.com?text=' + message)
// .then(res => res.text())
// .then(data => {
// var p = document.createElement('p');
// p.innerHTML = '<b>RanauBot:</b> ' + data;
// p.classList.add("bot-message");
// response.appendChild(p);
// response.scrollTop = response.scrollHeight; // scroll ke bawah saat ada respons baru
// });
// return false;
// }

// ++++++++++++++++++++++++
// fungsi untuk menampilkan/menyembunyikan popup chatbot
var chatIcon = document.querySelector('.chat-icon');
var chatPopup = document.querySelector('.chat-popup');
var response = document.getElementById('chat-response'); // memindahkan variabel response agar bisa diakses oleh fungsi submitForm
var lastUserMessage = null; // menambahkan variabel untuk menyimpan pesan terakhir dari pengguna
var lastBotMessage = null; // menambahkan variabel untuk menyimpan pesan terakhir dari bot
chatIcon.addEventListener('click', function() {
chatPopup.style.display = chatPopup.style.display === 'none' ? 'block' : 'none';
});

// fungsi untuk mengirim pesan dan menerima respons dari chatbot
function submitForm(event) {
event.preventDefault();
var input = document.getElementById('chat-input');
// mengambil pesan dari input
var message = input.value;
input.value = ''; //membersihkan input
if (lastUserMessage) {
    // menghapus pesan terakhir dari pengguna
    response.removeChild(lastUserMessage);
}
if (lastBotMessage) {
    // menghapus pesan terakhir dari bot
    response.removeChild(lastBotMessage);
}

// menambahkan pesan baru dari pengguna ke div response
var userMessage = document.createElement('p');
userMessage.innerHTML = '<b>You:</b> ' + message;
userMessage.classList.add("user-message");
response.appendChild(userMessage);

// mengirim pesan ke chatbot dan menerima respons
fetch('https://node.depth-g.com?text=' + message)
.then(res => res.text())
.then(data => {
    // menambahkan pesan baru dari bot ke div response
    var botMessage = document.createElement('p');
    botMessage.innerHTML = '<b>RanauBot:</b> ' + data;
    botMessage.classList.add("bot-message");
    response.appendChild(botMessage);
    response.scrollTop = response.scrollHeight; // scroll ke bawah saat ada respons baru
    lastUserMessage = userMessage; // menyimpan pesan terakhir dari pengguna
    lastBotMessage = botMessage; // menyimpan pesan terakhir dari bot
});
return false;
}
