@extends('dashboard.index')
@section('title', 'العملاء')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item">العملاء</li>
@endsection

@section('section')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <x-alert type='success'/>
                <x-alert type='dark'/>
                <x-alert type='danger'/>

                <x-form.search-form  :clients="$clients" />

                <div class="table-responsive mt-2">
                    <table class="table table-striped table-bordered mt-2" id="product-table">
                        <thead>
                            <tr>
                                <th>اسم العميل</th>
                                <th>رقم الهاتف</th>
                                <th>عنوان الip</th>
                                <th>الحالة</th>
                                <th>تحكم</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($clients as $client)
                                <tr>
                                    <td>{{ $client->name }}</td>
                                    <td>{{ $client->phone_number }}</td>
                                    <td>{{ $client->ip_address }}</td>
                                    <td>
                                        @if ($client->is_active)
                                            <span class="badge bg-success">مفعل</span>
                                        @else
                                            <span class="badge bg-danger">غير مفعل</span>
                                        @endif
                                    </td>
                                    <td>
                                        <form action="{{ route('clients.toggle', $client->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-sm {{ $client->is_active ? 'btn-danger' : 'btn-success' }}">
                                                {{ $client->is_active ? 'إلغاء التفعيل' : 'تفعيل' }}
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">لا يوجد عملاء لعرضهم</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $clients->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
