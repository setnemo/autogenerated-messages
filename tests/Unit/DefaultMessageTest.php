<?php

declare(strict_types=1);

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Tests\Stubs\LowerCaseRule;
use Tests\Stubs\Request;
use Tests\Stubs\RequestAddRules;

/**
 * Class DefaultMessageTest
 * @package Tests\Unit
 */
class DefaultMessageTest extends TestCase
{
    /**
     * @var Request
     */
    private static Request $request;

    /**
     * This method is called before the first test of this test class is run.
     */
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        self::$request  = new Request([
            'key_required' => 'required',
            'key_string' => 'string',
            'key_integer' => 'integer',
            'key_numeric' => 'numeric',
            'key_max' => 'max:120',
            'key_min' => 'min:0',
            'key_mimes' => 'mimes:mp4,mov,avi',
            'key_in' => 'in:public,personal',
            'key_lower_case' => [new LowerCaseRule()],
            'key_email' => 'email',
            'key_unique' => 'unique:users,email',
            'key_boolean' => 'boolean',
            'key_image' => 'image|mimes:jpg,jpeg, png',
            'key_regex' => 'regex:/^[\w]+$/',
            'key_uuid' => 'uuid',
            'key_after' => 'after:' . 'tomorrow',
            'key_ip' => 'ip',
            'key_ipv4' => 'ip|ipv4',
            'key_ipv6' => 'ip|ipv6',
            'key_mac_address' => 'mac_address',
            'key_starts_with' => 'starts_with:foo',
            'key_ends_with' => 'ends_with:bar',
            'key_doesnt_start_with' => 'doesnt_start_with:cannot_foo',
            'key_doesnt_end_with' => 'doesnt_end_with:cannot_bar',
            'key_multiple_of' => 'multiple_of:2',
            'key_same' => 'same:field1',
        ]); 
    }

    /**
     * @test
     */
    public function addRulesTest(): void
    {
        $requestAddRules = new RequestAddRules([
            'test_key' => 'test_rule',
        ]);
        $messages = $requestAddRules->messages();
        $this->assertEquals(
            $requestAddRules->getKeyMessage(
                'test_rule',
                'test_key',
            ),
            $messages['test_key.test_rule']
        );
    }

    /**
     * @test
     * @dataProvider additionProvider
     */
    public function messagesTest(string $key, string $messageKey, string|object $keyRule, string $value = ''): void
    {
        $request = self::$request;
        $messages = $request->messages();

        if(is_object($keyRule)) {
            $this->assertEquals(
                $request->getKeyObjectMessage(
                    new LowerCaseRule(),
                    $key
                ),
                $messages[$messageKey]
            );
        }
     
        if(is_string($keyRule) ) {
            if($value === '') {
                $this->assertEquals(
                    $request->getKeyMessage(
                        $keyRule,
                        $key
                    ),
                    $messages[$messageKey]
                ); 
            }
    
            if($value !== '') {
                $this->assertEquals(
                    $request->getKeyValueMessage(
                        $keyRule,
                        $key,
                        $value
                    ),
                    $messages[$messageKey]
                );
            }
        }
    }

    /**
     * @return array
     */
    public static function additionProvider(): array
    {
        return [
            'test_required' => ['key_required', 'key_required.required', 'required'],
            'test_string' => ['key_string', 'key_string.string', 'string'],
            'test_integer' => ['key_integer', 'key_integer.integer', 'integer'],
            'test_numeric' => ['key_numeric', 'key_numeric.numeric', 'numeric'],
            'test_max' => ['key_max', 'key_max.max', 'max', '120'],
            'test_min' => ['key_min', 'key_min.min', 'min', '0'],
            'test_mimes' => ['key_mimes', 'key_mimes.mimes', 'mimes', 'mp4,mov,avi'],
            'test_in' => ['key_in', 'key_in.in', 'in', 'public,personal'],
            'test_lower_case' => ['key_lower_case', 'key_lower_case.LowerCaseRule', new LowerCaseRule()],
            'test_email' => ['key_email', 'key_email.email', 'email'],
            'test_unique' => ['key_unique', 'key_unique.unique', 'unique', 'users,email'],
            'test_boolean' => ['key_boolean', 'key_boolean.boolean', 'boolean'],
            'test_image' => ['key_image', 'key_image.image', 'image', 'jpg,jpeg,png'],
            'test_regex' => ['key_regex', 'key_regex.regex', 'regex', 'asdas asdsd'],
            'test_uuid' => ['key_uuid', 'key_uuid.uuid', 'uuid', 'asdas asdsd'],
            'test_after' => ['key_after', 'key_after.after', 'after', 'tomorrow'],
            'test_ip' => ['key_ip', 'key_ip.ip', 'ip', '0.0.0.0'],
            'test_ipv4' => ['key_ipv4', 'key_ipv4.ipv4', 'ipv4', '0.0.0.0'],
            'test_ipv6' => ['key_ipv6', 'key_ipv6.ipv6', 'ipv6', '00:10:0b:de:62:48:ad:5a'],
            'test_mac_address' => ['key_mac_address', 'key_mac_address.mac_address', 'mac_address', 'xx:xx:xx:xx:xx'],
            'test_starts_with' => ['key_starts_with', 'key_starts_with.starts_with', 'starts_with', 'foo'],
            'test_ends_with' => ['key_ends_with', 'key_ends_with.ends_with', 'ends_with', 'bar'],
            'test_doesnt_start_with' => ['key_doesnt_start_with', 'key_doesnt_start_with.doesnt_start_with', 'doesnt_start_with', 'cannot_foo'],
            'test_doesnt_end_with' => ['key_doesnt_end_with', 'key_doesnt_end_with.doesnt_end_with', 'doesnt_end_with',  'cannot_bar'],
            'test_multiple_of' => ['key_multiple_of', 'key_multiple_of.multiple_of', 'multiple_of', '2'],
            'test_same' => ['key_same', 'key_same.same', 'same', 'field1'],
        ];
    }
}
