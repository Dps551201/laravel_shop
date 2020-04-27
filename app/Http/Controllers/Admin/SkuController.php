<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SkuRequest;
use App\Models\Product;
use App\Models\Sku;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SkuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Product $product
     * @return Factory|View
     */
    public function index(Product $product)
    {
        $skus = $product->skus()->paginate(6);
        return view('auth.skus.index', compact('skus', 'product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Product $product
     * @return Factory|View
     */
    public function create(Product $product)
    {
        return view('auth.skus.form', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param SkuRequest $request
     * @param Product $product
     * @return RedirectResponse
     */
    public function store(SkuRequest $request, Product $product)
    {
        $params = $request->all();
        $params['product_id'] = $request->product->id;
        $skus = Sku::create($params);
        $skus->propertyOptions()->sync($request->property_id);
        return redirect()->route('skus.index', $product);
    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @param Sku $skus
     * @return Factory|View
     */
    public function show(Product $product, Sku $skus)
    {
        return view('auth.skus.show', compact('product', 'skus'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Product $product
     * @param Sku $skus
     * @return Factory|View
     */
    public function edit(Product $product, Sku $skus)
    {
        return view('auth.skus.form', compact('product', 'skus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Product $product
     * @param Sku $skus
     * @return RedirectResponse
     */
    public function update(Request $request, Product $product, Sku $skus)
    {
        $params = $request->all();
        $params['product_id'] = $request->product->id;
        $skus->update($params);
        $skus->propertyOptions()->sync($request->property_id);
        return redirect()->route('skus.index', $product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @param Sku $skus
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(Product $product, Sku $skus)
    {
        $skus->delete();
        return redirect()->route('skus.index', $product);
    }
}
