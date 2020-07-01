

<h3>Repayments Made</h3>
<table class="table">
    <tr>
        <th>Date Paid</th>
        <th>Receipt</th>
        <th>Method</th>
        <th>Amount</th>
        <th>Entered By</th>
        <th>Entered At</th>
        <th>Actions</th>
    </tr>
    @foreach ($row->repayments as $row)
        <tr>
            <td>{{$row->date_paid}}</td>
            <td>{{$row->receipt}}</td>
            <td>{{$row->method}}</td>
            <td>{{$row->amount}}</td>
            <td>{{$row->entered_by}}</td>
            <td>{{$row->created_at}}</td>
            <td><href="#">Void</a></td>
        </tr>
    @endforeach
</table>
            