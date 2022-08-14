<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class StatusTipo extends Enum
{
    const ABERTO =   1;
    const ANDAMENTO =   2;
    const ENCERRADO = 2;
    const REABERTO = 0;
}
