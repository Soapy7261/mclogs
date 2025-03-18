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
    "maxLines" => 25_000,

    /**
     * Compress data before storing it
     * 
     * This is recommended since logs usually compress well
     */
    "compress" => true,

    /**
     * Method to use for compression
     * 
     * Valid methods: "gzip", "bzip2", "zstd" (requires extention, recommended), "lz4" (requires extention)
     * 
     * Only used if compress is true
     */
    "method" => "zstd",

    /**
     * Methods to check for compression support
     * 
     * Only useful if you've changed the method when you already have logs stored
     * 
     * You do not need to put your current method in this array as it will be checked automatically
     * 
     * Still used if compress is false, assuming you have methods in the array
     * 
     * Valid methods: "gzip", "bzip2", "zstd" (requires extention), "lz4" (requires extention)
     */
    "methods_to_check" => [ "gzip" ],

    /**
     * Compression level
     *
     * Higher levels mean better compression but more CPU usage
     * 
     * Ranges from 1-9 on gzip, 1-9 on bzip2, 1-19 on zstd and 1-17 on lz4
     * 
     * Only used if compress is true
     */
    "level" => 19,

    /**
     * Minimum size to compress
     * 
     * Data will not be compressed if it is smaller than this
     * 
     * Only used if compress is true
     */
    "minimum_size" => 1 * 1024,
];
