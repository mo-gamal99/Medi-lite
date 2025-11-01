@extends('dashboard.index')

@section('title', 'تفاصيل الدواء')

@section('section')
<div class="container mt-4">
    <h3>تفاصيل الدواء</h3>
    <table class="table table-bordered">
        <tr><th>الباركود</th><td>{{ $medical->barcode }}</td></tr>
        <tr><th>الاسم العربي</th><td>{{ $medical->name_ar }}</td></tr>
        <tr><th>الاسم الإنجليزي</th><td>{{ $medical->name_en }}</td></tr>
        <tr><th>الشركة</th><td>{{ $medical->company }}</td></tr>
        <tr><th>التركيب العلمي</th><td>{{ $medical->composistion }}</td></tr>
        <tr><th>القوة (Strength)</th><td>{{ $medical->strength }}</td></tr>
        <tr><th>الإستطباب</th><td>{{ $medical->indication }}</td></tr>
        <tr><th>السعر العام</th><td>{{ $medical->public }}</td></tr>
        <tr><th>سعر النت</th><td>{{ $medical->net }}</td></tr>
        <tr><th>ملاحظات الحمل</th><td>{{ $medical->pregnancy }}</td></tr>
    </table>

    <a href="{{ route('medicals.edit', $medical) }}" class="btn btn-primary">تعديل</a>
    <a href="{{ route('medicals.index') }}" class="btn btn-secondary">رجوع</a>
</div>
@endsection
