<!DOCTYPE html>
<html>
	<head>
		<meta name="description" content="Just a Cube Summation Solver" />
		<meta name="author" content="Leonardo Méndez Aguilar" />
		
		<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/flick/jquery-ui.css">
		{{ HTML::style('foundation/css/foundation.min.css') }}
		{{ HTML::style('css/global.css') }}
		@yield('css')
		
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>		
		<script src="http://connect.facebook.net/es_ES/all.js"></script>
		{{ HTML::script('foundation/js/modernizr.js') }}
		
		<script type="text/javascript">
			var _base_url = '{{ URL::to('/'); }}';
		</script>
		
		@yield('javascript')
		
		<title>Cube Summation Solver</title>
		
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	</head>
	<body>
		<div class="off-canvas-wrap" id="wrapper">
			<div class="inner-wrap">
				<header>
					{{ View::make('partials.header') }}
				</header>
				<section role="main">
					<div class="row">
						<div class="large-12 columns main-content">
							@yield('content')
						</div>
					</div>
				</section>
				<footer>
					<div class="row" id="footer">
						<div class="large-12">
							{{ View::make('partials.footer') }}
						</div>
					</div>
				</footer>
			</div>
		</div>
		{{ HTML::script('foundation/js/foundation.min.js') }}
		<script>
			$(document).foundation();
			$(document).ready(function(){
				@yield('jquery_on_ready')
			});
		</script>
	</body>
</html>