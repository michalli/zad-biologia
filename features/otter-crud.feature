Feature: I would like to edit otters

  Scenario Outline: Insert records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I go to "/admin/otter/"
    Then I should not see "<otter>"
    And I follow "Create a new entry"
    Then I should see "Otter creation"
    When I fill in "Name" with "<otter>"
    And I fill in "Age" with "<age>"
    And I press "Create"
    Then I should see "<otter>"
    And I should see "<age>"

  Examples:
    | otter     | age |
    | lutra       | 15  |
    | nippon     | 190 |
    | sumatrana   | 70  |



  Scenario Outline: Edit records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I go to "/admin/otter/"
    Then I should not see "<new-otter>"
    When I follow "<old-otter>"
    Then I should see "<old-otter>"
    When I follow "Edit"
    And I fill in "Name" with "<new-otter>"
    And I fill in "Age" with "<new-age>"
    And I press "Update"
    And I follow "Back to the list"
    Then I should see "<new-otter>"
    And I should see "<new-age>"
    And I should not see "<old-otter>"

  Examples:
    | old-otter     | new-otter  | new-age    |
    | lutra           | N-E-W-L-U-T       | 9876       |
    | nippon          | N-I-P-N-I-P       | 3333       |


  Scenario Outline: Delete records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I go to "/admin/otter/"
    Then I should see "<otter>"
    When I follow "<otter>"
    Then I should see "<otter>"
    When I press "Delete"
    Then I should not see "<otter>"

  Examples:
    |  otter    |
    | sumatrana   |
    | N-E-W-L-U-T  |
    | N-I-P-N-I-P |

