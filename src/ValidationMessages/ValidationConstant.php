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
    public const RULE_NOT_IN = 'not_in';
    public const RULE_MIN = 'min';
    public const RULE_URL = 'url';
    public const RULE_MAX = 'max';
    public const RULE_INTEGER = 'integer';
    public const RULE_MIMES = 'mimes';
    public const RULE_LOWERCASE = 'LowerCaseRule';
    public const RULE_EMAIL = 'email';
    public const RULE_UNIQUE = 'unique';
    public const RULE_JSON = 'json';
    public const RULE_IMAGE = 'image';
    public const RULE_ACCEPTED = 'accepted';
    public const RULE_ARRAY = 'array';
    public const RULE_BOOLEAN = 'boolean';
    public const RULE_REGEX = 'regex';
    public const RULE_EXISTS = 'exists';
    public const RULE_UUID = 'uuid';
    public const RULE_AFTER = 'after';
    public const RULE_IP = 'ip';
    public const RULE_IPV4 = 'ipv4';
    public const RULE_IPV6 = 'ipv6';
    public const RULE_MAC_ADDRESS = 'mac_address';
    public const RULE_STARTS_WITH = 'starts_with';
    public const RULE_ENDS_WITH = 'ends_with';
    public const RULE_DOESNT_START_WITH = 'doesnt_start_with';
    public const RULE_DOESNT_END_WITH = 'doesnt_end_with';
    public const RULE_MULTIPLE_OF = 'multiple_of';

    public const RULE_NUMERIC = 'numeric';
    public const RULE_VALUE = ':value';

    public const KEY_ATTRIBUTE = ':attribute';
    public const INVALID_DATA_FOR_KEY = 'Invalid data for :attribute';
    public const MESSAGE_MAXIMAL_VALUE_FOR_KEY_IS_VALUE = 'Maximal value for :attribute is :value';
    public const MESSAGE_VALUE_FOR_KEY_MUST_BE_INTEGER = 'Value for :attribute must be integer';
    public const MESSAGE_ALLOWED_FORMATS_FOR_KEY_VALUE = 'Allowed formats for :attribute: :value';
    public const MESSAGE_KEY_KEY_MUST_BE_VALID_URL = 'Key :attribute must be valid url';
    public const MESSAGE_VALUE_FOR_KEY_MUST_BE_STRING = 'Value for :attribute must be string';
    public const MESSAGE_KEY_KEY_MUST_BE_NUMERIC = 'Key :attribute must be numeric';
    public const MESSAGE_KEY_IS_REQUIRED = ':attribute is required';
    public const MESSAGE_MINIMAL_VALUE_FOR_KEY_IS_VALUE = 'Minimal value for :attribute is :value';
    public const MESSAGE_ALLOWED_VALUES_FOR_KEY_VALUE = 'Allowed values for :attribute: :value';
    public const MESSAGE_KEY_IS_EMAIL = ':attribute must have email format';
    public const MESSAGE_KEY_UNIQUE = ':attribute already exists';
    public const MESSAGE_KEY_JSON = ':attribute must be a valid JSON string';
    public const MESSAGE_KEY_IMAGE = ':attribute must be an image (jpg, jpeg, png)';
    public const MESSAGE_KEY_ACCEPTED = 'The :attribute must be yes, on, 1, or true.';
    public const MESSAGE_KEY_ARRAY = 'The :attribute must be array.';
    public const MESSAGE_KEY_BOOLEAN = 'The :attribute must be able to be cast as a boolean. Accepted input are true, false, 1 and 0.';
    public const MESSAGE_SELECTED_VALUE_IS_INVALID = 'The selected :attribute: is invalid';
    public const MESSAGE_KEY_REGEX = 'The :attribute: format is invalid';
    public const MESSAGE_KEY_EXISTS = 'The :attribute: doesn\'t exist';
    public const MESSAGE_KEY_UUID = 'The :attribute doesn\'t match UUID format';
    public const MESSAGE_KEY_AFTER = 'The :attribute must be a date after :value.';
    public const MESSAGE_KEY_IP = 'The :attribute must be a valid IP address';
    public const MESSAGE_KEY_IPV4 = 'The :attribute must be a valid IPv4 address';
    public const MESSAGE_KEY_IPV6 = 'The :attribute must be a valid IPv6 address';
    public const MESSAGE_KEY_MAC = 'The :attribute must be a valid MAC address.';
    public const MESSAGE_KEY_STARTS_WITH = 'The :attribute should start with :value';
    public const MESSAGE_KEY_ENDS_WITH = 'The :attribute should end with :value';
    public const MESSAGE_KEY_DOESNT_START_WITH = 'The :attribute cannot start with :value';
    public const MESSAGE_KEY_DOESNT_END_WITH = 'The :attribute cannot end with :value';
    public const MESSAGE_KEY_MULTIPLE_OF = 'The :attribute must be a multiple of :value';
}
