<?php

namespace Infrastructure\Http\Resources\Traits;

use Infrastructure\Eloquent\Models\Link;
use Infrastructure\Eloquent\Models\NavigationLink;
use Infrastructure\Eloquent\Models\ShowroomCategory;
use Infrastructure\Eloquent\Models\ShowroomInspiration;

trait FullPathGenerator
{
    /**
     *
     * @param  Link  $model
     * @return string
     */
    protected function generateFullPath(Link $model): string
    {
        if ($model->linkable) {
            if ($model->linkable instanceof ShowroomInspiration) {
                $fullPath = '/'.$model->linkable->slug;
            } else {
                $paths = $model->linkable ? [$model->linkable->slug] : [];
                $parent = $model->linkable;
                if ($parent->parent_id) {
                    array_unshift($paths, $parent->parent->slug);
                    if ($parent->parent->parent_id) {
                        array_unshift($paths, $parent->parent->slug);
                        if ($parent->parent->parent->parent_id) {
                            array_unshift($paths, $parent->parent->parent->slug);
                        }
                    }
                }
                $fullPath = implode('/', $paths);
            }
        } else {
            $fullPath = $model->url ?? '';
        }

        return $fullPath;
    }

    /**
     * @param  ShowroomCategory  $showroomCategory
     * @return string
     */
    protected function generatePathForShowroom(ShowroomCategory $showroomCategory): string
    {
        $paths = [$showroomCategory->slug];
        if ($showroomCategory->parent_id) {
            array_unshift($paths, $showroomCategory->parent->slug);
            if ($showroomCategory->parent->parent_id) {
                array_unshift($paths, $showroomCategory->parent->slug);
                if ($showroomCategory->parent->parent->parent_id) {
                    array_unshift($paths, $showroomCategory->parent->parent->slug);
                }
            }
        }
        return implode('/', $paths);
    }
}
