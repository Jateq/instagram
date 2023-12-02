document.getElementById('selectButton').addEventListener('click', function() {
    document.getElementById('fileInput').click();
});

document.getElementById('fileInput').addEventListener('change', function() {
    let fileInput = this;
    const selectButton = document.getElementById('selectButton');
    const uploadedImage = document.getElementById('userImg');
    const fileChoose = document.getElementById('fileChoose');
    let descriptionInput = document.createElement('input');


    selectButton.style.display = 'none';
    fileChoose.style.display = 'none';

    uploadedImage.src = URL.createObjectURL(fileInput.files[0]);


    // Add the description input before the submit button
    let form = document.getElementById('uploadForm');
    form.insertBefore(descriptionInput, form.childNodes[form.childNodes.length - 2]);

    // Show the submit button
    document.getElementById('mySubmit').style.display = 'block';
    document.getElementById('mySubmit').style.marginLeft = '30px'


});

document.getElementById('mySubmit').addEventListener('click', function(event) {
    let descriptionInput = document.querySelector('input[name="image_description"]');

    // Check if description is provided
    if (!descriptionInput.value.trim()) {
        alert('Please enter an image description.');
        event.preventDefault(); // Prevent form submission
    }
});
