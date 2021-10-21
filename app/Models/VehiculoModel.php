<?php

namespace App\Models;
use CodeIgniter\Model;




class VehiculoModel extends Model
{
    
    protected $table                = 'car';
    protected $allowedFields = [
        'placa', 'tipo', 'marca', 'linea', 'modelo', 
    ];
   
    // Dates
    protected $useTimestamps        = true;
    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';
    protected $deletedField         = 'deleted_at';

    public function findCarById($id){
        $vehiculo = $this->asArray()->where(['id'=>$id])->first();

        if(!$vehiculo){
            throw new \Exception('No existe el vehiculo especificado!!');
        }
        return $vehiculo;
    }
    
    
}
