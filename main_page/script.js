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




function toggleDropdown() {
    var dropdown = document.querySelector('.dropdown');
    dropdown.classList.toggle('open');
}

// Close the dropdown when clicking outside of it
window.onclick = function(event) {
    if (!event.target.matches('#more')) {
        var dropdowns = document.getElementsByClassName("dropdown");
        for (var i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('open')) {
                openDropdown.classList.remove('open');
            }
        }
    }
}

function likePost(button) {
    var postId = button.getAttribute('data-post-id');

    // Check if the button has a certain class to determine the current state
    var isLiked = button.getAttribute('data-liked') === 'true';

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'like_handler.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            if (isLiked) {
                button.classList.remove('liked');
            } else {
                button.classList.add('liked');
            }
        }
    };

    // Send the appropriate action based on the current state
    var action = isLiked ? 'unlike' : 'like';
    xhr.send('action=' + action + '&post_id=' + postId);
}


document.addEventListener('DOMContentLoaded', function () {
    const commentInput = document.getElementById('comment');
    const addCommentForm = document.getElementById('addCommentForm');

    commentInput.addEventListener('keydown', function (event) {
        // Check if the pressed key is "Enter"
        if (event.key === 'Enter') {
            event.preventDefault();

            addCommentForm.submit();
        }
    });
});