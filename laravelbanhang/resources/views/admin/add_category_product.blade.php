 @extends('page.admin')
@section('admin_content')
 <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm danh mục sản phẩm
                        </header>
                         <?php 
            $message=Session::get('message');
            if($message){
            echo '  <h1> <span class="text-alert"  >'. $message .'</span> </h1>';
            Session::put('message',null);
            }
      ?>
                        <div class="panel-body">
                            <div class="position-center">
                                <form role="form" action="{{URL::to('save-category-product')}}" method="post">
                                    {{csrf_field()}}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên loại</label>
                                    <input type="text" name="category_product_name" class="form-control" id="exampleInputEmail1" placeholder=" Nhập tên danh mục">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả </label>
                                    <textarea style="resize: none" rows="5" class="form-control" name="category_product_desc"  id="exampleInputPassword1" placeholder="Mô tả danh mục"></textarea>
                                </div>
                            
                            <button type="submit" name ="save-category-product" class="btn btn-info">Thêm</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>
           
</div>
@endsection      