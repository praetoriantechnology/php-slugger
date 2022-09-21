<?php

declare(strict_types=1);

namespace Praetorian\Tests\Slugger\Behat;

use Behat\Behat\Context\Context;
use Behat\Behat\Tester\Exception\PendingException;
use PHPUnit\Framework\Assert;
use Praetorian\Slugger\CannotSlugifyException;
use Praetorian\Slugger\Slugger;

class SluggerContext implements Context
{
    private string $result;

    /**
     * @When /^I generate a slug from the text "([^"]*)"$/
     * @throws CannotSlugifyException
     */
    public function iGenerateASlugFromTheText(string $text)
    {
        $this->result = (new Slugger())->slugify(text: $text);
    }

    /**
     * @Then /^I should get the sluggified version$/
     */
    public function iShouldGetTheSluggifiedVersion()
    {
        Assert::assertEquals(expected: 'this-is-an-example-text', actual: $this->result);
    }

    /**
     * @Given /^I generate a slug from the text "([^"]*)" with the divider "([^"]*)"$/
     * @throws CannotSlugifyException
     */
    public function iGenerateASlugFromTheTextWithTheDivider(string $text, string $divider)
    {
        $this->result = (new Slugger())->slugify(text: $text, divider: $divider);
    }

    /**
     * @Then /^I should get the sluggified version with the different divider$/
     */
    public function iShouldGetTheSluggifiedVersionWithTheDifferentDivider()
    {
        Assert::assertEquals(expected: 'this_is_an_example_text', actual: $this->result);
    }

    /**
     * @Given /^I generate a slug from an empty string$/
     */
    public function iGenerateASlugFromAnEmptyString()
    {
        try {
            $this->result = (new Slugger())->slugify(text: '');
        } catch (CannotSlugifyException $exception) {
            $this->result = CannotSlugifyException::class;
        }
    }

    /**
     * @Then /^I should expect an exception to be thrown$/
     */
    public function iShouldExpectAnExceptionToBeThrown()
    {
        Assert::assertEquals(expected: CannotSlugifyException::class, actual: $this->result);
    }
}