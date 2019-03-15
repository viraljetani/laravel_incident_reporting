<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Common extends Model
{
    public static function getDataFromCSV ($filename, $delimiter=',', $tableColumns = null) {

    	// Check file
    	if (!file_exists($filename) || !is_readable($filename))
        return [];

	    $data = [];
	    $header = null;
	    if (($handle = fopen($filename, 'r')) !== false)
	    {
	        while (($row = fgetcsv($handle, null, $delimiter)) !== false)
	        {

	        	// Set header
	        	if (!$header) {$header = $tableColumns ?? $row; continue;}

	        	// Remove non-standard characters
	        	foreach ($row as $key => $value) {
            		$row[$key] = preg_replace('/[^\x00-\x7F]/', '', $value);            		
            	}

            	// Set data for row
            	if ($tableColumns) {

		        	$rowData = [];
		        	foreach ($row as $key => $value) {
	            		if (in_array($key, array_keys($tableColumns))) {
	            			$rowData[$tableColumns[$key]] = $row[$key];
	            		}
	            	}
	            	$data[] = $rowData;

            	}
                else {
                	$data[] = array_combine($header, $row);
                }

	        }

	        fclose($handle);
	    }

	    return $data;

    }
}
