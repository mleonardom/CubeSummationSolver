<?php

class SolverController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function show()
	{
		return View::make('solver.main');
	}
	
	/*
	|
	| Solve an input
	|
	|	Route::get('/solve', 'SolverController@solve');
	|
	*/
	
	public function solve(){
		
		$solver = Solver::make(Input::get('input'));
		$data = array(
			'input' => Input::get('input')
		);
		$response = $solver->solve();
		if($response!==false){
			$data['output'] = $response;
			return parent::jsonResponse($data);
		}else{
			return parent::jsonError('Parámetro inválido', 200, $data);
		}
		
	}

}
