<?php
class SamplesModel{
    
    protected $db;
    
    public function __construct(PDO $db){
        $this->db = $db;
    }
    
    public function getAllSamples(){
        $stmt = $this->db->prepare("SELECT hive_id, num_mites, collection_date, sample_period FROM samples");
         $stmt -> execute();
        return $stmt;
    }
}

?>