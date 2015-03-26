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
		// TODO resturn response, not a boolean
		return true;
	}
	
}