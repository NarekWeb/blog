<?php

namespace Infrastructure\Eloquent\Orderable\Drivers;

use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Infrastructure\Eloquent\Orderable\OrderableDriver;

final class ShowroomProductOrderableDriver extends OrderableDriver
{
    public function id(Builder $builder, string $direction): void
    {
        $builder->orderBy('showroom_products.id', $direction);
    }

    public function price(Builder $builder, string $direction): void
    {
        $builder->orderBy(DB::raw('COALESCE(showroom_products.discount_price, showroom_products.price)'), $direction);
    }

    public function relevance(Builder $builder, string $direction): void
    {
        $builder->orderBy('showroom_products.relevance', $direction);
    }
}
