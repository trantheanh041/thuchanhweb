 @extends('page.admin')
@section('admin_content')
 <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm  sản phẩm
                        </header>
                        <div class="panel-body">
                            <div class="position-center">
                                <form role="form"action="{{URL::to('save-product')}}" method="post" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên sản phẩm</label>
                                    <input type="text" name="product_name" class="form-control" id="exampleInputEmail1" placeholder=" Nhập tên sản phẩm">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả </label>
                                    <textarea style="resize: none" rows="5" class="form-control" name="product_desc"  id="exampleInputPassword1" placeholder="Mô tả danh mục"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Hình ảnh</label>
                                    <input type="file" name="product_image" class="form-control" id="exampleInputEmail1" >
                                </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Loại sản phẩm</label>
                                  <select name="category_product" class="form-control input- m-bot15">
                                    @foreach($id_type as $key => $cate)
                                    <option value="{{$cate->id}}"> {{$cate->name}}</option>
                                    @endforeach                                 
                                </select>  
                            </div>
                             <div class="form-group">
                                    <label for="exampleInputEmail1">Giá gốc</label>
                                    <input type="text" name="product_unit_price" class="form-control" id="exampleInputEmail1" >
                            </div>
                              <div class="form-group">
                                    <label for="exampleInputEmail1">Giá khuyến mãi</label>
                                    <input type="text" name="product_promo" class="form-control" id="exampleInputEmail1" >
                            </div>
                               <div class="form-group">
                                <label for="exampleInputPassword1">Đơn vị</label>
                                  <select name="unit" class="form-control input- m-bot15">
                                    <option> Hộp</option>
                                    <option>Cái</option>                                   
                                </select>
                            </div>
                            <button type="submit" name ="add_product" class="btn btn-info">Thêm</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>
           
</div>
@endsection      