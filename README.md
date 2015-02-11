AliasGenerator
==============

This project provides helpers to generate pseudo-random alias.


Installation
============

Add AliasBundle to your vendor/bundles/ dir
------------------------------------------

::

    $ git submodule add git://github.com/jlaso/AliasGenerator.git app/models/alias



Usage
=====


For example generating alias for an url based on id

```
    $generator = new AliasGenerator();
    $alias     = $generator->encode($id,4);
```

And for decode

```
    $generator = new AliasGenerator();
    $id        = $generator->decode($alias);
```
