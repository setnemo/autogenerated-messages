<?php

declare(strict_types=1);

namespace Setnemo\ValidationMessages;

/**
 * Class ValidationConstant
 * @package Setnemo\ValidationMessages
 */
class ValidationConstant
{
    public const COLON = ':';
    public const PIPELINE = '|';

    public const RULE_REQUIRED = 'required';
    public const RULE_STRING = 'string';
    public const RULE_IN = 'in';
    public const RULE_MIN = 'min';
    public const RULE_URL = 'url';
    public const RULE_MAX = 'max';
    public const RULE_INTEGER = 'integer';
    public const RULE_MIMES = 'mimes';

    public const RULE_NUMERIC = 'numeric';
    public const RULE_VALUE = ':value';

    public const RULE_KEY = ':key';
    public const INVALID_DATA_FOR_KEY = 'Invalid data for :key';
    public const MESSAGE_MAXIMAL_VALUE_FOR_KEY_IS_VALUE = 'Maximal value for :key is :value';
    public const MESSAGE_VALUE_FOR_KEY_MUST_BE_INTEGER = 'Value for :key must be integer';
    public const MESSAGE_ALLOWED_FORMATS_FOR_KEY_VALUE = 'Allowed formats for :key: :value';
    public const MESSAGE_KEY_KEY_MUST_BE_VALID_URL = 'Key :key must be valid url';
    public const MESSAGE_VALUE_FOR_KEY_MUST_BE_STRING = 'Value for :key must be string';
    public const MESSAGE_KEY_KEY_MUST_BE_NUMERIC = 'Key :key must be numeric';
    public const MESSAGE_KEY_IS_REQUIRED = ':key is required';
    public const MESSAGE_MINIMAL_VALUE_FOR_KEY_IS_VALUE = 'Minimal value for :key is :value';
    public const MESSAGE_ALLOWED_VALUES_FOR_KEY_VALUE = 'Allowed values for :key: :value';
}
