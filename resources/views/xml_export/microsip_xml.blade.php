<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
{{-- <contacts refresh="0">
    @foreach ($contacts as $contact)
        <contact name="{{ $contact->username }}" number="{{ $contact->nmr_casa }}"
            firstname="{{ $contact->pri_nome }}" lastname="{{ $contact->apelido }}"
            @if ($contact->usar_nmr_escritorio == 1) phone="{{ $contact->nmr_escritorio }}" @else phone="" @endif
            @if ($contact->usar_nmr_telemovel == 1) mobile="{{ $contact->nmr_telemovel }}" @else mobile="" @endif
            email="{{ $contact->email }}" address="" city="" state="" zip="" comment="" presence="0" starred="0"
            info="" />
    @endforeach
</contacts> --}}
<directory>
    @foreach ($contacts as $contact)
        @if ($contact->usar_nmr_escritorio == 0)
        @else
            <entry>
                <presence>1</presence>
                <name>{{ $contact->username }}</name>
                <extension>{{ $contact->nmr_escritorio }}</extension>
            </entry>
        @endif
    @endforeach
</directory>
