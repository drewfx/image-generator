<?php

if (!function_exists('url')) {
    function url() {
        return $_SERVER['SERVER_NAME'];
    }
}