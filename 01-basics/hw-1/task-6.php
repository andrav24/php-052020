<?php
$rows = "";
for ($row = 1; $row <= 10; $row++) {
    $rowIsEven = ($row % 2 == 0);
    $data = "";
    for ($col = 1; $col <= 10; $col++) {
        $colIsEven = ($col % 2 == 0);
        if ($rowIsEven && $colIsEven) {
            $data .= "<td>(" . ($row * $col) . ")</td>";
        } elseif (!$rowIsEven && !$colIsEven) {
            $data .= "<td>[" . ($row * $col) . "]</td>";
        } else {
            $data .= "<td>" . ($row * $col) . "</td>";
        }
    }
    $rows .= "<tr>$data</tr>";
}
echo "<table style='width:50%'>$rows</table>";
