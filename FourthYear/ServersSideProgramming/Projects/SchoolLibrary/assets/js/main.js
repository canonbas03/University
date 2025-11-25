$(document).ready(function() {

    function showMessage(response) {
        $("#message").html(response).fadeIn(200).delay(3000).fadeOut(1000);
        $("#addBookForm")[0].reset();
        $("#borrowBookForm")[0].reset();
        $("#returnBorrowedForm")[0].reset();
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
                fetchBooks();
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
                fetchBooks();
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
                fetchBooks();
            }
        })
        
    });

    fetchBooks();
    function fetchBooks() {
    $.ajax({
        url: "api/fetch_books.php",
        type: "GET",
        success: function(response) {
                $("#allBooksTable tbody").html(response);
                 fetchBorrowedBooks();
            }
        });
    }

    function fetchBorrowedBooks(){
        $.ajax({
            url: "api/fetch_borrowed.php",
            type: "GET",
            success: function(response){
                $("#borrowedBooksTable tbody").html(response);
            }
        });
    }
});


