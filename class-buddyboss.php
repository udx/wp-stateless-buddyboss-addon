<?php

namespace SLCA\BuddyBoss;

use wpCloud\StatelessMedia\Compatibility;
use wpCloud\StatelessMedia\Utility;

/**
 * Class BuddyBoss
 */
class BuddyBoss extends Compatibility {
  protected $id = 'buddyboss';
  protected $title = 'BuddyBoss';
  protected $constant = 'WP_STATELESS_COMPATIBILITY_BUDDYBOSS';
  protected $description = 'Ensures compatibility with BuddyBoss.';
  protected $plugin_file = [ 'buddyboss-platform/bp-loader.php' ];
  protected $sm_mode_not_supported = [ 'stateless' ];

  /**
   * @param $sm
   */
  public function module_init( $sm ) {
    add_filter( 'stateless_skip_cache_busting', array( $this, 'skip_cache_busting' ), 10, 2 );
  }

  /**
   * Skip cache busting for template file name.
   * @param $return
   * @param $filename
   * @return mixed
   */
  public function skip_cache_busting( $return, $filename ) {
    $info = pathinfo( $filename );
    $backtrace = debug_backtrace( DEBUG_BACKTRACE_IGNORE_ARGS, 8 );
    if( empty( $info[ 'extension' ] ) && strpos( $backtrace[ 6 ][ 'file' ], '/buddyboss-platform/' ) !== false ) {
      return $filename;
    }
    return $return;
  }
}
