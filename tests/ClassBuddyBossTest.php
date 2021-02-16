<?php

namespace WPSL\BuddyBoss;

use PHPUnit\Framework\TestCase;
use wpCloud\StatelessMedia\WPStatelessStub;
use WPSL\BuddyBoss\BuddyBoss;

/**
 * Class ClassBuddyBossTest
 */

class ClassBuddyBossTest extends TestCase {

  public static $functions;

  public function setUp(): void {
    self::$functions = $this->createPartialMock(
      ClassBuddyBossTest::class,
      ['add_filter', 'apply_filters']
    );

    $this::$functions->method('apply_filters')->will($this->returnArgument(1));
  }

  public function testShouldInitModule() {
    self::$functions->expects($this->exactly(1))
      ->method('add_filter')
      ->with('stateless_skip_cache_busting');

    $budyboss = new BuddyBoss();
    $budyboss->module_init([]);
  }

  public function testShouldSkipCacheBusting() {
    $budyboss = new BuddyBoss();

    $this->assertEquals('https://test.test/buddyboss-platform/test', $budyboss->skip_cache_busting(null, 'https://test.test/buddyboss-platform/test'));
  }

  public function add_filter() {
  }

  public function apply_filters() {
  }

  public function debug_backtrace($a, $b) {
  }
}

function add_filter($a, $b, $c = 10, $d = 1) {
  return ClassBuddyBossTest::$functions->add_filter($a, $b, $c, $d);
}

function apply_filters($a, $b) {
  return ClassBuddyBossTest::$functions->apply_filters($a, $b);
}

function strpos() {
  return true;
}

function ud_get_stateless_media() {
  return WPStatelessStub::instance();
}
