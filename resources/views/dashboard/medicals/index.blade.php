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
                        <h3 class="mb-4">إدارة الأدوية</h3>

                        {{-- رفع ملف Excel --}}
                        <form action="{{ route('medicals.upload') }}" method="POST" enctype="multipart/form-data"
                            class="mb-4">
                            @csrf
                            <div class="input-group">
                                <input type="file" name="file" class="form-control" required>
                                <button class="btn btn-primary">رفع الملف</button>
                            </div>
                        </form>

                        {{-- بحث --}}
                        <form method="GET" action="{{ route('medicals.index') }}" class="mb-3">
                            <div class="input-group">
                                <input type="text" name="q" value="{{ request('q') }}" class="form-control"
                                    placeholder="ابحث بالاسم أو الشركة أو التركيب">
                                <button class="btn btn-secondary">بحث</button>
                            </div>
                        </form>

                        {{-- تنبيه --}}
                        {{-- @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif --}}

                        {{-- جدول الأدوية --}}
                        <table class="table table-bordered table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th>#</th>
                                    <th>الاسم العربي</th>
                                    <th>الاسم الإنجليزي</th>
                                    <th>الشركة</th>
                                    <th>التركيب</th>
                                    <th>الإستطباب</th>
                                    <th>تحكم</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($medicals as $m)
                                    <tr>
                                        <td>{{ $m->id }}</td>
                                        <td>{{ $m->name_ar }}</td>
                                        <td>{{ $m->name_en }}</td>
                                        <td>{{ $m->company }}</td>
                                        <td>{{ $m->strength }}</td>
                                        <td>{{ $m->indication }}</td>
                                        <td>
                                            <a href="{{ route('medicals.edit', $m) }}" class="btn btn-sm btn-info">تعديل</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{ $medicals->links() }}
                    </div>
                    <!-- end -->
                </div>
            </div>
        </div> <!-- end col -->
    </div>

@endsection
