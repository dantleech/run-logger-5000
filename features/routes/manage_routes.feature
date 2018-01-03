Feature: Manage routes
    As a runner
    In order that I can log my times and improve my fitness
    I need to be able to record and manage the routes that I run

    Scenario: List all routes
        Given the following routes exist:
            | title               | distance |
            | Home to Inviqa      | 7km      |
            | Brandenberg gate    | 12km     |
        When I am on the route listing page
        Then I should see the following routes listed:
            | title            |
            | Home to Inviqa   |
            | Brandenberg gate |

    Scenario: Create route
        Given I am on the route listing page
        When I create a new route "Weisensee to Kreuzberg" with distance "10km"
        And I am on the route listing page
        Then I should see the following routes listed:
            | title                  |
            | Weisensee to Kreuzberg |

    Scenario: View route
        Given the following routes exist:
            | title               | distance |
            | Home to Inviqa      | 7km      |
        And I am on the route listing page
        When I click on route "Home to Inviqa"
        Then I should see the "Home to Inviqa" route details
