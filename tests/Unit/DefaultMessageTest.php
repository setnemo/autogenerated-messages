<?php

declare(strict_types=1);

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
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
        $request = new Request([
            'name' => 'required|string|max:120',
            'start_date' => 'required|integer',
            'price' => 'nullable|numeric|min:0 ',
            'pay_link' => 'nullable|string|url|max:256',
            'video' => 'nullable|mimes:mp4,mov,avi',
            'confidentiality' => 'required|string|in:public,personal',
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
            [':key' => $key]
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
            [':key' => $key, ':value' => trim(implode(', ', explode(',', $value)))]
        );
    }
}
