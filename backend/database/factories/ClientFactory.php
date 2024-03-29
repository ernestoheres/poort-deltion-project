<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Provider\nl_NL\Person;
use Illuminate\Support\Facades\Storage;
use Database\Factories\UserFactory;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = \App\Models\Client::class;

    public function definition(): array
    {

    $tussenvoegsels = [
        '‘S', '‘s', '‘T', '‘t', 'A', 'a', 'Aan', 'aan', 'Aan ’t', 'aan ’t',
        'Aan de', 'aan de', 'Aan den', 'aan den', 'Aan der', 'aan der',
        'Aan het', 'aan het', 'Aan t', 'aan t', 'Af', 'af', 'Al', 'al',
        'Am', 'am', 'Am de', 'am de', 'Auf', 'auf', 'Auf dem', 'auf dem',
        'Auf den', 'auf den', 'Auf der', 'auf der', 'Auf ter', 'auf ter',
        'Aus', 'aus', 'Aus ‘m', 'aus ‘m', 'Aus dem', 'aus dem', 'Aus den', 'aus den',
        'Aus der', 'aus der', 'Aus m', 'aus m', 'Ben', 'ben', 'Bij', 'bij',
        'Bij ’t', 'bij ’t', 'Bij de', 'bij de', 'Bij den', 'bij den', 'Bij het', 'bij het',
        'Bij t', 'bij t', 'Bin', 'bin', 'Boven d', 'boven d', 'Boven d’', 'boven d’',
        'D', 'd', 'D’', 'd’', 'Da', 'da', 'Dal', 'dal', 'Dal’', 'dal’',
        'Dalla', 'dalla', 'Das', 'das', 'De', 'de', 'De die', 'de die',
        'De die le', 'de die le', 'De l', 'de l', 'De l’', 'de l’', 'De la', 'de la',
        'De las', 'de las', 'De le', 'de le', 'De van der', 'de van der', 'Deca', 'deca',
        'Degli', 'degli', 'Dei', 'dei', 'Del', 'del', 'Della', 'della', 'Den', 'den',
        'Der', 'der', 'Des', 'des', 'Di', 'di', 'Die le', 'die le', 'Do', 'do', 'Don', 'don',
        'Dos', 'dos', 'Du', 'du', 'El', 'el', 'Het', 'het', 'I', 'i', 'Im', 'im',
        'In', 'in', 'In ’t', 'in ’t', 'In de', 'in de', 'In den', 'in den', 'In der', 'in der',
        'In het', 'in het', 'In t', 'in t', 'L', 'l', 'L’', 'l’', 'La', 'la', 'Las', 'las',
        'Le', 'le', 'Les', 'les', 'Lo', 'lo', 'Los', 'los', 'Of', 'of', 'Onder', 'onder',
        'Onder ’t', 'onder ’t', 'Onder de', 'onder de', 'Onder den', 'onder den', 'Onder het',
        'onder het', 'Onder t', 'onder t', 'Op', 'op', 'Op ’t', 'op ’t', 'Op de', 'op de',
        'Op den', 'op den', 'Op der', 'op der', 'Op gen', 'op gen', 'Op het', 'op het',
        'Op t', 'op t', 'Op ten', 'op ten', 'Over', 'over', 'Over ’t', 'over ’t', 'Over de',
        'over de', 'Over den', 'over den', 'Over het', 'over het', 'Over t', 'over t', 'S', 's',
        'S’', 's’', 'T', 't', 'Te', 'te', 'Ten', 'ten', 'Ter', 'ter', 'Tho', 'tho', 'Thoe', 'thoe',
        'Thor', 'thor', 'To', 'to', 'Toe', 'toe', 'Tot', 'tot', 'Uijt', 'uijt', 'Uijt ’t', 'uijt ’t',
        'Uijt de', 'uijt de', 'Uijt den', 'uijt den', 'Uijt te de', 'uijt te de', 'Uijt ten', 'uijt ten',
        'Uit', 'uit', 'Uit ’t', 'uit ’t', 'Uit de', 'uit de', 'Uit den', 'uit den', 'Uit het', 'uit het',
        'Uit t', 'uit t', 'Uit te de', 'uit te de', 'Uit ten', 'uit ten', 'Unter', 'unter', 'Van', 'van',
        'Van ’t', 'van ’t', 'Van de', 'van De', 'van de', 'Van de l', 'van de l', 'Van de l’', 'van de l’',
        'Van Den', 'Van den', 'van den', 'Van Der', 'Van der', 'van der', 'Van gen', 'van gen', 'Van het',
        'van het', 'Van la', 'van la', 'Van t', 'van t', 'Van ter', 'van ter', 'Van van de', 'van van de',
        'Ver', 'ver', 'Vom', 'vom', 'Von', 'von', 'Von ’t', 'von ’t', 'Von dem', 'von dem', 'Von den', 'von den',
        'Von der', 'von der', 'Von t', 'von t', 'Voor', 'voor', 'Voor ’t', 'voor ’t', 'Voor de', 'voor de',
        'Voor den', 'voor den', 'Voor in ’t', 'voor in ’t', 'Voor in t', 'voor in t', 'Vor', 'vor', 'Vor der', 'vor der',
        'Zu', 'zu', 'Zum', 'zum', 'Zur', 'zur'
    ];

    $bloedtypes = [
        'A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-', 'onbekend'
    ];

    $bloedtype = $bloedtypes[array_rand($bloedtypes)];

        #33% kans op een tussenvoegsel

        $tussenvoegsel = $tussenvoegsels[array_rand($tussenvoegsels)];
        if (rand(0, 2) !== 0) {
            $tussenvoegsel = '';
        }

        $host = '127.0.0.1';
        $port = '2000';
    try {
        $socket = socket_create(AF_INET, SOCK_STREAM, 0) or die('Could not create socket');
        $result = socket_connect($socket, $host, $port) or die('Could not connect to server');

        if(rand(0,1) == 0) {
            $gender = "Male";
        }
        else {
            $gender = "Female";
        }

        socket_write($socket,  "GET ". $gender) or die('Could not write to server');

        $result = socket_read ($socket, 600000) or die('Could not read server response');

        $uuid = $this->faker->uuid();
        Storage::disk('local')->put('img/'. $uuid . '.jpg', $result);

        socket_close($socket);
    } catch (\Throwable $th) {
        
        $uuid = null;
    }

        if ($gender === "Male") {
            $firstname = $this->faker->firstNameMale();
            $geslacht = "Man";
        }
        else {
            $firstname = $this->faker->firstNameFemale();
            $geslacht = "Vrouw";
        }

        $this->faker->addProvider(new Person($this->faker));
        return [
            'voornaam' => $firstname,
            'tussenvoegels' => $tussenvoegsel,
            'achternaam' => $this->faker->lastName(),
            'adres' => $this->faker->streetAddress(),
            'postcode' => $this->faker->postcode(),
            'woonplaats' => $this->faker->city(),
            'land' => $this->faker->country(),
            'telefoon' => $this->faker->phoneNumber(),
            'bsn' => $this->faker->idNumber(),
            'vezekering' => $this->faker->company(),
            'polisnummer' => $this->faker->randomNumber(),
            'bloedtype' => $bloedtype,
            'geslacht' => $geslacht,
            'profielfoto' => $uuid,
            'user_id' => UserFactory::new()->create()->id,
        ];

    }
}
