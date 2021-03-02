<?php

class DATABASE_CONFIG
{
	public $default = [
		'persistent' => false,
		'database' => 'cakephp_test',
		'prefix' => '',
	];

	public $test = [
		'persistent' => false,
		'database' => 'cakephp_test',
		'prefix' => '',
	];

	public $test2 = [
		'persistent' => false,
		'database' => 'cakephp_test2',
		'prefix' => '',
	];

	public $test_database_three = [
		'persistent' => false,
		'database' => 'cakephp_test3',
		'prefix' => '',
	];

	public function __construct()
	{
		$identities = [
			'mysql' => [
				'datasource' => 'Database/Mysql',
				'host' => '127.0.0.1',
				'password' => 'password',
				'login' => 'root',
				'port' => '33306',
			],
			'pgsql' => [
				'datasource' => 'Database/Postgres',
				'host' => '127.0.0.1',
				'login' => 'postgres',
				'database' => 'cakephp_test',
				'schema' => [
					'default' => 'public',
					'test' => 'public',
					'test2' => 'test2',
					'test_database_three' => 'test3',
				],
			],
			'sqlite' => [
				'datasource' => 'Database/Sqlite',
				'database' => [
					'default' => ':memory:',
					'test' => ':memory:',
					'test2' => sys_get_temp_dir() . '/cakephp_test2.db',
					'test_database_three' => sys_get_temp_dir() . '/cakephp_test3.db',
				],
			],
		];

		$db = $_SERVER['DB'];

		echo "\n\nDatabase is " . $db . "\n\n";

		foreach (['default', 'test', 'test2', 'test_database_three'] as $source) {
			$config = array_merge($this->{$source}, $identities[$db]);
			if (is_array($config['database'])) {
				$config['database'] = $config['database'][$source];
			}
			if (!empty($config['schema']) && is_array($config['schema'])) {
				$config['schema'] = $config['schema'][$source];
			}
			$this->{$source} = $config;
		}
	}
}
