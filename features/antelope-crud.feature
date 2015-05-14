Feature: I would like to edit antelope

  Scenario Outline: Insert records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I go to "/admin/antelope/"
    Then I should not see "<antelope>"
    And I follow "Create a new entry"
    Then I should see "antelope creation"
    When I fill in "Name" with "<antelope>"
    And I fill in "Weight" with "<weight>"
    And I press "Create"
    Then I should see "<antelope>"
    And I should see "<weight>"

  Examples:
    | antelope     | weight |
    | kudu         | 270    |
    | sable        | 235    |
    



  Scenario Outline: Edit records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I go to "/admin/antelope/"
    Then I should not see "<new-antelope>"
    When I follow "<old-antelope>"
    Then I should see "<old-antelope>"
    When I follow "Edit"
    And I fill in "Name" with "<new-antelope>"
    And I fill in "Weight" with "<new-weight>"
    And I press "Update"
    And I follow "Back to the list"
    Then I should see "<new-antelope>"
    And I should see "<new-weight>"
    And I should not see "<old-antelope>"

  Examples:
    | old-antelope   | new-antelope          | new-weight    |
    | kudu           | nyala                 | 135           |
    | sable          | roan                  | 245           |


  Scenario Outline: Delete records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I go to "/admin/antelope/"
    Then I should see "<antelope>"
    When I follow "<antelope>"
    Then I should see "<antelope>"
    When I press "Delete"
    Then I should not see "<antelope>"

  Examples:
    | antelope    |
    | nyala       |
    | roan        |

