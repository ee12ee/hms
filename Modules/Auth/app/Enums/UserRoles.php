<?php declare(strict_types=1);

namespace Modules\Auth\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class UserRoles extends Enum
{
    const superAdmin='superAdmin';
    const manager='manager';
    const admissionStaff='admissionStaff';
    const ambulanceStaff='ambulanceStaff';
    const HrStaff='hrStaff';
}
