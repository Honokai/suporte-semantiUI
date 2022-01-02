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
    const ABERTO =   "aberto";
    const ANDAMENTO =   "em andamento";
    const ENCERRADO = "encerrado";
    const REABERTO = "reaberto";
}
