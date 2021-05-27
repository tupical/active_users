<?php
session_start();

include 'database.php';
include 'db.php';

class Users {

    protected $cache_file;
    protected $timer;
    protected $db;
    public $json;

    public function __construct($sessid,$db)
    {
        $this->cache_file = "./cnt.json";
        $this->db = $db;
        $this->timer = time()-30;
        $this->check_user($sessid);
    }

    public function get_online() {  
        if($row = $this->get_cache()){
            $data = json_encode($row);
        }else{
            $row = get_cnt($this->timer,$this->db);
            $row['time'] = time();
            $data = json_encode($row);
            $this->set_cache($data);
        }
        return $data;
    }

    public function check_user() {
        add_activity(session_id(),time(),$this->db);
    }
 
    private function get_cache() {
        $json = file_get_contents($this->cache_file);
        $data = json_decode($json, true);

        if(intVal($data['time']) >= time()-5 && intVal($data['time']) > 1){
            return $data;
        }else{
            return false;
        }
    }

    private function set_cache($cache) {
        file_put_contents($this->cache_file, $cache);
    }

} 


$users = new Users(session_id(),$db);
echo $users->get_online();
?>