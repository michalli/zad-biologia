Feature: I would like to edit frogs

  Scenario Outline: Insert records
   Given I am on homepage
     And I follow "Login"
     And I fill in "Username" with "admin"
     And I fill in "Password" with "loremipsum"
     And I press "Login"
     And I go to "/admin/frog/"
    Then I should not see "<frog>"
     And I follow "Create a new entry"
    Then I should see "Frog creation"
    When I fill in "Name" with "<frog>"
     And I fill in "Type" with "<type>"
     And I press "Create"
    Then I should see "<frog>"
     And I should see "<type>"

  Examples:
    | frog         | type    |
    | floating     | toad    |
    | smiling      | tree    |
    | dart         | exotic  |



  Scenario Outline: Edit records
   Given I am on homepage
     And I follow "Login"
     And I fill in "Username" with "admin"
     And I fill in "Password" with "loremipsum"
     And I press "Login"
     And I go to "/admin/frog/"
    Then I should not see "<new-frog>"
    When I follow "<old-frog>"
    Then I should see "<old-frog>"
    When I follow "Edit"
     And I fill in "Name" with "<new-frog>"
     And I fill in "Type" with "<new-type>"
     And I press "Update"
     And I follow "Back to the list"
    Then I should see "<new-frog>"
     And I should see "<new-type>"
     And I should not see "<old-frog>"

  Examples:
    | old-frog        | new-frog          | new-type    |
    | floating        | N-E-W-F-L-O       | toad        |
    | smiling         | S-M-I-L-I-N       | tree        |


  Scenario Outline: Delete records
   Given I am on homepage
     And I follow "Login"
     And I fill in "Username" with "admin"
     And I fill in "Password" with "loremipsum"
     And I press "Login"
     And I go to "/admin/frog/"
    Then I should see "<frog>"
    When I follow "<frog>"
    Then I should see "<frog>"
    When I press "Delete"
    Then I should not see "<frog>"

  Examples:
    | frog        |
    | dart        |
    | N-E-W-F-L-O |
    | S-M-I-L-I-N |
