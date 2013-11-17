<?php
namespace Drupal\at_require\Drush\Command\AtRequire;

class DependenciesFetcher {
  /**
   * @var string
   */
  private $module;

  /**
   * @var array
   */
  private $data;

  public function __construct($module) {
    drush_print_r(__CLASS__ . ': ' . $module);
    try {
      $this->module = $module;
      $this->data   = at_config($module, 'at_require')->get('projects');
    }
    catch (\Exception $e) {
      $this->fetchSpyc();
      $this->data = at_config($module, 'at_require')->get('projects');
    }
  }

  public function fetch() {
    foreach ($this->data as $name => $info) {
      at_id(new DependencyFetcher($name, $info))->fetch();
    }
  }

  private function fetchSpyc() {
    $name = 'spyc';
    $info = array(
      'type' => 'library',
      'download' => array(
        'type' => 'git',
        'url' => 'https://github.com/mustangostang/spyc.git',
        'branch' => '0.5.1',
      ),
    );

    at_id(new DependencyFetcher($name, $info))->fetch();
  }
}
