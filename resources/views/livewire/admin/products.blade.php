<div>
    <div class="table overflow-auto" tabindex="8">
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">عنوان جستجو</label>
            <div class="col-sm-10">
                <input type="text" class="form-control text-left" dir="rtl" wire:model="search">
            </div>
        </div>
        <table class="table table-striped table-hover">
            <thead class="thead-light">
            <tr>
                <th class="text-center align-middle text-primary">ردیف</th>
                <th class="text-center align-middle text-primary">عکس</th>
                <th class="text-center align-middle text-primary">نام محصول</th>
                <th class="text-center align-middle text-primary">قیمت</th>
                <th class="text-center align-middle text-primary">تعداد</th>
                <th class="text-center align-middle text-primary">ویرایش</th>
                <th class="text-center align-middle text-primary">حذف</th>
                <th class="text-center align-middle text-primary">گالری</th>
                <th class="text-center align-middle text-primary">تاریخ ایجاد</th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $index => $product)
                <tr>
                    <td class="text-center align-middle">{{ $products->firstItem() + $index }}</td>
                    <td class="text-center align-middle">
                        <figure class="avatar avatar">
                            <img src="{{ url('images/admin/products/big/'.$product->image) }}" class="rounded-circle"
                                 alt="image">
                        </figure>
                    </td>
                    <td class="text-center align-middle">{{ $product->name }}</td>
                    <td class="text-center align-middle">{{ $product->price }}</td>
                    <td class="text-center align-middle">{{ $product->count }}</td>
                    <td class="text-center align-middle">
                        <a class="btn btn-outline-info" href="{{ route('products.edit', $product->id) }}">
                            ویرایش
                        </a>
                    </td>
                    <td class="text-center align-middle">
                        <a class="btn btn-outline-danger" wire:click="deleteProduct({{ $product->id }})">
                            حذف
                        </a>
                    </td>
                    <td class="text-center align-middle">
                        <a class="btn btn-outline-warning" href="{{ route('create-product-gallery', $product->id) }}">
                            گالری
                        </a>
                    </td>
                    <td class="text-center align-middle">{{ \Hekmatinasser\Verta\Verta::instance($product->created_at)->format('%B %d، %Y') }}</td>
                </tr>
            @endforeach
        </table>
        <div style="margin: 40px !important;"
             class="pagination pagination-rounded pagination-sm d-flex justify-content-center">
            {{ $products->appends(Request::except('page'))->links() }}
        </div>
    </div>
</div>
