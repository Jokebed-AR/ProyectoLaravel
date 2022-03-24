<?php

namespace App\Helpers;


class LaravelMedia
{
    public static function getImage($model, $variable)
    {
        $mediaItems = $model->media;
        $model[$variable] = null;
        if (isset($mediaItems))
        {
            foreach ($mediaItems as $mediaItem)
            {
                if($mediaItem['collection_name'] === $variable)
                {
                    $model[$variable] =str_replace('http://', 'https://', $mediaItem->getFullUrl());
                    break;
                }
            }
        }
        unset($model->media);

        return (isset($model[$variable])) ? $model[$variable] : '';
    }

    public static function getImages($model, $variable)
    {
        $mediaItems = $model->media;
        $model[$variable] = null;
        $images = [];
        if (isset($mediaItems))
        {
            foreach ($mediaItems as $mediaItem)
            {
                if($mediaItem['collection_name'] === $variable)
                {
                    $images[] =str_replace('http://', 'https://', $mediaItem->getFullUrl());
                }
            }
        }
        unset($model->media);
        return $images;
    }

    public static function getVideos($model, $variable)
    {
        $mediaItems = $model->media;
        $model[$variable] = null;
        $videos = [];
        if (isset($mediaItems))
        {
            foreach ($mediaItems as $mediaItem)
            {
                if($mediaItem['collection_name'] === $variable)
                {
                    $videos[] =str_replace('http://', 'https://', $mediaItem->getFullUrl());
                }
            }
        }
        unset($model->media);
        return $videos;
    }

    public static function getDocuments($model, $variable)
    {
        $mediaItems = $model->media;
        $model[$variable] = null;
        $documents = [];
        if (isset($mediaItems))
        {
            foreach ($mediaItems as $mediaItem)
            {
                if($mediaItem['collection_name'] === $variable)
                {
                    $url = str_replace('http://', 'https://', $mediaItem->getFullUrl());

                    $documents[$mediaItem->getCustomProperty('name')] = $url;
                }
            }
        }
        unset($model->media);
        return $documents;
    }

    public static function getDocumentsByName($model)
    {
        $mediaItems = $model->media;
        $documents = [];

        if (isset($mediaItems))
        {
            foreach ($mediaItems as $mediaItem)
            {
                $url = str_replace('http://', 'https://', $mediaItem->getFullUrl());
                $documents[$mediaItem['collection_name']] = $url;
            }
        }
        unset($model->media);
        return $documents;
    }

}