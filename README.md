Fxp Require Asset
=================

[![Latest Stable Version](https://poser.pugx.org/fxp/require-asset/v/stable.svg)](https://packagist.org/packages/fxp/require-asset)
[![Latest Unstable Version](https://poser.pugx.org/fxp/require-asset/v/unstable.svg)](https://packagist.org/packages/fxp/require-asset)
[![Build Status](https://travis-ci.org/francoispluchino/fxp-require-asset.svg)](https://travis-ci.org/francoispluchino/fxp-require-asset)
[![Coverage Status](https://img.shields.io/coveralls/francoispluchino/fxp-require-asset.svg)](https://coveralls.io/r/francoispluchino/fxp-require-asset?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/francoispluchino/fxp-require-asset/badges/quality-score.png)](https://scrutinizer-ci.com/g/francoispluchino/fxp-require-asset)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/43b207f9-6d4c-4d99-927d-e7bbd710d6ee/mini.png)](https://insight.sensiolabs.com/projects/43b207f9-6d4c-4d99-927d-e7bbd710d6ee)

The Fxp Require Asset is a helper for assetic and twig to manage automatically the
required assets. It allows to define the required assets (script, style) directly
in the Twig template and adds the HTML links of the assets automatically to the
right place in the template, while removing duplicates.

##### Features include:

- Filter the copy of the assets of each packages by:
  - file extensions (and debug mode)
  - glob patterns
- Configure:
  - the assetic filters of asset package by the extensions
  - the assetic filters for all asset packages
  - the custom asset package
  - the rewrite output path of asset
- Compiling the final list of asset in cache for increase performance
- Assetic filters:
  - `requirecssrewrite`: for rewrite the url of another require asset in css file
- Twig extension for:
  - require a script and inject the link in the good place defined in the twig base template
  - require a style and inject the link in the good place defined in the twig base template
  - automatically move all inline script in the same place defined in the twig base template
  - automatically move all inline style in the same place defined in the twig base template

Documentation
-------------

The bulk of the documentation is located in the `Resources/doc/index.md`:

[Read the Documentation](Resources/doc/index.md)

[Read the Release Notes](https://github.com/francoispluchino/fxp-require-asset/releases)

Installation
------------

All the installation instructions are located in [documentation](Resources/doc/index.md).

License
-------

This library is under the MIT license. See the complete license in the bundle:

[Resources/meta/LICENSE](Resources/meta/LICENSE)

About
-----

Fxp Require Asset is a [François Pluchino](https://github.com/francoispluchino) initiative.
See also the list of [contributors](https://github.com/francoispluchino/fxp-require-asset/contributors).

Reporting an issue or a feature request
---------------------------------------

Issues and feature requests are tracked in the [Github issue tracker](https://github.com/francoispluchino/fxp-require-asset/issues).
