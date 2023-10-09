<?php

require_once __DIR__ . "/config.php";

class EZQuery
{
    /* --------------------------------- Var -------------------------------- */
    private PDO $pdo;
    private bool $debug = false;

    /* ----------------------------- Constructor ---------------------------- */
    public function __construct()
    {
        // Connection to the DB
        $pdo = new PDO("mysql:host=" . HOST . ";dbname=" . DB_NAME, USERNAME, PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->pdo = $pdo;
    }

    /**
     * Echo the query executed and the args binding
     */
    public function debug(?bool $debug = true): void
    {
        $this->debug = $debug;
    }

    /**
     * Execute a SELECT query
     */
    public function executeSelect(string $query, ...$args): array
    {
        // Replace % ? by args
        $queryArgs = $this->convertArgs($query, $args);
        $query = $queryArgs['query'];
        $args = $queryArgs['args'];

        // Debug
        if ($this->debug) $this->displayQuery($query, $args);

        // Prepare query
        $stmt = $this->pdo->prepare($query);

        // Bind Args
        foreach ($args as $i => $arg)
            $stmt->bindValue($i + 1, $arg);

        // Execute query
        $stmt->execute();

        // Return results
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Execute an EDIT query (insert, update, delete, ...)
     */
    public function executeEdit(string $query, ...$args): int
    {
        // Replace % ? by args
        $queryArgs = $this->convertArgs($query, $args);
        $query = $queryArgs['query'];
        $args = $queryArgs['args'];

        // Debug
        if ($this->debug) $this->displayQuery($query, $args);

        // Prepare query
        $stmt = $this->pdo->prepare($query);

        // Bind Args
        foreach ($args as $i => $arg)
            $stmt->bindValue($i + 1, $arg);

        // Execute query
        $stmt->execute();

        // Return num rows affected
        return $stmt->rowCount();
    }

    /**
     * Echo the query and the args binding
     */
    private function displayQuery(string $query, array $args): void
    {
        echo "<br><strong>$query<br><pre><i>";
        print_r($args);
        echo "</i></pre></strong><br>";
    }

    /**
     * Convert the %, ? by the args
     */
    private function convertArgs(string $query, array $args): array
    {
        // Args to bind
        $argsToBind = [];

        // Split into a table the string $where
        $split = str_split($query);

        // replace % by the value
        // Stock the value of ? into $this->args
        $count = count($split);
        for ($i = $j = 0; $i < $count; $i++) {
            switch ($split[$i]) {
                case '\\': // Skip the next char
                    $i++;
                    break;
                case '%': // Replace
                    $split[$i] = $args[$j++];
                    break;
                case '?': // Bind
                    $argsToBind[] = $args[$j++];
                    break;
            }
        }

        return ['query' => join('', $split), 'args' => $argsToBind];
    }
}
