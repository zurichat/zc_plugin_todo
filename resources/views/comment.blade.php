<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
            integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <title>Create Todo</title>
    </head>

    <body>
        <form action="/api/comment" method="post" class="card col-md-6 offset-md-3 p-4 mt-5">
            <div class="form-group">
                <label>Comment on Task {{$id}}</label>
                <input type="hidden" name="taskId" value="{{$id}}">
                <input type="text" class="form-control" name="content" />
            </div>
            <div class="form-group">
                <input type="submit" value="comment" class="btn btn-success" />
            </div>
        </form>
    </body>
</html>