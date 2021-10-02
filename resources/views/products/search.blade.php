@extends('layouts.app')

@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Products</h1>
        <a style="float:right;" href="{{route('product.index')}}" class="h3 mb-0 text-gray-800 text-info">Back to All products</a>
    </div>
  

    <div class="card">
    <form action="{{url('/search')}}" method="get" class="card-header">
                <div class="form-row justify-content-between">
                    <div class="col-md-2">
                        <input type="text" name="title" placeholder="Product Title" required='true' class="form-control">
                    </div>

                    <div class="col-md-2">
                        <select name="variant" required='true' id="" class="form-control">
                        <option> </option>

                        @foreach ($variants as $variant)

                        <optgroup label="{{ $variant->title }}">
                        @foreach($variant->product_variants->unique('variant') as $value)
                        <option>{{$value->variant}} </option>
                         @endforeach
                        </optgroup>
                   
                        @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Price Range</span>
                            </div>
                            <input type="text" name="price_from" required='true' aria-label="First name" placeholder="From" class="form-control">
                            <input type="text" name="price_to" required='true' aria-label="Last name" placeholder="To" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <input type="date" required='true' name="date" placeholder="Date" class="form-control">
                    </div>
                    <div class="col-md-1">
                        <button type="submit" class="btn btn-primary float-right"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </form>
          
                @if(count($product_filter)>0)

                    <div class="card-body">
                <div class="table-response">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Variant</th>
                            <th width="100px">Action</th>
                        </tr>
                        </thead>

                        <tbody>
                    <?php $i=1; $x=1; ?>
                    
                        @foreach ($product_filter as $product)
                        <tr>
                        

                            <td>{{$x++}}</td>
                            <td>{{$product->title}} <br> Created at : {{$product->created_at->diffForHumans()}}</td>
                            <td>{{ Str::limit($product->description, 70) }}</td>
                            <td>
                                <dl class="row mb-0" style="height: 80px; overflow: hidden" id="variant{{$i++}}">

                            
                                    <dt class="col-sm-3 pb-0">
                                    @foreach($product->product_variant as $product_variant)
                                    {{ $product_variant->variant }} /
                                    @endforeach
                                    </dt>
                                
                                    <dd class="col-sm-9">
                                        <dl class="row mb-0">
                                            <dt class="col-sm-4 pb-0">
                                                
                                            @foreach($product->price_variant as $price_variant)
                                            Price : {{number_format($price_variant->price, 2)  }} </br>
                                            @endforeach
                                        
                                            </dt>
                                            <dd class="col-sm-8 pb-0">
                                                
                                            @foreach($product->price_variant as $price_variant)
                                            InStock : {{number_format($price_variant->stock, 2)  }} </br>
                                            @endforeach
                                        
                                        </dd>
                                        </dl>
                                    </dd>
                                </dl>
                                <button onclick="$('#variant{{$i-1}}').toggleClass('h-auto')" class="btn btn-sm btn-link">Show more</button>
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('product.edit', 1) }}" class="btn btn-success">Edit</a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>

                    </table>
                </div>

            </div>

       
          @else
         

            <div class="card-body">

            <center><h3>No Product Found</h3></center>
            </div>
        
           
              @endif


        <div class="card-footer">
            <div class="row justify-content-between">
                <div class="col-md-6">
               
                </div>
                <div class="col-md-2">
               
                </div>
            </div>
        </div>
    </div>

@endsection
