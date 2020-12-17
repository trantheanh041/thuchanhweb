 @extends('page.admin')
@section('admin_content')
 <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Sửa sản phẩm
                        </header>
                        <div class="panel-body">
                            @foreach($edit_product as $key =>$edit_value)
                            <div class="position-center">
                                <form role="form"action="{{URL::to('update-product/'.$edit_value->id)}}" method="post" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên sản phẩm</label>
                                    <input type="text" name="product_name" class="form-control" id="exampleInputEmail1"value="{{$edit_value->name}}" >
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả </label>
                                    <textarea style="resize: none" rows="5" class="form-control" name="product_desc"  id="exampleInputPassword1" > {{$edit_value->description}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Hình ảnh</label>
                                    <input type="file" name="product_image" class="form-control" id="exampleInputEmail1" >
                                    <img src="{{URL::to('source/image/product/'.$edit_value->image)}}" height="100" width="100" >
                                </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Loại sản phẩm</label>
                                  <select name="category_product" class="form-control input- m-bot15">
                                    @foreach($type_products as $key => $cate)
                                    @if($cate->id==$edit_value->id_type)
                                    <option selected value="{{$cate->id}}"> {{$cate->name}}</option>
                                    @else
                                     <option value="{{$cate->id}}"> {{$cate->name}}</option>
                                    @endif
                                    @endforeach                                 
                                </select>  
                            </div>
                             <div class="form-group">
                                    <label for="exampleInputEmail1">Giá gốc</label>
                                    <input type="text" name="product_unit_price" class="form-control" value="{{$edit_value->unit_price}}" id="exampleInputEmail1" >
                            </div>
                              <div class="form-group">
                                    <label for="exampleInputEmail1">Giá khuyến mãi</label>
                                    <input type="text" value="{{$edit_value->promotion_price}}" name="product_promo" class="form-control" id="exampleInputEmail1" >
                            </div>
                               <div class="form-group">
                                <label for="exampleInputPassword1">Đơn vị</label>
                                  <select name="unit" value="{{$edit_value->unit}}" class="form-control input- m-bot15">
                                    <option> Hộp</option>
                                    <option>Cái</option>                                   
                                </select>
                            </div>
                            <button type="submit" name ="add_product" class="btn btn-info">Cập nhật</button>
                            </form>
                            </div>
                            @endforeach
                        </div>
                    </section>

            </div>
           
</div>
@endsection      