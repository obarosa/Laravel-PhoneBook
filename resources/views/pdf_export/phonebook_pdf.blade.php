<style type="text/css">
   table{
        width: 100%;
        border-collapse: collapse;
    }
    table td, table th{
        border:1px solid black;
    }
    table tr, table td{
        padding: 5px;
    }

</style>

<div class="container">
    <h3>Phonebook</h3>
    <table>
        <thead>
            <tr>
                <th>{{ __('main.pbx') }}</th>
                <th>{{ __('main.company') }}</th>
                <th>{{ __('main.nmrCasa') }}</th>
                <th>{{ __('main.nmrTelemovel') }}</th>
                <th>{{ __('main.nmrEscritorio') }}</th>
            </tr>
        </thead>
        <tbody>
            @if (count($contacts) > 0)
                @foreach ($contacts as $contact)
                    <tr>
                        <td class="">{{ $contact->username }}</td>
                        <td class="">{{ $contact->empresa }}</td>
                        <td class="">{{ $contact->nmr_casa }}</td>
                        @if ($contact->usar_nmr_telemovel == null)
                            <td></td>
                        @else
                            <td>{{ $contact->nmr_telemovel }}</td>
                        @endif
                        @if ($contact->usar_nmr_escritorio == null)
                            <td></td>
                        @else
                            <td>{{ $contact->nmr_escritorio }}</td>
                        @endif
                    </tr>
                @endforeach
            @else
                <td colspan="9">{{ __('main.0data') }}</td>
            @endif
        </tbody>
    </table>
</div>
