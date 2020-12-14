<?php namespace Relaxsd\Gate;

use Relaxsd\Gate\Exceptions\ModelGateException;

trait ModelGateTrait {

	/**
	 * Model gate instance
	 *
	 * @var mixed
	 */
	protected $gateInstance;

	/**
	 * Prepare a new or cached model gate instance
	 *
	 * @return mixed
	 * @throws ModelGateException
	 */
	public function gate()
	{
		if ( ! $this->gate or ! class_exists($this->gate))
		{
			throw new ModelGateException('Please set the $gate property to your model gate path.');
		}

		if ( ! $this->gateInstance)
		{
			$this->gateInstance = new $this->gate($this);
		}

		return $this->gateInstance;
	}

} 
