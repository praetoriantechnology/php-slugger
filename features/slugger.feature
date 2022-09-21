Feature: Slugger
  In order to prove that the Slugger is working properly
  As a developer,
  I need to be able to generate a slug from a string

  Scenario: It generates a slug from a string
    Given I generate a slug from the text "This is an example text"
    Then I should get the sluggified version

  Scenario: It generates a slug from a string with a different divider
    Given I generate a slug from the text "This is an example text" with the divider "_"
    Then I should get the sluggified version with the different divider

  Scenario: It throws an error when trying to generate a slug from a empty string
    Given I generate a slug from an empty string
    Then I should expect an exception to be thrown