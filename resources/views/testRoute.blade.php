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
    <div class="alert flash alert-success mx-4" id="flash-msg" style="position: fixed; right: 0%; z-index: 10000"
                role="alert">
                Todo edit route
            </div>
        <form action="/edit" method="post">  
            @csrf          
            <button type="submit" class="btn btn-primary">edit todo </button>
        </form>

<div class="alert flash alert-success mx-4" id="flash-msg" style="position: fixed; right: 0%; z-index: 10000"
        role="alert">
        create todo route
    </div>
<form action="create-todo" method="post">    
    @csrf
    <button type="submit" class="btn btn-primary">create todo </button>
</form>

<div class="alert flash alert-success mx-4" id="flash-msg" style="position: fixed; right: 0%; z-index: 10000"
        role="alert">
        edit todo route
    </div>
<form action="update" method="post">    
    @csrf
    <button type="submit" class="btn btn-primary">update todo </button>
</form>
    
</body>

</html>
