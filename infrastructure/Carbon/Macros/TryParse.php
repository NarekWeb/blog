<?php

namespace Infrastructure\Carbon\Macros;

use DateTimeInterface;
use Illuminate\Support\Carbon;
use Infrastructure\AbstractMacro;
use Carbon\Exceptions\InvalidFormatException;

final class TryParse extends AbstractMacro
{
    protected function register(): void
    {
        Carbon::macro('tryParse', function ($arg): ?Carbon {
            if ($arg instanceof DateTimeInterface) {
                return Carbon::instance($arg);
            }

            if (!is_string($arg)) {
                return null;
            }

            try {
                return Carbon::parse($arg);
            } catch (InvalidFormatException) {
                return null;
            }
        });
    }
}
