<?php


namespace App\models\Tasks;


use System\Model;

class Tasks extends Model
{
    public function get(){
        return $this->db()->table('tasks')->getAll();
    }

    public function byId($id){
        return $this->db()->table('tasks')->where('id','=',$id)->get();
    }

    public function add($data){
        $this->db()->table('tasks')->insert($data);
    }

    public function byCategory($category){
        return $this->db()->table('tasks')->where('category',$category)->getAll();
    }

    public function updateStatus($id,$data){
        $this->db()->table('tasks')->where('id',$id)->update($data);
    }

    public function delete($id){
        $this->db()->table('tasks')->where('id','=',$id)->delete();
    }
}