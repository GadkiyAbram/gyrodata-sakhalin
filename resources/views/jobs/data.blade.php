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
            <th scope="col">Job Number</th>
            <th scope="col">Client</th>
            <th scope="col">Tool</th>
            <th scope="col">Modem</th>
            <th scope="col">BBP</th>
            <th scope="col">Battery</th>
            <th scope="col">Engineer 1</th>
            <th scope="col">Engineer 2</th>
            <th scope="col">Circ Hrs</th>
            <th scope="col">Container</th>
            <th scope="col">Comment</th>
            <th scope="col">###</th>
        </tr>
        </thead>
        @foreach($jobs as $job)
            <tbody>
            <tr>
                <th scope="row"><a href="/jobs/{{ $job->JobNumber }}">{{ $job->JobNumber }}</a></th>
                <td>{{ $job->ClientName }}</td>
                <td>{{ $job->GDP }}</td>
                <td>{{ $job->Modem }}</td>
                <td>{{ $job->Bullplug }}</td>
                <td>{{ $job->Battery }}</td>
                <td>{{ $job->EngineerOne }}</td>
                <td>{{ $job->EngineerTwo }}</td>
                <td>{{ $job->CirculationHours }}</td>
                <td>{{ $job->Container }}</td>
                <td>{{ $job->Comment }}</td>
                <td><a href="/jobs/{{ $job->JobNumber }}/edit">Edit</a></td>
            </tr>
            </tbody>
        @endforeach
    </table>
</div>
</body>
</html>
