<?php
$year = 2025;
$month = 1;

$daysInMonth = date('t', mktime(0, 0, 0, $month, 1, $year));

echo "January $year\n";
echo "Mo Tu We Th Fr Sa Su\n";

$dayOfWeek = date('w', mktime(0, 0, 0, $month, 1, $year));
for ($i = 0; $i < $dayOfWeek; $i++) {
    echo "   ";
}

for ($day = 1; $day <= $daysInMonth; $day++) {
    echo sprintf("%2d ", $day);
    if (($day + $dayOfWeek - 1) % 7 == 0) {
        echo "\n";
    }
}
?>