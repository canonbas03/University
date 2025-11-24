$(document).ready(function () {
    $("#regBtn").on("click", function () {
        $.post("api/register.php",
            {
                username: $("#regUser").val(),
                email: $("#regEmail").val(),
                password: $("#regPass").val(),
                password_repeat: $("#regRepeat").val(),
                recaptcha: grecaptcha.getResponse()
            },
            function (response) {
                let data = JSON.parse(response);
                if (data.status == 'error')
                    Swal.fire("Грешка", data.message, "error");
                else if (data.status == 'success')
                    Swal.fire("", data.message, "success").then(() => { location.href = "login.php" });
            }
        )
    })

    $("#loginBtn").on("click", function () {
        $.post("api/login.php",
            {
                usernameOrEmail: $("#loginUser").val(),
                password: $("#loginPass").val(),
                remember: $("#remember").is(":checked") ? 1 : 0,
                recaptcha: grecaptcha.getResponse()
            },
            function (response) {
                let data = JSON.parse(response);
                if (data.status == 'error')
                    Swal.fire("Грешка", data.message, "error");
                else if (data.status == 'success')
                    Swal.fire("", data.message, "success").then(() => { location.href = "index.php" });
            }
        )
    })

    $("#logoutBtn").on("click", function () {
        $.post("api/logout.php",
            function (response) {
                let data = JSON.parse(response);
                if (data.status == 'success')
                    location.href = "login.php";
            }
        )
    })

    $("#uploadForm").submit(function (e) {
        e.preventDefault();
        let formData = new FormData(this);
        $.ajax({
            url: "api/upload.php",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                let data = JSON.parse(response);
                if (data.status == "success") {
                    Swal.fire("", data.message, "success");
                    loadPhotos();
                }
                else {
                    Swal.fire("Грешка", data.message, "error");
                }
                $("#uploadForm")[0].reset();
            }
        })
    })
    

    $(document).on("click", ".like-btn", function () {
    let btn = $(this);
    let photoId = btn.data("id");

    $.post("api/like.php", { photo_id: photoId }, function (response) {
        let data = JSON.parse(response);

        if (data.success) {
            let likes = data.likes;

            if (data.liked) {
                btn.html("❤️ <span class='likes-count'>" + likes + "</span>");
            } else {
                btn.html("🤍 <span class='likes-count'>" + likes + "</span>");
            }
        } else {
            console.log("Error:", data.message);
        }
    });
});

// Edit
$(document).on("click", ".edit-btn", function() {
    let btn = $(this);
    let photoId = btn.data("id");
    let descEl = $(".photo-desc[data-id='" + photoId + "']");
    let currentDesc = btn.data("desc"); // still from button

    Swal.fire({
        title: 'Редактирай описание',
        input: 'text',
        inputValue: currentDesc,
        showCancelButton: true,
        confirmButtonText: 'Запази',
        cancelButtonText: 'Откажи'
    }).then((result) => {
        if(result.isConfirmed){
            $.post("api/edit.php", { photo_id: photoId, description: result.value }, function(response){
                let data = JSON.parse(response);
                if(data.success){
                    btn.data("desc", data.description); // update button

                    let descEl = $(".photo-desc[data-id='" + photoId + "']");
                    let username = descEl.find("b").text(); 
                    descEl.html("<b>" + username + "</b>: " + data.description); // use data.description

                    Swal.fire("Успех", "Описание актуализирано", "success");
                } else {
                    Swal.fire("Грешка", data.message, "error");
                }
            });
        }
    });
});

// Delete
$(document).on("click", ".delete-btn", function() {
    let btn = $(this);
    let photoId = btn.data("id");

    Swal.fire({
        title: 'Сигурни ли сте?',
        text: "Тази снимка ще бъде изтрита завинаги!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Да, изтрий',
        cancelButtonText: 'Откажи'
    }).then((result) => {
        if(result.isConfirmed){
            $.post("api/delete.php", { photo_id: photoId }, function(response){
                let data = JSON.parse(response);
                if(data.success){
                    // Remove the photo card by data-id
                    $(".photo-card[data-id='" + photoId + "']").remove();

                    Swal.fire("Изтрито!", "Снимката беше успешно изтрита.", "success");
                } else {
                    Swal.fire("Грешка", data.message, "error");
                }
            });
        }
    });
});




loadPhotos();
    function loadPhotos() {
        $("#gallery").load("api/load_photos.php");
    }

})