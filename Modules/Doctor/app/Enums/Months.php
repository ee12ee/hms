<?php declare(strict_types=1);

namespace Modules\Doctor\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class Months extends Enum
{
    const January = 'January';
    const February = 'February';
    const March = 'March';
    const April = 'April';
    const May = 'May';
    const June = 'June';
    const July = 'July';
    const August = 'August';
    const September = 'September';
    const October = 'October';
    const November = 'November';
    const December = 'December';
}
