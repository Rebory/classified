<?php

namespace App\Http\Controllers;

use App\Category;
use App\CategoryView;
use File;
use Auth;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    private $_category;

    /**
     * CategoriesController constructor.
     * @param Category $category
     */
    public function __construct(Category $category)
    {
        $this->_category = $category;

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

//    public function index(Request $request)
//    {
//        $keyword = $request->get('keyword');
//
//        $query = Category::orderBy('id', 'desc');
//        if($keyword != '') {
//            $categories = $query->where('category_name', 'like', '%' . $keyword . '%')->paginate(15);
//        } else {
//            $categories = $query->paginate(15);
//        }
//
//        return view('administrative.super_admin.tasks.category.index', compact('categories', 'keyword'));
//    }

     public function index()
     {   $categories = CategoryView::orderBy('id', 'desc')->paginate(15);
         return view('administrative.super_admin.tasks.category.index', compact('categories'));
     }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {   $categories = $this->_category->categoryOptions();
        return view('administrative.super_admin.tasks.category.create', compact('categories'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        if(!$request->ajax()) {
            abort('404');
        }

        if(Auth::user()->role != 0) {
            return response()->json(['error' => ['Warning! Your role not eligible for do any super admin task.'] ]);
        }

        $validator = Validator::make($request->all(), [
            'category_name' => 'required|max:150|unique:categories',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        } else {

        $fileName = null;
        if($request->hasFile('image'))
        {
            $fileName = fileUpload($request, 'uploads/', 'image');
        }

            $data = [
                'category_name'       => $request->category_name,
                'parent_id'           => $request->parent_category_name,
                'slug'                => Str::slug($request->category_name),
                'is_blog'             => ($request->has('is_blog')) ? $request->is_blog : 0,
                'image'               =>  $fileName,
        ];

            $this->_category->store($data);
            return response()->json(['success' => 'Create Successfully.']);
        }
    }


    /**
     * @param Category $category
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Category $category)
    {
        $categories = $this->_category->categoryOptions();
        return view('administrative.super_admin.tasks.category.edit', compact('category','categories'));

    }

    /**
     * @param Request $request
     * @param Category $category
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request , Category $category)
    {

        if(!$request->ajax()) {
            abort('404');
        }

        if(Auth::user()->role != 0) {
            return response()->json(['error' => ['Warning! Your role not eligible for do any super admin task.'] ]);
        }

        $validator = Validator::make($request->all(), [
                  'category_name'   => 'required|max:255|unique:categories,category_name,'.$category->id.',id',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        } else {

        $fileName = ($category->image != null) ? $category->image : null;

        if ($request->hasFile('image')) {
            $fileName = fileUpload($request, 'uploads/', 'image');
        }

            $data = [
                'category_name'       => $request->category_name,
                'parent_id'           => $request->parent_category_name,
                'slug'                => Str::slug($request->category_name),
                'is_active'           => ($request->has('is_active')) ? $request->is_active : 0,
                'is_blog'             => ($request->has('is_blog')) ? $request->is_blog : 0,
                'image'               =>  $fileName,
            ];

           $this->_category->store($data, $category->id);
            return response()->json(['success' => 'Update Successfully.']);
        }
    }


    /**
     * @param Category $category
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Category $category)
    {
        $main_photo = public_path('uploads/'. $category->image);

        if(File::exists($main_photo)) {
            File::delete($main_photo);
        }

        $category->delete();
        return redirect()->back()->with('success', 'Category has been Delete successfully.');

    }

    public function activation(Request $request)
    {
        if(Auth::user()->role != 0) {
            return response()->json(['error' => ['Warning! Your role not eligible for do any super admin task.'] ]);
        }

        if($request->has('is_active')) {
            $model= Category::findOrFail($request->category_id);
            if ($model->is_active == 1) {
                $model->is_active = 0;
                $model->update();
                return response()->json(['success' => ['Disabled Successfully.'] ]);
            } else {
                $model->is_active = 1;
                $model->update();
                return response()->json(['success' => ['Activated Successfully.'] ]);
            }
        }

    }

}
