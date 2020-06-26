<?php

namespace ImportWPAddon\XLSX;

use ImportWP\EventHandler;

class ServiceProvider extends \ImportWP\ServiceProvider
{
    /**
     * @param EventHandler $event_handler
     */
    private $event_handler;

    public function __construct($event_handler)
    {
        $this->event_handler = $event_handler;

        $this->event_handler->listen('importer.allowed_file_types', [$this, 'add_xlsx_file_type']);
        $this->event_handler->listen('importer.allowed_mime_types', [$this, 'check_xlsx_mime_type']);
    }

    public function add_xlsx_file_type($file_types)
    {
        if (!in_array('xlsx', $file_types, true)) {
            $file_types[] = 'xlsx';
        }
        return $file_types;
    }

    public function check_xlsx_mime_type($allowed, $mime)
    {

        switch ($mime) {
            case 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet':
            case 'application/vnd.ms-excel':
                return 'csv';
        }

        return $allowed;
    }
}
