<?php

namespace Infrastructure\Http\Enums;

enum VacancyType: string
{
    case FULL_TIME = 'FULL_TIME';
    case PART_TIME = 'PART_TIME';
    case FULL_TIME_AND_PART_TIME = 'FULL_TIME_AND_PART_TIME';
}
