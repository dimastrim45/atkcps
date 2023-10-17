<tr class="text-center">
    <td><a href="{{ route('pengeluaran.show', ['pengeluaran' => $pengeluaran->docnum]) }}">{{ $pengeluaran->docnum }}</a>
    </td>
    <td>{{ $pengeluaran->admin }}</td>
    <td>{{ $pengeluaran->requester_name }}</td>
    <td>{{ $pengeluaran->docdate }}</td>
    <td>{{ $pengeluaran->requester->plant->name }}</td>
    <td>{{ $pengeluaran->status }}</td>
    @if (auth()->user()->license !== 'staff')
        <td class="d-flex justify-content-center">
            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                @if ($pengeluaran->status == 'Open')
                    <form action="/pengeluaran/cancel/{{ $pengeluaran->docnum }}" method="POST">
                        @method('PUT')
                        @csrf
                        <button type="submit" class="btn btn-danger">Cancel</button>
                    </form>
                    {{-- <button type="button" class="btn btn-warning">Open</button> --}}
                    <form action="/pengeluaran/picked/{{ $pengeluaran->docnum }}" method="POST">
                        @method('PUT')
                        @csrf
                        <button type="submit" class="btn btn-success">Picked</button>
                    </form>
                @endif
            </div>
        </td>
    @endif
</tr>
