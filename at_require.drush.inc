<?php

/**
 * @file ./drush/at_reqruire.inc
 */

use \Drupal\at_require\Drush\Command\AtRequire as AtRequireCommand;
use \Drupal\at_require\Drush\Command\AtRequireSpyc as AtRequireSpycCommand;

/**
 * Implements hook_drush_command()
 */
function at_require_drush_command() {
  $commands['at_require'] = array(
    'description' => 'Help download all missing dependencies.',
    'arguments' => array(
      'module' => 'Download dependencies for specific module',
    ),
    'examples' => array(
      'drush at_require' => 'Download dependencies for all modules',
      'drush at_require module_name' => 'Download dependencies for specific module',
    ),
    'aliases' => array('at-require', 'atr'),
    'bootstrap' => DRUSH_BOOTSTRAP_FULL,
  );
  return $commands;
}

class DrushMakeProject_AtRequire_Library extends \DrushMakeProject_Library {
  /**
   * Override default value of parent.
   */
  protected function generatePath() {
   return parent::generatePath($base = FALSE);
  }
}

/**
 * Callback for at_require command.
 */
function drush_at_require($module = 'all') {
  $command = new AtRequireCommand($module);
  $command->execute();
}
