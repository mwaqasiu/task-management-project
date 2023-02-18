<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap 5 Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.css"/>
    <link rel="stylesheet" type="text/css"
          href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
</head>
<body>

<div class="container-fluid p-5 bg-primary text-white text-center">
    <h1>Task Management Test</h1>
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
    <div class="row">
        <div class="col-md-3">
            <a href="{{route('task.create')}}" class="btn btn-primary">Add Task</a>
        </div>
    </div>
    <table id="table" class="table">
        <thead>
        <tr>
            <th scope="col">Priority</th>
            <th scope="col">Task Id</th>
            <th scope="col">Task Name</th>
            <th scope="col">Created At</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody id="tablecontents">
        @foreach($tasks as $task)
            <tr class="row1" data-id="{{ $task->id }}">
                <td class="pl-3"><i class="fa fa-sort"></i></td>
                <td>{{$task->id}}</td>
                <td>{{$task->name}}</td>
                <td>{{$task->created_at->diffForHumans()}}</td>
                <td>
                    <a href="{{route('task.edit', $task->id)}}" class="btn btn-primary">Edit</a>
                    <a href="{{route('task.destroy', $task->id)}}" class="btn btn-danger">Delete</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.js"></script>

<script type="text/javascript">
    $(function () {
        $("#table").DataTable();

        $("#tablecontents").sortable({
            items: "tr",
            cursor: 'move',
            opacity: 0.6,
            update: function () {
                sendOrderToServer();
            }
        });

        function sendOrderToServer() {
            var order = [];
            var token = $('meta[name="csrf-token"]').attr('content');
            $('tr.row1').each(function (index, element) {
                order.push({
                    id: $(this).attr('data-id'),
                    position: index + 1
                });
            });

            $.ajax({
                type: "POST",
                dataType: "json",
                url: "{{ url('task/sortable') }}",
                data: {
                    order: order,
                    _token: token
                },
                success: function (response) {
                    if (response.status == "success") {
                        console.log(response);
                    } else {
                        console.log(response);
                    }
                }
            });
        }

    });
</script>

</body>
</html>
