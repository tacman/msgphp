# Projection Document Transformers

A projection document transformer is bound to `MsgPhp\Domain\Projection\ProjectionDocumentTransformer`. Its purpose is
to transform arbitrary objects into documents.

## API

### `transform(object $object): array`

Transforms a domain object into its projection document.

## Basic example

```php
<?php

use MsgPhp\Domain\Projection\ProjectionDocumentTransformer;

// --- SETUP ---

class MyEntity
{
    public $id;
    public $someField;
}

class MyTransformer implements ProjectionDocumentTransformer
{
    public function transform($object): array
    {
        if ($object instanceof MyEntity) {
            return [
                'id' => $object->id,
                'some_field' => $object->someField,
            ];
        }

        throw new \LogicException();
    }
}

$transformer = new MyTransformer();

// --- USAGE ---

$entity = new MyEntity();
$document = $transformer->transform($entity);
```
