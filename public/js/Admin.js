// pour afficher l'image selectionner par l'input file
function previewImage(event) {
    var preview = document.getElementById('preview');
    preview.src = URL.createObjectURL(event.target.files[0]);
}

function previewImages(event,name) {
    const files = event.target.files;
    const previewContainer = document.getElementById(name);

    // Clear any existing previews
    previewContainer.innerHTML = '';

    for (const file of files) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const img = document.createElement('img');
            img.src = e.target.result;
            img.alt = file.name;
            img.className = 'selected-image';
            previewContainer.appendChild(img);
        };
        reader.readAsDataURL(file);
    }
}

