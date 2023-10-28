<tr class="text-center">
    <td><a href="{{ route('permintaan.show', ['permintaan' => $permintaan->docnum]) }}">{{ $permintaan->docnum }}</a>
    </td>
    <td>{{ $permintaan->requester }}</td>
    <td>{{ $permintaan->docdate }}</td>
    <td>{{ $permintaan->duedate }}</td>
    <td>{{ $permintaan->user->plant->name }}</td>
    <td>{{ $permintaan->status }}</td>
    @if (auth()->user()->license !== 'staff')
        <td class="d-flex justify-content-center">
            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                @if ($permintaan->status == 'Open')
                    <form action="/permintaan/reject/{{ $permintaan->docnum }}" method="POST">
                        @method('PUT')
                        @csrf
                        <button type="submit" class="btn btn-danger mr-2">Reject</button>
                    </form>
                    <form action="/permintaan/close/{{ $permintaan->docnum }}" method="POST">
                        @method('PUT')
                        @csrf
                        <button type="submit" class="btn btn-success">Close</button>
                    </form>
                @endif
                @if ($permintaan->status !== 'Open')
                    <form action="/permintaan/open/{{ $permintaan->docnum }}" method="POST">
                        @method('PUT')
                        @csrf
                        <button type="submit" class="btn btn-success mr-2">Open</button>
                    </form>
                @endif
            </div>
        </td>
    @endif
</tr>
