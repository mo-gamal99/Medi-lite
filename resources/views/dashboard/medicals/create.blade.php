@extends('dashboard.index')

@section('title', 'إضافة دواء جديد')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item"><a href="{{ route('medicals.index') }}">الأدوية</a></li>
    <li class="breadcrumb-item">إضافة دواء</li>
@endsection

@section('section')
    <div class="container mt-4">
        <h3>إضافة دواء جديد</h3>

        <form method="POST" action="{{ route('medicals.store') }}">
            @csrf

            <x-form.input name="barcode" label="الباركود" />
            <x-form.input name="name_ar" label="الاسم العربي" required />
            <x-form.input name="name_en" label="الاسم الإنجليزي" />
            <x-form.input name="company" label="الشركة" />
            <x-form.input name="composistion" label="التركيب العلمي" />
            <x-form.input name="indication" label="الإستطباب" />
            <x-form.input name="dosage" label="الجرعة (Dosage)" />
            <x-form.input name="strength" label="التركيز (Strength)" />
            <x-form.input type="number" min="0" step="0.01" name="public" label="السعر العام" />
            <x-form.input type="number" min="0" step="0.01" name="net" label="سعر النت" />
            <x-form.input name="pregnancy" label="الحمل" placeholder="مثلاً: يُمنع أثناء الحمل" />

            <button class="btn btn-success mt-3"><i class="fas fa-plus"></i> إضافة</button>
            <a href="{{ route('medicals.index') }}" class="btn btn-secondary mt-3">رجوع</a>
        </form>
    </div>
@endsection
