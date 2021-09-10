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
    <div class="container my-5">
        @if (session('sent'))
            <div class="alert flash alert-success mx-4" id="flash-msg" style="position: fixed; right: 0%; z-index: 10000"
                role="alert">
                Todo Created
            </div>
            <script>
                setTimeout(() => {
                    document.getElementById('flash-msg').style.display = 'none'
                }, 3000);
            </script>
        @endif
        <form action="/create-todo" method="post">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-8">
                    <label for="title">Title</label>
                    <input type="text" name="title" class="form-control" id="title">
                    @error('title')
                        <div class="alert mt-2 alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-md-4">
                    <label for="members">Assignee</label>
                    <select id="members" name="colaborators[]" class="form-control">
                        <option value="1">John Doe</option>
                        <option value="2">Jayne Doe</option>
                        <option value="3">John Doe 2</option>
                        <option value="4">Jayne Doe 2</option>
                        <option value="5">John Doe 3</option>
                        <option value="6">Jayne Doe 3</option>
                    </select>
                    @error('members')
                    <div class="alert mt-2 alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="title">Task</label>
                    <input type="text" name="tasks[]" class="form-control" id="title">
                </div>
                <div class="form-group col-md-6">
                    <label for="title">Task</label>
                    <input type="text" name="tasks[]" class="form-control" id="title">
                </div>
                {{-- <div class="form-group col-md-4">
                    <label for="title">Title</label>
                    <input type="text" name="title" class="form-control" id="title">
                </div> --}}
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="category">label</label>
                    <select id="category" name="labels" class="form-control">
                        <option>category 1</option>
                        <option>category 2</option>
                    </select>
                    @error('category_id')
                        <div class="alert mt-2 alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-md-4">
                    <label for="start_date">Start Date</label>
                    <input type="date" name="start_date" class="form-control" id="start_date">
                </div>
                <div class="form-group col-md-4">
                    <label for="end_date">End Date</label>
                    <input type="date" name="end_date" class="form-control" id="end_date">
                    <input type="text" name="workspace_id" value="1" class="d-none">
                    <input type="text" name="owner" value="organization" class="d-none">
                    <input type="text" name="token" value="eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJhdXRob3JpemVkIjp0cnVlLCJVc2VyIjp7ImlkIjoiNjEzOWE0MzU1OTg0MmM3NDQ0ZmIwMWVmIiwiZW1haWwiOiJvZ2lhLmFnaGFob3dhQGdtYWlsLmNvbSJ9LCJleHAiOjE2MzEyMTE1ODcsImlzcyI6ImFwaS56dXJpLmNoYXQifQ.gpzPo32pLkDyPB1Jn7bPzzDTFt5AKes-lEwE_KtciVU" class="d-none">
                    <input type="text" name="plugin_id" value="6138deac99bd9e223a37d8f5" class="d-none">
                    <input type="text" name="org" value="613a3ac959842c7444fb0240" class="d-none">
                    <input type="text" name="user" value="6139d47c59842c7444fb0200&" class="d-none">
                    @error('end_date')
                        <div class="alert mt-2 alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="address">Description</label>
                <textarea name="description" id="address" cols="30" class="form-control"></textarea>
                @error('description')
                    <div class="alert mt-2 alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group d-none">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="gridCheck">
                    <label class="form-check-label" for="gridCheck">
                        Check me out
                    </label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>

</html>
