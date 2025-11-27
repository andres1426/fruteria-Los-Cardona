<?php
declare(strict_types=1);

$dbConfig = [
    'host' => '127.0.0.1',
    'dbname' => 'fruteria',
    'user' => 'root',
    'pass' => '',
    'charset' => 'utf8mb4',
];

/**
 * Retorna una instancia PDO reutilizable.
 */
function db(): PDO
{
    static $pdo = null;
    global $dbConfig;

    if ($pdo instanceof PDO) {
        return $pdo;
    }

    $dsn = sprintf(
        'mysql:host=%s;dbname=%s;charset=%s',
        $dbConfig['host'],
        $dbConfig['dbname'],
        $dbConfig['charset']
    );

    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];

    try {
        $pdo = new PDO($dsn, $dbConfig['user'], $dbConfig['pass'], $options);
    } catch (PDOException $e) {
        exit('Error de conexión: ' . $e->getMessage());
    }

    return $pdo;
}

