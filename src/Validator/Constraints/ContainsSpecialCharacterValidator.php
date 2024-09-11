<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class ContainsSpecialCharacterValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint): void
    {
        if (!$constraint instanceof ContainsSpecialCharacter) {
            throw new UnexpectedTypeException($constraint, ContainsSpecialCharacter::class);
        }

        if (null === $value || '' === $value) {
            return;
        }

        if (!preg_match('/[^a-zA-Z0-9]/', $value, $matches)) {
            // there are no special characters, it's not valid
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ string }}', $value)
                ->addViolation();
        }
    }
}
