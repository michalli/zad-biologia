Feature: I would like to edit deers

  Scenario Outline: Insert records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I go to "/admin/deer/"
    Then I should not see "<deer>"
    And I follow "Create a new entry"
    Then I should see "Cats creation"
    When I fill in "Name" with "<deer>"
    And I fill in "Weight" with "<weight>"
    And I press "Create"
    Then I should see "<deer>"
    And I should see "<weight>"

  Examples:
    | deer     | weight |
    | aksis    | 60     |
    | elda     | 73     |
    | olbrzymi | 150    |



  Scenario Outline: Edit records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I go to "/admin/deer/"
    Then I should not see "<new-deer>"
    When I follow "<old-deer>"
    Then I should see "<old-deer>"
    When I follow "Edit"
    And I fill in "Name" with "<new-deer>"
    And I fill in "Weight" with "<new-weight>"
    And I press "Update"
    And I follow "Back to the list"
    Then I should see "<new-deer>"
    And I should see "<new-weight>"
    And I should not see "<old-deer>"

  Examples:
    | old-deer     | new-deer          | new-weight |
    | aksis        | milu              | 62         |
    | elda         | wschodni          | 73         |


  Scenario Outline: Delete records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I go to "/admin/deer/"
    Then I should see "<deer>"
    When I follow "<deer>"
    Then I should see "<deer>"
    When I press "Delete"
    Then I should not see "<deer>"

  Examples:
    | deer     |
    | olbrzymi |
    | wschodni |
    | milu     |

