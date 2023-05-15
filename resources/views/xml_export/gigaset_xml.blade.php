<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
{{-- <!DOCTYPE LocalDirectory> --}}
<list response="get_list" type="pb" total="" first="1" last="" regsrc="auto">
    @foreach ($contacts as $contact)
        @if ($contact->usar_nmr_escritorio == 0 && $contact->usar_nmr_telemovel == 0)
        @else
            <entry nn="{{ $contact->username }}" ln="{{ $contact->empresa }}"
                @if ($contact->usar_nmr_escritorio == 1) hm="{{ $contact->nmr_escritorio }}"
            @else hm="" @endif
                @if ($contact->usar_nmr_telemovel == 1) mb="{{ $contact->nmr_telemovel }}"
            @else mb="" @endif
                ct="" cat="{{ $contact->grupo }}" st="" />
        @endif
    @endforeach
</list>
