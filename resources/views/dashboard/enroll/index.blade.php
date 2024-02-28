@extends('layouts.dashboard')

@section('content')
    <div class="row mb-3">
        <div class="col-sm-2">
            <select id="batch" class="form-select">
                <option value="all">All</option>
                @foreach ($batches as $batche)
                    <option value="{{ $batche->id }}" {{ request()->batch == $batche->id ? 'selected' : '' }}>{{ $batche->batch }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-sm-2">
            <button type="button" id="enroll-filter" class="btn btn-primary"><i class="fa-solid fa-magnifying-glass"></i></button>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-3">
            <div class="card overflow-hidden rounded-4">
                <div class="card-body p-2">
                    <div class="rounded-4 overflow-hidden bg-primary">
                        <div class="p-3 d-flex justify-content-between align-items-center">
                            <p class="text-white m-0">Total Registration</p>
                            <h4 class="text-white m-0">{{ $enrolls->count() }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card overflow-hidden rounded-4">
                <div class="card-body p-2">
                    <div class="rounded-4 overflow-hidden bg-pink">
                        <div class="p-3 d-flex justify-content-between align-items-center">
                            <p class="text-white m-0">bkash Payment</p>
                            <h4 class="text-white m-0">{{ $enrolls->where('payment_method', 'bkash')->count() }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card overflow-hidden rounded-4">
                <div class="card-body p-2">
                    <div class="rounded-4 overflow-hidden bg-purple">
                        <div class="p-3 d-flex justify-content-between align-items-center">
                            <p class="text-white m-0">Offline Payment</p>
                            <h4 class="text-white m-0">{{ $enrolls->where('payment_method', 'offline')->count() }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card overflow-hidden rounded-4">
                <div class="card-body p-2">
                    <div class="rounded-4 overflow-hidden bg-success">
                        <div class="p-3 d-flex justify-content-between align-items-center">
                            <p class="text-white m-0">Total Received</p>
                            <h4 class="text-white m-0">{{ moneyFormatBD($enrolls->sum('amount')) }} <small>TK</small></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <div class="h4 m-0">Registrations</div>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped align-middle text-center datatable" width="100%">
                <thead>
                    <tr>
                        <th width="30px">S/N</th>
                        <th>Name</th>
                        <th class="text-center">Mobile</th>
                        <th class="text-center">Batch</th>
                        <th class="text-center">Payment Method</th>
                        <th class="text-center">Token</th>
                        <th class="text-center">Amount</th>
                        <th class="text-center">Registred On</th>
                        @if (in_array(auth()->user()->role_id, [1]))
                            <th class="text-center">Action</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($enrolls as $enroll)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="text-start">{{ $enroll->name }}</td>
                            <td>{{ $enroll->mobile }}</td>
                            <td>{{ $enroll->batch ? $enroll->batch->batch : '--' }}</td>
                            <td>
                                {{ $enroll->payment_method }}
                                @if ($enroll->transaction)
                                    <p class="m-0 f-10">{{ $enroll->transaction }}</p>
                                @endif
                            </td>
                            <td>{{ $enroll->token }}</td>
                            <td>{{ moneyFormatBD($enroll->amount) }} TK</td>
                            <td>
                                {{ $enroll->created_at->format('d-m-Y') }}<br>
                                {{ $enroll->created_at->format('h:i A') }}
                            </td>
                            @if (in_array(auth()->user()->role_id, [1]))
                                <td>
                                    <x-dropdown>
                                        <x-dropdownButton class="enroll-edit" icon="pencil-alt" data-id="{{ $enroll->id }}">Edit</x-dropdownButton>
                                        <x-dropdownButton class="enroll-delete" icon="trash-can" data-id="{{ $enroll->id }}">Delete</x-dropdownButton>
                                    </x-dropdown>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $('#enroll-filter').click(function() {
            let batch = $('#batch').val();
            if (batch != '') {
                let url = "{{ route('dashboard.index') }}?batch=" + batch;
                window.location.href = url;
            }
        });

        $('.enroll-edit').click(function() {
            $('#rhModal').modal('show');
            let id = $(this).data('id');
            let url = "{{ route('dashboard.enroll.edit', ':id') }}";
            url = url.replace(':id', id);
            $.ajax({
                method: 'GET',
                url: url,
                success: function(response) {
                    $('#rhModal .modal-content').html(response);
                }
            });
        });

        $('.enroll-delete').click(function() {
            let url = "{{ route('dashboard.enroll.delete', ':id') }}";
            url = url.replace(':id', $(this).data('id'));
            delete_warning(url);
        });
    </script>
@endpush
