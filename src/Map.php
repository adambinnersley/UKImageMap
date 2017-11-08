<?php
namespace UKMap;

use DBAL\Database;

class Map{
    protected static $db;
    
    public $table_uk = 'areas';
    public $table_regions = 'postcodes';
    
    /**
     * Constructor add an instance of the database object
     * @param Database $db This should be an instance of the database object
     */
    public function __construct(Database $db) {
        self::$db = $db;
    }
    
    /**
     * Get all of the regions for the national UK map
     * @return array|false If regions exist they will be returned as an array else will return false
     */
    public function getRegions() {
        return self::$db->selectAll($this->table_uk, array(), '*', array('name' => 'ASC'));
    }
    
    /**
     * List all of the postcode within a selected region of the UK
     * @param string $region This should be the URL safe name of the region
     * @return array|false If postcode areas exist for the region they will be returned as an array else will return false
     */
    public function getRegionPostcodes($region) {
        return self::$db->selectAll($this->table_regions, array('area' => $region), '*', array('postcode' => 'ASC'));
    }
    
    /**
     * Returns the information in the database for a given region
     * @paramstring $region This should be the URL safe name of the region
     * @return array|false If the region exists the information will be returned as an array else will return false
     */
    public function getRegionInfo($region) {
        return self::$db->select($this->table_uk, array('url' => $region));
    }
    
}