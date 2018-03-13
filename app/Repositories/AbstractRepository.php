<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Helpers\UtilHelper;
use Exception;

abstract class AbstractRepository
{
    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    public function find($id)
    {
        return $this->model->findOrFail($id);    
    }

    public function findDeleted(array $andCriteria)
    {
        $model = $this->model;
        $model = $model::onlyTrashed();

        if (count($andCriteria) > 1) {
            foreach ($andCriteria as $c) {
                $model = $model->where($c[0], $c[1], $c[2]);
            }
        } elseif (count($andCriteria == 1)) {
            $model = $model->where($andCriteria[0][0], $andCriteria[0][1], $andCriteria[0][2]);
        }

        return $model->get();
    }

    public function restoreDeleted(array $andCriteria)
    {
        $model = $this->model;
        $model = $model::onlyTrashed();

        try{

            if (count($andCriteria) > 1) {
                foreach ($andCriteria as $c) {
                    $model = $model->where($c[0], $c[1], $c[2]);
                }
            } elseif (count($andCriteria == 1)) {
                $model = $model->where($andCriteria[0][0], $andCriteria[0][1], $andCriteria[0][2]);
            }
            
            return $model->restore();

        }catch (Exception $e){

            UtilHelper::makeMessageLogError($e->getMessage(), 'restoreDeleted');
            throw new Exception($e->getMessage(), 999);

        }
    }

    public function findByAttribute($key, $value)
    {
        return $this->model->where($key, $value)->firstOrFail();
    }

    public function deleteBy(array $andCriteria)
    {   
        $model = $this->model;

        try{

            if (count($andCriteria) > 1) {
                foreach ($andCriteria as $c) {
                    $model = $model->where($c[0], $c[1], $c[2]);
                }
            } elseif (count($andCriteria == 1)) {
                $model = $model->where($andCriteria[0][0], $andCriteria[0][1], $andCriteria[0][2]);
            }
            
            return $model->delete();

        }catch (Exception $e){

            UtilHelper::makeMessageLogError($e->getMessage(), 'deleteBy');
            throw new Exception($e->getMessage(), 999);

        }
    }

    public function restore(array $andCriteria)
    {
        $model = $this->model;
        $model = $model::onlyTrashed();

        try{
            
            if (count($andCriteria) > 1) {
                foreach ($andCriteria as $c) {
                    $model = $model->where($c[0], $c[1], $c[2]);
                }
            } elseif (count($andCriteria == 1)) {
                $model = $model->where($andCriteria[0][0], $andCriteria[0][1], $andCriteria[0][2]);
            }

            return $model->restore();

        }catch (Exception $e){

            UtilHelper::makeMessageLogError($e->getMessage(), 'restore');
            throw new Exception($e->getMessage(), 999);

        }
    }

    public function findAll(array $orderBy)
    {
        $model = $this->model;

        if (count($orderBy) > 1) {
            foreach ($orderBy as $order) {
                $model = $model->orderBy($order);
            }
        } elseif (count($orderBy == 1)) {
            $model = $model->orderBy($orderBy[0]);
        }
        
        return $model->get();
    }



    public function findAllOrderBy(array $orderBy)
    {
        $model = $this->model;

        foreach ($orderBy as $order) {
            $model = $model->orderBy($order[0],$order[1]);
        }

        return $model->get();
    }

    public function all()
    {
        return $this->model->all();
    }

    public function create(array $data)
    {
        try{
            
            return $this->model->create($data);

        }catch (Exception $e){

            UtilHelper::makeMessageLogError($e->getMessage(), 'create');
            throw new Exception($e->getMessage(), 999);

        }
    }

    public function update(array $data, $id)
    {
        try{
            
            return $this->model->find($id)->update($data);

        }catch (Exception $e){

            UtilHelper::makeMessageLogError($e->getMessage(), 'update');
            throw new Exception($e->getMessage(), 999);

        }
    }

    public function firstOrCreate(array $data)
    {
        return $this->model->firstOrCreate($data);
    }

    public function delete($id)
    {
        try{
            
            return $this->model->find($id)->delete();

        }catch (Exception $e){

            UtilHelper::makeMessageLogError($e->getMessage(), 'delete');
            throw new Exception($e->getMessage(), 999);

        }
    }

    public function lists($nome,$id){
        return $this->model->orderBy($nome)->pluck($nome,$id);
    }

    public function listsOpcional($nome,$id){
        return $this->model->orderBy($nome)->pluck($nome,$id)->prepend('','');
    }

