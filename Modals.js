function openForm() {
    document.getElementById("upload").style.display = "block";
    document.getElementById("recipes").style.display = "none";
    document.getElementById("settings").style.display = "none";
    selectElement('.nav-list').classList.remove('active');
}

function closeForm() {
    document.getElementById("upload").style.display = "none";
    document.getElementById("recipes").style.display = "grid";
}

function openForm_profile() {
    document.getElementById("settings").style.display = "block";
    document.getElementById("upload").style.display = "none";
    document.getElementById("recipes").style.display = "none";
    selectElement('.nav-list').classList.remove('active');
}

function closeForm_profile() {
    document.getElementById("settings").style.display = "none";
    document.getElementById("recipes").style.display = "grid";
}

function show_delete_btn() {
    document.getElementById("delete_button").style.display = "inline-block";
    document.getElementById("delete").style.display = "none";
}