<?php

use ImportWPAddon\XLSX\XLSXReader;

function iwp_xlsx_read_file_matching_ext($input_filepath)
{
    $file_parts = explode('.', basename($input_filepath));
    if ($file_parts[count($file_parts) - 1] !== 'xlsx') {
        return;
    }

    $xlsx = new XLSXReader($input_filepath);
    $sheets = $xlsx->getSheetNames();
    if (empty($sheets)) {
        return;
    }

    $sheet_name = array_shift($sheets);
    $data = $xlsx->getSheetData($sheet_name);
    if (empty($data)) {
        return;
    }

    $fh = fopen($input_filepath, 'w');
    foreach ($data as $row) {
        fputcsv($fh, $row);
    }
    fclose($fh);
}

add_action('iwp/importer/file_uploaded', 'iwp_xlsx_read_file_matching_ext', 10);
