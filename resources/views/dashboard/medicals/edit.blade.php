@extends('dashboard.index')

@section('title', 'تعديل دواء')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item"><a href="{{ route('medicals.index') }}">الأدوية</a></li>
    <li class="breadcrumb-item">تعديل دواء</li>
@endsection

@section('section')
    <div class="container mt-4">
        <h3>تعديل الدواء: {{ $medical->name_ar }}</h3>

        <form method="POST" action="{{ route('medicals.update', $medical) }}">
            @csrf
            @method('PUT')

            <x-form.input name="barcode" label="الباركود" :value="$medical->barcode" />
            <x-form.input name="name_ar" label="الاسم العربي" :value="$medical->name_ar" required />
            <x-form.input name="name_en" label="الاسم الإنجليزي" :value="$medical->name_en" />
            <x-form.input name="company" label="الشركة" :value="$medical->company" />
            <x-form.input name="composistion" label="التركيب العلمي" :value="$medical->composistion" />
            <x-form.input name="strength" label="القوة (Strength)" :value="$medical->strength" />
            <x-form.input name="indication" label="الإستطباب" :value="$medical->indication" />
            <x-form.input type="number" step="0.01" min="0" name="public" label="السعر العام"
                :value="$medical->public" />
            <x-form.input type="number" step="0.01" min="0" name="net" label="سعر النت" :value="$medical->net" />
            <x-form.input name="pregnancy" label="ملاحظات الحمل" :value="$medical->pregnancy" />

            <button class="btn btn-success mt-3">تحديث</button>
            <a href="{{ route('medicals.index') }}" class="btn btn-secondary mt-3">رجوع</a>
        </form>
    </div>
@endsection
