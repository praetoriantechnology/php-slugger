<?php

declare(strict_types=1);

namespace Praetorian\Tests\PhpSlugger;

use PHPUnit\Framework\TestCase;
use Praetorian\PhpSlugger\CannotSlugifyException;
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
     * @throws CannotSlugifyException
     */
    public function it_throws_an_exception_if_the_text_is_an_empty_string(): void
    {
        $this->expectException(CannotSlugifyException::class);
        $this->expectExceptionMessage('An empty string cannot be converted to a slug.');

        $slugger = new Slugger();

        $slugger->slugify('');
    }
}
