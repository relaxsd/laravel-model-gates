<?php

namespace spec\Relaxsd\Gate;

use Mockery;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ModelGateTraitSpec extends ObjectBehavior
{
	function let()
	{
		$this->beAnInstanceOf('spec\Relaxsd\Gate\Foo');
	}

	function it_is_initializable()
	{
		$this->shouldHaveType('spec\Relaxsd\Gate\Foo');
	}

	function it_fetches_a_valid_model_gate()
	{
		Mockery::mock('FooModelGate');

		$this->gate()->shouldBeAnInstanceOf('FooModelGate');
	}

	function it_throws_up_if_invalid_model_gate_is_provided()
	{
		$this->gate = 'Invalid';

		$this->shouldThrow('Relaxsd\Gate\Exceptions\ModelGateException')->duringGate();
	}

	function it_caches_the_model_gate_for_future_use()
	{
		Mockery::mock('FooModelGate');

		$one = $this->gate();
		$two = $this->gate();

		$one->shouldBe($two);
	}
}

// We'll reproduce what the consumer of our
// package might do. This way, we can test the
// trait.
class Foo {
	use \Relaxsd\Gate\ModelGateTrait;

	public $gate = 'FooModelGate';
}


