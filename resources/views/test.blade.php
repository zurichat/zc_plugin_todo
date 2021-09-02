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
                    <select id="members" name="members[]" class="form-control">
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
                {{-- <div class="form-group col-md-4">
                    <label for="title">Title</label>
                    <input type="text" name="title" class="form-control" id="title">
                </div> --}}
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="category">Category</label>
                    <select id="category" name="category_id" class="form-control">
                        <option value="1">category 1</option>
                        <option value="2">category 2</option>
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
                    <input type="text" name="color_code" value="red" class="d-none">
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
