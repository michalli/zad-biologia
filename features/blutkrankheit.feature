Feature: I would like to edit blutkrankheit

  Scenario Outline: Insert records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I go to "/admin/blutkrankheit/"
    Then I should not see "<blutkrankheit>"
    And I follow "Create a new entry"
    Then I should see "blutkrankheit creation"
    When I fill in "Name" with "<blutkrankheit>"
    And I fill in "Mortality" with "<mortality>"
    And I press "Create"
    Then I should see "<blutkrankheit>"
    And I should see "<mortality>"

  Examples:
    | blutkrankheit    | mortality |
    | hemofilia        | 30        |
    | małopłytkowość   | 90        | 
    | białaczka        | 50        |



  Scenario Outline: Edit records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I go to "/admin/blutkrankheit/"
    Then I should not see "<new-blutkrankheit>"
    When I follow "<old-blutkrankheit>"
    Then I should see "<old-blutkrankheit>"
    When I follow "Edit"
    And I fill in "Name" with "<new-blutkrankheit>"
    And I fill in "Mortality" with "<new-mortality>"
    And I press "Update"
    And I follow "Back to the list"
    Then I should see "<new-blutkrankheit>"
    And I should see "<new-mortality>"
    And I should not see "<old-blutkrankheit>"

  Examples:
    | old-blutkrankheit     | new-blutkrankheit   | new-mortality |
    | hemofilia             | anemia              | 80            |
    | małopłytkowość        | czerwienica         | 70            |


  Scenario Outline: Delete records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I go to "/admin/blutkrankheit/"
    Then I should see "<blutkrankheit>"
    When I follow "<blutkrankheit>"
    Then I should see "<blutkrankheit>"
    When I press "Delete"
    Then I should not see "<blutkrankheit>"

  Examples:
    | blutkrankheit    |
    | białaczka        |
    | anemia           |
    | czerwienica      |

