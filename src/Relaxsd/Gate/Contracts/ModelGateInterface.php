<?php namespace Relaxsd\Gate\Contracts;

interface ModelGateInterface {

	/**
	 * Prepare a new or cached model gate instance
	 *
	 * @return mixed
	 */
	public function gate();

} 
