<style>
    .container {
        display: grid;
        place-items: center;
        margin-top: 5%
    }
    table {
        border-collapse: collapse;
        width: 80%;
    }

    th, td {
        border: 1px solid black;
    }
</style>
<div class="container">
    <table>
        <thead>
            @foreach ($th as $item)
            <th>{{ $item }}</th>
            @endforeach
        </thead>
        <tbody>
            @foreach ($users as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->username }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>