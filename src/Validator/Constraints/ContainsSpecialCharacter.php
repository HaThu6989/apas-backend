<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 * @Target({"PROPERTY", "METHOD", "ANNOTATION"})
 *
 */
#[\Attribute(\Attribute::TARGET_PROPERTY | \Attribute::TARGET_METHOD | \Attribute::IS_REPEATABLE)]
class ContainsSpecialCharacter extends Constraint
{
    public $message = 'The string "{{ string }}" must contain at least one special character.';
    public function __construct(
        array $options = null,
        string $message = null,
        array $groups = null,
        mixed $payload = null
    ) {
        $this->message = $message ?? $this->message;
        parent::__construct($options, $groups, $payload);
    }
}
