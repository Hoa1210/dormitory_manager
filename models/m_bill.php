<?php
include "core/database.php";
class m_bill extends DB
{

    public function getAllRooms()
    {
        $sql = "SELECT * FROM rooms";
        return $this->get_list($sql);
    }

    public function insertBillEW($room_id, $e_first, $e_last, $price_per_e, $w_first, $w_last, $price_per_w, $start_date, $end_date, $status, $payment)
    {
        if ($payment == '') {
            $sql = "INSERT INTO electric_water 
                VALUES (null,$e_first, $e_last, $price_per_e, $w_first, $w_last, $price_per_w, $room_id, '$start_date', '$end_date', null, $status)";
        } else {
            $sql = "INSERT INTO electric_water 
                VALUES (null,$e_first, $e_last, $price_per_e, $w_first, $w_last, $price_per_w, $room_id, '$start_date', '$end_date', $payment, $status)";
        }
        return $this->query($sql);
    }


    public function getAllEW()
    {
        $sql = "SELECT electric_water.*, rooms.room_name FROM electric_water INNER JOIN rooms ON electric_water.rooms_id = rooms.id";
        return $this->get_list($sql);
    }

    public function getEWBById($id){
        $sql = "SELECT electric_water.*, rooms.room_name FROM electric_water INNER JOIN rooms ON electric_water.rooms_id = rooms.id WHERE electric_water.id = $id";
        return $this->get_row($sql);
    }

    public function editEWB($id, $room_id, $e_first, $e_last, $price_per_e, $w_first, $w_last, $price_per_w, $start_date, $end_date, $status, $payment)
    {
        if ($payment == '') {
            $sql = "UPDATE electric_water 
                    SET e_first=$e_first,e_last=$e_last,price_per_e=$price_per_e,w_first=$w_first,w_last=$w_last,price_per_w=$price_per_w,rooms_id=$room_id,start_date='$start_date',end_date='$end_date',payment=null,status=$status 
                    WHERE id = $id";
        } else {
            $sql = "UPDATE electric_water 
                    SET e_first=$e_first,e_last=$e_last,price_per_e=$price_per_e,w_first=$w_first,w_last=$w_last,price_per_w=$price_per_w,rooms_id=$room_id,start_date='$start_date',end_date='$end_date',payment=$payment,status=$status
                    WHERE id = $id ";
        }
        return $this->query($sql);
    }

    public function deleteById($id){

        $sql = "DELETE FROM electric_water WHERE id = $id";

        return $this->query($sql);
    }

    public function getBillByRoomId($id){
        $sql = "SELECT * FROM electric_water WHERE rooms_id = $id";
        return $this->get_list($sql);
    }

    public function getRoomId($id){
        $sql = "SELECT room_id FROM contracts WHERE student_id = $id";
        return $this->get_row($sql);
    }
}
