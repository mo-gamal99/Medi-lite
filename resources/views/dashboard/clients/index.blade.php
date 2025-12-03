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

                    <x-alert type='success' />
                    <x-alert type='dark' />
                    <x-alert type='danger' />

                    <x-form.search-form :clients="$clients" />

                    <div class="table-responsive mt-2">
                        <table class="table table-striped table-bordered mt-2" id="product-table">
                            <thead>
                                <tr>
                                    <th>اسم العميل</th>
                                    <th>رقم الهاتف</th>
                                    <th>رقم الجهاز</th>
                                    <th>الحالة</th>
                                    <th>تاريخ التفعيل</th>
                                    <th>تاريخ انتهاء الصلاحية</th>
                                    <th>الإثبات</th>
                                    @can('client.control')
                                        <th>تحكم</th>
                                    @endcan
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($clients as $client)
                                    <tr>
                                        <td>{{ $client->name }}</td>
                                        <td>{{ $client->phone_number }}</td>
                                        <td>{{ $client->device_id }}</td>

                                        <td>
                                            @if ($client->is_active)
                                                <span class="badge bg-success">مفعل</span>
                                            @else
                                                <span class="badge bg-danger">غير مفعل</span>
                                            @endif
                                        </td>

                                        <td>
                                            {{ $client->activated_at ? $client->activated_at->format('Y-m-d H:i') : '-' }}
                                        </td>
                                        <td>
                                            {{ $client->expires_at ? $client->expires_at->format('Y-m-d H:i') : '-' }}
                                        </td>

                                        <td>
                                            @if ($client->verification_document)
                                                <button class="btn btn-info btn-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#docModal{{ $client->id }}">
                                                    عرض الإثبات
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="docModal{{ $client->id }}" tabindex="-1" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">إثبات العميل</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                            </div>
                                                            <div class="modal-body text-center">
                                                                <img src="{{ $client->verification_document_url }}"
                                                                     class="img-fluid rounded"
                                                                     alt="document image">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                -
                                            @endif
                                        </td>

                                        <td>
                                            @can('client.control')
                                                <form action="{{ route('clients.toggle', $client->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    <button type="submit"
                                                        class="btn btn-sm {{ $client->is_active ? 'btn-warning' : 'btn-success' }}">
                                                        {{ $client->is_active ? 'إلغاء التفعيل' : 'تفعيل' }}
                                                    </button>
                                                </form>

                                                <form action="{{ route('clients.destroy', $client->id) }}" method="POST"
                                                    style="display:inline;" onsubmit="return confirm('هل أنت متأكد من حذف هذا العميل؟');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        حذف
                                                    </button>
                                                </form>
                                            @endcan
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
