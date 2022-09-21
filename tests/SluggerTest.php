<?php

declare(strict_types=1);

namespace Praetorian\Tests\Slugger;

use PHPUnit\Framework\TestCase;
use Praetorian\Slugger\CannotSlugifyException;
use Praetorian\Slugger\Slugger;

final class SluggerTest extends TestCase
{
    /**
     * @test
     * @return void
     * @throws CannotSlugifyException
     */
    public function it_generates_a_slug_from_text(): void
    {
        $slugger = new Slugger();

        $text = $slugger->slugify(text: 'This is an example text');

        $this->assertEquals(expected: 'this-is-an-example-text', actual: $text);
    }

    /**
     * @test
     * @return void
     * @throws CannotSlugifyException
     */
    public function it_generates_a_slug_from_text_with_a_different_divider(): void
    {
        $slugger = new Slugger();

        $text = $slugger->slugify(text: 'This is an example text', divider: '_');

        $this->assertEquals(expected: 'this_is_an_example_text', actual: $text);
    }

    /**
     * @test
     * @return void
     * @throws CannotSlugifyException
     */
    public function it_throws_an_exception_if_the_text_is_an_empty_string(): void
    {
        $this->expectException(exception: CannotSlugifyException::class);
        $this->expectExceptionMessage(message: 'An empty string cannot be converted to a slug.');

        $slugger = new Slugger();

        $slugger->slugify(text: '');
    }
}
