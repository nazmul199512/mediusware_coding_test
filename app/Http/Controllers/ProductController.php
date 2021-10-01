<?php

  
    namespace App\Http\Controllers;

    use App\Models\Product;
    use App\Models\ProductVariant;
    use App\Models\ProductVariantPrice;
    use App\Models\Variant;
    use Illuminate\Http\Request;

    class ProductController extends Controller
    {
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
         */
        public function index()
        {
            $variants = Variant::all();
            $products = Product::paginate(5);;
            return view('products.index', ['products'=>$products, 'variants'=>$variants]);
        }

        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
         */
        public function create()
        {
            $variants = Variant::all();
            return view('products.create', compact('variants'));
        }
        
        // Search function for product filter 

        public function search()
        {       $variants = Variant::all();   
                
                $date = date($_GET['date']).' 00:00:00';
            
                $product_filter = Product::join('product_variant_prices', 'product_variant_prices.product_id','=', 'products.id')
                ->join('product_variants', 'product_variants.product_id','=', 'products.id') 
                ->where('products.title', 'LIKE', '%'.$_GET['title'].'%')
                ->where('product_variants.variant', 'LIKE', '%'.$_GET['variant'].'%')
                ->where('products.created_at', '<=', $date)
                ->whereBetween('product_variant_prices.price', [ $_GET['price_from'], $_GET['price_to']])  
                ->get();   
            
            return view('products.search',['product_filter'=>$product_filter, 'variants'=>$variants]);
        }

        /**
         * Store a newly created resource in storage.
         *
         * @param \Illuminate\Http\Request $request
         * @return \Illuminate\Http\JsonResponse
         */
        public function store(Request $request)
        {

        }


        /**
         * Display the specified resource.
         *
         * @param \App\Models\Product $product
         * @return \Illuminate\Http\Response
         */
        public function show($product)
        {

        }

        /**
         * Show the form for editing the specified resource.
         *
         * @param \App\Models\Product $product
         * @return \Illuminate\Http\Response
         */
        public function edit(Product $product)
        {
            $variants = Variant::all();
            return view('products.edit', compact('variants'));
        }

        /**
         * Update the specified resource in storage.
         *
         * @param \Illuminate\Http\Request $request
         * @param \App\Models\Product $product
         * @return \Illuminate\Http\Response
         */
        public function update(Request $request, Product $product)
        {
            //
        }

        /**
         * Remove the specified resource from storage.
         *
         * @param \App\Models\Product $product
         * @return \Illuminate\Http\Response
         */
        public function destroy(Product $product)
        {
            //
        }
    }
