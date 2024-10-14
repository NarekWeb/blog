<?php

namespace Infrastructure\Http\Enums;

enum FrontendLinkType: string
{
    case URL = 'URL';
    case PRODUCT_CATEGORY = 'PRODUCT_CATEGORY';
    case SHOWROOM_CATEGORY = 'SHOWROOM_CATEGORY';
    case SHOWROOM_INSPIRATION = 'SHOWROOM_INSPIRATION';
}
