# PSR-3: Logger

The main goal of PSR-3 logger is to allow libraries to receive a `Psr\Log\LoggerInterface` object and write logs to it in a simple and universal way.
For more details about PSR-3 Logger please visit [here](https://www.php-fig.org/psr/psr-3/)

This project is just an example how to implement psr-3 logger, if you want to add logger in your project use monolog logger package.
For more details please visit this [link](https://github.com/Seldaek/monolog)
  
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
 - Check storage/log directory to find the generated log file.