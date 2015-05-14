Feature: I would like to edit marsupials

  Scenario Outline: Insert records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I go to "/admin/marsupials/"
    Then I should not see "<marsupials>"
    And I follow "Create a new entry"
    Then I should see "Marsupials creation"
    When I fill in "Name" with "<marsupials>"
    And I fill in "Weight" with "<weight>"
    And I press "Create"
    Then I should see "<marsupials>"
    And I should see "<weight>"

  Examples:
    |marsupials |weight |
    |kangaroo   |130    |
    |opossum    |30     |
    |koala      |70     |



  Scenario Outline: Edit records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I go to "/admin/marsupials/"
    Then I should not see "<new-marsupials>"
    When I follow "<old-marsupials>"
    Then I should see "<old-marsupials>"
    When I follow "Edit"
    And I fill in "Name" with "<new-marsupials>"
    And I fill in "Weight" with "<new-weight>"
    And I press "Update"
    And I follow "Back to the list"
    Then I should see "<new-marsupials>"
    And I should see "<new-weight>"
    And I should not see "<old-marsupials>"

  Examples:
    |old-marsupials |new-marsupials |new-weight|
    |kangaroo       |N-E-W-K-A-N      |200       |
    |opossum        |N-E-W-O-P-O      |110       |


  Scenario Outline: Delete records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I go to "/admin/marsupials/"
    Then I should see "<marsupials>"
    When I follow "<marsupials>"
    Then I should see "<marsupials>"
    When I press "Delete"
    Then I should not see "<marsupials>"

  Examples:
    |marsupials  |
    |N-E-W-K-A-N |
    |N-E-W-O-P-O |
    |koala       |
    