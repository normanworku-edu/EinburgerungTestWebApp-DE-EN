<?php
class DatabaseExport {
    private $host = 'localhost';
    private $port = 3306;
    private $dbname = 'german_citizenship_test_db';
    private $username = 'root';
    private $password = 'root';

    public function exportDatabase($outputFile = 'backup.sql') {
        // Escape shell arguments
        $host = escapeshellarg($this->host);
        $port = escapeshellarg($this->port);
        $dbname = escapeshellarg($this->dbname);
        $username = escapeshellarg($this->username);
        $password = escapeshellarg($this->password);
        $outputFile = escapeshellarg($outputFile);

        // Build mysqldump command
        // Note: For password, no space between -p and password
        $mysqldumpPath = '"C:\\Program Files\\MySQL\\MySQL Workbench 8.0\\mysqldump.exe"';// Use your actual path with double quotes
        $command = "$mysqldumpPath -h $host -P $port -u $username -p$this->password $dbname > $outputFile";


        // Execute the command and capture output and return status
        exec($command, $output, $return_var);

        if ($return_var === 0) {
            echo "✅ Database exported successfully to $outputFile";
        } else {
            echo "❌ Error exporting database. Return code: $return_var";
        }
    }
}

// Usage example:
$exporter = new DatabaseExport();
$exporter->exportDatabase('backup_' . date('Ymd_His') . '.sql');
?>
