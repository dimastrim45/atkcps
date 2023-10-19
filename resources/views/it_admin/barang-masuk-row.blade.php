<tr class="text-center">
    <td><a
            href="{{ route('barangmasuk.show', ['barangmasuk' => $barangmasuk->docnum]) }}">{{ $barangmasuk->docnum }}</a>
    </td>
    <td>{{ $barangmasuk->admin }}</td>
    <td>{{ $barangmasuk->po_docnum }}</td>
    <td>{{ $barangmasuk->docdate }}</td>
    <td>{{ $barangmasuk->status }}</td>
    <td class="word-wrap: break-word w-25">
        {{ $barangmasuk->remarks }}
    </td>
    <td class="d-flex justify-content-center">
        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
            @unless ($barangmasuk->status === 'open')
                <form action="/barangmasuk/cancel/{{ $barangmasuk->docnum }}" method="POST">
                    @method('PUT')
                    @csrf
                    <button type="submit" class="btn btn-danger">Cancel</button>
                </form>
                <form action="barangmasuk/approve/{{ $barangmasuk->docnum }}" method="POST">
                    @method('PUT')
                    @csrf
                    <button type="submit" class="btn btn-success">Approve</button>
                </form>
            @endunless
        </div>
    </td>
</tr>