<?php declare(strict_types=1);

namespace Modules\Doctor\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Active()
 * @method static static Inactive()
 * @method static static Resigned()
 */
final class DoctorStatues extends Enum
{
    const Active ='active';
    const Inactive ='leave';
    const Resigned ='resigned';
}
