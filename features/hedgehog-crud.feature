Feature: I would like to edit hedgehog

  Scenario Outline: Insert records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I go to "/admin/hedgehog/"
    Then I should not see "<hedgehog>"
    And I follow "Create a new entry"
    Then I should see "Hedgehog creation"
    When I fill in "Name" with "<hedgehog>"
    And I fill in "Lifetime" with "<lifetime>"
    And I press "Create"
    Then I should see "<hedgehog>"
    And I should see "<lifetime>"

  Examples:
    | hedgehog     | lifetime |
    | białobrzuchy | 5        |
    | uszaty       | 9        |
    | amurski      | 8        |



  Scenario Outline: Edit records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I go to "/admin/hedgehog/"
    Then I should not see "<new-hedgehog>"
    When I follow "<old-hedgehog>"
    Then I should see "<old-hedgehog>"
    When I follow "Edit"
    And I fill in "Name" with "<new-hedgehog>"
    And I fill in "Lifetime" with "<new-lifetime>"
    And I press "Update"
    And I follow "Back to the list"
    Then I should see "<new-hedgehog>"
    And I should see "<new-lifetime>"
    And I should not see "<old-hedgehog>"

  Examples:
    | old-hedgehog    | new-hedgehog        | new-lifetime |
    | uszaty          | zachodni            | 10           |
    | amurski         | wschodni            | 12           |


  Scenario Outline: Delete records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I go to "/admin/hedgehog/"
    Then I should see "<hedgehog>"
    When I follow "<hedgehog>"
    Then I should see "<hedgehog>"
    When I press "Delete"
    Then I should not see "<hedgehog>"

  Examples:
    |  hedgehog    |   
    | białobrzuchy |
    | zachodni     |