    public function listsByAttribute($nome,$id,$key,$value){
        return $this->model->where($key, $value)->orderBy($nome)->pluck($nome,$id);
    }

    public function filter($ids)
    {
        return $this->model->find($ids);    
    }

    public function filterByAttribute($key,$value){
        return $this->model->where($key, $value)->get();
    }

    /**
    * Array de exemplo andCriteria ['nr_cpf', '=' , '12112112155'], para cada condição
    * Array de exemplo orCriteria ['nr_cpf', '=' , '12112112155'], para cada condição
    * OBS.: Caso queira uma condição 'is not null' ou 'is null', favor informar utilizar o exemplo: ['dt_encerramento', 'is', 'null'] ou ['dt_encerramento', 'is not', 'null']
    */ 
    public function findBy(array $andCriteria, array $orCriteria = null, array $orderBy = null, $limit = null, $offset = null)
    {
        $model = $this->model;


        if (count($andCriteria) > 1) {
            foreach ($andCriteria as $c) {
                if (($c[1] == 'is') && ($c[2] == 'null')){
                    $model = $model->whereNull($c[0]);    
                }elseif (($c[1] == 'is not') && ($c[2] == 'null')){
                    $model = $model->whereNotNull($c[0]);    
                }else{
                    $model = $model->where($c[0], $c[1], $c[2]);    
                }
            }
        } elseif (count($andCriteria == 1)) {
            if (($andCriteria[0][1] == 'is') && ($andCriteria[0][2] == 'null')){
                $model = $model->whereNull($andCriteria[0][0]);    
            }elseif (($andCriteria[0][1] == 'is not') && ($c[2] == 'null')){
                $model = $model->whereNotNull($andCriteria[0][0]);
            }else{
                $model = $model->where($andCriteria[0][0], $andCriteria[0][1], $andCriteria[0][2]);
            }
        }

        if($orCriteria){
            if (count($orCriteria) > 1) {              
                foreach ($orCriteria as $c) {
                    if (($c[1] == 'is') && ($c[2] == 'null')){
                        $model = $model->orWhereNull($c[0]);    
                    }elseif (($c[1] == 'is not') && ($c[2] == 'null')){
                        $model = $model->orWhereNotNull($c[0]);    
                    }else{
                        $model = $model->orWhere($c[0], $c[1], $c[2]);
                    }
                }
            } elseif (count($orCriteria == 1)) {
                if (($orCriteria[0][1] == 'is') && ($orCriteria[0][2] == 'null')){
                    $model = $model->orWhereNull($orCriteria[0][0]);    
                }elseif (($orCriteria[0][1] == 'is not') && ($orCriteria[0][2] == 'null')){
                    $model = $model->orWhereNotNull($orCriteria[0][0]);    
                }else{
                    $model = $model->orWhere($orCriteria[0][0], $orCriteria[0][1], $orCriteria[0][2]);
                }
            }
        }   
        
        if($orderBy){
            if (count($orderBy) > 1) {
                foreach ($orderBy as $order) {
                    $model = $model->orderBy($order[0],$order[1]);
                }
            } elseif (count($orderBy == 1)) {
                $model = $model->orderBy($orderBy[0][0],$orderBy[0][1]);
            }
        }

        if (count($limit)) {
            $model = $model->take((int)$limit);
        }

        if (count($offset)) {
            $model = $model->skip((int)$offset);
        }
        
        return $model->get();
    }

    public function findOneBy(array $andCriteria, array $orCriteria = null)
    {
        return $this->findBy($andCriteria,$orCriteria)->first();
    }

    // from Doctrine
    public function __call($method, $arguments)
    {
        if (substr($method, 0, 6) == 'findBy') {
            $by = substr($method, 6, strlen($method));
            $method = 'findBy';
        } else {
            if (substr($method, 0, 9) == 'findOneBy') {
                $by = substr($method, 9, strlen($method));
                $method = 'findOneBy';
            } else {
                throw new \Exception(
                    "Undefined method '$method'. The method name must start with " .
                    "either findBy or findOneBy!"
                    );
            }
        }
        if (!isset($arguments[0])) {
            // we dont even want to allow null at this point, because we cannot (yet) transform it into IS NULL.
            throw new \Exception('You must have one argument');
        }

        $fieldName = lcfirst($by);

        return $this->$method([$fieldName, '=', $arguments[0]]);
    }

    public function paginate($pages)
    {
        return $this->model->paginate($pages);
    }
}