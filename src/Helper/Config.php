<?php
/**
 * @author      Oleh Kravets <oleh.kravets@snk.de>
 * @copyright   Copyright (c) 2021 schoene neue kinder GmbH  (https://www.snk.de)
 * @license     https://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

declare(strict_types=1);

namespace Snk\RecurringUpgradeDisabler\Helper;

use Magento\Framework\App\Config\ScopeConfigInterface;

class Config
{
    private const CONFIG_PATH_MODULE_LIST = 'system/recurring_upgrade/disabled_module_list';

    /**
     * @var ScopeConfigInterface
     */
    private $config;

    public function __construct(ScopeConfigInterface $config)
    {
        $this->config = $config;
    }

    /**
     * @return string[]
     */
    public function getModuleList(): array
    {
        $configValue = (string) $this->config->getValue(self::CONFIG_PATH_MODULE_LIST);

        $moduleNames = array_filter(
            array_map('trim', explode(',', $configValue)),
            static function ($module) {
                // only a-zA-Z0-9 and _ are allowed
                return !preg_match('/\W/', $module);
            }
        );

        return $moduleNames;
    }
}
