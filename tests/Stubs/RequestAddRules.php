<?php

declare(strict_types=1);

namespace Tests\Stubs;

use Setnemo\ValidationMessages\DefaultMessages;

/**
 * Class RequestAddRules
 * @package Tests\Stubs
 */
class RequestAddRules
{
    use DefaultMessages;

    private array $rules;

    /**
     * @param array $rules
     */
    public function __construct(array $rules)
    {
        $this->rules = $rules;
        $this->addRuleNames(['test_rule']);
        $this->addRulesToMessages(['test_rule' => 'test_message']);
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return $this->rules;
    }
}
