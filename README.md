# Transaction Commission Calculator

The **Transaction Commission Calculator** project is responsible for processing transaction data, calculating commissions, and handling exchange rates. This service reads transactions from a file, processes each transaction to calculate the appropriate commission, and handles any exceptions that may occur during the process.

### Requirements

1. **PHP**:
   - Make sure you have PHP installed (version 8.3 or higher). You can download it from [php.net](https://www.php.net/downloads).

2. **Composer**:
   - Composer is required to manage the project's dependencies. You can install Composer by following the instructions at [getcomposer.org](https://getcomposer.org/download/).
   
3. **Git**:
   - Git is required to install the project else you have to download project manually. You can download and install Git from [git-scm.com](https://git-scm.com/).


### Installation

- Clone the project repository to your local machine and change directory.

```sh
git clone https://github.com/taraszh/transaction_commission_calculator.git
cd transaction_commission_calculator
```

- Install dependencies.
```sh
composer install
```

### Usage

To calculate commissions, run the following commands:

```sh
cd client_code
php app.php input.txt
```
   
### Run tests:
```sh
cd ..
vendor/bin/phpunit tests
```
----------------------------------------------------------------
## Test task requirements:

1. It **must** have unit tests. If you haven't written any previously, please take the time to learn it before making the task, you'll thank us later.
    1. Unit tests must test the actual results and still pass even when the response from remote services change (this is quite normal, exchange rates change every day). This is best accomplished by using mocking.
1. As an improvement, add ceiling of commissions by cents. For example, `0.46180...` should become `0.47`.
1. It should give the same result as original code in case there are no failures, except for the additional ceiling.
1. Code should be extendible – we should not need to change existing, already tested functionality to accomplish the following:
    1. Switch our currency rates provider (different URL, different response format and structure, possibly some authentication);
    2. Switch our BIN provider (different URL, different response format and structure, possibly some authentication);
    3. Just to note – no need to implement anything additional. Just structure your code so that we could implement that later on without braking our tests;
1. It should look as you'd write it yourself in production – consistent, readable, structured. Anything we'll find in the code, we'll treat as if you'd write it yourself. Basically it's better to just look at the existing code and re-write it from scratch. For example, if `'yes'`/`'no'`, ugly parsing code or `die` statements are left in the solution, we'd treat it as an instant red flag.
1. Use composer to install testing framework and any needed dependencies you'd like to use, also for enabling autoloading.
