<?php

namespace App\Models;

class Address
{
    public const LAT_REGX = '^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$^';
    public const LNG_REGX = '^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$^';
}
