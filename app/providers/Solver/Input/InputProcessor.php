<?php namespace App\Providers\Solver\Input;

class InputProcessor{
	
	/**
	 * extracted single commands
	 * 
	 * @var array
	 */
	private $inputLines;
	
	/**
	 * number of test-cases
	 * 
	 * @var int
	 */
	private $testCases;
	
	/**
	 * N value for each operation
	 * 
	 * @var array
	 */
	private $matrixDimensions;
	
	/**
	 * Number of operations
	 * 
	 * @var int 
	 */
	private $operationsNumber;
	
	/** 
	 * Operations to execute (UPDATE or QUERY type)
	 *
	 * @var array
	 */
	private $operations;
	
	public function __construct($input){
		$this->matrixDimensions = array();
		$this->operationsNumber = array();
		$this->operations = array();
		$this->inputLines = $this->processInput($input);
	}
	
	/**
	 * 
	 * @return array
	 */
	public function getMatrixDimensions(){
		return $this->matrixDimensions;
	}
	
	/**
	 * 
	 * @return int
	 */
	public function getMatrixDimension($index){
		return $this->matrixDimensions[$index];
	}
	
	/**
	 * 
	 * @return int
	 */
	public function getOperationsNumber(){
		return $this->operationsNumber;
	}
	
	/**
	 * 
	 * @return array
	 */
	public function getOperations(){
		return $this->operations;
	}
	
	/*
	 * Extract data from input
	 */
	public function parseInput(){
		$current_operation = 0;
		$total_commands = 0;
		$n_m_type = false;
		for( $i=0; $i<count($this->inputLines); $i++ ){
			// split by spaces
			$temporal = preg_split("/[\\s]+/", $this->inputLines[$i]);
			if($i==0){
				// Type T
				if(!$this->parseTestCases($temporal)){ return false; }
				$n_m_type = true;
			}elseif($n_m_type){
				// N M type
				if($current_operation >= $this->testCases){ return false; }
				if(!$this->parseNMType($temporal, $current_operation)){ return false; }

				$total_commands += $this->operationsNumber[$current_operation]+1;

				$n_m_type = false;
			}else{
				// Operation type
				if(!$this->parseOperation($temporal, $current_operation)){ return false; }
				if($i==($total_commands)){
					$current_operation ++;
					$n_m_type = true;
				}
			}
		}
		return true;
	}
	
	/*
	 * Parse input line to T
	 */
	private function parseTestCases($array){
		// Validate 1 <= T <= 50 
		if(count($array)!=1){ return false; }
		$this->testCases = $array[0]+0;
		if($this->testCases<1 || $this->testCases>50){ return false; }
		return true;
	}
	
	/*
	 * Parse input line to N M
	 */
	private function parseNMType($array, $current_operation){
		// Validate 1 <= N <= 100 and 1 <= M <= 1000 
		if(count($array)!=2){ return false; }
		$this->matrixDimensions[$current_operation] = $array[0]+0;
		if($this->matrixDimensions[$current_operation]<1 ||
				$this->matrixDimensions[$current_operation]>100){ return false; }

		$this->operationsNumber[$current_operation] = $array[1]+0;
		if($this->operationsNumber[$current_operation]<1 ||
				$this->operationsNumber[$current_operation]>1000){ return false; }
				
		return true;
	}
	
	/*
	 * Parse input line to UPDATE or QUERY operation
	 */
	private function parseOperation($array, $current_operation){
		if($array[0]=='UPDATE') {
			// Validate 1 <= x,y,z <= N and -109 <= W <= 109
			if(count($array)!=5){ return false; }
			$operation = array(
				'action' => 'UPDATE',
				'x' => $array[1]+0,
				'y' => $array[2]+0,
				'z' => $array[3]+0,
				'W' => $array[4]+0,
			);
			if($operation['x']<1 || $operation['x']>$this->matrixDimensions[$current_operation]){ return false; }
			if($operation['y']<1 || $operation['y']>$this->matrixDimensions[$current_operation]){ return false; }
			if($operation['z']<1 || $operation['z']>$this->matrixDimensions[$current_operation]){ return false; }
			if($operation['W']<-1000000000 || $operation['W']>1000000000){ return false; }
			$this->operations[$current_operation][] = $operation;
		}elseif($array[0]=='QUERY') {
			// validate 1 <= x1 <= x2 <= N; 1 <= y1 <= y2 <= N and 1 <= z1 <= z2 <= N 
			if(count($array)!=7){ return false; }
			$operation = array(
				'action' => 'QUERY',
				'x1' => $array[1]+0,
				'y1' => $array[2]+0,
				'z1' => $array[3]+0,
				'x2' => $array[4]+0,
				'y2' => $array[5]+0,
				'z2' => $array[6]+0,
			);
			if($operation['x1']<1 ||
					$operation['x1']>$operation['x2'] ||
					$operation['x2']>$this->matrixDimensions[$current_operation]){
				return false;
			}
			if($operation['y1']<1 ||
					$operation['y1']>$operation['y2'] ||
					$operation['y2']>$this->matrixDimensions[$current_operation]){
				return false;
			}
			if($operation['z1']<1 ||
					$operation['z1']>$operation['z2'] ||
					$operation['z2']>$this->matrixDimensions[$current_operation]){
				return false;
			}
			$this->operations[$current_operation][] = $operation;
		}else{
			return false;
		}
		return true;
	}
	
	/*
	 * Extract lines from serialized input
	 */
	private function processInput($input){
		$lines = explode(";", $input);
		$lines = array_filter($lines);
		$lines = array_values($lines);
		$lines = array_map("trim", $lines);
		return $lines;
		
	}
	
}
