<?php
/**
 * @author      Oleh Kravets <oleh.kravets@snk.de>
 * @copyright   Copyright (c) 2021 schoene neue kinder GmbH  (https://www.snk.de)
 * @license     https://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

declare(strict_types=1);

namespace Snk\RecurringUpgradeDisabler\Plugin\Setup;

class InstallSchemaPlugin extends AbstractInstallPlugin
{
    private const RECURRING_SCHEMA_SCRIPT_NAME = 'Recurring';

    /**
     * @return string
     */
    protected function getRecurringScriptName(): string
    {
        return self::RECURRING_SCHEMA_SCRIPT_NAME;
    }
}
