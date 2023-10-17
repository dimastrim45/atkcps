<tr class="text-center">
    <td>{{ $item->name }}</td>
    <td>{{ $item->itemgroup->code }}</td>
    <td>{{ $item->uom }}</td>
    <td>{{ $item->price }}</td>
    <td>{{ $item->expdate }}</td>
    <td>{{ $item->qty }}</td>
    <td>{{ $item->min_qty }}</td>
    <td>{{ $item->status }}</td>
    @if (in_array(auth()->user()->license, ['administrator', 'hradmin']))
        <td class="d-flex justify-content-center">
            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                @unless ($item->status === 'inactive')
                    <form action="/items/inactive/{{ $item->id }}" method="POST">
                        @method('PUT')
                        @csrf
                        <button type="submit" class="btn btn-danger">Inactive</button>
                    </form>
                @endunless

                <a href="{{ route('item.edit', ['item' => $item->id]) }}">
                    <button type="button" class="btn btn-warning">Edit</button>
                </a>

                @unless ($item->status === 'active')
                    <form action="items/active/{{ $item->id }}" method="POST">
                        @method('PUT')
                        @csrf
                        <button type="submit" class="btn btn-success">Active</button>
                    </form>
                @endunless
            </div>
        </td>
    @endif
</tr>
