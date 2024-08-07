@if ($row && $row->plan && $row->plan->currency)
    {{ currencyFormat($row->payable_amount, 0, $row->plan->currency->currency_code) }}
@else
    {{ currencyFormat($row->payable_amount, 0, 'USD') }}
@endif
