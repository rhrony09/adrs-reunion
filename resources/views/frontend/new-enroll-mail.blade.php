<x-mail::message>
# New Enrollment

Hello, Admin. New reunion enrollment received.

<x-mail::panel>
    Token: {{ $data['token'] }}\
    Name: {{ $data['name'] }}\
    Mobile: {{ $data['mobile'] }}\
    Batch: {{ $data['batch']->batch }}\
    Payment Method: {{ $data['payment_method'] }}\
    Transaction: {{ $data['transaction'] ?? '--' }}
</x-mail::panel>

Thanks
</x-mail::message>
