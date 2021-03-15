<?php

namespace Tests\Unit;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $client = new Client();
        $t= $client->get('laravel-test.com/apps/7b9325b3b6dfe8f9/channels/kefu/users?auth_key=22539cb6dd11df297d145df517ee4f49');
        dd($t->getBody()->getContents());
        $this->assertTrue(true);
    }
}
