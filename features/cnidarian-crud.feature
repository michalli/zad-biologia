Feature: I would like to edit cnidarians

  Scenario Outline: Insert records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I go to "/admin/cnidarian/"
    Then I should not see "<cnidarian>"
    And I follow "Create a new entry"
    Then I should see "Cnidarian creation"
    When I fill in "Name" with "<cnidarian>"
    And I fill in "Weight" with "<weight>"
    And I press "Create"
    Then I should see "<cnidarian>"
    And I should see "<weight>"

  Examples:
    | cnidarian     | weight |
    | zeglarz       | 10     |
    | meduza        | 5      |
    | polip         | 3      |



  Scenario Outline: Edit records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I go to "/admin/cnidarian/"
    Then I should not see "<new-cnidarian>"
    When I follow "<old-cnidarian>"
    Then I should see "<old-cnidarian>"
    When I follow "Edit"
    And I fill in "Name" with "<new-cnidarian>"
    And I fill in "Weight" with "<new-weight>"
    And I press "Update"
    And I follow "Back to the list"
    Then I should see "<new-cnidarian>"
    And I should see "<new-weight>"
    And I should not see "<old-cnidarian>"

  Examples:
    | old-cnidarian     | new-cnidarian     | new-weight    |
    | zeglarz           | chelbia           | 30            |
    | meduza            | cuboza            | 12            |


  Scenario Outline: Delete records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I go to "/admin/cnidarian/"
    Then I should see "<cnidarian>"
    When I follow "<cnidarian>"
    Then I should see "<cnidarian>"
    When I press "Delete"
    Then I should not see "<cnidarian>"

  Examples:
    |  cnidarian    |
    |  polip        |
    |  chelbia      |
    |  cuboza       |