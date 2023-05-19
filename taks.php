<?php

$data = <<<'EOD'
X,-9\\\10\100\-5\\\0\\\\,A
Y,\\13\\1\, B
Z,\\\5\\\-3\\2\\\800,C
EOD;

$lines = explode("\n", $data);
$result = [];
foreach ($lines as $line) {
    $parts = explode(',', $line);
    $letter1 = $parts[0];
    $letter2 = trim($parts[2]);
    $numbers = preg_split('/\\\\+/', $parts[1]);
    foreach ($numbers as $number) {
        if (is_numeric($number)) {
            $result[] = [$letter1, (int)$number, $letter2];
        }
    }
}
usort($result, function ($a, $b) {
    return $a[1] <=> $b[1];
});
$counter = [];
foreach ($result as &$row) {
    if (!isset($counter[$row[0]])) {
        $counter[$row[0]] = 0;
    }
    $counter[$row[0]]++;
    $row[] = $counter[$row[0]];
}
foreach ($result as $row) {
    echo implode(', ', $row) . "<br>\n";
}
?>