<?php

namespace Thunk\Verbs\Attributes;

use Attribute;
use InvalidArgumentException;
use Thunk\Verbs\Lifecycle\Hook;
use Thunk\Verbs\State;

#[Attribute(Attribute::TARGET_METHOD)]
class Apply implements HookAttribute
{
    public function __construct(
        protected string $state_type
    ) {
		if (! is_a($this->state_type, State::class, true)) {
			throw new InvalidArgumentException('You must pass state class names to the "Apply" attribute.');
		}
    }

    public function applyToHook(Hook $hook): void
    {
        $hook->states[] = $this->state_type;
    }
}
