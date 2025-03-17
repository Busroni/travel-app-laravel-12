document.addEventListener("DOMContentLoaded", function () {
    let logoutButton = document.querySelector("#logout-btn"); // Sesuaikan dengan ID tombol logout

    if (logoutButton) {
        logoutButton.addEventListener("click", function (event) {
            event.preventDefault(); // Hindari reload sebelum logout selesai

            fetch("/logout", {
                method: "POST",
                headers: {
                    "Accept": "application/json",
                    "Authorization": "Bearer " + localStorage.getItem("auth_token"),
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => {
                if (response.ok) {
                    localStorage.removeItem("auth_token"); 
                    localStorage.removeItem("role");     
                    window.location.href = "/";      
                } else {
                    alert("Logout gagal!");
                }
            })
            .catch(error => {
                console.error("Error saat logout:", error);
                alert("Terjadi kesalahan saat logout.");
            });
        });
    }
});
