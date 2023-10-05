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
     * @test
     */
    public function addRulesTest(): void
    {
        $request = new RequestAddRules([
            'test_key' => 'test_rule',
        ]);
        $messages = $request->messages();
        $this->assertEquals(
            $this->createKeyMessages(
                $request->getRulesToMessages()['test_rule'],
                'test_key'
            ),
            $messages['test_key.test_rule']
        );
    }

    /**
     * @test
     */
    public function messagesTest(): void
    {
        $timestamp = time();
        $date = date(DATE_W3C, $timestamp);
        $request   = new Request([
            'name' => 'required|string|max:120',
            'start_date' => 'required|integer',
            'price' => 'nullable|numeric|min:0 ',
            'pay_link' => 'nullable|string|url|max:256',
            'video' => 'nullable|mimes:mp4,mov,avi',
            'confidentiality' => 'required|string|in:public,personal',
            'gender' => ['required', 'string', 'in:male,female', new LowerCaseRule()],
            'email' => 'required|email|unique:users,email',
            'admin' => 'required|boolean',
            'image' => 'image|mimes:jpg,jpeg, png',
            'id' => 'not_in:0',
            'field1' => 'regex:/^[\w]+$/',
            'uuid' => 'uuid',
            'field2' => 'after:' . $date,
            'local_ip' => 'required|ip',
            'local_ipv4' => 'required|ip|ipv4',
            'local_ipv6' => 'required|ip|ipv6',
            'mac_address' => 'required|mac_address',
            'starts_with' => 'required|starts_with:foo',
            'ends_with' => 'required|ends_with:bar',
        ]);
        $messages = $request->messages();
        $this->assertEquals(
            $this->createKeyMessages(
                $request->getRulesToMessages()['required'],
                'name'
            ),
            $messages['name.required']
        );
        $this->assertEquals(
            $this->createKeyMessages(
                $request->getRulesToMessages()['string'],
                'name'
            ),
            $messages['name.string']
        );
        $this->assertEquals(
            $this->createKeyMessages(
                $request->getRulesToMessages()['integer'],
                'start_date'
            ),
            $messages['start_date.integer']
        );
        $this->assertEquals(
            $this->createKeyMessages(
                $request->getRulesToMessages()['numeric'],
                'price'
            ),
            $messages['price.numeric']
        );
        $this->assertEquals(
            $this->createKeyValueMessages(
                $request->getRulesToMessages()['max'],
                'name',
                '120'
            ),
            $messages['name.max']
        );
        $this->assertEquals(
            $this->createKeyValueMessages(
                $request->getRulesToMessages()['min'],
                'price',
                '0'
            ),
            $messages['price.min']
        );
        $this->assertEquals(
            $this->createKeyValueMessages(
                $request->getRulesToMessages()['mimes'],
                'video',
                'mp4,mov,avi'
            ),
            $messages['video.mimes']
        );
        $this->assertEquals(
            $this->createKeyValueMessages(
                $request->getRulesToMessages()['in'],
                'confidentiality',
                'public,personal'
            ),
            $messages['confidentiality.in']
        );
        $this->assertEquals(
            $this->createKeyValueMessages(
                $request->getRulesToMessages()['in'],
                'gender',
                'male,female'
            ),
            $messages['gender.in']
        );
        $this->assertEquals(
            $this->createKeyMessages(
                $request->getRulesToMessages()['required'],
                'gender'
            ),
            $messages['gender.required']
        );
        $this->assertEquals(
            $this->createKeyMessages(
                $request->getRulesToMessages()['string'],
                'gender'
            ),
            $messages['gender.string']
        );
        $this->assertEquals(
            $this->createKeyMessages(
                (new LowerCaseRule())->message(),
                'gender'
            ),
            $messages['gender.LowerCaseRule']
        );

        $this->assertEquals(
            $this->createKeyMessages(
                $request->getRulesToMessages()['required'],
                'email'
            ),
            $messages['email.required']
        );

        $this->assertEquals(
            $this->createKeyMessages(
                $request->getRulesToMessages()['email'],
                'email'
            ),
            $messages['email.email']
        );
        $this->assertEquals(
            $this->createKeyValueMessages(
                $request->getRulesToMessages()['unique'],
                'email',
                'users,email'
            ),
            $messages['email.unique']
        );
        $this->assertEquals(
            $this->createKeyMessages(
                $request->getRulesToMessages()['boolean'],
                'admin'
            ),
            $messages['admin.boolean']
        );
        $this->assertEquals(
            $this->createKeyValueMessages(
                $request->getRulesToMessages()['image'],
                'image',
                'jpg,jpeg,png'
            ),
            $messages['image.image']
        );
        $this->assertEquals(
            $this->createKeyValueMessages(
                $request->getRulesToMessages()['regex'],
                'field1',
                'asdas asdsd'
            ),
            $messages['field1.regex']
        );
        $this->assertEquals(
            $this->createKeyValueMessages(
                $request->getRulesToMessages()['uuid'],
                'uuid',
                'asdas asdsd'
            ),
            $messages['uuid.uuid']
        );
        $this->assertStringContainsString(
            'The field2 must be a date after ',
            $this->createKeyValueMessages(
                $request->getRulesToMessages()['after'],
                'field2',
                $date
            )
        );
        $this->assertEquals(
            $this->createKeyValueMessages(
                $request->getRulesToMessages()['ip'],
                'local_ip',
                '0.0.0.0'
            ),
            $messages['local_ip.ip']
        );
        $this->assertEquals(
            $this->createKeyValueMessages(
                $request->getRulesToMessages()['ipv4'],
                'local_ipv4',
                '0.0.0.0'
            ),
            $messages['local_ipv4.ipv4']
        );
        $this->assertEquals(
            $this->createKeyValueMessages(
                $request->getRulesToMessages()['ipv6'],
                'local_ipv6',
                '00:10:0b:de:62:48:ad:5a'
            ),
            $messages['local_ipv6.ipv6']
        );
        $this->assertEquals(
            $this->createKeyValueMessages(
                $request->getRulesToMessages()['mac_address'],
                'mac_address',
                'xx:xx:xx:xx:xx'
            ),
            $messages['mac_address.mac_address']
        );
        $this->assertEquals(
            $this->createKeyValueMessages(
                $request->getRulesToMessages()['starts_with'],
                'starts_with',
                'foo'
            ),
            $messages['starts_with.starts_with']
        );
        $this->assertEquals(
            $this->createKeyValueMessages(
                $request->getRulesToMessages()['ends_with'],
                'ends_with',
                'bar'
            ),
            $messages['ends_with.ends_with']
        );
    }

    /**
     * @param string $string
     * @param string $key
     * @return string
     */
    private function createKeyMessages(string $string, string $key): string
    {
        return strtr(
            $string,
            [':attribute' => $key]
        );
    }

    /**
     * @param string $string
     * @param string $key
     * @param string $value
     * @return string
     */
    private function createKeyValueMessages(string $string, string $key, string $value): string
    {
        return strtr(
            $string,
            [':attribute' => $key, ':value' => trim(implode(', ', explode(',', $value)))]
        );
    }
}
