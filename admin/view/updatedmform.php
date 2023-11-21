<section class="content-main">
    <div class="content-header">
        <div>
            <h2 class="content-title card-title">Sửa danh mục </h2>
            <p>Thêm, chỉnh sửa hoặc xóa một danh mục</p>
        </div>
        <div>
            <input type="text" placeholder="Tìm kiếm danh mục" class="form-control bg-white">
        </div>
    </div>
    <div class="card" >
        <div class="card-body" >
            <div class="row">
                <div class="col-md-3">
                    <form action="index.php?pg=categories" method="POST" enctype="multipart/form-data">
                        
                        <div class="mb-4">
                            <label for="product_slug" class="form-label">Tên Danh mục</label>
                            <input name="name" type="text" placeholder="Nhập tên danh mục" class="form-control" id="product_slug" />
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <h4>Hình ảnh</h4>
                            </div>
                            <div class="card-body" >
                                <div class="input-upload">
                                    <img src="assets/imgs/theme/upload.svg" alt="">
                                    <input name="img" class="form-control" type="file">
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-grid">
                            <button type="submit" name="updatecata" class="btn btn-primary">Cập nhật</button>
                        </div>
                        
                    </form>
                </div>
                <!-- <div class="col-md-9">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Mã</th>
                                    <th>Ảnh danh mục</th>
                                    <th>Tên Danh Mục</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?=$catalog_html?>
                                
                            </tbody>
                        </table>
                    </div>
                </div> -->
                <!-- .col// -->
            </div>
            <!-- .row // -->
        </div>
        <!-- card body .// -->
    </div>
    <!-- card .// -->
</section>