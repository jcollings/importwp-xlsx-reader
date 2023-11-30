<?php

function iwp_xlsx_read_file_matching_ext($input_filepath)
{
    $file_parts = explode('.', basename($input_filepath));
    if (!in_array('xlsx', $file_parts) && !in_array('xls', $file_parts)) {
        return;
    }

    $inputFileType = in_array('xlsx', $file_parts) ? 'Xlsx' : 'Xls';

    $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
    $spreadsheet = $reader->load($input_filepath);

    $worksheet = $spreadsheet->getActiveSheet();
    $data = $worksheet->toArray();

    $fh = fopen($input_filepath, 'w');
    foreach ($data as $row) {
        fputcsv($fh, $row);
    }
    fclose($fh);
}

add_action('iwp/importer/file_uploaded', 'iwp_xlsx_read_file_matching_ext', 10);

// set xlsx filetype to csv
add_filter('iwp/get_filetype_from_ext', function ($filetype, $filename) {

    if (preg_match('/\.xlsx?$/', $filename)) {
        $filetype = 'csv';
    }

    return $filetype;
}, 10, 2);
