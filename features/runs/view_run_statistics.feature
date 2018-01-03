Feature: Run statistics
    As a runner
    In order to quantify my performance and predict future performance
    I want to see statistics about my run

    Background:
        Given the following routes exist:
            | title               | distance |
            | Weisensee lake      | 5km      |

    Scenario: View run statistics
        Given I ran "35 minutes" on route "Weisensee lake"
        And I am on the route page for "Weisensee lake"
        When I click to view the statistics for my "35 minute" run
        Then I should see that my average speed was "8.58kmph"
        And that my marathon time is "4 hours 55 minutes"
