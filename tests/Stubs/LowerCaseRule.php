<?php

declare(strict_types=1);

namespace Tests\Stubs;

/**
 * Class LowerCaseRule
 * @package Tests\Stubs
 */
class LowerCaseRule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return ctype_lower($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string|array
     */
    public function message()
    {
        return 'The :attribute must be in lowercase.';
    }
}
