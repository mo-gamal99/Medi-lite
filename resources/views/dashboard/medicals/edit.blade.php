@extends('dashboard.index')

@section('title', 'تعديل منتج')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item"><a href="{{ route('products.index') }}">المنتجات</a></li>
    <li class="breadcrumb-item">تعديل منتج</li>
@endsection

@section('section')
<div class="container mt-4">
    <h3>تعديل الدواء: {{ $medical->name_ar }}</h3>

    <form method="POST" action="{{ route('medicals.update', $medical) }}">
        @csrf
        <div class="mb-3">
            <label>الاسم العربي</label>
            <input type="text" name="name_ar" value="{{ $medical->name_ar }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>الاسم الإنجليزي</label>
            <input type="text" name="name_en" value="{{ $medical->name_en }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>الشركة</label>
            <input type="text" name="company" value="{{ $medical->company }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>التركيب العلمي</label>
            <input type="text" name="composistion" value="{{ $medical->composistion }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>السعر العام</label>
            <input type="number" step="0.01" name="public" value="{{ $medical->public }}" class="form-control">
        </div>

        <button class="btn btn-success">تحديث</button>
        <a href="{{ route('medicals.index') }}" class="btn btn-secondary">رجوع</a>
    </form>
</div>

@endsection

