<?php
class Countries extends MX_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    function countries()
    {
        $query = $this->db->query("SELECT id, Name FROM Country");
        return $query->result_array();
    }
    
    function cities($countryId)
    {
        $query = $this->db->query("SELECT id, Name FROM City WHERE CountryCode = $countryId");
        return $query->result_array();
    }
    
     /* collect everything for one country */
    function countryDetails01(){
  
    
    $strSQL = "SELECT Country.Name AS CountryName,Continent,Region,SurfaceArea,IndepYear,Country.Population,LifeExpectancy,GNP,LocalName,GovernmentForm,HeadOfState
    FROM Country
    WHERE id = 15";
    
        $query = $this->db->query($strSQL);
        return $query->result_array();
        
    // test before using the database
    //return array('CountryName'=>"SY WAS HERE $countryID");
        
    }
    
      
    /* collect everything for one country */
    function countryDetails(){
    $countryID = ($this->uri->segment(3))?$this->uri->segment(3):1;
    
    $strSQL = "SELECT Country.Name AS CountryName,Continent,Region,SurfaceArea,IndepYear,Country.Population,LifeExpectancy,GNP,LocalName,GovernmentForm,HeadOfState,City.Name AS  CapitalName, City.Population AS CityPop, District
    FROM City, Country
    WHERE Country.Capital = City.ID
    AND Country.id = $countryID";
    
        $query = $this->db->query($strSQL);
        return $query->result_array();
        
    // test before using the database
    //return array('CountryName'=>"SY WAS HERE $countryID");
        
    }
    
    
/**
 * cityDetails for one country
 * SELECT * FROM City WHERE CountryCode = $CountryID AND != CapitalID
 * 
 *
 */
    function cityDetails()
    {
         $countryID = ($this->uri->segment(3))?$this->uri->segment(3):1;
        //
        $strSQL = "SELECT Name, District, Population
        FROM City
        WHERE CountryCode = $countryID";
        $query = $this->db->query($strSQL);
      return $query->result_array();
     // print_r($arr);exit();
    }
    
    
    
}
/*  end modules/lists/models/countries.php