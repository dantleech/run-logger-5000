SF4 Run Logger Workshop
-----------------------

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

1. Add a new route `/routes/{id}/view`
2. Show the route details (i.e. title and number of meters)
