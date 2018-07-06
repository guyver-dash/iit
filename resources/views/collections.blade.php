<table>
    <thead>
    <tr></tr>
    <tr></tr>
    <tr>
        <td><h3>DAILY COLLECTION REPORT</h3></td>
    </tr>
    <tr>
        <th>From: {{ $startDate }}</th>
        <th>To: {{ $endDate }}</th>
    </tr>
    </thead>
    <tbody>
    <tr></tr>
    <tr></tr>
    <tr>
        <th>OR NO</th>
        <th>Lastname</th>
        <th>Firstname</th>
        <th>STD No:</th>
        <th>Course</th>
        <th>Balance Name</th>
        <th>Paid Amount</th>
        <th>SU</th>
        <th>ID</th>
        <th>Old Balance</th>

    </tr>
    @foreach($payments as $payment)
        <tr>
            <td>{{ $payment->prefix . '-' . $payment->receipt_no }}</td>
            <td>{{ $payment->confirmEnrolled->enrollee->lastname }}</td>
            <td>{{ $payment->confirmEnrolled->enrollee->firstname }}</td>
            <td></td>
            <td>{{ $payment->confirmEnrolled->course->name }}</td>
            <td>{{ $payment->balance->name }}</td>
            <td>&#8369; {{number_format($payment->amount_charge,  2, '.', ',')}}</td>
        </tr>
    @endforeach
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td> TOTAL COLLECTION</td>
            <td>&#8369; {{ $payments->sum('amount_charge') }}</td>

        </tr>
    </tbody>
</table>