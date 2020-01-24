<?php

/**
 * Generate SQL for inserting data from database table 1 to database table 2
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);

function print2($content = '', $die = 0)
{
    echo '<pre>';
    print_r($content);
    echo '</pre>';

    if ($die) exit;
}

if (!$_REQUEST)
{
?>
<!DOCTYPE html>
<html>
    <body>
        <form name="generate_sql" id="generate_sql" method="post">
            <div>
                <label for="database1">Database 1</label>
                <input type="text" id="database1" name="database1">
            </div><hr>

            <div>
                <label for="database1table">Table 1</label>
                <input type="text" id="database1table" name="database1table">
            </div><hr>

            <div>
                <label for="database2">Database 2</label>
                <input type="text" id="database2" name="database2">
            </div><hr>

            <div>
                <label for="database2table">Table 2</label>
                <input type="text" id="database2table" name="database2table">
            </div><hr>

            <div>
                <label for="csvFields">Table 1 Comma Separated Fields</label>
                <input type="text" id="csvFields" name="csvFields">
            </div><hr>

            <div>
                <input type="submit" id="generate" value="Generate">
            </div>
        </form>
    </body>
</html>

<?php
}
else
{
    $database1      = isset($_REQUEST['database1']) ? trim($_REQUEST['database1']) : null;
    $database1table = isset($_REQUEST['database1table']) ? trim($_REQUEST['database1table']) : null;
    $database2      = isset($_REQUEST['database2']) ? trim($_REQUEST['database2']) : null;
    $database2table = isset($_REQUEST['database2table']) ? trim($_REQUEST['database2table']) : null;
    $csvFields      = isset($_REQUEST['csvFields']) ? trim($_REQUEST['csvFields']) : null;

    if ((!$database1 || !$database2 || !$database1table || !$database2table || !$csvFields) && $_REQUEST)
    {
        echo "Required data missing <button onclick='window.history.go(-1);'>Back &laquo;</button>";
        exit;
    }

    $fields = explode(',', $csvFields);
    $fields = array_map('trim', $fields); // Trim whitespace

    $db1Select = $db2Select = $fieldMapper = [];

    foreach ($fields as $field) {
        $field = str_ireplace('`', '', $field);

        $db1Select[] = "$database1.$database1table.$field";
        $db2Select[] = "$database2.$database2table.$field";
        $fieldMapper[] = "$database1.$database1table.$field = $database2.$database2table.$field";
    }

    echo "<h1>Generated SQL <button onclick='window.history.go(-1);'>Back &laquo;</button></h1><hr>";

    echo "<br>SET GLOBAL FOREIGN_KEY_CHECKS=0;<br>";

    echo "<br>INSERT INTO $database1.$database1table<br>(<br>";

    echo implode(',<br>', $db1Select);

    echo "<br>)<br> SELECT<br>";

    echo implode(',<br>', $db2Select);

    echo "<br>FROM $database2.$database2table<br>";

    echo "ON DUPLICATE KEY UPDATE<br>";

    echo implode(',<br>', $fieldMapper).';';

    echo "<br><br>SET GLOBAL FOREIGN_KEY_CHECKS=1;";
}
