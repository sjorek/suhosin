--TEST--
Testing: suhosin.executor.eval.whitelist with suhosin.executor.eval.exists_forbidden=1
--SKIPIF--
<?php include "../skipifnotcli.inc"; ?>
--INI--
suhosin.log.sapi=512
suhosin.executor.disable_eval=0
suhosin.executor.eval.whitelist=function_exists
suhosin.executor.eval.blacklist=
suhosin.executor.eval.exists_forbidden=1
--FILE--
<?php
    eval('function_exists("intval");');
?>
--EXPECTF--
ALERT - evaluated existence of a function not within eval whitelist: eval('function_exists("intval");') (attacker 'REMOTE_ADDR not set', file '%s(2) : eval()'d code', line 1)

Fatal error: SUHOSIN - Evaluating existence of functions not within eval whitelist is forbidden by configuration in %s(2) : eval()'d code on line 1
