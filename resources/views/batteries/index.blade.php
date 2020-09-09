<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
	<style>
		.conditionNew {
			color: forestgreen;
		}
		.conditionUsed {
			color: red;
        }
	</style>
</head>

<body>
    <div class="pl-3 pr-3">
        @include('nav')
    </div>

    <div class="pl-4 pr-4">
        <div class="d-flex justify-content-between align-items-baseline">
            <div>
                <h3>Lithium Batteries</h3>
    {{--			Total batteries: {{ $count }}--}}
            </div>
            <div>
                <a href="/batteries/create">Add New Battery</a>
            </div>
        </div>

        <!-- SEARCH FORM -->
        <div class="d-flex justify-content-between align-items-baseline">
            <div class="row">
                <div class="row mb-2 ml-3 mr-3">
                    <input type="search" id="battery_data" placeholder="Search..." class="form-control">
                </div>
                <div class="btn-group" data-toggle="buttons">
                    <label class="btn btn-secondary">
                        <input type="radio" class="search_where" name="search_where" value="Serial" checked>Serial 1
                    </label>

                    <label class="btn btn-secondary">
                        <input type="radio" class="search_where" name="search_where" value="Status" >Status
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
        <p class="ml-3 mr-3" id="output">
            <div class="loader">
                <img src="loading.gif" alt="Loading..."/>
            </div>
        </p>
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

    function delay(callback, ms) {
        var timer = 0;
        return function() {
            var context = this, args = arguments;
            clearTimeout(timer);
            timer = setTimeout(function () {
                callback.apply(context, args);
            }, ms || 0);
        };
    }

    function loadData(){
        $.ajax({
            type: 'POST',
            url: "{{ route('batteries.index') }}",

            success: function($data){
                $('#output').html($data);
            },
        });
    }

    var delay = (function(){
        var timer = 0;
        return function(callback, ms){
            clearTimeout (timer);
            timer = setTimeout(callback, ms);
        };
    })();

    $(document).ready(function () {
        const loader = document.querySelector(".loader");
        var search_where = $(".search_where:checked").val();
        $('input[type="radio"]').click(function () {
            search_where = $(this).val();
        });

        $('#battery_data').keyup(function (e) {
            var search_data = $('#battery_data').val();
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: "{{ route('batteries.index') }}",
                data: { search_data: search_data,
                    search_where: search_where
                },
                success: function($data){
                    loader.className += " hidden";
                    $('#output').html($data);  
                }
            });
        });
        $('#battery_data').keyup();

        setInterval(loadData, 10000);
    });
</script>
