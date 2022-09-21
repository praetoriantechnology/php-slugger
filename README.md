PHP Slugger
===========

![Tests status](https://github.com/praetoriantechnology/php-slugger/workflows/Tests/badge.svg)
![GitHub tag (latest SemVer)](https://img.shields.io/github/v/tag/praetoriantechnology/php-slugger?label=latest%20version&sort=semver)

Simple library for building a slugs out of strings.

Usage:
```php\
use Praetorian\Slugger\Slugger;

$slugger = new Slugger();
echo $slugger->slugify('sample$$@#%$ test ąęćźż'); //sample-test-aeczz
echo PHP_EOL;
echo $slugger->slugify('sample$$@#%$ test ąęćźż', divider: '_'); //sample_test_aeczz
```

# Contribution

Any pull requests or issues reported are more than welcome.

# License

MIT