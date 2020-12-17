 @extends('page.admin')
@section('admin_content')
 <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Sửa loại sản phẩm
                        </header>
                       
                        <div class="panel-body">
                            @foreach($edit_category_product as $key =>$edit_value)
                            <div class="position-center">
                                <form role="form" action="{{URL::to('update-category-product/'.$edit_value->id)}}" method="post">
                                    {{csrf_field()}}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên loại</label>
                                    <input type="text" value="{{$edit_value->name}}" name="category_product_name" class="form-control" id="exampleInputEmail1" placeholder=" Nhập tên danh mục">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả </label>
                                    <textarea style="resize: none" rows="5" class="form-control" name="category_product_desc"  id="exampleInputPassword1"> {{$edit_value->description}}</textarea>
                                </div>
                            
                            <button type="submit" name ="save-category-product" class="btn btn-info">Cập nhật</button>
                            </form>
                            </div>
                            @endforeach
                        </div>
                    </section>

            </div>          
</div>
@endsection  