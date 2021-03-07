<?php
/**
 * @author      Oleh Kravets <oleh.kravets@snk.de>
 * @copyright   Copyright (c) 2021 schoene neue kinder GmbH  (https://www.snk.de)
 * @license     https://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

declare(strict_types=1);

namespace Snk\RecurringUpgradeDisabler\Plugin\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Snk\RecurringUpgradeDisabler\Helper\Config;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Symfony\Component\Console\Output\ConsoleOutput;

abstract class AbstractInstallPlugin
{
    /**
     * @var Config
     */
    protected $config;
    /**
     * @var ConsoleOutput
     */
    protected $output;

    public function __construct(Config $config, ConsoleOutput $output)
    {
        $this->config = $config;
        $this->output = $output;
    }

    /**
     * @param InstallSchemaInterface|InstallDataInterface $subject
     * @param callable $proceed
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function aroundInstall(
        $subject,
        callable $proceed,
        $setup,
        $context
    ) {
        $moduleName = $this->getModuleName($subject);

        if (in_array($moduleName, $this->config->getModuleList())
            && $this->getScriptName($subject) === $this->getRecurringScriptName()
        ) {
            $this->output->write("\n");
            $this->output->write(sprintf(
                '<info>Recurring scripts for module "%s" have been disabled by Snk_RecurringScriptDisabler</info>',
                $moduleName
            ));
            return;
        }

        return $proceed($setup, $context);
    }

    /**
     * @param $object
     * @return string
     */
    protected function getScriptName($object): string
    {
        $class = get_class($object);
        $scriptName = explode('\\Setup\\', $class);
        $scriptName = explode('\\', $scriptName[1]);
        return $scriptName[0] ?? '';
    }

    /**
     * Retrieve class module name
     *
     * @param object $object
     * @return string
     * @see \Magento\Framework\App\Helper\AbstractHelper::_getModuleName()
     */
    protected function getModuleName($object): string
    {
        $className = get_class($object);
        $moduleName = substr($className, 0, strpos($className, '\\Setup'));
        return str_replace('\\', '_', $moduleName);
    }

    /**
     * @return string
     */
    abstract protected function getRecurringScriptName(): string;
}
