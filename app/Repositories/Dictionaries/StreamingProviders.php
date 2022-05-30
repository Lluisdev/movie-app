<?php

namespace App\Repositories\Dictionaries;

final class StreamingProviders
{
    public const DEFAULT = '1';
    public const NETFLIX = '2';
    public const AMAZON = '3';
    public const HBO = '4';
    public const DISNEY = '5';

    public static array $map = [
        self::DEFAULT => 'Select a Provider',
        self::NETFLIX => 'Netflix',
        self::AMAZON => 'Amazon Prime Video',
        self::HBO => 'HBO',
        self::DISNEY => 'Disney Plus',
    ];
}