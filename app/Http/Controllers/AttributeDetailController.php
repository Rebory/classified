<?php

namespace App\Http\Controllers;

use App\Attribute;
use App\AttributeDetail;
use Illuminate\Http\Request;
use Validator;

class AttributeDetailController extends Controller
{

    private $_attributeDetail;
    /**
     * AttributeDetailController constructor.
     * @param AttributeDetail $attributeDetail
     */

    public function __construct(AttributeDetail $attributeDetail)
    {
        $this->_attributeDetail = $attributeDetail;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $attributedetails = AttributeDetail::paginate(25);
        return view('administrative.super_admin.tasks.attribute_detail.index', compact('attributedetails'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $attributes = (new Attribute)->attributeOptions();
        return view('administrative.super_admin.tasks.attribute_detail.create', compact('attributes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'attribute' => 'required|max:11',
            'attribute_value' => 'required|max:200'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        } else {

            $data = [
                'attribute_id' => $request->attribute,
                'attribute_value' => $request->attribute_value,
            ];

            $this->_attributeDetail->store($data);
            return response()->json(['success' => 'Attribute detail saved.']);
        }
    }


    /**
     * @param AttributeDetail $attributeDetail
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(AttributeDetail $attributeDetail)
    {
        $attributes = (new Attribute)->attributeOptions();
        return view('administrative.super_admin.tasks.attribute_detail.edit', compact('attributeDetail' , 'attributes'));
    }

    /**
     * @param Request $request
     * @param AttributeDetail $attributeDetail
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, AttributeDetail $attributeDetail)
    {
        $validator = Validator::make($request->all(), [
            'attribute'       => 'required|max:11',
            'attribute_value' => 'required|max:200'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        } else {

            $data = [
                'attribute_id' => $request->attribute,
                'attribute_value' => $request->attribute_value,
            ];

            $this->_attributeDetail->store($data, $attributeDetail->id);
            return response()->json(['success' => 'Attribute detail saved.']);
        }
    }

    /**
     * @param AttributeDetail $attributeDetail
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(AttributeDetail $attributeDetail)
    {
        $attributeDetail->delete();
        return redirect()->back()->with('success', 'deleted');
    }
}
