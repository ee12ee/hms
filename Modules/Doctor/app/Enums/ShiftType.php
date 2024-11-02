<?php declare(strict_types=1);

namespace Modules\Doctor\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class ShiftType extends Enum
{
    const day = 'day';
    const evening = 'evening';
    const night = 'night';
}
