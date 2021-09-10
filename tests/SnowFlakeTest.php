<?php

require_once './src/SnowFlake.php';

class SnowFlakeTest
{
    static function test() {
        $machineId = 100;
        $machineId2 = 101;
        $cnt = 5;
        while ($cnt--) {
            $sfId = \dbh\component\uuids\SnowFlake::generate($machineId);
            $sfId2 = \dbh\component\uuids\SnowFlake::generate($machineId2);
            if ($sfId == $sfId2) {
                echo '冲突='.$sfId," ",$sfId2."\n";
            } else {
                echo $sfId. " ",$sfId2."\n";
            }
        }
    }
}

SnowFlakeTest::test();
