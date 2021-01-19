<?php

use PHPUnit\Framework\TestCase;
use wpCloud\StatelessMedia\WPStatelessStub;
use wpCloud\StatelessMedia\Compatibility;
use WPSL\BuddyBoss;

/**
 * Class ClassBuddyBossTest
 */

class ClassBuddyBossTest extends TestCase {

  public static $functions;

  public function setUp(): void {
    self::$functions = $this->createPartialMock(
      ClassBuddyBossTest::class,
      ['add_filter', 'add_action', 'apply_filters', 'do_action']
    );

    $this::$functions->method('apply_filters')->will($this->returnArgument(1));
  }

  public function testShouldInitModule() {

  }

}

function ud_get_stateless_media() {
  return WPStatelessStub::instance();
}
