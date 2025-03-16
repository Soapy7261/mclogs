<?php

$config = [

    /**
     * Available storages with ID, name and class
     *
     * The class should implement \Storage\StorageInterface
     */
    "storages" => [
        "m" => [
            "name" => "MongoDB",
            "class" => "\\Storage\\Mongo",
            "enabled" => false
        ],
        "f" => [
            "name" => "Filesystem",
            "class" => "\\Storage\\Filesystem",
            "enabled" => true
        ],
        "r" => [
            "name" => "Redis",
            "class" => "\\Storage\\Redis",
            "enabled" => false
        ]
    ],

    /**
     * Current storage id for new data
     *
     * Should be a key in the $storages array
     */
    "storageId" => "f",

    /**
     * Time in seconds to store data after put or last renew
     */
    "storageTime" => 30 * 24 * 60 * 60,

    /**
     * Maximum string length to store
     *
     * Will be cut by \Filter\Pre\Length
     */
    "maxLength" => 5 * 1024 * 1024,

    /**
     * Maximum number of lines to store
     *
     * Will be cut by \Filter\Pre\Lines
     */
    "maxLines" => 25_000

];
