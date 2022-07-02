@foreach ($data as $value)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $value->district }}</td>
        <td>{{ $value->area }}</td>
        <td>{{ $value->post_code }}</td>
        <td>{{ $value->home_delivery }}</td>
        <td>{{ $value->charge_1kg }}</td>
        <td>{{ $value->charge_2kg }}</td>
        <td>{{ $value->charge_3kg }}</td>
        <td>{{ $value->code_charge }}</td>
    </tr>
@endforeach
<tr>
    <td colspan="3" align="center">
        {!! $data->links() !!}
    </td>
</tr>