Feature: Log run
    As a runner
    In order that I can monitor and improve my performance
    I need to be able to log my runs

    Scenario: Log run
        Given the following routes exist:
            | title               | distance |
            | Home to Inviqa      | 7km      |
        And I am on the route page for "Home to Inviqa"
        When I log a run with time "35 minutes"
        Then I should see a success notification
        And the run should be listed on the route page
