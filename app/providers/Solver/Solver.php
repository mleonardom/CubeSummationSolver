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
		$operations = $this->inputProcessor->getOperations();
		return true;
	}
	
}