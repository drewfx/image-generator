<?php

namespace App\Articles;

Interface ArticleInterface
{
    // plot x y coordinates w/ text
    public function plot($img, $x, $y, $value);

    // save file as Title + date + time
    public function save($img, $name);
}