AliasGenerator
==============

This project provides helpers to generate pseudo-random alias.

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/d7d70442-b52c-4072-8e03-45e6a47e1ca2/mini.png)](https://insight.sensiolabs.com/projects/d7d70442-b52c-4072-8e03-45e6a47e1ca2)

[![Build Status](https://travis-ci.org/jlaso/AliasGenerator.svg?branch=master)](https://travis-ci.org/jlaso/AliasGenerator)

Installation
============

Add AliasBundle to your vendor/bundles/ dir
------------------------------------------

::

    $ git submodule add git://github.com/jlaso/AliasGenerator.git app/models/alias
    
or use composer
    
    composer require jlaso/alias-generator


Usage
=====


For example generating alias for an url based on id

```
    $generator = new AliasGenerator();
    $alias     = $generator->encode($id);
```

And for decode

```
    $generator = new AliasGenerator();
    $id        = $generator->decode($alias);
```

Start docker container to test
==============================

```
    docker-compose up --build
```

once started log in into the container

```
    docker-compose exec php /bin/bash
```

and run the tests

```
    phpunit
```
