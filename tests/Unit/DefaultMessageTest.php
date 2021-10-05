<?php

declare(strict_types=1);

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Tests\Stubs\Request;

/**
 * Class DefaultMessageTest
 * @package Tests\Unit
 */
class DefaultMessageTest extends TestCase
{
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
                $request->getDefaultMessagesCommonRules()['required'],
                'name'
            ),
            $messages['name.required']
        );
        $this->assertEquals(
            $this->createKeyMessages(
                $request->getDefaultMessagesCommonRules()['string'],
                'name'
            ),
            $messages['name.string']
        );
        $this->assertEquals(
            $this->createKeyMessages(
                $request->getDefaultMessagesCommonRules()['integer'],
                'start_date'
            ),
            $messages['start_date.integer']
        );
        $this->assertEquals(
            $this->createKeyMessages(
                $request->getDefaultMessagesCommonRules()['numeric'],
                'price'
            ),
            $messages['price.numeric']
        );
        $this->assertEquals(
            $this->createKeyValueMessages(
                $request->getDefaultMessagesCommonRules()['max'],
                'name',
                '120'
            ),
            $messages['name.max']
        );
        $this->assertEquals(
            $this->createKeyValueMessages(
                $request->getDefaultMessagesCommonRules()['min'],
                'price',
                '0'
            ),
            $messages['price.min']
        );
        $this->assertEquals(
            $this->createKeyValueMessages(
                $request->getDefaultMessagesCommonRules()['mimes'],
                'video',
                'mp4,mov,avi'
            ),
            $messages['video.mimes']
        );
        $this->assertEquals(
            $this->createKeyValueMessages(
                $request->getDefaultMessagesCommonRules()['in'],
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
