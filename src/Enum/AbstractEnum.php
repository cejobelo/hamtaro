<?php
namespace Hamtaro\Enum;

/**
 * An enumeration.
 *
 * @author Phil'dy Jocelyn Belcou <pj.belcou@gmail.com>
 */
abstract class AbstractEnum
{
    /** Les options clé => label. */
    const OPTIONS = [];

    /**
     * Cette méthode renvoie le label d'une constante.
     *
     * @param string $key
     * @return array
     */
    public static function getLabel($key)
    {
        return static::OPTIONS[$key] ?? '';
    }

    /**
     * Cette méthode renvoie true si la clé passée en paramètre existe.
     *
     * @param string $key
     * @return bool
     */
    public static function exists($key)
    {
        return array_key_exists($key, static::OPTIONS);
    }
}