<?php
/**
 * MySQLi Database Connection
 * File: api/mysqli_connection.php
 * Alternative database connection using MySQLi instead of PDO
 */

// Database configuration
$db_config = [
    'host' => 'localhost',
    'username' => 'root',
    'password' => '',
    'database' => 'meditrack_system',
    'charset' => 'utf8mb4'
];

// Create MySQLi connection
$mysqli = new mysqli(
    $db_config['host'], 
    $db_config['username'], 
    $db_config['password'], 
    $db_config['database']
);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Set charset
$mysqli->set_charset($db_config['charset']);

/**
 * Execute a query and return result
 * @param mysqli $mysqli Database connection
 * @param string $query SQL query
 * @return mysqli_result|bool Query result
 */
function executeQuery($mysqli, $query) {
    $result = $mysqli->query($query);
    if (!$result) {
        error_log("MySQL Error: " . $mysqli->error);
        return false;
    }
    return $result;
}

/**
 * Execute a prepared statement
 * @param mysqli $mysqli Database connection
 * @param string $query SQL query with placeholders
 * @param string $types Parameter types (e.g., 'ssi' for string, string, int)
 * @param array $params Parameters to bind
 * @return mysqli_result|bool Query result
 */
function executePreparedQuery($mysqli, $query, $types = '', $params = []) {
    $stmt = $mysqli->prepare($query);
    if (!$stmt) {
        error_log("MySQL Prepare Error: " . $mysqli->error);
        return false;
    }
    
    if (!empty($types) && !empty($params)) {
        $stmt->bind_param($types, ...$params);
    }
    
    $result = $stmt->execute();
    if (!$result) {
        error_log("MySQL Execute Error: " . $stmt->error);
        $stmt->close();
        return false;
    }
    
    $queryResult = $stmt->get_result();
    $stmt->close();
    
    return $queryResult;
}

/**
 * Get a single row from query result
 * @param mysqli_result $result Query result
 * @return array|null Associative array or null
 */
function fetchSingleRow($result) {
    if ($result && $result->num_rows > 0) {
        return $result->fetch_assoc();
    }
    return null;
}

/**
 * Get all rows from query result
 * @param mysqli_result $result Query result
 * @return array Array of associative arrays
 */
function fetchAllRows($result) {
    $rows = [];
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
    }
    return $rows;
}

/**
 * Escape string for SQL (alternative to prepared statements)
 * @param mysqli $mysqli Database connection
 * @param string $string String to escape
 * @return string Escaped string
 */
function escapeString($mysqli, $string) {
    return $mysqli->real_escape_string($string);
}

/**
 * Get last inserted ID
 * @param mysqli $mysqli Database connection
 * @return int Last inserted ID
 */
function getLastInsertId($mysqli) {
    return $mysqli->insert_id;
}

/**
 * Get affected rows count
 * @param mysqli $mysqli Database connection
 * @return int Number of affected rows
 */
function getAffectedRows($mysqli) {
    return $mysqli->affected_rows;
}

/**
 * Close database connection
 * @param mysqli $mysqli Database connection
 */
function closeMysqliConnection($mysqli) {
    if ($mysqli) {
        $mysqli->close();
    }
}

// Optional: Set error reporting for debugging
// Remove in production
if (defined('DEBUG_MODE') && DEBUG_MODE) {
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
}
?>