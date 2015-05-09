Feature: I would like to edit predators
+
+  Scenario Outline: Insert records
+    Given I am on homepage
+    And I follow "Login"
+    And I fill in "Username" with "admin"
+    And I fill in "Password" with "loremipsum"
+    And I press "Login"
+    And I go to "/admin/predator/"
+    Then I should not see "<predator>"
+    And I follow "Create a new entry"
+    Then I should see "Predator creation"
+    When I fill in "Name" with "<predator>"
+    And I fill in "Age" with "<age>"
+    And I press "Create"
+    Then I should see "<predator>"
+    And I should see "<age>"
+
+  Examples:
+    | predator   | age |
+    | lion       | 10  |
+    | tiger      | 15  |
+    | wolf       | 15  |
+
+
+
+  Scenario Outline: Edit records
+    Given I am on homepage
+    And I follow "Login"
+    And I fill in "Username" with "admin"
+    And I fill in "Password" with "loremipsum"
+    And I press "Login"
+    And I go to "/admin/predator/"
+    Then I should not see "<new-predator>"
+    When I follow "<old-predator>"
+    Then I should see "<old-predator>"
+    When I follow "Edit"
+    And I fill in "Name" with "<new-predator>"
+    And I fill in "Age" with "<new-age>"
+    And I press "Update"
+    And I follow "Back to the list"
+    Then I should see "<new-predator>"
+    And I should see "<new-age>"
+    And I should not see "<old-predator>"
+
+  Examples:
+    | old-predator    | new-predator    | new-age  |
+    | lion            | N-E-W-L-I-O-N   | 100      |
+    | tiger           | N-E-W-T-I-G-E-R | 200      |
+
+
+  Scenario Outline: Delete records
+    Given I am on homepage
+    And I follow "Login"
+    And I fill in "Username" with "admin"
+    And I fill in "Password" with "loremipsum"
+    And I press "Login"
+    And I go to "/admin/predator/"
+    Then I should see "<predator>"
+    When I follow "<predator>"
+    Then I should see "<predator>"
+    When I press "Delete"
+    Then I should not see "<predator>"
+
+  Examples:
+    | predator        |
+    | wolf            |
+    | N-E-W-L-I-O-N   |
+    | N-E-W-T-I-G-E-R |