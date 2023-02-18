<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap 5 Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="container-fluid p-5 bg-primary text-white text-center">
    <h1>Add Task</h1>
</div>

<div class="container mt-5">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            @if (Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
            @endif
            @if (Session::has('error'))
                <div class="alert alert-danger">
                    {{ Session::get('error') }}
                </div>
            @endif
        </div>
    </div>
    <form action="{{route('task.store')}}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Task Name*</label>
            <input type="text" name="name" class="form-control">
            <div class="form-text">Minimum length 5, Maximum length 255</div>
            @error('name')
            <div>
                {{$message}}
            </div>
            @enderror
            <label class="form-label">Priority*</label>
            <input type="number" name="priority" class="form-control">
            @error('priority')
            <div>
                {{$message}}
            </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

</body>
</html>
