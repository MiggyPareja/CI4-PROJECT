<?php 
namespace App\Models;

use CodeIgniter\Model;

class CalendarModel extends Model
{
    protected $table ='todo';

    protected $primaryKey = 'id';
    
     protected $allowedFields = ['Appointment', 'appoint_desc','Time_start', 'Time_end'];
}

?>