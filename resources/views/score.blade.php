<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Laravel</title>
</head>

<body>
    <form id="scoreForm" action="{{ route('submitScore') }}" method="post">
        @csrf
        <label for="score">Enter Score:</label>
        <input type="number" name="score" id="score" required>
        <button type="submit">Submit</button>
    </form>
</body>

</html>
