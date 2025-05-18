// Ajouter une réaction publique
function addResponse(){
const txt = document.getElementById('otherMessage').value.trim();
if(!txt) return;
const div = document.createElement('div');
div.className = 'response-message';
div.textContent = txt;
document.getElementById('messageList').appendChild(div);
document.getElementById('otherMessage').value = '';
}
