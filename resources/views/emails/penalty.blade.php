<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h2>Borrow a book</h2>
    <p>Hello {{$full_name}}, you borrow book of {{$book_name}} at {{$borrow->borrow_date}} and
        should return at {{$borrow->should_return_at}}. but return it at {{$borrow->borrow_back_date}}.
        You penalty.
    </p>
</body>
</html>
