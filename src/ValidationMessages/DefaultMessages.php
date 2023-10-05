<?php

declare(strict_types=1);

namespace Setnemo\ValidationMessages;

use ReflectionClass;
use ReflectionException;

/**
 * trait DefaultMessages
 * @package Setnemo\ValidationMessages
 */
trait DefaultMessages
{
    public array $ruleNames = [
        ValidationConstant::RULE_REQUIRED,
        ValidationConstant::RULE_INTEGER,
        ValidationConstant::RULE_NUMERIC,
        ValidationConstant::RULE_STRING,
        ValidationConstant::RULE_URL,
        ValidationConstant::RULE_IN,
        ValidationConstant::RULE_NOT_IN,
        ValidationConstant::RULE_MIN,
        ValidationConstant::RULE_MAX,
        ValidationConstant::RULE_MIMES,
        ValidationConstant::RULE_LOWERCASE,
        ValidationConstant::RULE_EMAIL,
        ValidationConstant::RULE_UNIQUE,
        ValidationConstant::RULE_JSON,
        ValidationConstant::RULE_IMAGE,
        ValidationConstant::RULE_ACCEPTED,
        ValidationConstant::RULE_ARRAY,
        ValidationConstant::RULE_BOOLEAN,
        ValidationConstant::RULE_REGEX,
        ValidationConstant::RULE_EXISTS,
        ValidationConstant::RULE_UUID,
        ValidationConstant::RULE_AFTER,
        ValidationConstant::RULE_IP,
        ValidationConstant::RULE_IPV4,
        ValidationConstant::RULE_IPV6,
        ValidationConstant::RULE_MAC_ADDRESS,
        ValidationConstant::RULE_STARTS_WITH,
        ValidationConstant::RULE_ENDS_WITH,
    ];

    public array $addRules = [

    ];

    public array $rulesToMessages = [
        ValidationConstant::RULE_REQUIRED => ValidationConstant::MESSAGE_KEY_IS_REQUIRED,
        ValidationConstant::RULE_INTEGER => ValidationConstant::MESSAGE_VALUE_FOR_KEY_MUST_BE_INTEGER,
        ValidationConstant::RULE_NUMERIC => ValidationConstant::MESSAGE_KEY_KEY_MUST_BE_NUMERIC,
        ValidationConstant::RULE_STRING => ValidationConstant::MESSAGE_VALUE_FOR_KEY_MUST_BE_STRING,
        ValidationConstant::RULE_URL => ValidationConstant::MESSAGE_KEY_KEY_MUST_BE_VALID_URL,
        ValidationConstant::RULE_IN => ValidationConstant::MESSAGE_ALLOWED_VALUES_FOR_KEY_VALUE,
        ValidationConstant::RULE_NOT_IN => ValidationConstant::MESSAGE_SELECTED_VALUE_IS_INVALID,
        ValidationConstant::RULE_MIN => ValidationConstant::MESSAGE_MINIMAL_VALUE_FOR_KEY_IS_VALUE,
        ValidationConstant::RULE_MAX => ValidationConstant::MESSAGE_MAXIMAL_VALUE_FOR_KEY_IS_VALUE,
        ValidationConstant::RULE_MIMES => ValidationConstant::MESSAGE_ALLOWED_FORMATS_FOR_KEY_VALUE,
        ValidationConstant::RULE_EMAIL => ValidationConstant::MESSAGE_KEY_IS_EMAIL,
        ValidationConstant::RULE_UNIQUE => ValidationConstant::MESSAGE_KEY_UNIQUE,
        ValidationConstant::RULE_JSON => ValidationConstant::MESSAGE_KEY_JSON,
        ValidationConstant::RULE_IMAGE => ValidationConstant::MESSAGE_KEY_IMAGE,
        ValidationConstant::RULE_ACCEPTED => ValidationConstant::MESSAGE_KEY_ACCEPTED,
        ValidationConstant::RULE_ARRAY => ValidationConstant::MESSAGE_KEY_ARRAY,
        ValidationConstant::RULE_BOOLEAN => ValidationConstant::MESSAGE_KEY_BOOLEAN,
        ValidationConstant::RULE_REGEX => ValidationConstant::MESSAGE_KEY_REGEX,
        ValidationConstant::RULE_EXISTS => ValidationConstant::MESSAGE_KEY_EXISTS,
        ValidationConstant::RULE_UUID => ValidationConstant::MESSAGE_KEY_UUID,
        ValidationConstant::RULE_AFTER => ValidationConstant::MESSAGE_KEY_AFTER,
        ValidationConstant::RULE_IP => ValidationConstant::MESSAGE_KEY_IP,
        ValidationConstant::RULE_IPV4 => ValidationConstant::MESSAGE_KEY_IPV4,
        ValidationConstant::RULE_IPV6 => ValidationConstant::MESSAGE_KEY_IPV6,
        ValidationConstant::RULE_MAC_ADDRESS => ValidationConstant::MESSAGE_KEY_MAC,
        ValidationConstant::RULE_STARTS_WITH => ValidationConstant::MESSAGE_KEY_STARTS_WITH,
        ValidationConstant::RULE_ENDS_WITH => ValidationConstant::MESSAGE_KEY_ENDS_WITH,
    ];

