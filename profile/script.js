function showPopup() {
    var overlay = document.getElementById("overlay");
    var popup = document.getElementById("popup");
    
    overlay.style.display = "block";
    popup.style.display = "block";
            
    setTimeout(function() {
        overlay.style.opacity = "1";
        popup.style.opacity = "1";
    }, 50);
}
            
function hidePopup() {
    var overlay = document.getElementById("overlay");
    var popup = document.getElementById("popup");
          
    overlay.style.opacity = "0";
    popup.style.opacity = "0";
            
    setTimeout(function() {
    overlay.style.display = "none";
    popup.style.display = "none";
    }, 300);
}

function showFollowers() {
    document.getElementById('followersPopup').style.display = 'block';
    document.getElementById('overlay').style.display = 'block';
}
function showFollowing() {
    document.getElementById('followingPopup').style.display = 'block';
    document.getElementById('overlay').style.display = 'block';
}
function hidePopup() {
    document.getElementById('followersPopup').style.display = 'none';
    document.getElementById('followingPopup').style.display = 'none';
    document.getElementById('overlay').style.display = 'none';
}


