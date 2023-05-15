<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<AddressBook>
    @foreach ($contacts as $contact)
        @if ($contact->usar_nmr_escritorio == 0)
        @else
            <Contact>
                <FirstName>{{ $contact->username }}</FirstName>
                <LastName></LastName>
                <Phone>
                    <phonenumber>{{ $contact->nmr_escritorio }}</phonenumber>
                    <accountindex>1</accountindex>
                </Phone>
                <Groups>
                    @if ($contact->grupo == 'amigos')
                        <groupid>1</groupid>
                    @elseif ($contact->grupo == 'familia')
                        <groupid>0</groupid>
                    @elseif ($contact->grupo == 'trabalho')
                        <groupid>2</groupid>
                    @elseif ($contact->grupo == 'lista_colegas')
                        <groupid>3</groupid>
                    @else
                        <groupid>4</groupid>
                    @endif
                </Groups>
            </Contact>
        @endif
    @endforeach
</AddressBook>
