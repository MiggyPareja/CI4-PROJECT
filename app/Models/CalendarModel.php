<?php 
namespace App\Models;

use CodeIgniter\Model;

class CalendarModel extends Model
{
    protected $table ='todo';

    protected $primaryKey = 'id';
    
     protected $allowedFields = ['Appointment', 'appoint_desc','start_date', 'end_date'];
}

?>