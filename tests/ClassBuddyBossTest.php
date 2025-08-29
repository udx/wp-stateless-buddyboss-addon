<?php

namespace SLCA\BuddyBoss;

use PHPUnit\Framework\TestCase;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use Brain\Monkey;
use Brain\Monkey\Functions;

/**
 * Class ClassBuddyBossTest
 */

class ClassBuddyBossTest extends TestCase {

  // Adds Mockery expectations to the PHPUnit assertions count.
  use MockeryPHPUnitIntegration;

  const TEST_URL = 'https://test.test';
  const TEST_FILE = self::TEST_URL . '/buddyboss-platform/test';

  public function setUp(): void {
		parent::setUp();
		Monkey\setUp();
  }

  public function tearDown(): void {
		Monkey\tearDown();
		parent::tearDown();
	}

  public function testShouldInitHooks() {
    $budyboss = new BuddyBoss();

    $budyboss->module_init([]);

    self::assertNotFalse( has_filter('stateless_skip_cache_busting', [ $budyboss, 'skip_cache_busting' ]) );
  }

  public function testShouldCountHooks() {
    $budyboss = new BuddyBoss();

    Functions\expect('add_action')->times(0);
    Functions\expect('add_filter')->times(1);

    $budyboss->module_init([]);
  }

  public function testShouldSkipCacheBusting() {
    $budyboss = new BuddyBoss();

    $this->assertEquals(
      self::TEST_FILE, 
      $budyboss->skip_cache_busting('some-value', self::TEST_FILE)
    );
  }

  public function testShouldNotSkipCacheBusting() {
    $budyboss = new BuddyBoss();

    $this->assertEquals(
      'some-value', 
      $budyboss->skip_cache_busting('some-value', self::TEST_URL . '/avatar.png')
    );
  }
}

function debug_backtrace($a) {
  return [
    '6' => [
      'file' => '/buddyboss-platform/',
    ],
  ];
}
