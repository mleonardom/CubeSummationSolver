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
		$this->assertTrue($solver->solve());
		
		$input = " 1 ;";
		$solver = Solver::make($input);
		$this->assertTrue($solver->solve());
		
		$input = "1;1 2;UPDATE 1 1 1 4;QUERY 1 1 1 1 1 1";
		$solver = Solver::make($input);
		$this->assertTrue($solver->solve());
		
		$input = "2;2 2;UPDATE 1 2 1 4;QUERY 1 1 1 1 1 1;1 1;UPDATE 1 1 1 4";
		$solver = Solver::make($input);
		$this->assertTrue($solver->solve());
		
		$input = "1;1 2;UPDATE 1 1 1 -4520;QUERY 1 1 1 1 1 1";
		$solver = Solver::make($input);
		$this->assertTrue($solver->solve());
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
