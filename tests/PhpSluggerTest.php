<?php

declare(strict_types=1);

namespace Praetorian\Tests\PhpSlugger;

use PHPUnit\Framework\TestCase;
use Praetorian\PhpSlugger\Slugger;

final class PhpSluggerTest extends TestCase
{
    /**
     * @test
     * @return void
     */
    public function it_generates_a_slug_from_text(): void
    {
        $slugger = new Slugger();

        $text = $slugger->slugify('This is an example text');

        $this->assertEquals('this-is-an-example-text', $text);
    }


    /**
     * @test
     * @return void
     */
    public function it_returns_not_available_from_text(): void
    {
        $slugger = new Slugger();

        $text = $slugger->slugify('');

        $this->assertEquals('n-a', $text);
    }
}
