RefLibRisBundle
===

[![Build Status](https://travis-ci.org/Funstaff/RefLibRisBundle.svg?branch=master)](https://travis-ci.org/Funstaff/RefLibRisBundle)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Funstaff/RefLibRisBundle/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/Funstaff/RefLibRisBundle/?branch=master)
[![Latest Stable Version](https://poser.pugx.org/funstaff/ref-lib-ris-bundle/v/stable)](https://packagist.org/packages/funstaff/ref-lib-ris-bundle)
[![License](https://poser.pugx.org/funstaff/ref-lib-ris-bundle/license)](https://packagist.org/packages/funstaff/ref-lib-ris-bundle)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/f7eaf3b4-f3a8-4918-b701-8e5f8237cfba/mini.png)](https://insight.sensiolabs.com/projects/f7eaf3b4-f3a8-4918-b701-8e5f8237cfba)

* Author: Bertrand Zuchuat <bertrand.zuchuat@gmail.com>
* License: MIT

This bundle provide an interface for [Funstaff RefLibRis](https://github.com/Funstaff/RefLibRis)


## Configuration

__Minimal configuration__
```yml
ref_lib_ris:
    mapping_fields:
        TY: ['type']
        AU: ['creator', 'author']
        ...
```

__Full configuration__
```yml
ref_lib_ris:
    classes:
        ris_fields_mapping: 'Funstaff\RefLibRis\RisFieldsMapping'
        record_processing: 'Funstaff\RefLibRis\RecordProcessing'
        ris_definition: 'Funstaff\RefLibRis\RisDefinition'
        ris_writer: 'Funstaff\RefLibRis\RisWriter'
    mapping_fields:
        TY: ['type']
        AU: ['creator', 'author']
        ...
```

## Use
```php
$recordDb = [
    'type' => ['BOOK'],
    'author' => ['Book Author'],
    'title' => ['Book Title'],
];

$record = $this->get('ref_lib_ris.record_processing')->process($recordDb);
$ris = $this->get('ref_lib_ris.ris_writer')->addRecord($record)->process();
```

## Found a bug

If you found a bug, *please* let me know. The best way is to file a report at 
[http://github.com/funstaff/RefLibRisBundle/issues](http://github.com/funstaff/RefLibRisBundle/issues).
