const container = document.getElementById('vote-container');
const fameList = document.getElementById('fame-list');

function renderCards() {
  container.innerHTML = '';
  window.endings.forEach((end, index) => {
    const card = document.createElement('div');
    card.className = 'card';

    card.innerHTML = `
      <a href="${end.previewUrl}" class="preview-link" style="text-decoration:none; color:inherit;">
            <img src="${end.previewFile}" alt="${end.emotion}">
            <h3>${end.title}</h3>
        </a>
      <p><em>Émotion : ${end.emotion}</em></p>
      <p><strong>La raison ? bah un ${end.category}</strong></p>
      <p>${end.description}</p>
      <button class="vote-btn" onclick="vote(${index})">Voter</button>
      <div class="votes">Votes : <span id="vote-${index}">${end.votes}</span></div>
    `;

    container.appendChild(card);
  });
}

function vote(index) {
  window.endings[index].votes++;
  document.getElementById(`vote-${index}`).textContent = window.endings[index].votes;
  updateHallOfFame();


  fetch('vote.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ id: window.endings[index].id }) 
  })
  .then(response => response.json())
  .then(data => {
    if(data.success) {
      console.log('Vote enregistré');
    } else {
      console.error('Erreur lors de l\'enregistrement du vote');
    }
  })
  .catch(err => console.error('Erreur AJAX:', err));
}


function updateHallOfFame() {
  const top = [...window.endings].sort((a, b) => b.votes - a.votes).filter(e => e.votes > 0).slice(0, 3);
  fameList.innerHTML = top.map(e => `<li><strong>${e.title}</strong> (${e.votes} votes)</li>`).join('');
}




renderCards();
updateHallOfFame();


