<?php

namespace XmlSquad\Example\Tests\Command;

use XmlSquad\Example\Command\HelloWorldCommand;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;
use PHPUnit\Framework\TestCase;

final class HelloWorldCommandTest extends TestCase
{

    const TMP_TEST_DATA_DIR = "tests/tmp-test-data";

    public function setUp()
    {
        if (file_exists(SELF::TMP_TEST_DATA_DIR .'/HelloWorld.txt')) {
            unlink(SELF::TMP_TEST_DATA_DIR .'/HelloWorld.txt');
        }
    }

    public function tearDown()
    {
        unlink(SELF::TMP_TEST_DATA_DIR .'/HelloWorld.txt');
    }

    public function testExecute()
    {
        $application = new Application();
        $application->add(new HelloWorldCommand());

        $command = $application->find(HelloWorldCommand::NAME);
        $commandTester = new CommandTester($command);
        $commandTester->execute(array(
            'command'  => $command->getName(),
            '--targetDirectory'=> SELF::TMP_TEST_DATA_DIR,
            '--configFilename' => 'XmlAuthoringProjectSettings.yaml.dist',
        ));

        $output = $commandTester->getDisplay();
        $this->assertContains("[HelloWorld.txt] successfully written.\n", $output);

        $commandTester = new CommandTester($command);
        $commandTester->execute(array(
            'command'  => $command->getName(),
            '--targetDirectory'=> SELF::TMP_TEST_DATA_DIR,
            '--configFilename' => 'XmlAuthoringProjectSettings.yaml.dist',
        ));
        $output = $commandTester->getDisplay();
        $this->assertContains("[HelloWorld.txt] already exists.\n", $output);
    }
}
