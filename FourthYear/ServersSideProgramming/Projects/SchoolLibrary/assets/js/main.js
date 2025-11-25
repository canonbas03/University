$(document).ready(function() {

    function showMessage(response) {
        $("#message").html(response).fadeIn(200).delay(3000).fadeOut(1000);
        $("#addBookForm")[0].reset();
        $("#borrowBookForm")[0].reset();
        $("returnBorrowedForm")[0].reset();
    }

    $("#addBookForm").submit(function(e) {
        e.preventDefault(); 

        let formData = {
            title: $("#title").val(),
            author: $("#author").val(),
            year: $("#year").val(),
            total_copies: $("#total_copies").val()
        };

        $.ajax({
            url: "api/add_book.php",
            type: "POST",
            data: formData,
            success: function(response) {
                showMessage(response);
            }
        });
    });

    $("#borrowBookForm").on("submit", function(e) {
        e.preventDefault();

        let formData = {
            reader: $("#reader").val(),
            book_title: $("#book_title").val()
        }

        $.ajax({
            url: "api/borrow_book.php",
            type: "POST",
            data: formData,
            success: function(response){
                showMessage(response);
            }

        })

    });

    $("#returnBorrowedForm").on("submit", function(e){
        e.preventDefault();

        let formData = {
            reader: $("#return_reader").val(),
            book_title: $("#return_book_title").val()
        }

        $.ajax({
            url: "api/return_book.php",
            type: "POST",
            data: formData,
            success: function(response){
                showMessage(response);
            }
        })
    });

});


