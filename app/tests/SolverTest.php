<?php

class SolverTest extends TestCase {

	/**
	 * A simple SolverServiceProvider test.
	 *
	 * @return void
	 */
	public function testBasic()
	{
		$input = "Boring text";
		$this->assertEquals("$input now is very cool :)", Solver::doSomethingCool($input));
	}

}
