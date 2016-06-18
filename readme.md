# TimeKeeper
A series of scopes for Laravel Models to do with Time Management.

Please note: This project is a work in progress.

#Installation

This package requires PHP 5.6+ and Laravel 5.

To install through composer include the package in your `composer.json`.

    "midnite81/timekeeper": "0.1.*"

Run `composer install` or `composer update` to download the dependencies or you can run `composer require midnite81/timekeeper`.

##Laravel 5 Integration

There is no service provider to install. Simply include the trait to the model you need to use it on.


# Example Usage

On your model simply add the use statement to the Model you want to use it on

    use Midnite81\TimeKeeper\Traits\TimeKeeper;

    class YourModel
    {
        use TimeKeeper;

        ...

    }

Then reference it in your controller or service etc;

    public function check() {

        $overlap = YourModel::noOverlap('2016-01-01 15:32:00', '2016-01-01 16:46:00')->exists();

        ...

    }

# Relationship Diagram

![Relationship Diagram](https://raw.githubusercontent.com/midnite81/timekeeper/master/diagram/relationships.png)
