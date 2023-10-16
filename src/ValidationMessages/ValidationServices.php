<?php

declare(strict_types=1);

namespace Setnemo\ValidationMessages;

trait ValidationServices
{
    /**
     * @param string $keyRule
     * @param string $key
     * @return string
     */
    public function getKeyMessage(string $keyRule, string $key): string
    {
        $template = $this->getRulesToMessages()[$keyRule] ?? ValidationConstant::INVALID_DATA_FOR_KEY;

        return strtr($template, [ValidationConstant::KEY_ATTRIBUTE => $key]);
    }

    /**
     * @param array $extract
     * @param string $key
     * @return string
     */
    public function getKeyValueMessage(string $string, string $key, string $value): string
    {
        $template = $this->getRulesToMessages()[$string] ?? ValidationConstant::INVALID_DATA_FOR_KEY;

        return strtr(
            $template,
            [
                ValidationConstant::KEY_ATTRIBUTE => $key,
                ValidationConstant::RULE_VALUE => trim(implode(', ', explode(',', $value))),
                ValidationConstant::KEY_OTHER => $value,
            ]
        );
    }

    /**
     * @param object $objectRule
     * @param string $key
     * @return string
     */
    public function getKeyObjectMessage(object $objectRule, string $key): string
    {
        return strtr($objectRule->message(), [ValidationConstant::KEY_ATTRIBUTE => $key]);
    }
}
