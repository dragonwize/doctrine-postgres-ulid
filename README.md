Doctrine Postgres ULID
======================
Doctrine DBAL column type for Postgres pgx_ulid extension.

## Requirements

Technically, this can (for now) be used with any DB type that is `ulid` in the DB.
However, this will probably diverge in the future.

This is designed to work with the Postgresql extension [pgx_ulid](https://github.com/pksunkara/pgx_ulid).

The pgx_ulid extension or some other extension that provides the `ulid` column type
to Postgres must be installed for this to work.

## Usage

### Symfony
https://symfony.com/doc/current/doctrine/dbal.html#registering-custom-mapping-types

```yaml
# config/packages/doctrine.yaml
doctrine:
    dbal:
        types:
            pgx_ulid: \Dragonwize\Doctrine\Type\PgxUlidType
```

### Doctrine Direct
https://www.doctrine-project.org/projects/doctrine-dbal/en/4.4/reference/types.html#custom-mapping-types

## For use in Symfony consider using symfony/doctrine-bridge

[symfony/doctrine-bridge](https://github.com/symfony/doctrine-bridge) provides a ULID
Doctrine DBAL type already and it works in more DB's and situations. 
The doctrine-bridge version is great if you need the flexibility it provides.

This `ulid` type is desgined for simplicity in a specific scenario.
* You must be using a DB that uses the `ulid` column type. (eg. Postgres with pgx_ulid)
* That type must be returned as a standard 26 char string.
* You must provide the ULID genaration. [symfony/uid component](https://github.com/symfony/uid) is one option for this. @todo Later this will support using DB based generation.

Under those conditions we can use a simple string type instead of an object as the 
PHP value which greatly simplifies value handling in many scenarios.


