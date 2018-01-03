SF4 Run Logger Workshop
-----------------------

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

Created project using:

    $ composer create-project symfony/skeleton sf4-workshop

Serve using:

    $ php -S 127.0.0.1:8000 -t public

Database
--------

```
$ composer require doctrine
```

- Use the `pdo_sqlite` driver
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
            | +minutes:int    |
            +-----------------+
```

Don't forget to add the mapping annotations:
https://symfony.com/doc/current/doctrine.html#creating-an-entity-class

And:

```
$ ./bin/console doctrine:schema:create --force
```


