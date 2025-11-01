<form action="{{ URL::current() }}" method="get" class="d-flex justify-content-between mb-4">
    {{-- <x-form.input name="name" placeholder="البحث عن..." class="mx-2" :value="request('name')"/> --}}
    <input type="text" name="q" value="{{ request('q') }}" class="form-control" placeholder="ابحث بالاسم أو الهاتف أو رقم الجهاز">

    <select name="status" class="form-control mx-2">
        <option value="">الكل</option>
        <option value="active" @selected(request('status') == 'active')>نشط</option>
        <option value="archived" @selected(request('status') == 'archived')>غير نشط</option>
    </select>

            {{-- <select name="category" class="form-control mx-2">
                <option value="">الأقسام</option>
                    @foreach($categories as $category)
                        <option value="{{$category->id}}" @selected(request('$category') == $category->id)>
                            {{$category->name}}</option>
                    @endforeach

            </select> --}}
    <button class="btn btn-dark">بحث</button>
</form>
