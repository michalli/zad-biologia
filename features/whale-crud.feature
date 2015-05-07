Feature: I would like to edit whale
age
  Scenario Outline: Insert records
   Given I am on homepage
     And I follow "Login"
     And I fill in "Username" with "admin"
     And I fill in "Password" with "loremipsum"
     And I press "Login"
     And I go to "/admin/whale/"
    Then I should not see "<whale>"
     And I follow "Create a new entry"
    Then I should see "Whale creation"
    When I fill in "Name" with "<whale>"
     And I fill in "Feet" with "<feet>"
     And I press "Create"
    Then I should see "<whale>"
     And I should see "<feet>"

  Examples:
    | whale       | feet |
    | blue        | 60   |
    | finback     | 50   |
    | humpback    | 50   |



  Scenario Outline: Edit records
   Given I am on homepage
     And I follow "Login"
     And I fill in "Username" with "admin"
     And I fill in "Password" with "loremipsum"
     And I press "Login"
     And I go to "/admin/whale/"
    Then I should not see "<new-whale>"
    When I follow "<old-whale>"
    Then I should see "<old-whale>"
    When I follow "Edit"
     And I fill in "Name" with "<new-whale>"
     And I fill in "Feet" with "<new-feet>"
     And I press "Update"
     And I follow "Back to the list"
    Then I should see "<new-whale>"
     And I should see "<new-feet>"
     And I should not see "<old-whale>"

  Examples:
    | old-whale     | new-whale  | new-feet   |
    | blue          | orca       | 25         |
    | finback       | narwhal    | 40         |


  Scenario Outline: Delete records
   Given I am on homepage
     And I follow "Login"
     And I fill in "Username" with "admin"
     And I fill in "Password" with "loremipsum"
     And I press "Login"
     And I go to "/admin/whale/"
    Then I should see "<whale>"
    When I follow "<whale>"
    Then I should see "<whale>"
    When I press "Delete"
    Then I should not see "<whale>"

  Examples:
    |  whale   |
    | orca     |
    | narwhal  |
    | humpback |