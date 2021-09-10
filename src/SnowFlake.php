<?php

namespace dbh\component\uuids;
class SnowFlake
{
    const EPOCH = 1479533469598;  //开始时间
    const max12bit = 4095; // 12位随机序列号范围
    const max41bit = 1000000000000; // 41位初始时间戳
    static $machineId = 1; // 10位机器码

    /**
     *
     * @param int $machineId 机器编码 个人定义
     * @return float|int
     */
    public static function generate($machineId = 1)
    {
        if ($machineId) {
            self::$machineId = $machineId;
        }
        // 当前时间戳微秒取整
        $time = floor(microtime(true) * 1000);
        // 当前时间与开始时间时间差
        $time -= self::EPOCH;
        // 41位二进制码
        $base = decbin(self::max41bit + $time);
        // 第一位补0
        $base = str_pad($base, 42, "0", STR_PAD_LEFT);
        // 10位机器码
        $machineId = str_pad(decbin(self::$machineId), 10, "0", STR_PAD_LEFT);
        // 12随机序列号
        $random = str_pad(decbin(mt_rand(0, self::max12bit)), 12, "0", STR_PAD_LEFT);
        // 64位
        $base = $base . $machineId . $random;
        return bindec($base);
    }
}
