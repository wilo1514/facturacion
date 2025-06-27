<?php
/**
 * Clase de conexión PDO única para toda la aplicación.
 * Requiere que en Config/Config.php existan:
 *   DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_CHARSET
 */
class Conexion
{
    /** @var PDO */
    private $conect;

    public function __construct()
    {
        /* DSN con host del contenedor ('db') y utf8mb4 */
        $dsn = sprintf(
            'mysql:host=%s;dbname=%s;charset=%s',
            DB_HOST,
            DB_NAME,
            DB_CHARSET
        );

        try {
            $this->conect = new PDO($dsn, DB_USER, DB_PASS, [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]);
        } catch (PDOException $e) {
            /* Lanza la excepción para que el caller la maneje o se loguee */
            throw new RuntimeException('Error de conexión: ' . $e->getMessage(), 0, $e);
        }
    }

    /** Devuelve la instancia PDO */
    public function conect()
    {
        return $this->conect;
    }

    /* ---------- Singleton opcional ---------- */
    private static $instancia = null;

    public static function getInstance(): PDO
    {
        if (self::$instancia === null) {
            self::$instancia = (new self())->conect();
        }
        return self::$instancia;
    }
}
