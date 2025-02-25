<?php 

function multiplicationTable($tableNum, $size) {
    if ($size <= 0) {
        return "";
    } 
    $result = "
    <div class=\"mult-table-{$tableNum}-size-{$size}\" 
    style=\"padding:5px;
            border-radius:5px;
            border-color:black; 
            border: solid 2px;
            display : inline-block; 
            margin : 5px
    \">
    ";
    for ($i = 1; $i <= $size; $i++) {
        $result .= "{$tableNum} x {$i} = " . ($tableNum * $i) . "<br>";
    }
    $result .= "</div>";
    return $result;
}

?>