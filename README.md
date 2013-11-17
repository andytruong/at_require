at_require
==========

Module provides drush command to download all dependencies for your modules.

Easier for modules/themes to require external libraries.

To define dependencies, modules/themes need defined ./config/at_require.yml

```yml
projects:
  ctools:
    type: module
    version: 1.3
  mustangostang/spyc
    type: composer
    version: 0.5.*
  twig:
    type: library
    download:
      type: git
      url: https://github.com/fabpot/Twig.git
      revision: v1.14.2
  jquery.cycle:
    type: library
    download:
      type: file
      url: http://malsup.github.io/jquery.cycle.all.js
```

To downlaod requirements:

```bash
$ # Download dependencies for all modules
$ drush at_require
$ # Download dependencies for specific module
$ drush at_require module_name
```
