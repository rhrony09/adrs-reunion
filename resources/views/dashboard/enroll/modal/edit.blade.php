<form id="enroll-form-modal">
    <div class="modal-header">
        <h5 class="modal-title">Edit Registration</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>

    <div class="modal-body">
        <div id="form-errors-modal"></div>
        @csrf
        <input type="hidden" name="id" value="{{ $enroll->id }}">
        <div class="row">
            <div class="col-md-6">
                <label class="mb-1" for="name">Name</label>
                <input type="text" class="form-control" value="{{ $enroll->name }}" name="name" id="name" required>
            </div>
            <div class="col-md-6">
                <label class="mb-1" for="mobile">Mobile</label>
                <input type="text" class="form-control" value="{{ $enroll->mobile }}" name="mobile" id="mobile" required>
            </div>
            <div class="col-md-3 mt-3">
                <label class="mb-1" for="batch_id">Batch</label>
                <select name="batch_id" id="batch_id" class="form-select">
                    @foreach ($batches as $batch)
                        <option value="{{ $batch->id }}" {{ $batch->id == $enroll->batch_id ? 'selected' : '' }}>{{ $batch->batch }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 mt-3">
                <label class="mb-1" for="payment_method">Payment Method</label>
                <select name="payment_method" id="payment_method" class="form-select">
                    <option value="bkash" {{ $enroll->payment_method == 'bkash' ? 'selected' : '' }}>bkash</option>
                    <option value="offline" {{ $enroll->payment_method == 'offline' ? 'selected' : '' }}>offline</option>
                </select>
            </div>
            <div class="col-md-3 mt-3">
                <label class="mb-1" for="amount">Amount</label>
                <input type="text" class="form-control" value="{{ $enroll->amount }}" name="amount" id="amount">
            </div>
            <div class="col-md-3 mt-3">
                <label class="mb-1" for="transaction">Transaction No</label>
                <input type="text" class="form-control" value="{{ $enroll->transaction }}" name="transaction" id="transaction">
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
    </div>
</form>

<script>
    $('#enroll-form-modal').submit(function(e) {
        e.preventDefault();
        $('#form-errors-modal').html('');
        $.ajax({
            type: 'POST',
            url: "{{ route('dashboard.enroll.update') }}",
            data: $(this).serialize(),
            success: function(response) {
                if (response.success) {
                    window.location.reload(true);
                }
            },
            error: function(response) {
                let errors = response.responseJSON.errors;
                let errorsHtml = '<div class="alert alert-danger alert-dismissible fade show"><ul class="m-0">';
                if (errors) {
                    $.each(errors, function(key, value) {
                        errorsHtml += '<li>' + value + '</li>';
                    });
                } else {
                    errorsHtml += '<li>' + response.responseJSON.message + '</li>';
                }
                errorsHtml += '</ul><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';

                $('#form-errors-modal').html(errorsHtml);
            }
        });
    });
</script>
