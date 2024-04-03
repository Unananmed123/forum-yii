<?php

namespace app\repository;

use app\entity\sections;

class ForumRepository
{
    public static function getSections(): array
    {
        return Sections::find()->all();
    }

    public static function createSection($title, $desc)
    {
        $section = new Sections();
        $section->title = $title;
        $section->description = $desc;

        $section->save();
        return $section->id;
    }


}