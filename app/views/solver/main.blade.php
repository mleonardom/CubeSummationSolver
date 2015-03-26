@extends('layout')

@section('content')

	<div class="input-container" id="input-container"></div>
		{{ Form::open(array('url' => '#', 'id'=>'main-form')) }}
			{{ Form::label('input', 'Input:') }}
			{{ Form::text('input', Input::old('input'), array('id' => 'input-field')) }}
			{{ Form::submit('Enviar', array('class'=>'button small') ) }}
		{{ Form::close() }}
	<div class="output-container" id="output-container"></div>
@stop

@section('jquery_on_ready')
	var commands = '';
	$('#main-form').submit(function(event){
		event.preventDefault();
		var input = commands.length==0? $('#input-field').val() : commands+';'+$('#input-field').val();
		$.ajax({
			url: '{{ URL::action('SolverController@solve') }}',
			type: 'POST',
			data: 'input='+input,
			dataType: 'json',
			error: function(){
				alert("Error en respuesta del servidor");
			},
			success: function(res){
				$command_dom = $('<div></div>');
				if(res.data && res.data.input){
					$command_dom.text($('#input-field').val());
					if(res.ok){
						commands = input;
						$command_dom.addClass('success');
					}else{
						$command_dom.addClass('error');
						res.error_message = res.error_message || 'Error.';
						$command_dom.append(" - "+res.error_message);
					}
				}else{
					$command_dom.text('Error en respuesta.');
				}
				$('#input-container').append($command_dom);
			},
			complete: function(){
				$('#input-field').val('');
			}
		});
	});
@stop