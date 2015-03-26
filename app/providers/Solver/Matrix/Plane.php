<?php namespace App\Providers\Solver\Matrix;

class Plane{
	
	/**
	 * Dimension of the Plane
	 * 
	 * @var int
	 */
	private $dimension;
	
	/**
	 * Values for the Plane
	 * 
	 * @var array
	 */
	private $values;
	
	public function __construct($dimension){
		$this->dimension = $dimension;
		$this->values = array();
	}
	
	/**
	 * Set a value on x and y coords
	 * 
	 * @param type $x
	 * @param type $y
	 * @param type $value
	 */
	public function setValue($x, $y, $value){
		if(!isset($this->values[$x])) $this->values[$x] = array();
		$this->values[$x][$y] = $value;
	}
	
	/**
	 * Sum a line
	 * 
	 * @param type $y1
	 * @param type $y2
	 * @param type $array
	 * @return type
	 */
	private function totalLine($y1, $y2, $array){
		$total = 0;
		for($i=$y1; $i<=$y2; $i++){
			if(isset($array[$i])){
				$total += $array[$i];
			}
		}
		return $total;
	}
	
	/**
	 * Sum all the plane
	 * 
	 * @param type $x1
	 * @param type $y1
	 * @param type $x2
	 * @param type $y2
	 * @return type
	 */
	public function total($x1, $y1, $x2, $y2){
		$total = 0;
		for($i=$x1; $i<=$x2; $i++){
			if(isset($this->values[$i])){
				$total += $this->totalLine($y1, $y2, $this->values[$i]);
			}
		}
		return $total;
	}
	
}