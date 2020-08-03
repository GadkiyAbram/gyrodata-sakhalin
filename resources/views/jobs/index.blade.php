<html>

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
</head>

<body>
<div class="pl-3 pr-3">
	@include('nav')
</div>

<div class="pl-4 pr-4">
	<div class="d-flex justify-content-between align-items-baseline">
		<div>
			<h3>Job Tracking</h3>
		</div>
		<div>
			<a href="/jobs/create">Add New Job</a>
		</div>
	</div>

    <!-- SEARCH FORM -->
    <div class="d-flex justify-content-between align-items-baseline">
        <div class="row">
            <div class="row mb-2 ml-3 mr-3">
                <input type="search" id="job_data" placeholder="Search..." class="form-control">
            </div>
            <div class="btn-group" data-toggle="buttons">
                <label class="btn btn-secondary">
                    <input type="radio" class="search_where" name="search_where" value="Job Number" checked>Job Number
                </label>

                <label class="btn btn-secondary">
                    <input type="radio" class="search_where" name="search_where" value="GDP Sections" >GDP Sections
                </label>

                <label class="btn btn-secondary">
                    <input type="radio" class="search_where" name="search_where" value="Modem" >Modem
                </label>

                <label class="btn btn-secondary">
                    <input type="radio" class="search_where" name="search_where" value="Bullplug" >Bullplug
                </label>

                <label class="btn btn-secondary">
                    <input type="radio" class="search_where" name="search_where" value="Battery" >Battery
                </label>
            </div>
        </div>
    </div>
    <p class="ml-3 mr-3" id="output"></p>
</div>
</body>
</html>

<script type="text/javascript">
    // TODO - add periodical data refresh to batteries
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).ready(function () {
        var search_where = $(".search_where:checked").val();
        $('input[type="radio"]').click(function () {
            search_where = $(this).val();
        });

        $('#job_data').keyup(function (e) {
            var search_data = $('#job_data').val();
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: "{{ route('jobs.index') }}",
                data: { search_data: search_data,
                    search_where: search_where
                },
                success: function($data){
                    $('#output').html($data);
                }
            });
        });
        $('#job_data').keyup();
    });
</script>
