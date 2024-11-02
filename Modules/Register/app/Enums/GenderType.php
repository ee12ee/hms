<?php declare(strict_types=1);

namespace  Modules\Register\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class GenderType extends Enum
{
    const Male = 'male';
    const Female = 'female';
}
