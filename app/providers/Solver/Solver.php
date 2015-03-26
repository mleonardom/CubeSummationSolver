<?php namespace App\Providers\Solver;

class Solver{
	
	private $input;
	
	private $inputProcessor;
	
	public static function make($input){
		$instance = new Solver();
		$instance->input = $input;
		$instance->inputProcessor = new Input\InputProcessor($input);
		return $instance;
	}
	
	public function solve(){
		if(!$this->inputProcessor->parseInput()){
			return false;
		}
		$response = $this->executeOperations();
		return $response;
	}
	
	private function executeOperations(){
		$response = '';
		$operations = $this->inputProcessor->getOperations();
		foreach($operations as $index => $operations_group){
			$response .= $this->executeOperationsGroup($operations_group, $index);
		}
		return $response;
	}
	
	private function executeOperationsGroup($operations_group, $index){
		$response = '';
		$matrixDimension = $this->inputProcessor->getMatrixDimension($index);
		$matrix = new Matrix\Matrix($matrixDimension);
		foreach($operations_group as $operation){
			$prev_response = $matrix->executeOperation($operation);
			if($prev_response!==''){
				$response .= $prev_response.';';
			}
		}
		return $response;
	}
	
}