Feature: I would like to edit horses

  Scenario Outline: Insert records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I go to "/admin/horse/"
    Then I should not see "<horse>"
    And I follow "Create a new entry"
    Then I should see "Horse creation"
    When I fill in "Name" with "<horse>"
    And I fill in "Lifespan" with "<lifespan>"
    And I press "Create"
    Then I should see "<horse>"
    And I should see "<lifespan>"

  Examples:
    | horse     | lifespan |
    | pinto     | 27  |
    | hunter    | 24  |
 



  Scenario Outline: Edit records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I go to "/admin/horse/"
    Then I should not see "<new-horse>"
    When I follow "<old-horse>"
    Then I should see "<old-horse>"
    When I follow "Edit"
    And I fill in "Name" with "<new-horse>"
    And I fill in "Lifespan" with "<new-lifespan>"
    And I press "Update"
    And I follow "Back to the list"
    Then I should see "<new-horse>"
    And I should see "<new-lifespan>"
    And I should not see "<old-horse>"

  Examples:
    | old-horse     | new-horse         | new-lifespan    |
    | pinto         | stallion          | 16              |
    | hunter        | cob               | 17              |


  Scenario Outline: Delete records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I go to "/admin/horse/"
    Then I should see "<horse>"
    When I follow "<horse>"
    Then I should see "<horse>"
    When I press "Delete"
    Then I should not see "<horse>"

  Examples:
    | horse     |
    | stallion  |
    | cob       |