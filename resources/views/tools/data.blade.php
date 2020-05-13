<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>
<body>
<div class="row">
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Tool Type</th>
            <th scope="col">Tool A/N</th>
            <th scope="col">Arrived</th>
            <th scope="col">CCD</th>
            <th scope="col">Invoice</th>
            <th scope="col">Location</th>
            <th scope="col">Circ Hrs</th>
            <th scope="col">Comment</th>
            <th scope="col">###</th>
        </tr>
        </thead>
        @foreach($items as $item)
            <tbody>
            <tr>
                <td>{{ $item->Item }}</td>
                <td><a href="/tools/{{ $item->Id }}">{{ $item->Asset }}</a></td>
                <td>{{ $item->Arrived }}</td>
                <td>{{ $item->CCD }}</td>
                <td>{{ $item->Invoice }}</td>
                <td>{{ $item->ItemStatus }}</td>
                <td>{{ $item->Circulation }}</td>
                <td>{{ $item->Comment }}</td>
                <td><a href="/tools/{{ $item->Id }}/edit">Edit</a></td>
            </tr>
            </tbody>
        @endforeach
    </table>
</div>
</body>
</html>
