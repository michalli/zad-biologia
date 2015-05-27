Feature: I would like to edit housefly

  Scenario Outline: Insert records
   Given I am on homepage
     And I follow "Login"
     And I fill in "Username" with "admin"
     And I fill in "Password" with "loremipsum"
     And I press "Login"
     And I go to "/admin/housefly/"
    Then I should not see "<housefly>"
     And I follow "Create a new entry"
    Then I should see "housefly creation"
    When I fill in "Name" with "<housefly>"
     And I fill in "Age" with "<age>"
     And I press "Create"
    Then I should see "<housefly>"
     And I should see "<age>"

  Examples:
    | housefly     | age |
    | viper       | 15  |
    | turtle      | 190 |
    | crocodile   | 70  |



  Scenario Outline: Edit records
   Given I am on homepage
     And I follow "Login"
     And I fill in "Username" with "admin"
     And I fill in "Password" with "loremipsum"
     And I press "Login"
     And I go to "/admin/housefly/"
    Then I should not see "<new-housefly>"
    When I follow "<old-housefly>"
    Then I should see "<old-housefly>"
    When I follow "Edit"
     And I fill in "Name" with "<new-housefly>"
     And I fill in "Age" with "<new-age>"
     And I press "Update"
     And I follow "Back to the list"
    Then I should see "<new-housefly>"
     And I should see "<new-age>"
     And I should not see "<old-housefly>"

  Examples:
    | old-housefly     | new-housefly  | new-age    |
    | viper           | N-E-W-V-I-P       | 9876       |
    | turtle          | T-U-R-T-U-R       | 3333       |


  Scenario Outline: Delete records
   Given I am on homepage
     And I follow "Login"
     And I fill in "Username" with "admin"
     And I fill in "Password" with "loremipsum"
     And I press "Login"
     And I go to "/admin/housefly/"
    Then I should see "<housefly>"
    When I follow "<housefly>"
    Then I should see "<housefly>"
    When I press "Delete"
    Then I should not see "<housefly>"

  Examples:
    |  housefly    |
    | crocodile   |
    | N-E-W-V-I-P |
    | T-U-R-T-U-R |