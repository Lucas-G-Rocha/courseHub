<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>baaaah</title>
</head>

<body>

    @foreach($response as $i)

        <div>
            <hr>
            <h1>{{ $i['id'] }} - {{ $i['title'] }}</h1>

            <p>{{ $i['body'] }}</p>
            <hr>
        </div>

    @endforeach


</body>

</html>