--TEST--
Test for bug #1782: Make sure we use SameSite=Strict cookies (>= PHP 7.3)
--SKIPIF--
<?php
require __DIR__ . '/../utils.inc';
check_reqs('PHP >= 7.3');
?>
--ENV--
XDEBUG_CONFIG=idekey=testing
--INI--
xdebug.default_enable=1
default_charset=utf-8
xdebug.filename_format=
xdebug.profiler_enable=0
xdebug.remote_enable=1
xdebug.remote_cookie_expire_time=1234
--FILE--
<?php
var_dump( xdebug_get_headers( ) );
?>
--EXPECTF--
%sbug01782.php:2:
array(1) {
  [0] =>
  string(%d) "Set-Cookie: XDEBUG_SESSION=testing; expires=%s; Max-Age=123%d; path=/; SameSite=Strict"
}
