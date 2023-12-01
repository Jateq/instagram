document.getElementById('selectButton').addEventListener('click', function() {
    document.getElementById('fileInput').click();
});

document.getElementById('fileInput').addEventListener('change', function() {
    let fileInput = this;
    const selectButton = document.getElementById('selectButton');
    const uploadIcons = document.getElementById('uploadIcons');
    const fileChoose = document.getElementById('fileChoose');
    let uploadedImage = document.getElementById('uploadedImage');
    let descriptionInput = document.createElement('input');
    descriptionInput.type = 'text-area';
    descriptionInput.name = 'image_description'; // Change the name as needed
    descriptionInput.placeholder = 'Enter image description';
    descriptionInput.id = 'uploadDesc'

    selectButton.style.display = 'none';
    uploadIcons.style.display = 'none';
    fileChoose.style.display = 'none';

    uploadedImage.src = URL.createObjectURL(fileInput.files[0]);
    uploadedImage.style.display = 'block';

    // Add the description input before the submit button
    let form = document.getElementById('uploadForm');
    form.insertBefore(descriptionInput, form.childNodes[form.childNodes.length - 2]);

    // Show the submit button
    document.getElementById('mySubmit').style.display = 'block';
});

document.getElementById('mySubmit').addEventListener('click', function(event) {
    let descriptionInput = document.querySelector('input[name="image_description"]');

    // Check if description is provided
    if (!descriptionInput.value.trim()) {
        alert('Please enter an image description.');
        event.preventDefault(); // Prevent form submission
    }
});
