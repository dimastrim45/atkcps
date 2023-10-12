<tr class="text-center">
    <td><a
            href="{{ route('barangmasuk.show', ['barangmasuk' => $barangmasuk->docnum]) }}">{{ $barangmasuk->docnum }}</a>
    </td>
    <td>{{ $barangmasuk->admin }}</td>
    <td>{{ $barangmasuk->po_docnum }}</td>
    <td>{{ $barangmasuk->docdate }}</td>
    <td class="word-wrap: break-word w-25">
        {{ $barangmasuk->remarks }}
    </td>
</tr>