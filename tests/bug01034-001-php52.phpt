--TEST--
Test for bug #1034: path coverage [1]
--SKIPIF--
<?php if (!version_compare(phpversion(), "5.2", '>=')) echo "skip PHP 5.2 needed\n"; ?>
<?php if (!version_compare(phpversion(), "5.3", '<')) echo "skip PHP 5.2 needed\n"; ?>
--FILE--
<?php
include 'dump-branch-coverage.inc';

xdebug_start_code_coverage(XDEBUG_CC_UNUSED | XDEBUG_CC_DEAD_CODE | XDEBUG_CC_BRANCH_CHECK);

include 'bug01034-001.inc';

xdebug_stop_code_coverage(false);
$c = xdebug_get_code_coverage();
dump_branch_coverage($c);
?>
--EXPECTF--
0 1 2 3 
!42
caught
ifelse
- branches
  - 00; OP: 00-04; line: 10-12 HIT; out1: 05  X ; out2: 08 HIT
  - 05; OP: 05-07; line: 13-14  X ; out1: 12  X 
  - 08; OP: 08-11; line: 15-16 HIT; out1: EX  X 
  - 12; OP: 12-16; line: 18-19  X 
- paths
  - 0 5 12:  X 
  - 0 8: HIT

loopy
- branches
  - 00; OP: 00-03; line: 02-04 HIT; out1: 04 HIT
  - 04; OP: 04-06; line: 04-04 HIT; out1: 14 HIT; out2: 10 HIT
  - 07; OP: 07-09; line: 04-04 HIT; out1: 04 HIT
  - 10; OP: 10-13; line: 05-06 HIT; out1: 07 HIT
  - 14; OP: 14-18; line: 07-08 HIT
- paths
  - 0 4 14: HIT
  - 0 4 10 7 4 14: HIT

trycatch
- branches
  - 00; OP: 00-09; line: 21-24 HIT; out1: EX  X 
  - 14; OP: 14-14; line: 26-26 HIT; out1: 15 HIT; out2: EX  X 
  - 15; OP: 15-19; line: 27-29 HIT
- paths
  - 0: HIT
  - 14 15: HIT

{main}
- branches
  - 00; OP: 00-27; line: 02-36 HIT
- paths
  - 0: HIT
