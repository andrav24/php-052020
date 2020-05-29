<?php
const TOTAL_DRAWINGS = 80;
const FELTPEN_DRAWINGS = 23;
const PENCIL_DRAWINGS = 40;

echo "На школьной выставке " . TOTAL_DRAWINGS . " рисунков. " . FELTPEN_DRAWINGS . " из них выполнены фломастерами, " .
    PENCIL_DRAWINGS . " карандашами, а " . (TOTAL_DRAWINGS - FELTPEN_DRAWINGS - PENCIL_DRAWINGS) . " — красками.";
