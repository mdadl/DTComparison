# DTComparison
This is a standalone CLI PHP application to do special DateTime comparison.

## Getting Started
These instructions will get you a copy of the project up and running on your machine.

### Prerequisites
You need the following software as a minimum to run this application.

```
PHP Version 5.6
```
If you are about to run the test suites then you need the following software as well.

```
PHPUnit 5.X
```
Please note that if you are running a higher version of PHP, ex. 7 then you will require different version of PHPUnit. For more information please refer to [PHPUnit documentation](https://phpunit.de/).


### Installing
Navigate to your desired folder to install the application and run the following command:

```
$ git clone https://github.com/mdadl/DTComparison.git
```

### Running the application
Navigate to the application root folder and run the following commands:

```
$ cd src
$ php app.php
```
It will tell you the correct syntax on how to run the application. For your information, it will be:

```
Correct syntax: function_name datetime1 datetime2 [return_type [timezone]]
Supported function_name are: number_of_days, number_of_weekdays, number_of_complete_weeks.
Supported return_type are: days for days, y for years, h for hours, i for minutes, s for seconds.
```

### Running the tests
Navigate to the application root folder and run the following commands:

```
$ cd test
$ phpunit date_util_test.php
```
It will run the following tests:

```
number_of_days:
A whole calendar month
A whole calendar month minus one second
A whole inverted calendar month
A whole calendar year
A whole calendar leap year

number_of_days_in_hours:
A whole calendar month
A whole calendar month minus one second
A whole inverted calendar month
A whole calendar year
A whole calendar leap year

number_of_weekdays:
A whole calendar month
A whole calendar month minus one second
A whole inverted calendar month

number_of_weekdays_in_hours:
A whole calendar month
A whole calendar month minus one second
A whole inverted calendar month

number_of_complete_weeks:
A whole calendar month
A whole calendar year
```
