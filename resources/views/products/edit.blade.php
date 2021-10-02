@extends('layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Product</h1>
        <a style="float:right;" href="{{route('product.index')}}" class="h3 mb-0 text-gray-800 text-info">Back to All products</a>
    </div>

    <section>
    <form action="{{route('product.update', $product->id) }}" method="POST" >
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-6">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Product Name</label>
                           <input type="text" name="product_name" placeholder="Product Name" value=" {{$product->title}}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Product SKU</label>
                            <input type="text" name="product_sku" placeholder="Product Name" value=" {{$product->sku}}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Description</label>
                            <textarea style="height:400px;" name="description" id="" cols="30" rows="4"  class="form-control">{{$product->description}}</textarea>
                        </div>
                    </div>
                </div>

               
            </div>

            <div class="col-md-6">
                <div class="card shadow mb-4">
                      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                          Variants
                      </div>
                   

                    <div class="card-body">
                        <div class="row">
                            <div col-md-4>
                           
                            </div>

                            <div class="col-md-8" style="float: right;">
                            <!-- @foreach($product->product_variant as $value)
                            <input type="text" name="price[]" value="{{$value->variant}}" class="form-control" > 
                             <hr/>
                            @endforeach -->
                            </div>
                        </div>
                    </div>
                    
                   

                    <div class="card-header text-uppercase">Price and Stock</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    
                                    <td>Price</td>
                                    <td>Stock</td>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($product->price_variant as $value)
                                <input type="hidden" name="id[]" value="{{$value->id}}" >
                                    <tr >  
                                        <td>                                       
                                           <input type="text" name="price[]" value="{{$value->price}}" class="form-control" >  
                                        </td>
                                        <td>                                   
                                            <input type="text" name="stock[]" value="{{$value->stock}}" class="form-control" >                                       
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <button  type="submit" class="btn btn-lg btn-primary">Update</button>    
      
    </form>
   
    </section>
    
@endsection
