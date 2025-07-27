
function showPanel(panelId) {
   
    document.querySelectorAll(".panel").forEach(panel => panel.style.display = "none");

  
    document.getElementById(panelId).style.display = "block";
}


function logout() {
    window.location.href = "../server/logOutUser.php";
}


document.addEventListener("DOMContentLoaded", function () {
    showPanel('profile');
});
