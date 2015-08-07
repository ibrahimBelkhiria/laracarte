<?php

namespace Laracarte\Presenters;

use Laracarte\ContentParser\ContentParserFacade as ContentParser;
use Laracasts\Presenter\Presenter;
use Thomaswelton\LaravelGravatar\Facades\Gravatar;

class UserPresenter extends Presenter
{
    /**
     * @return string
     */
    public function profileImage($width = null)
    {
        if (isset($this->entity->avatar)) {
            if (!is_null($width)) {
                $width = "?w=" . $width;
            }

            return config('upload_paths.avatars') . $this->entity->avatar . $width;
        }

        return Gravatar::src($this->entity->email, $width);
    }

     /**
     * @return string
     */
    public function biography()
    {
        return ContentParser::transform($this->entity->bio);
    }
}
