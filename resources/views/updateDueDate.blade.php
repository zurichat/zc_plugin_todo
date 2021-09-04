<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
            integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <title>Modify Task Due Date</title>
    </head>

    <body>
        <div class="w-100 h-100 d-flex justify-content-center align-items-center">
            <form action="{{url('/api/task/modify/156787872gf78')}}" method="POST">
                @csrf
                <input type="date" name="content" required/></br>
                <button class="btn btn-success" type="submit" name="submit">Submit</button>
            </form>
        </div>
    </body>
</html>
