<?php

namespace Infrastructure\Eloquent\Orderable\Drivers;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Infrastructure\Eloquent\Orderable\OrderableDriver;
use Infrastructure\Eloquent\Models\ShopProductVariation;

final class ShopProductOrderableDriver extends OrderableDriver
{
    public function id(Builder $builder, string $direction): void
    {
        $builder->orderBy('shop_products.id', $direction);
    }

    public function price(Builder $builder, string $direction): void
    {
        $builder
            ->leftJoinSub(
                ShopProductVariation::query()
                    ->where('order', 0)
                    ->select(['shop_product_id', 'price', 'discount_price']),
                '__price_variation',
                fn (JoinClause $join) => $join->on('shop_products.id', '=', '__price_variation.shop_product_id')
            )
            ->orderBy(DB::raw('COALESCE(__price_variation.discount_price, __price_variation.price)'), $direction);
    }

    public function relevance(Builder $builder, string $direction): void
    {
        $builder->orderBy('shop_products.relevance', $direction);
    }
}
