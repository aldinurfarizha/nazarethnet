<?php


namespace Twilio;


class VersionInfo {
    const MAJOR = "7";
    const MINOR = "12";
    const PATCH = "3";

    public static function string() {
        return implode('.', array(self::MAJOR, self::MINOR, self::PATCH));
    }
}
