<?php

namespace App\Http\Controllers;

use App\Attribute;
use Illuminate\Http\Request;
use Validator;

class AttributeController extends Controller
{
    private $_attribute;

    public function __construct(Attribute $attribute)
    {
        $this->_attribute = $attribute;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $attributes = Attribute::orderBy('id','desc')->paginate(50);
        return view('administrative.super_admin.tasks.attribute.index', compact('attributes'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('administrative.super_admin.tasks.attribute.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'attribute_name' => 'required|unique:attribute_master,attribute_name|max:200'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        } else {

            $data = [
                'attribute_name' => $request->attribute_name,
            ];

            $this->_attribute->store($data);
            return response()->json(['success' => 'Attribute Created.']);
        }

    }

    /**
     * @param Attribute $attribute
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Attribute $attribute)
    {
        return view('administrative.super_admin.tasks.attribute.edit', compact('attribute'));
    }

    /**
     * @param Request $request
     * @param Attribute $attribute
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Attribute $attribute)
    {
        $validator = Validator::make($request->all(), [
            'attribute_name' => "required|max:200|unique:attribute_master,attribute_name,". $attribute->id . ',id',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        } else {

            $data = [
                'attribute_name' => $request->attribute_name,
            ];

            $this->_attribute->store($data , $attribute->id);
            return response()->json(['success' => 'Attribute Update.']);
        }

    }

    /**
     * @param Attribute $attribute
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Attribute $attribute)
    {
        $attribute->delete();
        return redirect()->back()->with('success', 'Attribute Deleted');
    }

}
