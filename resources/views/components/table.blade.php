<div>

    <table class="table">
        <thead>
            <tr>
                @foreach ($items[0] as $key => $value)
                    <th>{{ $key }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $row)
                <tr>
                    @foreach ($row as $item)
                        <td>{{ $item }}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>

</div>
