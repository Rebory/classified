<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Validator;


class Attribute extends Model
{
    protected $table = 'attribute_master';

    protected $fillable =[ 'attribute_name'];


    /**
     * @param $inputs
     * @param null $id
     * @return mixed
     *
     */
    public function store($inputs, $id = null)
    {
        if($id)
        {
            $attribute= $this->findOrFail($id);
            return $attribute->update($inputs);
        }

        return $this->create($inputs)->id;
    }

    /**
     * @return array
     */
    public function attributeOptions()
    {
        $data = [null => '--Select Attribute--'];
        $result = $this->pluck('attribute_name', 'id');
        if($result->count() > 0) {
            $data = $data + $result->toArray();
        }
        return $data;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function detail()
    {
        return $this->hasMany(AttributeDetail::class);
    }

}
