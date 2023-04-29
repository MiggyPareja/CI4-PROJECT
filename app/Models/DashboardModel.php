<?php 
namespace App\Models;
use CodeIgniter\Model;

class DashboardModel extends Model{
    protected $table =  'product';

    protected $primaryKey = 'id';
    protected $allowedFields= ['prod_name','prod_file','prod_desc','prod_price','user','created_at','updated_at',];

    public function dashboard()
    {
        
    }
}
?>