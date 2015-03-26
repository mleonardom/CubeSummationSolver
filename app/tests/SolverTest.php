<?php

class SolverTest extends TestCase {

	/**
	 * Test with valid input.
	 *
	 * @return void
	 */
	public function testValidData()
	{
		$input = "1";
		$solver = Solver::make($input);
		$this->assertEquals('', $solver->solve());
		
		$input = " 1 ;";
		$solver = Solver::make($input);
		$this->assertEquals('', $solver->solve());
		
		$input = "1;1 2;UPDATE 1 1 1 4;QUERY 1 1 1 1 1 1";
		$solver = Solver::make($input);
		$this->assertEquals('4;', $solver->solve());
		
		$input = "100;2 2;UPDATE 1 2 1 4";
		$solver = Solver::make($input);
		$this->assertEquals('', $solver->solve());
		
		$input = "2;2 2;UPDATE 1 2 1 4;QUERY 1 1 1 1 1 1;1 1";
		$solver = Solver::make($input);
		$this->assertEquals('0;', $solver->solve());
		
		$input = "1;100 3;UPDATE 1 1 1 -4520;UPDATE 1 2 1 -5;QUERY 1 1 1 2 1 1";
		$solver = Solver::make($input);
		$this->assertEquals('-4520;', $solver->solve());
		
		$input = "1;100 3;UPDATE 1 1 1 -4520;UPDATE 1 2 1 -5;QUERY 1 1 1 1 2 1";
		$solver = Solver::make($input);
		$this->assertEquals('-4525;', $solver->solve());
		
		$input = "1;100 6;UPDATE 1 1 1 99999999;UPDATE 1 99 1 99999999;UPDATE 1 1 100 99999999;QUERY 1 1 1 100 100 100";
		$solver = Solver::make($input);
		$this->assertEquals('299999997;', $solver->solve());
		
		$input = "2;2 2;UPDATE 1 2 1 4;QUERY 1 1 1 1 1 1;85 3;QUERY 1 1 1 85 85 85;UPDATE 1 10 1 99999999;QUERY 1 1 1 20 20 20";
		$solver = Solver::make($input);
		$this->assertEquals('0;0;99999999;', $solver->solve());
	}
	
	/**
	 * Test with invalid input.
	 *
	 * @return void
	 */
	public function testInvalidData()
	{
		$input = "1 2";
		$solver = Solver::make($input);
		$this->assertEquals(false, $solver->solve());
		
		$input = "1;UPDATE 1 1 1 4";
		$solver = Solver::make($input);
		$this->assertEquals(false, $solver->solve());
		
		$input = "1;1 2;UPDATE 1 2 1 4;QUERY 1 1 1 1 1 1";
		$solver = Solver::make($input);
		$this->assertEquals(false, $solver->solve());
		
		$input = "1;1 2;UPDATE 1 1 1 4;QUERY 1 2 1 1 1 1";
		$solver = Solver::make($input);
		$this->assertEquals(false, $solver->solve());
		
		$input = "1;1 2;UPDATE 1 1 1 -4000000000;QUERY 1 1 1 1 1 1";
		$solver = Solver::make($input);
		$this->assertEquals(false, $solver->solve());
		
		$input = "1;4 2;UPDATE 1 1 1 4;QUERY 1 3 1 1 1 1";
		$solver = Solver::make($input);
		$this->assertEquals(false, $solver->solve());
		
		$input = "1;4 2;UPDATE 1 1 1 4;QUERY 1 1 1 6 1 1";
		$solver = Solver::make($input);
		$this->assertEquals(false, $solver->solve());
		
		$input = "2;2 2;UPDATE 1 2 1 4;QUERY 1 1 1 1 1 1;1 1;UPDATE 1 1 1 4;3 4;UPDATE 1 1 1 4";
		$solver = Solver::make($input);
		$this->assertEquals(false, $solver->solve());
	}

}
