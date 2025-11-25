<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add book</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="assets/js/main.js"></script>

</head>
<!-- Create an HTML form with fields: title, author, year, total_copies. -->

<body>
    <div class="forms-container">
        <form id="addBookForm" method="post">
            <label for="title">Title:</label>
            <input id="title" name="title" type="text">

            <label for="author">Author:</label>
            <input id="author" name="author" type="text">

            <label for="year">Year:</label>
            <input id="year" name="year" type="number">

            <label for="total_copies">Total copies:</label>
            <input id="total_copies" name="total_copies" type="number">

            <button type="submit">Add</button>
        </form>

        <form id="borrowBookForm" method="post">
            <label for="reader">Reader:</label>
            <input id="reader" name="reader" type="text">

            <label for="book_title">Book:</label>
            <input id="book_title" name="book_title" type="text">

            <button id="borrowBtn" type="submit">Borrow</button>
        </form>

        <form id="returnBorrowedForm" method="post">
            <label for="return_reader">Reader:</label>
            <input id="return_reader" name="return_reader" type="text">

            <label for="return_book_title">Book:</label>
            <input id="return_book_title" name="return_book_title" type="text">

            <button id="returnBtn" type="submit">Return</button>
        </form>
    </div>
    <div id="message">This will dissapear</div>

    <table id="allBooksTable">
        <thead>
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Year</th>
                <th>Total Copies</th>
                <th>Available Copies</th>
            </tr>
            </head>
        <tbody>

        </tbody>
    </table>

    <table id="borrowedBooksTable">
        <thead>
            <tr>
                <th>Reader</th>
                <th>Title</th>
                <th>Date Taken</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</body>

</html>