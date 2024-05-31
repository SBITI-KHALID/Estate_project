// pour changer la couleur d'icon du coueur apres chaque click
function changeHeartColor(icon) {
    // Vérifie la couleur actuelle de l'icône
    let currentColor = icon.style.color;

    // Si la couleur actuelle est noire, change-la en rouge, sinon change-la en noir
    if (currentColor === 'black' || currentColor === '') {
        icon.style.color = 'red';
    } else {
        icon.style.color = 'black';
    }
}
