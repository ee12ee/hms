<?php declare(strict_types=1);

namespace Modules\Department\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class AnesthetizationTypes extends Enum
{
    const GeneralAnesthesia = 'general anesthesia';
    const LocalAnesthesia = 'local anesthesia';
    const RegionalAnesthesia = 'regional anesthesia';
    const SpinalAnesthesia = 'spinal anesthesia';
    const EpiduralAnesthesia = 'epidural anesthesia';
    const IntravenousAnesthesia = 'intravenous anesthesia';
    const ContinuousAnesthesia = 'continuous anesthesia';
    const SedationAnesthesia= 'sedation anesthesia';
}
