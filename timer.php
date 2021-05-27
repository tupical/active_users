<?php
session_start();

include 'database.php';
include 'db.php';

class Users {

    protected $cache_file;
    protected $timer;
    protected $db;
    public $json;

    public function __construct($sessid,$online_lifetime,$db)
    {
        $this->cache_file = "./cnt.json";
        $this->db = $db;
        $this->timer = time()-$online_lifetime;
    }

    public function get_online() {  
        if(($row = $this->get_cache())){
            $data = json_encode($row);
        }else{
            $row = get_cnt($this->timer,$this->db);
            $row['time'] = time();
            $data = json_encode($row);
            $this->set_cache($data);
        }
        return $data;
    }

    public function add_user() {
        $id = add_activity($this->generateRandomString(),time(),$this->db);
        return json_encode(['id'=>$id]);
    } 

    private function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function check_user() {
        $id = add_activity(session_id(),time(),$this->db);
        return json_encode(['id'=>$id]);
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


$users = new Users(session_id(),30,$db);
switch($_GET['action']){
    case 'init':
        echo $users->check_user();
    break;
    case 'update':
        echo $users->get_online();
    break;
    case 'addUser':
        echo $users->add_user();
    break;
}

?>