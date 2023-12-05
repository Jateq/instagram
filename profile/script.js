function showPopup() {
    var overlay = document.getElementById("overlay");
    var popup = document.getElementById("popup");

    overlay.style.display = "block";
    popup.style.display = "block";

    setTimeout(function () {
        overlay.style.opacity = "1";
        popup.style.opacity = "1";
    }, 50);
}

function hidePopup() {
    var overlay = document.getElementById("overlay");
    var popup = document.getElementById("popup");

    overlay.style.opacity = "0";
    popup.style.opacity = "0";

    setTimeout(function () {
        overlay.style.display = "none";
        popup.style.display = "none";
    }, 300);
}

// Добавляем функцию для возврата на главную страницу при клике на overlay
function returnToHomePage() {
    window.location.href = window.location.href;
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

$(document).ready(function() {
    var urlParams = new URLSearchParams(window.location.search);
    var activeTab = urlParams.get('activeTab');

    // Если параметр activeTab равен "saved", делаем вкладку "Saved" активной
    if (activeTab === 'saved') {
      $(".tab-item.saved").addClass("active");
    }
});