    public array $addRulesToMessages = [

    ];

    /**
     * @return array
     */
    abstract public function rules(): array;

    /**
     * @return array
     * @throws ReflectionException
     */
    public function messages(): array
    {
        $messages = [];

        foreach ($this->rules() as $key => $keyRules) {
            if (is_string($keyRules)) {
                $keyRules = explode(ValidationConstant::PIPELINE, $keyRules);
            }
            foreach ($keyRules as $keyRule) {
                if (is_object($keyRule)) {
                    $className = (new ReflectionClass($keyRule))->getShortName();
                    $messages["{$key}.{$className}"] = strtr($keyRule->message(), [ValidationConstant::KEY_ATTRIBUTE => $key]);
                    continue;
                }
                if (in_array($keyRule, $this->getRuleNames(), true)) {
                    $messages["{$key}.{$keyRule}"] = $this->getKeyMessage($keyRule, $key);
                    continue;
                }
                $extract = explode(ValidationConstant::COLON, $keyRule);
                if (isset($extract[1]) && in_array($extract[0], $this->getRuleNames(), true)) {
                    $messages["{$key}.{$extract[0]}"] = $this->getKeyValueMessage($extract, $key);
                }
            }
        }

        return $messages;
    }

    /**
     * @return array|string[]
     */
    public function getRuleNames(): array
    {
        return array_merge($this->ruleNames, $this->addRules);
    }

    /**
     * @return $this
     */
    public function addRuleNames(array $newRules): self
    {
        $this->addRules = array_merge($this->addRules, $newRules);

        return $this;
    }

    /**
     * @return array|string[]
     */
    public function getRulesToMessages(): array
    {
        return array_merge($this->rulesToMessages, $this->addRulesToMessages);
    }

    /**
     * @return $this
     */
    public function addRulesToMessages(array $newRules): self
    {
        $this->addRulesToMessages = array_merge($this->addRulesToMessages, $newRules);

        return $this;
    }

    /**
     * @param string $keyRule
     * @param string $key
     * @return string
     */
    protected function getKeyMessage(string $keyRule, string $key): string
    {
        $template = $this->getRulesToMessages()[$keyRule] ?? ValidationConstant::INVALID_DATA_FOR_KEY;

        return strtr($template, [ValidationConstant::KEY_ATTRIBUTE => $key]);
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

        $template = $this->getRulesToMessages()[$extract[0]] ?? ValidationConstant::INVALID_DATA_FOR_KEY;

        return strtr(
            $template,
            [
                ValidationConstant::KEY_ATTRIBUTE => $key,
                ValidationConstant::RULE_VALUE => trim(implode(', ', explode(',', $extract[1])))
            ]
        );
    }
}
