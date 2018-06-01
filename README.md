# xmlauthor-example-command

A git project that acts as an example of an xmlauthor command.

## Prerequisites

* Git
* PHP `5.5.9+`
* [Composer installed](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx) globally

## Install

* Install dependencies
 
    ```bash 
    composer install
    ```
    
* Try `hello-world` command:

    ```bash
    bin/hello-world --configFilename=scapesettings.yml.dist
    ```

### Building own command

* New commands should:

    * be written to run in a Symfony 3.4 console application. See [Symfony's documentation on creating commands](https://symfony.com/doc/3.4/console.html).have their own git repository project
    * have tests (one or more of PHPUnit/Behat/etc) stored within the project repository
    * be compatible with Symfony 3.4, and 
    * make good use of the `symfony/console` project. i.e. `$ composer require symfony/console:~3.4`
    * adhere to the [convention that allows the command to be automatically registered](https://symfony.com/doc/3.4/console.html#registering-the-command).
    * be installed by end users as a composer package
    * reuse existing libraries where possible. Such as;
      *  [PHP's Standard PHP Library](http://php.net/manual/en/book.spl.php) 
    * use [PSR-4 autoloading](https://www.php-fig.org/psr/psr-4/) where possible.
    * be cross-platform compatible; Run on the command line on Windows 10, MacOS High Sierra and Linux.
    * provide README.md instructions on how to install and use the command from .


* Example command:

    ```php
    # src/Command/NewCommand.php
    namespace Forikal\PackageName\Command;
    
    use Forikal\Library\Command\AbstractCommand;
    
    class NewCommand extends AbstractCommand
    {
        public function __construct()
        {
            # Specify command's name
            parent::__construct('new-command');
        }
    
        /**
         * {@inheritdoc}
         */
        protected function execute(InputInterface $input, OutputInterface $output)
        {
            try {
                $configFilename = $input->getOption('configFilename');
                $configOptions = $this->getConfigOptions($configFilename);
    
                dump($configOptions);
            } catch (FileNotFoundException $e) {
                $output->writeln(
                    $e->getMessage()
                );
            }
        }
    }
    ```

## Test

```bash
vendor/bin/phpunit
```

# TODO

[ ] Tests with virtual filesystem
