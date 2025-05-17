<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="/form" method="POST">
        <label for="name">
            <input type="text" name="name" placeholder="Enter your name">
        </label>
        <button type="submit">Say Hello</button>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
    </form>
</body>
</html>