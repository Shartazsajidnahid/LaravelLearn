<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- Styles -->


    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>

<body >
    <div class="container">
        <a href="{{ url('/add_user') }}" class="btn btn-primary my-3">Show all users</a>
        <br>
        <form action="{{ url('/store_Data') }}" method="post">
            @csrf
            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" name="name">
            </div>
            @error('name')
            <span class="text-danger"> {{ $message }} </span>
            @enderror

            <div class="form-group">
                <label>Phone</label>
                <input type="number" class="form-control" name="phone">
            </div>

            @error('phone')
            <span class="text-danger"> {{ $message }} </span>
            @enderror

            <div class="form-group">
                <label>Address</label>
                <input type="text" class="form-control" name="address">
            </div>

            @error('address')
            <span class="text-danger"> {{ $message }} </span>
            @enderror

            <br>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>

</html>
