<?php

namespace Storage;

class Compression {

    private static $compress_map = [
        "gzip" => "gzcompress",
        "bz2" => "bzcompress",
        "lz4" => "lz4_compress",
        "zstd" => "zstd_compress"
    ];

    private static $decompress_map = [
        "gzip" => "gzuncompress",
        "bz2" => "bzdecompress",
        "lz4" => "lz4_uncompress",
        "zstd" => "zstd_uncompress"
    ];
    /**
     * Compress input data using method provided by filesystem.php, returns the compressed data.
     *
     * @param string $data
     * @return string Compressed data
     */
    public static function compress(string $data): string
    {
        $config = \Config::Get("storage");

        if ($config['compress'] === false) {
            return $data;
        }

        if (strlen($data) < $config['minimum_size']) {
            return $data;
        }

        $method = $config['method'];

        if (!array_key_exists($method, self::$compress_map)) {
            return $data;
        }

        $compress = self::$compress_map[$method];

        return $compress($data, $config['level']);
    }

    /**
     * Decompress input data trying methods in filesystem.php, returns the decompressed data.
     *
     * @param string $data
     * @return string 
     */
    public static function decompress(string $data): string
    {
        if ($data === null) {
            return null;
        }
        $config = \Config::Get("storage");

        # Check for methods specificed in $config['methods_to_check']
        $methods_to_check = $config['methods_to_check'];
        if (!in_array($config['method'], $methods_to_check)) {
            array_push($methods_to_check, $config['method']);
        }
        foreach ($methods_to_check as $method) {
            if (array_key_exists($method, self::$decompress_map)) {
                $decompress = self::$decompress_map[$method];
                $decompressed = @$decompress($data);

                if ($decompressed !== false) {
                    return $decompressed;
                }
            }
        }
        return $data; # Return original data if no decompression was successful.
    }
}