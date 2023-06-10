<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductCategoryStore;
use App\Http\Requests\ProductCategoryUpdate;
use App\Models\ProductCategory;
use App\Models\Option;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Str;
use Cache;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Request $request)
    {
        $this->authorize('product_categories.index');

        $currentCategory = null;
        $categories = ProductCategory::search($request->get('q'))
            ->with(implode('.', array_fill(0, 10, 'children')))
            ->whereNull('parent_id')
            ->paginate();

        if ($request->has('id')) {
            $currentCategory = ProductCategory::findOrFail($request->get('id'));
        }
        return view('product_categories.index', compact('categories', 'currentCategory'));
    }

      /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function list(Request $request)
    {
        $this->authorize('product_categories.index');

        $categories = ProductCategory::whereNull('parent_id')
            ->orderBy('ordering', 'ASC')
            ->get();
        $level = 1;
        return view('product_categories.list', compact('categories', 'level'));
    }

    /**
     * Load các danh mục con
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function loadSubCate(Request $request)
    {
        $this->authorize('product_categories.index');
        $categories = null;
        $level = $request->get('level');
        $id    = $request->get('id');
        if ($id > 0) {
            $categories = ProductCategory::where('parent_id', '=', $id)
                ->orderBy('ordering')
                ->get();

            if ($categories->isEmpty()) {
                return '';
            }
        }
        $level += 1;

        return view('product_categories.sub_category', compact('categories', 'level'));
    }
    /**
     * Danh sách menu
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function showMenu(Request $request, $type)
    {
        $this->authorize('product_categories.index');

        if ($type == 'is_menu_home') {
            $childs = 'menuHomeChilds';
            $menus = ProductCategory::where('is_menu_home', true)->orderBy('ordering_menu_home')->get();
            return view('product_categories.menu', compact('menus', 'type', 'childs'));
        } else if ($type == 'is_menu_promotion') {
            $childs = 'menuPromotionChilds';
            $menus = ProductCategory::where('show_on_promotion', true)->orderBy('ordering_menu_promotion')->get();
            return view('product_categories.menu', compact('menus', 'type', 'childs'));
        }



        $typeOrder      = Str::replaceArray('is_', ['ordering_'], $type);
        $strParentId    = Str::replaceArray('is_', ['parent_id_'], $type);
        $childs = "menuTopChilds";
        if ($type == "is_menu_home") {
            $childs = "menuHomeChilds";
        } else if ($type == "is_menu_bottom") {
            $childs = "menuHomeChilds";
        }
        $menus          = ProductCategory::where($type, '=', 1)->where($strParentId, '=', 0)->with($childs)->orderBy($typeOrder)->get();
        return view('product_categories.menu', compact('menus', 'type', 'childs'));
    }

    /**
     * Lưu thứ tự sắp sếp của danh mục
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function saveOrderCate(Request $request): JsonResponse
    {
        $this->authorize('product_categories.update');
        $checkupdate    = true;
        $listCategories = $request->input('list_categories');
        $type           = $request->input('type');
        $strTypeOrder   = Str::replaceArray('is_', ['ordering_'], $type);
        $strParentId    = Str::replaceArray('is_', ['parent_id_'], $type);

        if ($listCategories) {
            foreach ($listCategories as $key => $row) {
                if ($type == 'ordering') {
                    $dataUpdate = [$strTypeOrder => $key];
                } else {
                    $dataUpdate = [$strTypeOrder => $key,  $strParentId => $row[1]];
                }

                $result =  ProductCategory::where('id', '=', $row[0])->update($dataUpdate);

                if ($result) {
                    $checkupdate = $checkupdate and true;
                } else {
                    $checkupdate = $checkupdate and false;
                }
            }
        }
        if ($checkupdate) {
            return response()->json(['status' => 1]);
        } else {
            return response()->json(['status' => 0]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return mixed
     */
    public function create(Request $request)
    {
        if (!$request->user()->can('product_categories.store')) {
            throw new AccessDeniedHttpException;
        }
        return view('product_categories.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ProductCategoryStore  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ProductCategoryStore $request)
    {
        $data = $request->validated();
        $data["level"] = 1;
        if (!empty($data["parent_id"])) {
            $parentCategory = ProductCategory::where('id', '=', $data["parent_id"])->first();
            $data["level"]  = $parentCategory->level + 1;
        }
        $productCategory = ProductCategory::create($data);
        $this->storeExtraData($productCategory, $data);

        if (!empty($data['posts'])) {
            $productCategory->posts()->attach($data['posts']);
        }

        $parentId = $productCategory->parent_id;
        $level    = $productCategory->level;

        Cache::pull('product_category_options');

        return redirect()
            ->back()
            ->with('success', __('Created category: :name', ['name' => $data['title']]));
       // return response()->json(['success' => __('Record is successfully added'), 'level' => $level, 'parentId' => $parentId]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductCategory    $currentCategory
     *
     * @return mixed
     */
    public function edit(Request $request, Int $id)
    {
        if (!$request->user()->can('product_categories.update')) {
            throw new AccessDeniedHttpException;
        }
        $currentCategory = ProductCategory::findOrFail($id);
        return view('product_categories.form', compact('currentCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ProductCategoryUpdate  $request
     * @param  \App\Models\ProductCategory               $productCategory
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ProductCategoryUpdate $request, ProductCategory $productCategory)
    {
        $data = $request->validated();
        $data["level"] = 1;
        if (!empty($data["parent_id"])) {
            $parentCategory = ProductCategory::where('id', '=', $data["parent_id"])->first();
            $data["level"]  = $parentCategory->level + 1;
        }
        if($productCategory->update($data)){
            $this->storeExtraData($productCategory, $data);
            $productCategory->posts()->sync($data['posts'] ?? []);
        }

        $parentId = $productCategory->parent_id;
        $level    = $productCategory->level;

        Cache::pull('product_category_options');

        return redirect()
        ->back()
        ->with('success', __('Updated category: :name', ['name' => $data['title']]));
       
       // return response()->json(['success' => __('Record is successfully updated'), 'level' => $level, 'parentId' => $parentId]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductCategory  $productCategory
     *
     * @return void
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Exception
     */
    public function destroy(ProductCategory $productCategory)
    {

        $parentId = $productCategory->parent_id;
        $level    = $productCategory->level;
        $this->authorize('product_categories.destroy');
        $productCategory->delete();
       

       // return response()->json(['success' => __('Record is successfully Deleted'), 'level' => $level, 'parentId' => $parentId]);
    }

    /**
     * Store product extra data
     *
     * @param \App\Models\ProductCategory $productCategory
     * @param array            $data
     *
     * @return void
     */
    public function storeExtraData(ProductCategory $productCategory, array $data): void
    {
        if (!empty($data['categories'])) {
            $productCategory->categories()->sync($data['categories']);
        }
        // SEO
        if (!empty($productCategory->seo)) {
            $productCategory->seo()->update($data['seo']);
        } else {
            $productCategory->seo()->create($data['seo']);
        }
    }
}
