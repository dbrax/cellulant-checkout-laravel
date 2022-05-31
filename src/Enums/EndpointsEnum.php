<?php

declare(strict_types=1);

namespace Epmnzava\CellulantLaravel\Enums;

class EndpointsEnum
{
    /**
     * @string
     */
    public const GET_TOKEN = '/checkout/v2/custom/oauth/tokens';

    public const CREATE_ORDER = "/checkout/v2/custom/requests/initiate";
}
