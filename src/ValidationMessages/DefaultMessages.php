<?php

declare(strict_types=1);

namespace Setnemo\ValidationMessages;

/**
 * trait DefaultMessages
 * @package Setnemo\ValidationMessages
 */
trait DefaultMessages
{
    public array $commonRulesForOverride = [
        'required',
        'integer',
        'numeric',
        'string',
        'url',
        'in',
        'min',
        'max',
        'mimes',
    ];

    public array $defaultMessagesCommonRules = [
        'required' => ':key is required',
        'integer' => 'Value for :key must be integer',
        'numeric' => 'Key :key must be numeric',
        'string' => 'Value for :key must be string',
        'url' => 'Key :key must be valid url',
        'in' => 'Allowed values for :key: :value',
        'min' => 'Minimal value for :key is :value',
        'max' => 'Maximal value for :key is :value',
        'mimes' => 'Allowed formats for :key: :value',
    ];

    /**
     * @return array
     */
    abstract public function rules(): array;

    /**
     * @return array
     */
    public function messages(): array
    {
        $rules = $this->rules();
        $messages = [];
        foreach ($rules as $key => $keyRulesAsString) {
            $keyRules = explode('|', $keyRulesAsString);
            foreach ($keyRules as $keyRule) {
                if (in_array($keyRule, $this->getCommonRulesForOverride(), true)) {
                    $messages["{$key}.{$keyRule}"] = $this->getKeyMessage($keyRule, $key);
                    continue;
                }
                $extract = explode(':', $keyRule);
                if (isset($extract[1]) && in_array($extract[0], $this->getCommonRulesForOverride(), true)) {
                    $messages["{$key}.{$extract[0]}"] = $this->getKeyValueMessage($extract, $key);
                }
            }
        }

        return $messages;
    }

    /**
     * @return array|string[]
     */
    public function getCommonRulesForOverride(): array
    {
        return $this->commonRulesForOverride;
    }

    /**
     * @return array|string[]
     */
    public function getDefaultMessagesCommonRules(): array
    {
        return $this->defaultMessagesCommonRules;
    }

    /**
     * @param $keyRule
     * @param $key
     * @return string
     */
    protected function getKeyMessage($keyRule, $key): string
    {
        return strtr(
            $this->getDefaultMessagesCommonRules()[$keyRule] ?? 'Invalid data for :key',
            [':key' => $key]
        );
    }

    /**
     * @param array $extract
     * @param string $key
     * @return string
     */
    protected function getKeyValueMessage(array $extract = [], string $key = ''): string
    {
        if ([] == $extract) {
            return 'Invalid data for ' . $key;
        }

        return strtr(
            $this->getDefaultMessagesCommonRules()[$extract[0]] ?? 'Invalid data for :key',
            [':key' => $key, ':value' => trim(implode(', ', explode(',', $extract[1])))]
        );
    }
}
