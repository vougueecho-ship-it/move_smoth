<?php
/**
 * MoveSmooth SQL Importer
 * Safe for large SQL files, handles foreign key checks, and preserves migrated table structures.
 */

// Set infinite time limit because cities.sql is large
set_time_limit(0);
ini_set('memory_limit', '512M');

echo "<html><head><title>MoveSmooth DB Importer</title></head><body style='font-family: Arial, sans-serif; background: #f4f6f9; padding: 20px; color: #333;'>";
echo "<div style='max-width: 800px; margin: 0 auto; background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);'>";
echo "<h2 style='color: #2b6cb0; border-bottom: 2px solid #e2e8f0; padding-bottom: 10px; margin-top: 0;'>MoveSmooth Database SQL Importer</h2>";

// 1. Parse .env file
$envPath = __DIR__ . '/../.env';
if (!file_exists($envPath)) {
    die("<div style='color: red; font-weight: bold;'>Error: .env file not found at $envPath. Please place this script in the public/ folder.</div></div></body></html>");
}

$env = file_get_contents($envPath);
$lines = explode("\n", $env);
$config = [];
foreach ($lines as $line) {
    $line = trim($line);
    if (empty($line) || strpos($line, '#') === 0) continue;
    if (strpos($line, '=') !== false) {
        list($key, $val) = explode('=', $line, 2);
        $config[trim($key)] = trim($val, " \t\n\r\0\x0B\"'");
    }
}

$db_host = $config['DB_HOST'] ?? '127.0.0.1';
$db_port = $config['DB_PORT'] ?? '3306';
$db_name = $config['DB_DATABASE'] ?? '';
$db_user = $config['DB_USERNAME'] ?? '';
$db_pass = $config['DB_PASSWORD'] ?? '';

if (empty($db_name)) {
    die("<div style='color: red; font-weight: bold;'>Error: DB_DATABASE not configured in .env</div></div></body></html>");
}

try {
    $pdo = new PDO("mysql:host=$db_host;port=$db_port;dbname=$db_name;charset=utf8mb4", $db_user, $db_pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES => false
    ]);
    echo "<div style='background: #ebf8ff; color: #2b6cb0; padding: 15px; border-radius: 5px; margin-bottom: 20px;'>Connected to database: <b>$db_name</b> successfully.</div>";
} catch (PDOException $e) {
    die("<div style='color: red; font-weight: bold;'>Connection failed: " . $e->getMessage() . "</div></div></body></html>");
}

// Disable foreign key checks
$pdo->exec("SET FOREIGN_KEY_CHECKS = 0");

function importSqlFile($pdo, $filePath) {
    if (!file_exists($filePath)) {
        echo "<div style='color: #dd6b20; margin-bottom: 10px;'>⚠️ File not found: <b>" . basename($filePath) . "</b> (Skipped)</div>";
        return;
    }
    
    echo "<div style='margin-bottom: 10px;'>Importing <b>" . basename($filePath) . "</b>... Please wait...</div>";
    
    $handle = fopen($filePath, "r");
    if (!$handle) {
        echo "<div style='color: red;'>Failed to open " . basename($filePath) . "</div>";
        return;
    }

    $buffer = "";
    $count = 0;
    
    while (($line = fgets($handle)) !== false) {
        $line = trim($line);
        
        // Skip comments, empty lines
        if (empty($line) || strpos($line, '--') === 0 || strpos($line, '/*') === 0) {
            continue;
        }
        
        // Skip CREATE TABLE and ALTER TABLE statements to protect the migrated table structures
        if (strpos($line, 'CREATE TABLE') === 0 || strpos($line, 'ALTER TABLE') === 0) {
            // Read until the end of the statement (semicolon) and discard it
            while (substr(trim($line), -1) !== ';') {
                if (($line = fgets($handle)) === false) break;
            }
            continue;
        }
        
        // Only run INSERT statements
        if (strpos($line, 'INSERT INTO') === 0 || !empty($buffer)) {
            $buffer .= $line . "\n";
            // Check if statement ends with semicolon
            if (substr(trim($line), -1) === ';') {
                try {
                    $pdo->exec($buffer);
                    $count++;
                } catch (Exception $e) {
                    echo "<div style='color:red; font-size: 13px;'>Error executing query block starting with: <code>" . htmlspecialchars(substr($buffer, 0, 80)) . "...</code><br>Reason: " . $e->getMessage() . "</div><br>";
                }
                $buffer = "";
            }
        }
    }
    
    fclose($handle);
    echo "<div style='background: #f0fff4; color: #38a169; padding: 10px; border-radius: 5px; margin-bottom: 20px;'>✔️ <b>Successfully imported $count data blocks from " . basename($filePath) . ".</b></div>";
}

// Empty the tables first to prevent duplicate entries if re-run
echo "<div style='margin-bottom: 10px;'>Clearing existing records to prevent duplicates...</div>";
$pdo->exec("TRUNCATE TABLE `cities`");
$pdo->exec("TRUNCATE TABLE `states`");
echo "<div style='color: #38a169; margin-bottom: 20px;'>✔️ Tables truncated.</div>";

// Run imports
importSqlFile($pdo, __DIR__ . '/../states.sql');
importSqlFile($pdo, __DIR__ . '/../cities.sql');

// Re-enable foreign key checks
$pdo->exec("SET FOREIGN_KEY_CHECKS = 1");

echo "<div style='background: #fffaf0; border-left: 4px solid #dd6b20; color: #dd6b20; padding: 15px; border-radius: 5px; margin-top: 30px;'>";
echo "<b>⚠️ IMPORTANT SECURITY NOTE:</b> Please <b>DELETE</b> the file <code>public/import_data.php</code> from your live server immediately now that the import is complete.";
echo "</div>";

echo "</div></body></html>";
