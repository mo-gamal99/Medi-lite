@extends('dashboard.index')
@section('title', 'الادوية')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item">الادوية</li>
@endsection

@section('section')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <x-alert type='success' />
                    <x-alert type='danger' />
                    <x-alert type='dark' />
                    {{-- <x-form.search-form :medicals="$medicals" /> --}}
                    <div class="container mt-4">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h3 class="m-0">إدارة الأدوية</h3>

                            <div class="d-flex gap-2">
                                @can('medicin.create')
                                    <a href="{{ route('medicals.create') }}" class="btn btn-success"><i class="fas fa-plus"></i>
                                        إضافة دواء جديد</a>
                                @endcan

                                @can('medicin.deleteAll')
                                    <form action="{{ route('medicals.destroyAll') }}" method="POST"
                                        onsubmit="return confirm('هل أنت متأكد من حذف كل الأدوية؟ سيتم فقدان جميع البيانات!')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i> حذف
                                            الكل</button>
                                    </form>
                                @endcan
                            </div>
                        </div>

                        {{-- رفع ملف Excel --}}
                        @can('medicin.upload')
                            <form action="{{ route('medicals.upload') }}" method="POST" enctype="multipart/form-data"
                                class="mb-4" id="uploadForm">
                                @csrf
                                <div class="input-group">
                                    <input type="file" name="file" class="form-control" required>
                                    <button type="submit" id="uploadBtn" class="btn btn-primary">رفع الملف</button>
                                </div>
                            </form>
                        @endcan

                        {{-- بحث --}}
                        <form method="GET" action="{{ route('medicals.index') }}" class="mb-3">
                            <div class="input-group">
                                <input type="text" name="q" value="{{ request('q') }}" class="form-control"
                                    placeholder="ابحث بالاسم أو الشركة أو التركيب">
                                <button class="btn btn-secondary">بحث</button>
                            </div>
                        </form>

                        {{-- جدول --}}
                        <table class="table table-bordered table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th>الباركود</th>
                                    <th>الاسم العربي</th>
                                    <th>الاسم الإنجليزي</th>
                                    <th>الشركة</th>
                                    <th>التركيب</th>
                                    {{-- <th>الإستطباب</th> --}}
                                    <th>تحكم</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($medicals as $m)
                                    <tr>
                                        <td>{{ $m->barcode }}</td>
                                        <td>{{ $m->name_ar }}</td>
                                        <td>{{ $m->name_en }}</td>
                                        <td>{{ $m->company }}</td>
                                        <td>{{ $m->strength }}</td>
                                        {{-- <td>{{ $m->indication }}</td> --}}
                                        <td class="text-center" style="white-space: nowrap; width: 150px;">
                                            <div class="d-flex justify-content-center align-items-center gap-1">

                                                @can('medicin.detials')
                                                    <a href="{{ route('medicals.show', $m) }}" title="التفاصيل"
                                                        class="btn btn-sm btn-dark">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                @endcan

                                                @can('medicin.edit')
                                                    <a href="{{ route('medicals.edit', $m) }}" title="تعديل"
                                                        class="btn btn-sm btn-info">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                                @endcan

                                                @can('medicin.delete')
                                                    <form action="{{ route('medicals.destroy', $m) }}" method="POST"
                                                        onsubmit="return confirm('هل أنت متأكد من حذف هذا الدواء؟ ⚠️')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-sm btn-danger" title="حذف">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </form>
                                                @endcan

                                            </div>
                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">لا يوجد بيانات</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        {{ $medicals->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('uploadForm').addEventListener('submit', function(e) {
            const button = document.getElementById('uploadBtn');
            button.disabled = true; // 🔒 قفل الزرار
            button.innerHTML = 'جاري الرفع... ⏳'; // 🕐 تغيير النص أثناء الرفع
        });
    </script>

@endsection
