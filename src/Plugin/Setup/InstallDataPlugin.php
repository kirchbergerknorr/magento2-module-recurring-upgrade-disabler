<?php
/**
 * @author      Oleh Kravets <oleh.kravets@snk.de>
 * @copyright   Copyright (c) 2021 schoene neue kinder GmbH  (https://www.snk.de)
 * @license     https://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

declare(strict_types=1);

namespace Snk\RecurringUpgradeDisabler\Plugin\Setup;

class InstallDataPlugin extends AbstractInstallPlugin
{
    private const RECURRING_DATA_SCRIPT_NAME = 'RecurringData';

    /**
     * @return string
     */
    protected function getRecurringScriptName(): string
    {
        return self::RECURRING_DATA_SCRIPT_NAME;
    }
}
