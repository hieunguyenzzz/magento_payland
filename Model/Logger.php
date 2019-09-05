<?php
namespace Hieu\Payland\Model;

class Logger {
    /**
     * @param $str
     */
    static function error($str) {
        $folder = BP . '/var/log/paylands';
        if (!file_exists($folder)) {
            mkdir($folder, 0777, true);
        }
        if (is_array($str)) {
            $str = print_r($str, true);
        }
        file_put_contents($folder . '/error.log', "$str\n", FILE_APPEND);
    }

    /**
     * @param $str
     */
    static function debug($str) {
        $folder = BP . '/var/log/paylands';
        if (!file_exists($folder)) {
            mkdir($folder, 0777, true);
        }
        if (is_array($str)) {
            $str = print_r($str, true);
        }
        file_put_contents($folder . '/debug.log', "$str\n", FILE_APPEND);
    }
}