// Liens de partage dynamiques
const pageUrl = window.location.href;
document.getElementById('facebookBtn').href = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(pageUrl)}`;
document.getElementById('whatsappBtn').href = `https://wa.me/?text=${encodeURIComponent(pageUrl)}`;

