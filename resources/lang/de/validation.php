<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => 'Das Feld :attribute muss akzeptiert werden.',
    'active_url'           => 'Das Feld :attribute enthält keine gültige URL.',
    'after'                => 'Das Feld :attribute muss ein Datum nach dem :date sein.',
    'alpha'                => 'Das Feld :attribute darf nur Buchstaben enthalten.',
    'alpha_dash'           => 'Das Feld :attribute darf nur Buchstaben, Zahlen und Bindestriche enthalten.',
    'alpha_num'            => 'Das Feld :attribute darf nur Buchstaben und Zahlen enthalten.',
    'array'                => 'Das Feld :attribute muss ein array sein.',
    'before'               => 'Das Feld :attribute muss ein Datum vor dem :date sein.',
    'between'              => [
        'numeric' => 'Die Eingabe im Feld :attribute muss zwischen :min und :max liegen.',
        'file'    => 'Die Eingabe im Feld :attribute muss zwischen :min und :max kilobytes liegen.',
        'string'  => 'Die Eingabe im Feld :attribute muss zwischen :min und :max Zeichen liegen.',
        'array'   => 'Die Eingabe im Feld :attribute muss zwischen :min und :max Felder enthalten.',
    ],
    'boolean'              => 'Das Feld :attribute muss wahr oder falsch zurückgeben.',
    'confirmed'            => 'Das Feld :attribute muss bestätigt werden.',
    'date'                 => 'Das Feld :attribute enthält kein gültiges Datum.',
    'date_format'          => 'Das Feld :attribute entspricht nicht dem vorgegebenen Format :format.',
    'different'            => 'Der Feldinhalt von :attribute und :other darf nicht gleich sein.',
    'digits'               => 'Das Feld :attribute muss :digits Zahlen enthalten.',
    'digits_between'       => 'Das Feld :attribute muss zwischen :min und :max Zahlen enthalten.',
    'email'                => 'Das Feld :attribute muss eine gültige E-Mail-Adresse enthalten.',
    'exists'               => 'Das ausgewählte Feld :attribute is ungültig.',
    'filled'               => 'Das Feld :attribute ist ein Pflichtfeld.',
    'image'                => 'Das Feld :attribute muss ein Bild enthalten.',
    'in'                   => 'Das ausgewählte Feld :attribute ist ungültig.',
    'integer'              => 'Das Feld :attribute muss eine Ganzzahl sein.',
    'ip'                   => 'Das Feld :attribute muss eine gültige IP-Adresse enthalten.',
    'max'                  => [
        'numeric' => 'Das Feld :attribute darf nicht größer sein als :max.',
        'string'  => 'Das Feld :attribute darf nicht mehr als :max Zeichen enthalten.',
        'file'    => 'Die Datei im Feld :attribute darf nicht größer sein als :max kilobytes.',
        'array'   => 'Das Feld :attribute darf nicht have more than :max items.',
    ],
    'mimes'                => 'Das Feld :attribute muss eine Datei vom Typ: :values enthalten.',
    'min'                  => [
        'numeric' => 'Die Eingabe im Feld :attribute muss mindestens :min betragen.',
        'file'    => 'Die Datei im Feld :attribute muss mindestens :min kilobytes groß sein.',
        'string'  => 'Das Feld :attribute muss mindestens :min Zeichen enthalten.',
        'array'   => 'Das Feld :attribute muss mindestens :min Felder enthalten.',
    ],
    'not_in'               => 'Das ausgewählte Feld :attribute ist ungültig.',
    'numeric'              => 'Das Feld :attribute muss eine Nummer enthalten.',
    'regex'                => 'Das im Feld :attribute eingetragene Format ist ungültig.',
    'required'             => 'Das Feld :attribute ist ein Pflichtfeld.',
    'required_if'          => 'Das Feld :attribute ist ein Pflichfeld, wenn im Feld :other :value ausgewählt ist.',
    'required_with'        => 'Das Feld :attribute ist ein Pflichtfeld, wenn :values ausgewählt ist.',
    'required_with_all'    => 'Das Feld :attribute ist ein Pflichtfeld, wenn :values ausgewählt sind.',
    'required_without'     => 'Das Feld :attribute ist ein Pflichtfeld, wenn :values nicht ausgewählt ist.',
    'required_without_all' => 'Das Feld :attribute ist ein Pflichtfeld, wenn :values nicht ausgewählt sind.',
    'same'                 => 'Das Feld :attribute und :other müssen übereinstimmen.',
    'size'                 => [
        'numeric' => 'Der Inhalt im Feld :attribute muss eine :size-stellige Zahl sein.',
        'file'    => 'Die Datei im Feld :attribute muss :size kilobytes groß sein.',
        'string'  => 'Die Eingabe im Feld :attribute muss :size Zeichen lang sein.',
        'array'   => 'Das Feld :attribute muss :size Felder enthalten.',
    ],
    'string'               => 'Das Feld :attribute muss eine Zeichenkette sein.',
    'timezone'             => 'Das Feld :attribute muss eine gültige Zeitzone enthalten.',
    'unique'               => 'Das Feld :attribute existiert bereits an einer anderen Stelle.',
    'url'                  => 'Das Feld :attribute enthält kein gültiges URL-Format.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'mailer'                  => [
            'error' => 'Es ist ein Fehler beim Versenden der E-Mail aufgetreten.',
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [
        'blog_id' => 'Blog ID',
        'title' => 'Anrede',
        'name' => 'Name',
        'firstname' => 'Vorname',
        'lastname' => 'Nachname',
        'surname' => 'Nachname',
        'email' => 'E-Mail Adresse',
        'phone' => 'Telefon',
        'message' => 'Nachricht',
        'street' => 'Straße und Nr.',
        'zip' => 'PLZ',
        'city' => 'Stadt',
        'birth_location' => 'Geburtsort',
        'birth_date' => 'Geburtsdatum',
        'privacy' => 'Datenschutzerklärung',
        'location' => 'Standort/Filiale',
    ],

];
