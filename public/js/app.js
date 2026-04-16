function openModal() {
    document.getElementById("loginModal").style.display = "flex";
}

function closeModal() {
    document.getElementById("loginModal").style.display = "none";
}

document.getElementById("loginForm").addEventListener("submit", function (e) {
    e.preventDefault();

    const username = document.getElementById("username").value;
    const password = document.getElementById("password").value;
    const role = document.getElementById("role").value;

    if (!role) {
        alert("Pilih role");
        return;
    }

    if (
        role === "mahasiswa" &&
        username === "mahasiswa" &&
        password === "mahasiswa123"
    ) {
        window.location.href = "/dashboard";
    } else if (role === "tu" && username === "tu" && password === "tu123") {
        window.location.href = "/tu";
    } else {
        alert("Login gagal");
    }
});
