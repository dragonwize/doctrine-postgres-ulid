<?php

declare(strict_types=1);

namespace Dragonwize\Doctrine\Type;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\DBAL\Types\Exception\InvalidType;
use Doctrine\DBAL\Types\Exception\ValueNotConvertible;
use Doctrine\DBAL\Types\Type;

final class PgxUlidType extends Type
{
    public const string NAME = 'pgx_ulid';

    public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
    {
        return 'ulid';
    }

    /**
     * @throws ConversionException
     */
    public function convertToPHPValue(mixed $value, AbstractPlatform $platform): ?string
    {
        if (!\is_string($value) && $value !== null) {
            throw ValueNotConvertible::new($value, $this->getName());
        }

        return $value;
    }

    public function getName(): string
    {
        return self::NAME;
    }

    /**
     * @throws ConversionException
     */
    public function convertToDatabaseValue(mixed $value, AbstractPlatform $platform): ?string
    {
        if ($value !== null && !\is_string($value)) {
            throw InvalidType::new($value, $this->getName(), ['null', 'string']);
        }

        return $value;
    }

    /**
     * Gets an array of database types that map to this Doctrine type.
     *
     * @return array<int, string>
     */
    public function getMappedDatabaseTypes(AbstractPlatform $platform): array
    {
        return ['ulid'];
    }
}
