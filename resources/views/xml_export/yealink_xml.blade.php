<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<IPPhoneDirectory>
    @foreach ($contacts as $contact)
        <DirectoryEntry>
            @if ($contact->usar_nmr_escritorio == 0 && $contact->usar_nmr_telemovel == 0)
            @else
                <Name>{{ $contact->username }}</Name>
                @if ($contact->usar_nmr_escritorio == 1)
                    <Telephone>{{ $contact->nmr_escritorio }}</Telephone>
                @else
                    <Telephone></Telephone>
                @endif
                @if ($contact->usar_nmr_telemovel == 1)
                    <Telephone>{{ $contact->nmr_telemovel }}</Telephone>
                @else
                    <Telephone></Telephone>
                @endif
                <Telephone>{{ $contact->nmr_casa }}</Telephone>
            @endif
        </DirectoryEntry>
    @endforeach
</IPPhoneDirectory>
