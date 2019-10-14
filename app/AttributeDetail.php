<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttributeDetail extends Model
{
    protected $table = "attribute_detail";

    protected $fillable = ['attribute_id', 'attribute_value'];


    public function store($inputs, $id = null)
    {
        if($id)
        {
            $attributeDetail= $this->findOrFail($id);
            return $attributeDetail->update($inputs);
        }

        return $this->create($inputs)->id;
    }

    public function getAttributeDetail()
    {
        $result = $this->leftJoin('attribute_master', 'attribute_master.id', '=', 'attribute_detail.attribute_id')
            ->orderBy('attribute_detail.id', 'desc')
            ->get(
                [
                    'attribute_master.attribute_name',
                    'attribute_detail.id as id',
                    'attribute_detail.attribute_value'
                ]
            );

        return $result;
    }


    public function attributeDetailOptions()
    {
        $data = ['--Select Attribute Detail--'];
        $result = $this->pluck('attribute_value', 'id');
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


}
