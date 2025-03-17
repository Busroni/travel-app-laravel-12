$(document).ready(function() {
    function validatePassword() {
        let password = $("#password").val();
        let confirmPassword = $("#confirm_password").val();
        let passwordMessage = $("#password-length-message");
        let matchMessage = $("#password-match-message");
        let submitBtn = $("#submit-btn");

        // Cek panjang password
        if (password.length < 8) {
            passwordMessage.text("Password minimal 8 karakter!").css("color", "red");
        } else {
            passwordMessage.text("✅ Password cukup kuat").css("color", "green");
        }

        // Cek apakah password & konfirmasi cocok
        if (password !== confirmPassword) {
            matchMessage.text("Password tidak cocok!").css("color", "red");
            submitBtn.prop("disabled", true);
        } else {
            matchMessage.text("✅ Password sesuai").css("color", "green");
            submitBtn.prop("disabled", false);
        }
    }

    $("#password, #confirm_password").on("keyup", validatePassword);

    $("#registerForm").on("submit", function(event) {
        event.preventDefault();
        
        let formData = $(this).serialize();
        let registerUrl = $(this).attr("action");

        $.ajax({
            url: registerUrl,
            type: "POST",
            data: formData,
            headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },
            success: function(response) {
                console.log("Response:", response); // Debugging

                if (response.success) {
                    alert("Akun admin berhasil dibuat!");
                    window.location.href = dashboardUrl;
                } else {
                    alert("Terjadi kesalahan: " + response.message);
                }
            },
            error: function(xhr) {
                console.log("Error Response:", xhr); // Debugging
                
                let errors = xhr.responseJSON ? xhr.responseJSON.errors : null;
                let errorMessage = "Gagal mendaftar.";

                if (errors) {
                    errorMessage = "";
                    for (let key in errors) {
                        errorMessage += errors[key][0] + "\n";
                    }
                }

                alert(errorMessage);
            }
        });
    });
});
