<!DOCTYPE html>
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
                <h3>Tools Tracking</h3>
            </div>
            <div>
                <a href="/tools/create">Add Tool</a>
            </div>

        </div>

    <!-- SEARCH FORM -->
        <div class="d-flex justify-content-between align-items-baseline">
            <div class="row">
                <div class="row mb-2 ml-3 mr-3">
                    <input type="search" id="item_data" placeholder="Search..." class="form-control">
                </div>
                <div class="btn-group" data-toggle="buttons">
                    <label class="btn btn-secondary active">
                        <input type="radio" class="search_where" name="search_where" value="Item" checked>Item
                    </label>

                    <label class="btn btn-secondary">
                        <input type="radio" class="search_where" name="search_where" value="Asset" >Asset
                    </label>

                    <label class="btn btn-secondary">
                        <input type="radio" class="search_where" name="search_where" value="CCD" >CCD
                    </label>

                    <label class="btn btn-secondary">
                        <input type="radio" class="search_where" name="search_where" value="Invoice" >Invoice
                    </label>
                </div>
            </div>

        </div>
        <p class="ml-3 mr-3" id="output"></p>


{{--    	<table class="table table-striped">--}}
{{--    		<thead>--}}
{{--    		<tr>--}}
{{--    			<th scope="col">Tool Type</th>--}}
{{--    			<th scope="col">Tool A/N</th>--}}
{{--    			<th scope="col">Arrived</th>--}}
{{--    			<th scope="col">CCD</th>--}}
{{--    			<th scope="col">Location</th>--}}
{{--    			<th scope="col">Circ Hrs</th>--}}
{{--    			<th scope="col">Comment</th>--}}
{{--    			<th scope="col">###</th>--}}
{{--    		</tr>--}}
{{--    		</thead>--}}
{{--    		@foreach($items as $item)--}}
{{--    			<tbody>--}}
{{--    			<tr>--}}
{{--    				<td>{{ $item->Item }}</td>--}}
{{--    				<td><a href="/tools/{{ $item->Id }}">{{ $item->Asset }}</a></td>--}}
{{--    				<td>{{ $item->Arrived }}</td>--}}
{{--    				<td>{{ $item->CCD }}</td>--}}
{{--    				<td>{{ $item->ItemStatus }}</td>--}}
{{--    				<td>{{ $item->Circulation }}</td>--}}
{{--    				<td>{{ $item->Comment }}</td>--}}
{{--    				<td><a href="/tools/{{ $item->Id }}/edit">Edit</a></td>--}}
{{--    			</tr>--}}
{{--    			</tbody>--}}
{{--    		@endforeach--}}
{{--    	</table>--}}
{{--        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">--}}
{{--        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>--}}
    </div>
</body>
</html>

<script type="text/javascript">
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

        $('#item_data').keyup(function (e) {
            var search_data = $('#item_data').val();
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: "{{ route('tools.index') }}",
                data: { search_data: search_data,
                    search_where: search_where
                },
                success: function($data){
                    $('#output').html($data);
                }
            });
        });
        $('#item_data').keyup();
    });
</script>
