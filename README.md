# PSR-3: Logger

The main goal is to allow libraries to receive a `Psr\Log\LoggerInterface` object and write logs to it in a simple and universal way.
For more details about PSR-3 Logger please visit [here](https://www.php-fig.org/psr/psr-3/)
 
### Prerequisites
```
  Make sure to use a version of php >= 7.3.9 (php -v).
  Make sure you have composer installed. 
```

### How to use
 - Download (as zip) and extract or git clone the project under your web server's root directory.
 
 - Install dependencies with `Composer` first:
   ```bash
   $ composer install
   ```
 - To run the tests use `phpunit`:   
   ```bash
   $ ./vendor/bin/phpunit --testdox tests
   ```
 - To run to application use `php`: 
    ```bash   
    $ php index.php
    ```  
 If `php` command not working in your terminal/command line, then you might need to add it to your environment Path.