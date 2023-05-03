<?php 
namespace App\Models;
use CodeIgniter\Model;

class DashboardModel extends Model{
    protected $table =  'product';

    protected $primaryKey = 'id';
    protected $allowedFields= ['prod_name','prod_file','prod_desc','prod_price','user','created_at','updated_at',];

    public function dashBoard()
    {
        $session = session();
        $userData = $session->get();
        $getUserId = $userData['id'];
        
        if (!$getUserId) {
            return;
        }
        
        $db = \Config\Database::connect();
        $builder = $db->table('product');
        $query = $builder->getWhere(['user' => $getUserId]);
        
        if ($query->getNumRows() > 0) {
            $data = $query->getResultArray();
            return $data;
        } else {
            return [];
        }
    }
    
}
?>