<?php declare(strict_types=1);

namespace  Modules\Department\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class RoomStatus extends Enum
{
    const Occupied = 'occupied';
    const Vacant = 'vacant';
    const PartiallyVacant = 'partially vacant';
    const UnderMaintenance = 'under maintenance';
}
