<?php

exec(__DIR__ . "/tests");

ini_set("memory_limit", "512M");

define("TMP", "/home/vagrant/caketmp/");

require(__DIR__ . "/lib/Cake/Console/ShellDispatcher.php");

define("CONFIG", __DIR__ . "/app/Config/");

// This is the least gross way of bootstrapping the framework
$shellDispatcher = new ShellDispatcher([
	__DIR__ . "/Console/cake.php",
	"-working",
	__DIR__
]);

define('CORE_TEST_CASES', CAKE . 'Test/Case');

$_SERVER["DB"] = $_SERVER["DB"] ?? "sqlite";

App::uses("CakeTestCase", "TestSuite");
App::uses("CakeTestModel", "TestSuite/Fixture");
App::uses("CakeFixtureManager", "TestSuite/Fixture");
App::uses("CakeTestFixture", "TestSuite/Fixture");
App::uses("ClassRegistry", "Utility");
App::uses("AppHelper", "View/Helper");

ClassRegistry::config(array('ds' => 'test', 'testing' => true));
CakeFixtureManager::initialize();

// This ensures that PhpUnit converts PHP errors, warnings, notices, etc to Exceptions which fail the tests
restore_error_handler();
restore_error_handler();
// Disable Cake's exception handler while tests are running
restore_exception_handler();
restore_exception_handler();

// freeze the time
CakeTestCase::time();
