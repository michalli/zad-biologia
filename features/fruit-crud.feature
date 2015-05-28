Feature: I would like to edit fruit

  Scenario Outline: Insert records
   Given I am on homepage
     And I follow "Login"
     And I fill in "Username" with "admin"
     And I fill in "Password" with "loremipsum"
     And I press "Login"
     And I go to "/admin/fruit/"
    Then I should not see "<fruit>"
     And I follow "Create a new entry"
    Then I should see "Fruit creation"
    When I fill in "Name" with "<fruit>"
     And I fill in "Caption" with "<caption>"
     And I fill in "Size" with "<size>"
     And I press "Create"
    Then I should see "<fruit>"
     And I should see "<caption>"
     And I should see "<size>"

  Examples:
    | fruit       | caption               | size  |
    | mango       | great                 |  689  |
    | orange      | oh good orange        |  890  |
    | aple        | opis aple             |  765  |



  Scenario Outline: Edit records
   Given I am on homepage
     And I follow "Login"
     And I fill in "Username" with "admin"
     And I fill in "Password" with "loremipsum"
     And I press "Login"
     And I go to "/admin/fruit/"
    Then I should not see "<new-fruit>"
    When I follow "<old-fruit>"
    Then I should see "<old-fruit>"
    When I follow "Edit"
     And I fill in "Name" with "<new-fruit>"
     And I fill in "Caption" with "<new-caption>"
     And I fill in "Size" with "<new-size>"
     And I press "Update"
     And I follow "Back to the list"
    Then I should see "<new-fruit>"
     And I should see "<new-caption>"
     And I should see "<new-size>"
     And I should not see "<old-fruit>"

  Examples:
    | old-fruit     | new-fruit     |   new-caption        | new-size    |
    | orange        | pomarancz     |   ala ma pomarancz   | 8888        |
    | aple          | jablko        |   bogaci maja jablko | 9999        |


  Scenario Outline: Delete records
   Given I am on homepage
     And I follow "Login"
     And I fill in "Username" with "admin"
     And I fill in "Password" with "loremipsum"
     And I press "Login"
     And I go to "/admin/fruit/"
    Then I should see "<fruit>"
    When I follow "<fruit>"
    Then I should see "<fruit>"
    When I press "Delete"
    Then I should not see "<fruit>"

  Examples:
    |  fruit      |
    | mango       |
    | pomarancz      |
    | jablko        | 

