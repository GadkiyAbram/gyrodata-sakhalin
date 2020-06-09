<html>

<head>
    <script src='http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'></script>
    <script src={{URL::asset('js/jquery.zoom.js')}}></script>
    <style>
        .zoom {
            display:inline-block;
            position: relative;
        }

        .zoom:after {
            content:'';
            display:block;
            width:33px;
            height:33px;
            position:absolute;
            top:0;
            right:0;
        }

        .zoom img::selection { background-color: transparent; }

        .zoom img {
            display: block;
        }
    </style>

</head>

<body>
<div class="pl-3 pr-3">
	@include('nav')
</div>

<div class="pl-4 pr-4">

	<div class="d-flex justify-content-between align-items-baseline">

		<div class="align-content-center pr-3">
			<div class="d-flex justify-content-between align-items-baseline">
				<a href="/tools">Go back</a>
				<h5 class="pl-2">{{ $item['Item'] }}</h5>
			</div>
		</div>
		<div>
			<a href="/tools/{{ $item['Id'] }}/edit">Edit Tool</a>
		</div>

	</div>

	<div class="row">
		<div class="col-4">
			<p><strong>Asset: </strong>{{ $item['Asset'] }}</p>
			<p><strong>Arrived: </strong>{{ $item['Arrived'] }}</p>
			<p><strong>Invoice: </strong>{{ $item['Invoice'] }}</p>
			<p><strong>Custom Decl: </strong>{{ $item['CCD'] }}</p>
			<p><strong>Description RUS: </strong>{{ $item['NameRus'] }}</p>
			<p><strong>CCD Position: </strong>{{ $item['PositionCCD'] }}</p>
			<p><strong>Tool Location: </strong>{{ $item['ItemStatus'] }}</p>
			<p><strong>Circulation: </strong>{{ $circulation }}</p>
			<p><strong>Comment: </strong>{{ $item['Comment'] }}</p>
        </div>

        <div class="col-4">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">Jobs involved</th>
                    <th scope="col">Circ Hrs</th>
                </tr>
                </thead>
                    @foreach($jobs as $job)
                	    <tbody>
                		    <tr>
                			    <td>{{ $job->JobNumber }}</td>
                                <td>{{ $job->CirculationHours }}</td>
                            </tr>
                        </tbody>
                    @endforeach
            </table>
        </div>

        <div class="col-4">
            <span class='zoom' id='zoom-on-grab'>
		    <img src="data:image/jpg|png|jpeg;base64,{{ $item['ItemImage'] }}" align="right" style="border: solid 1px" width="100%"/>
	        </span>
        </div>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	</div>
</div>
</body>
</html>

<script type="text/javascript">

    var $j = jQuery.noConflict();

    $j(document).ready(function(){
        $('#zoom-on-hover').zoom();
        $('#zoom-on-grab').zoom({ on:'grab' });
        $('#zoom-on-click').zoom({ on:'click' });
        $('#zoom-on-toggle').zoom({ on:'toggle' });
    });
</script>
