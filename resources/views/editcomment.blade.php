<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
            integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <title>Edit Comment</title>
    </head>

    <body>
        <form action="/api/update-comment/{{$comment['_id']}}" method="post">
            <input type="text" name="body" value="{{ $comment['body'] }}" />

            <input type="submit" value="update" />
            <input type="hidden" name="_method" value="put" />
        </form>
    </body>
</html>