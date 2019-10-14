<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = [ 'location_name', 'parent_id' , 'postal_code' ];


    /**
     * @param $inputs
     * @param null $id
     * @return mixed
     */
    public function store($inputs, $id = null)
    {
        if($id)
        {
            $locations = $this->findOrFail($id);
            return $locations->update($inputs);
        } else {
            return $this->create($inputs)->id;
        }
    }


    public function locationOptions()
    {
        $data = [ null => '--- select ---'];
        $result = $this->pluck('location_name', 'location_name'); // i dont need id so i put location,location
        if($result->count() > 0) {
            $data = $data + $result->toArray();
        }
        return $data;
    }


    /**
     * @return array
     */
    public function locationOptionsByID()
    {
        $data = [ null => '--- select ---'];
        $result = $this->pluck('location_name', 'id'); // i dont need id so i put location,ID
        if($result->count() > 0) {
            $data = $data + $result->toArray();
        }
        return $data;
    }





}//main



