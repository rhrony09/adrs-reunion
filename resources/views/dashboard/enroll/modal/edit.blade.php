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
                <x-forms.Text fieldId="name" fieldLabel="Name" fieldName="name" fieldValue="{{ $enroll->name }}" :fieldRequired="true"></x-forms.Text>
            </div>
            <div class="col-md-6">
                <x-forms.Text fieldId="mobile" fieldLabel="Mobile" fieldName="mobile" fieldValue="{{ $enroll->mobile }}" :fieldRequired="true"></x-forms.Text>
            </div>
            <div class="col-md-3">
                <x-forms.Select fieldId="batch_id" fieldLabel="Batch" fieldName="batch_id">
                    @foreach ($batches as $batch)
                        <option value="{{ $batch->id }}" {{ $batch->id == $enroll->batch_id ? 'selected' : '' }}>{{ $batch->batch }}</option>
                    @endforeach
                </x-forms.Select>
            </div>
            <div class="col-md-3">
                <x-forms.Select fieldId="payment_method" fieldLabel="Payment Method" fieldName="payment_method">
                    <option value="bkash" {{ $enroll->payment_method == 'bkash' ? 'selected' : '' }}>bkash</option>
                    <option value="offline" {{ $enroll->payment_method == 'offline' ? 'selected' : '' }}>offline</option>
                </x-forms.Select>
            </div>
            <div class="col-md-3">
                <x-forms.Text fieldId="amount" fieldLabel="Amount" fieldName="amount" fieldValue="{{ $enroll->amount }}"></x-forms.Text>
            </div>
            <div class="col-md-3">
                <x-forms.Text fieldId="transaction" fieldLabel="Transaction No" fieldName="transaction" fieldValue="{{ $enroll->transaction }}"></x-forms.Text>
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
