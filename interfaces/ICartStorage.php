<?php
/**
 * Defines the storages interface
 * @author Otavio Carvalho <otaviolcarvalho@gmail.com>
 */

namespace OvCart\Storage;

interface ICartStorage {
    function add($key, $value);
    function remove($key);
    function getAll();
    function get($key);
    function removeAll();
}