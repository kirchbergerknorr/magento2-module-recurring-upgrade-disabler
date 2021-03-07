## SNK Recurring Upgrade Disabler

Magento 2 module for disabling recurring upgrade scripts

---

### Overview

---
Magento 2 has the the possibility to implement upgrade scripts that run every time `setup:upgrade` is run. While in general this is a very useful feature, some modules might slow down the execution of `setup:upgrade` quite significantly.

For example `Magento\Customer\Setup\RecurringData` runs reindexing of the customer grid and this can take a lot of time in which the script will be running and the shop will be down. Even though the issue is claimed to have be fixed since Magento 2.3.6 and is now on supposed to be run only "when needed", checking this "if it is needed" takes some time.

Another example `Magento\Indexer\Setup\Recurring` checks if there are any new indexers and if so it sets their status as invalid. It is for sure an important thing, but one could argue this has to be done every time `setup:upgrade` is run.

So the module allows to specify a list of modules for which recurring upgrade scripts will be disabled.

### Installation

---

The module can be installed with comsposer:

```
composer require snk/magento2-module-recurring-upgrade-disabler
```

### Requirements

---

The module requires:
- Magento 2.3 and above
- PHP 7.2 and above

### Configuration

---
The list of modules:
- `Stores->Configuration->Advanced:System->Recurring Upgrade Scripts`

### License

---

MIT

### Authors

---

Oleh Kravets  
[oleh.kravets@snk.de](mailto:oleh.kravets@snk.de)