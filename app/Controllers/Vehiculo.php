<?php

namespace App\Controllers;
use App\Models\VehiculoModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;


class Vehiculo extends BaseController
{
    public function index()
    {
        $model = new VehiculoModel();
        return $this->getResponse([
            'message'=>'Cars encontrados',
            'cars'=>$model->findAll()
        ]);
    }

    public function storeCars(){
        $rules = [
            'placa'=>'required',
            'tipo'=>'required',
            'marca'=>'required',
            'linea'=>'required',
            'modelo'=>'required'
        ];

        $input = $this->getRequestInput($this->request);
        
        if (!$this->validateRequest($input, $rules)) {
            return $this->getResponse($this->validator->getErrors(), ResponseInterface::HTTP_BAD_REQUEST);
        }

        $placa = $input['placa'];

        $model = new VehiculoModel();
        $model->save($input);

        return $this->getResponse([
            'message'=>'Registro agregado correctamente',
            'cars'=>$placa
        ]);

    }

    public function mostrarPorId($id){
        try{
            $model = new VehiculoModel();
            $car = $model->findCarById($id);
            return $this->getResponse([
                'message'=>'Car encontrado',
                'car'=>$car
            ]);

        }catch(\Exception $e){
            return $this->getResponse([
                'message' => 'Could not find car for specified ID'
            ], ResponseInterface::HTTP_NOT_FOUND);
        }
    }

    public function updateCar($id)
    {//actualizamos la carro por id 
        try {

            $model = new VehiculoModel();
            $model->findCarById($id);

            $input = $this->getRequestInput($this->request);


            $model->update($id, $input);
            $car = $model->findCarById($id);

            return $this->getResponse([
                'message' => 'Car updated successfully',
                'client' => $car
            ]);

        } catch (\Exception $exception) {

            return $this->getResponse([
                'message' => $exception->getMessage()
            ], ResponseInterface::HTTP_NOT_FOUND);
        }
    }

    public function destroyCar($id)
    {
        try {

            $model = new VehiculoModel();
            $car = $model->findCarById($id);
            $model->delete($car);

            return $this->getResponse([
                'message' => 'Car deleted successfully',
            ]);

        } catch (\Exception $exception) {
            return $this->getResponse([
                'message' => $exception->getMessage()
            ], ResponseInterface::HTTP_NOT_FOUND);
        }
    }


}
