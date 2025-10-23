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

                    <div class="table-responsive mt-2">

                        <table
                            class="table table-editable table-nowrap align-middle table-edits table-striped table-bordered mt-2"
                            id="product-table">
                            <thead>

                            <tr>
                                <th>اسم العميل</th>
                                <th>رقم الهاتف</th>
                                <th>البريد الالكتروني</th>
                                <th>تاريخ الانشاء</th>
                            </tr>

                            </thead>


                            <tbody>
                            @forelse ($clients as $client)
                                <tr data-id="5">

                                    <td data-field="name">{{ $client->first_name . ' ' . $client->family_name }}</td>
                                    <td data-field="phone_number">{{$client->phone_number }}
                                        {{$client->addresses->first()->country->phone_code ?? '' }}+
                                    </td>
                                    <td data-field="email">{{ $client->email }}</td>
                                    <td data-field="gender">{{ $client->created_at->format('Y-m-d H:i') }}</td>


                                    @empty
                                        <td colspan="6">
                                            لا يوجد عملاء لعرضهم
                                        </td>
                                </tr>
                            @endforelse
                            </tbody>

                            <!-- end tbody -->
                        </table>
                        <!-- end table -->
                        {{ $clients->withQueryString()->links() }}
                    </div>
                    <!-- end -->
                </div>
            </div>
        </div> <!-- end col -->
    </div>

@endsection
