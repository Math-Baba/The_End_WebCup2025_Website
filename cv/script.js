function enregistrer() {
    const data = {
        nom: document.getElementById('nom').innerText,
        punchline: document.getElementById('punchline').innerText,
        message: document.getElementById('message').innerText,
        profil: document.getElementById('profil').innerText,
        competences: document.getElementById('competences').innerText,
        humeur: document.getElementById('humeur_select').value,
        experience: document.getElementById('experience').innerText,
        non_regret: document.getElementById('non_regret').innerText,
        regret: document.getElementById('regret').innerText,
        anecdote: document.getElementById('anecdote').innerText
    };

    // Vérifie si au moins un champ a été modifié par rapport au texte initial
    const isModified = Object.values(data).some(val => val && val.trim() !== '');

    if (!isModified) {
        alert("Aucune modification détectée.");
        return;
    }

    // Crée un formulaire temporaire pour POST vers previewTemp.php
    const form = document.createElement("form");
    form.method = "POST";
    form.action = "previewTemp.php";
    form.target = "cvPreviewWindow";

    for (let key in data) {
        const input = document.createElement("input");
        input.type = "hidden";
        input.name = key;
        input.value = data[key];
        form.appendChild(input);
    }

    document.body.appendChild(form);

    window.open('', 'cvPreviewWindow', 'width=900,height=700');
    form.submit();
    form.remove();
}
