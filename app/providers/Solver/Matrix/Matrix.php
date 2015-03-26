<?php namespace App\Providers\Solver\Matrix;

class Matrix{
	
	/**
	 * Dimension of the matrix
	 * 
	 * @var int
	 */
	private $dimension;
	
	/**
	 * Planes for the matrix
	 * 
	 * @var array
	 */
	private $planes;
	
	public function __construct($dimension){
		$this->dimension = $dimension;
		$this->planes = array();
	}
	
	/**
	 * Set a value on x, y, and z coords
	 * 
	 * @param type $x
	 * @param type $y
	 * @param type $z
	 * @param type $value
	 */
	private function setValue($x, $y, $z, $value){
		if(!isset($this->planes[$z])) $this->planes[$z] = new Plane($this->dimension);
		$this->planes[$z]->setValue($x, $y, $value);
	}
	
	/**
	 * Sum all the planes
	 * 
	 * @param type $x1
	 * @param type $y1
	 * @param type $z1
	 * @param type $x2
	 * @param type $y2
	 * @param type $z2
	 * @return int
	 */
	private function total( $x1, $y1, $z1, $x2, $y2, $z2 ){
		$total = 0;
		for($i=$z1; $i<=$z2; $i++){
			if(isset($this->planes[$i])){
				$total += $this->planes[$i]->total($x1, $y1, $x2, $y2);
			}
		}
		return $total;
	}
	
	/**
	 * Execute an operator
	 * 
	 * @param array $operation
	 * @return string
	 */
	public function executeOperation(array $operation){
		if($operation['action']=='UPDATE'){
			$this->setValue($operation['x'], $operation['y'], $operation['z'], $operation['W']);
			return '';
		}elseif($operation['action']=='QUERY'){
			return $this->total($operation['x1'], $operation['y1'], $operation['z1'],
					$operation['x2'], $operation['y2'], $operation['z2']);
		}
	}
	
}