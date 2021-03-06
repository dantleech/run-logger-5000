SF4 Run Logger Workshop
-----------------------

![runlogger](https://user-images.githubusercontent.com/530801/34525560-b1b22ab6-f09f-11e7-9993-5e125dee1b16.png)

Disclaimer
----------

This workshop provide an introduction to Symfony 4 and Flex, some previous
knowledge of Symfony or a similar MVC framework would be an advantage.

This workshop will not attempt to be architecturally sophisticated.

Brief
-----

As a keen runner, you want to be able to keep track of the runs that you make.

You realise that you want to gradually work up to running a marathon in a
years time, and you want to gradually build up your weekly runs. You have
already got some regular routes:

| Code | Route                     | Distance   |
| ---- | ------------------------- | ---------- |
| BG1  | Home to Brandenberg Gate  | 10km       |
| TG1  | Tiergarten 1              | 15km       |
| WSL3 | Weisensee Lake 3 loops    | 5km        |

And you have been recording your times in your notebook:

| Date        | Code | Time       | Notes                  |
| ----------- | ---- | ---------- | -----------------------|
| 2017-12-12  | BG1  | 50m        | Raining                |
| 2017-12-34  | TG1  | 1h5m       | Right knee was painful |
| 2018-01-02  | WSL3 | 23m        | Personal best!         |

And you often work out some simple statistics:

- **Minutes per kilometer**: `$minutes / $nbKilometers`
- **Kilometers per hour**: `$nbKilometers / $minutes * 60`
- **Marathon time**: `$minutesPerKilometer * 42.195`

In addition to being a keen runner, you are also an amazing and enthusiastic
web developer.

Make a web application which does this!

Getting Started
----------------

Pre-requsites:

- Composer
- Database (sqlite3, mysql, whatever)

Created project using:

    $ composer create-project symfony/skeleton sf4-workshop

Serve using:

    $ php -S 127.0.0.1:8000 -t public

### Database

```
$ composer require doctrine
```

- Use the `pdo_sqlite` driver (or whatever you prefer), see:
    - `config/packages/doctrine.yaml`
    - `.env`

- Create entities `src/Entity/{Route,Run}`:


```
             +---------------+
             | Route         |
             +---------------+
             | +title:string |
             | +meters:int   |
             +---------------+
                      ^
                      |
            +-----------------+
            | Run             |
            +-----------------+
            | +route:Route    |
            | +date:DateTime  |
            | +seconds:int    |
            +-----------------+
```

Don't forget to add the mapping annotations:
https://symfony.com/doc/current/doctrine.html#creating-an-entity-class

And:

```
$ ./bin/console doctrine:schema:create --force
```

List routes
-----------

```gherkin
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
```

1. Create a controller at `src/Controller/RouteController.php`
2. Make it extend `Controller`
3. Use `@Route("/routes")` to route
4. Include Twig `composer require twig`
5. Create some routes (`INSERT INTO route (title, distance) VALUES ("5K Park Run", 5000)`).
6. Render all routes as a table

Create Route
------------

```gherkin
Scenario: Create route
    Given I am on the route listing page
    When I create a new route "Weisensee to Kreuzberg" with distance "10km"
    And I am on the route listing page
    Then I should see the following routes listed:
        | title                  |
        | Weisensee to Kreuzberg |
```

1. Add a new route `/routes/add`.
2. Create a symfony form for the route (`composer require form`) and
   [documentation](http://symfony.com/doc/current/forms.html).
3. Validate the route, persist it and redirect to the list page.

View Route
----------

```gherkin
Scenario: View route
    Given the following routes exist:
        | title               | distance |
        | Home to Inviqa      | 7km      |
    And I am on the route listing page
    When I click on route "Home to Inviqa"
    Then I should see the "Home to Inviqa" route details
```

1. Add a new route `/routes/{id}/view`.
2. Show the route details (i.e. title and number of meters).
3. Link to view route from route list.

**Bonus**: Use a parameter converter to load the doctrine entity.

Add Run
-------

```gherkin
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
```

1. Create `RunController` and add a log run action with route
   `/routes/{routeId}/runs/log`
2. Ensure that the runs are listed on the route view page.

Show Run Statistics
--------------------

```gherkin
    Scenario: View run statistics
        Given I ran "35 minutes" on route "Weisensee lake"
        And I am on the route page for "Weisensee lake"
        Then I should see that my average speed was "8.58kmph"
        And that my marathon time is "4 hours 55 minutes"
```

1. Create a new class `App\Service\Statistics` with methods `averageSpeed(int
   $meters, int $seconds): int` and `marathonTime(int $meters, int $seconds):
   int`. They should return __meters per hour__ and __time in seconds__ respectively.
2. Create a Twig extension `App\Twig\RunLoggerExtension extends
   Twig\Extension`. Add filters `marathon_time` and `mph`.
3. Apply the columns for the new values in the run table.
