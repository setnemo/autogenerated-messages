<?php

declare(strict_types=1);

namespace Tests\Stubs;

use Setnemo\ValidationMessages\DefaultMessages;

/**
 * Class Request
 * @package Tests\Stubs
 */
class Request
{
    use DefaultMessages;

    private array $rules;

    /**
     * @param array $rules
     */
    public function __construct(array $rules)
    {
        $this->rules = $rules;
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return $this->rules;
    }
}
