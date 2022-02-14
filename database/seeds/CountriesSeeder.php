<?php

use Illuminate\Database\Seeder;

class CountriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('countries')->insert([
            ["code_phone" => "93", "code"=>'AF',"name"=> 'Afghanistan'],
            ["code_phone" => "355", "code"=>'AL',"name"=> 'Albania'],
            ["code_phone" => "213", "code"=>'DZ',"name"=> 'Algeria'],
            ["code_phone" => "1 (684)", "code"=>'AS',"name"=> 'American Samoa'],
            ["code_phone" => "376", "code"=>'AD',"name"=> 'Andorra'],
            ["code_phone" => "244", "code"=>'AO',"name"=> 'Angola'],
            ["code_phone" => "1 (264)", "code"=>'AI',"name"=> 'Anguilla'],
            ["code_phone" => "1 (268)", "code"=>'AG',"name"=> 'Antigua And Barbuda'],
            ["code_phone" => "54", "code"=>'AR',"name"=> 'Argentina'],
            ["code_phone" => "374", "code"=>'AM',"name"=> 'Armenia'],
            ["code_phone" => "297", "code"=>'AW',"name"=> 'Aruba'],
            ["code_phone" => "61", "code"=>'AU',"name"=> 'Australia'],
            ["code_phone" => "43", "code"=>'AT',"name"=> 'Austria'],
            ["code_phone" => "994", "code"=>'AZ',"name"=> 'Azerbaijan'],
            ["code_phone" => "1 (242)", "code"=>'BS',"name"=> 'Bahamas'],
            ["code_phone" => "973", "code"=>'BH',"name"=> 'Bahrain'],
            ["code_phone" => "880", "code"=>'BD',"name"=> 'Bangladesh'],
            ["code_phone" => "1 (246)", "code"=>'BB',"name"=> 'Barbados'],
            ["code_phone" => "375", "code"=>'BY',"name"=> 'Belarus'],
            ["code_phone" => "32", "code"=>'BE',"name"=> 'Belgium'],
            ["code_phone" => "501", "code"=>'BZ',"name"=> 'Belize'],
            ["code_phone" => "229", "code"=>'BJ',"name"=> 'Benin'],
            ["code_phone" => "1 (441)", "code"=>'BM',"name"=> 'Bermuda'],
            ["code_phone" => "975", "code"=>'BT',"name"=> 'Bhutan'],
            ["code_phone" => "591", "code"=>'BO',"name"=> 'Bolivia'],
            ["code_phone" => "387", "code"=>'BA',"name"=> 'Bosnia And Herzegovina'],
            ["code_phone" => "267", "code"=>'BW',"name"=> 'Botswana'],
            ["code_phone" => "55", "code"=>'BR',"name"=> 'Brazil'],
            ["code_phone" => "1 (284)", "code"=>'IO',"name"=> 'British Indian Ocean Territory'],
            ["code_phone" => "673", "code"=>'BN',"name"=> 'Brunei'],
            ["code_phone" => "359", "code"=>'BG',"name"=> 'Bulgaria'],
            ["code_phone" => "226", "code"=>'BF',"name"=> 'Burkina Faso'],
            ["code_phone" => "257", "code"=>'BI',"name"=> 'Burundi'],
            ["code_phone" => "855", "code"=>'KH',"name"=> 'Cambodia'],
            ["code_phone" => "237", "code"=>'CM',"name"=> 'Cameroon'],
            ["code_phone" => "1", "code"=>'CA',"name"=> 'Canada'],
            ["code_phone" => "238", "code"=>'CV',"name"=> 'Cape Verde'],
            ["code_phone" => "1 (345)", "code"=>'KY',"name"=> 'Cayman Islands'],
            ["code_phone" => "236", "code"=>'CF',"name"=> 'Central African Republic'],
            ["code_phone" => "235", "code"=>'TD',"name"=> 'Chad'],
            ["code_phone" => "56", "code"=>'CL',"name"=> 'Chile'],
            ["code_phone" => "86", "code"=>'CN',"name"=> 'China'],
            ["code_phone" => "57", "code"=>'CO',"name"=> 'Colombia'],
            ["code_phone" => "269", "code"=>'CG',"name"=> 'Congo'],
            ["code_phone" => "682", "code"=>'CK',"name"=> 'Cook Islands'],
            ["code_phone" => "506", "code"=>'CR',"name"=> 'Costa Rica'],
            ["code_phone" => "1", "code"=>'CI',"name"=> 'Cote D\'ivoire'],
            ["code_phone" => "385", "code"=>'HR',"name"=> 'Croatia'],
            ["code_phone" => "53", "code"=>'CU',"name"=> 'Cuba'],
            ["code_phone" => "357", "code"=>'CY',"name"=> 'Cyprus'],
            ["code_phone" => "420", "code"=>'CZ',"name"=> 'Czech Republic'],
            ["code_phone" => "45", "code"=>'CD',"name"=> 'Democratic Republic of the Congo'],
            ["code_phone" => "246", "code"=>'DK',"name"=> 'Denmark'],
            ["code_phone" => "253", "code"=>'DJ',"name"=> 'Djibouti'],
            ["code_phone" => "1 (767)", "code"=>'DM',"name"=> 'Dominica'],
            ["code_phone" => "1 (809/829/849)", "code"=>'DO',"name"=> 'Dominican Republic'],
            ["code_phone" => "593", "code"=>'EC',"name"=> 'Ecuador'],
            ["code_phone" => "20", "code"=>'EG',"name"=> 'Egypt'],
            ["code_phone" => "503", "code"=>'SV',"name"=> 'El Salvador'],
            ["code_phone" => "240", "code"=>'GQ',"name"=> 'Equatorial Guinea'],
            ["code_phone" => "291", "code"=>'ER',"name"=> 'Eritrea'],
            ["code_phone" => "372", "code"=>'EE',"name"=> 'Estonia'],
            ["code_phone" => "251", "code"=>'ET',"name"=> 'Ethiopia'],
            ["code_phone" => "500", "code"=>'FO',"name"=> 'Faroe Islands'],
            ["code_phone" => "298", "code"=>'FM',"name"=> 'Federated States Of Micronesia'],
            ["code_phone" => "679", "code"=>'FJ',"name"=> 'Fiji'],
            ["code_phone" => "358", "code"=>'FI',"name"=> 'Finland'],
            ["code_phone" => "33", "code"=>'FR',"name"=> 'France'],
            ["code_phone" => "594", "code"=>'GF',"name"=> 'French Guiana'],
            ["code_phone" => "1", "code"=>'PF',"name"=> 'French Polynesia'],
            ["code_phone" => "241", "code"=>'GA',"name"=> 'Gabon'],
            ["code_phone" => "220", "code"=>'GM',"name"=> 'Gambia'],
            ["code_phone" => "995", "code"=>'GE',"name"=> 'Georgia'],
            ["code_phone" => "49", "code"=>'DE',"name"=> 'Germany'],
            ["code_phone" => "233", "code"=>'GH',"name"=> 'Ghana'],
            ["code_phone" => "350", "code"=>'GI',"name"=> 'Gibraltar'],
            ["code_phone" => "30", "code"=>'GR',"name"=> 'Greece'],
            ["code_phone" => "299", "code"=>'GL',"name"=> 'Greenland'],
            ["code_phone" => "1 (473)", "code"=>'GD',"name"=> 'Grenada'],
            ["code_phone" => "590", "code"=>'GP',"name"=> 'Guadeloupe'],
            ["code_phone" => "502", "code"=>'GU',"name"=> 'Guam'],
            ["code_phone" => "44", "code"=>'GT',"name"=> 'Guatemala'],
            ["code_phone" => "224", "code"=>'GN',"name"=> 'Guinea'],
            ["code_phone" => "245", "code"=>'GW',"name"=> 'Guinea Bissau'],
            ["code_phone" => "592", "code"=>'GY',"name"=> 'Guyana'],
            ["code_phone" => "509", "code"=>'HT',"name"=> 'Haiti'],
            ["code_phone" => "504", "code"=>'HN',"name"=> 'Honduras'],
            ["code_phone" => "852", "code"=>'HK',"name"=> 'Hong Kong'],
            ["code_phone" => "36", "code"=>'HU',"name"=> 'Hungary'],
            ["code_phone" => "354", "code"=>'IS',"name"=> 'Iceland'],
            ["code_phone" => "91", "code"=>'IN',"name"=> 'India'],
            ["code_phone" => "62", "code"=>'ID',"name"=> 'Indonesia'],
            ["code_phone" => "98", "code"=>'IR',"name"=> 'Iran'],
            ["code_phone" => "353", "code"=>'IE',"name"=> 'Ireland'],
            ["code_phone" => "972", "code"=>'IL',"name"=> 'Israel'],
            ["code_phone" => "39", "code"=>'IT',"name"=> 'Italy'],
            ["code_phone" => "1 (876)", "code"=>'JM',"name"=> 'Jamaica'],
            ["code_phone" => "81", "code"=>'JP',"name"=> 'Japan'],
            ["code_phone" => "962", "code"=>'JO',"name"=> 'Jordan'],
            ["code_phone" => "7", "code"=>'KZ',"name"=> 'Kazakhstan'],
            ["code_phone" => "254", "code"=>'KE',"name"=> 'Kenya'],
            ["code_phone" => "965", "code"=>'KW',"name"=> 'Kuwait'],
            ["code_phone" => "996", "code"=>'KG',"name"=> 'Kyrgyzstan'],
            ["code_phone" => "856", "code"=>'LA',"name"=> 'Laos'],
            ["code_phone" => "371", "code"=>'LV',"name"=> 'Latvia'],
            ["code_phone" => "961", "code"=>'LB',"name"=> 'Lebanon'],
            ["code_phone" => "266", "code"=>'LS',"name"=> 'Lesotho'],
            ["code_phone" => "218", "code"=>'LY',"name"=> 'Libyan Arab Jamahiriya'],
            ["code_phone" => "423", "code"=>'LI',"name"=> 'Liechtenstein'],
            ["code_phone" => "370", "code"=>'LT',"name"=> 'Lithuania'],
            ["code_phone" => "352", "code"=>'LU',"name"=> 'Luxembourg'],
            ["code_phone" => "389", "code"=>'MK',"name"=> 'Macedonia'],
            ["code_phone" => "261", "code"=>'MG',"name"=> 'Madagascar'],
            ["code_phone" => "1", "code"=>'MW',"name"=> 'Malawi'],
            ["code_phone" => "60", "code"=>'MY',"name"=> 'Malaysia'],
            ["code_phone" => "960", "code"=>'MV',"name"=> 'Maldives'],
            ["code_phone" => "223", "code"=>'ML',"name"=> 'Mali'],
            ["code_phone" => "356", "code"=>'MT',"name"=> 'Malta'],
            ["code_phone" => "596", "code"=>'MQ',"name"=> 'Martinique'],
            ["code_phone" => "222", "code"=>'MR',"name"=> 'Mauritania'],
            ["code_phone" => "230", "code"=>'MU',"name"=> 'Mauritius'],
            ["code_phone" => "52", "code"=>'MX',"name"=> 'Mexico'],
            ["code_phone" => "377", "code"=>'MC',"name"=> 'Monaco'],
            ["code_phone" => "976", "code"=>'MN',"name"=> 'Mongolia'],
            ["code_phone" => "382", "code"=>'ME',"name"=> 'Montenegro'],
            ["code_phone" => "", "code"=>'MA',"name"=> 'Morocco'],
            ["code_phone" => "258", "code"=>'MZ',"name"=> 'Mozambique'],
            ["code_phone" => "95", "code"=>'MM',"name"=> 'Myanmar'],
            ["code_phone" => "264", "code"=>'NA',"name"=> 'Namibia'],
            ["code_phone" => "977", "code"=>'NP',"name"=> 'Nepal'],
            ["code_phone" => "31", "code"=>'NL',"name"=> 'Netherlands'],
            ["code_phone" => "599", "code"=>'AN',"name"=> 'Netherlands Antilles'],
            ["code_phone" => "687", "code"=>'NC',"name"=> 'New Caledonia'],
            ["code_phone" => "64", "code"=>'NZ',"name"=> 'New Zealand'],
            ["code_phone" => "505", "code"=>'NI',"name"=> 'Nicaragua'],
            ["code_phone" => "227", "code"=>'NE',"name"=> 'Niger'],
            ["code_phone" => "234", "code"=>'NG',"name"=> 'Nigeria'],
            ["code_phone" => "1 (670)", "code"=>'NF',"name"=> 'Norfolk Island'],
            ["code_phone" => "47", "code"=>'MP',"name"=> 'Northern Mariana Islands'],
            ["code_phone" => "1", "code"=>'NO',"name"=> 'Norway'],
            ["code_phone" => "968", "code"=>'OM',"name"=> 'Oman'],
            ["code_phone" => "92", "code"=>'PK',"name"=> 'Pakistan'],
            ["code_phone" => "680", "code"=>'PW',"name"=> 'Palau'],
            ["code_phone" => "507", "code"=>'PA',"name"=> 'Panama'],
            ["code_phone" => "675", "code"=>'PG',"name"=> 'Papua New Guinea'],
            ["code_phone" => "595", "code"=>'PY',"name"=> 'Paraguay'],
            ["code_phone" => "51", "code"=>'PE',"name"=> 'Peru'],
            ["code_phone" => "63", "code"=>'PH',"name"=> 'Philippines'],
            ["code_phone" => "48", "code"=>'PL',"name"=> 'Poland'],
            ["code_phone" => "351", "code"=>'PT',"name"=> 'Portugal'],
            ["code_phone" => "", "code"=>'PR',"name"=> 'Puerto Rico'],
            ["code_phone" => "974", "code"=>'QA',"name"=> 'Qatar'],
            ["code_phone" => "1", "code"=>'MD',"name"=> 'Republic Of Moldova'],
            ["code_phone" => "262", "code"=>'RE',"name"=> 'Reunion'],
            ["code_phone" => "40", "code"=>'RO',"name"=> 'Romania'],
            ["code_phone" => "7", "code"=>'RU',"name"=> 'Russia'],
            ["code_phone" => "250", "code"=>'RW',"name"=> 'Rwanda'],
            ["code_phone" => "1 (670)", "code"=>'KN',"name"=> 'Saint Kitts And Nevis'],
            ["code_phone" => "1 (242)", "code"=>'LC',"name"=> 'Saint Lucia'],
            ["code_phone" => "1 (242)", "code"=>'VC',"name"=> 'Saint Vincent And The Grenadines'],
            ["code_phone" => "685", "code"=>'WS',"name"=> 'Samoa'],
            ["code_phone" => "378", "code"=>'SM',"name"=> 'San Marino'],
            ["code_phone" => "239", "code"=>'ST',"name"=> 'Sao Tome And Principe'],
            ["code_phone" => "966", "code"=>'SA',"name"=> 'Saudi Arabia'],
            ["code_phone" => "221", "code"=>'SN',"name"=> 'Senegal'],
            ["code_phone" => "381", "code"=>'RS',"name"=> 'Serbia'],
            ["code_phone" => "248", "code"=>'SC',"name"=> 'Seychelles'],
            ["code_phone" => "65", "code"=>'SG',"name"=> 'Singapore'],
            ["code_phone" => "421", "code"=>'SK',"name"=> 'Slovakia'],
            ["code_phone" => "386", "code"=>'SI',"name"=> 'Slovenia'],
            ["code_phone" => "677", "code"=>'SB',"name"=> 'Solomon Islands'],
            ["code_phone" => "27", "code"=>'ZA',"name"=> 'South Africa'],
            ["code_phone" => "1", "code"=>'KR',"name"=> 'South Korea'],
            ["code_phone" => "34", "code"=>'ES',"name"=> 'Spain'],
            ["code_phone" => "94", "code"=>'LK',"name"=> 'Sri Lanka'],
            ["code_phone" => "249", "code"=>'SD',"name"=> 'Sudan'],
            ["code_phone" => "597", "code"=>'SR',"name"=> 'Suriname'],
            ["code_phone" => "268", "code"=>'SZ',"name"=> 'Swaziland'],
            ["code_phone" => "46", "code"=>'SE',"name"=> 'Sweden'],
            ["code_phone" => "41", "code"=>'CH',"name"=> 'Switzerland'],
            ["code_phone" => "963", "code"=>'SY',"name"=> 'Syrian Arab Republic'],
            ["code_phone" => "886", "code"=>'TW',"name"=> 'Taiwan'],
            ["code_phone" => "992", "code"=>'TJ',"name"=> 'Tajikistan'],
            ["code_phone" => "255", "code"=>'TZ',"name"=> 'Tanzania'],
            ["code_phone" => "66", "code"=>'TH',"name"=> 'Thailand'],
            ["code_phone" => "228", "code"=>'TG',"name"=> 'Togo'],
            ["code_phone" => "676", "code"=>'TO',"name"=> 'Tonga'],
            ["code_phone" => "1 (868)", "code"=>'TT',"name"=> 'Trinidad And Tobago'],
            ["code_phone" => "216", "code"=>'TN',"name"=> 'Tunisia'],
            ["code_phone" => "90", "code"=>'TR',"name"=> 'Turkey'],
            ["code_phone" => "993", "code"=>'TM',"name"=> 'Turkmenistan'],
            ["code_phone" => "256", "code"=>'UG',"name"=> 'Uganda'],
            ["code_phone" => "380", "code"=>'UA',"name"=> 'Ukraine'],
            ["code_phone" => "971", "code"=>'AE',"name"=> 'United Arab Emirates'],
            ["code_phone" => "44", "code"=>'GB',"name"=> 'United Kingdom'],
            ["code_phone" => "1", "code"=>'US',"name"=> 'United States'],
            ["code_phone" => "598", "code"=>'UY',"name"=> 'Uruguay'],
            ["code_phone" => "998", "code"=>'UZ',"name"=> 'Uzbekistan'],
            ["code_phone" => "678", "code"=>'VU',"name"=> 'Vanuatu'],
            ["code_phone" => "58", "code"=>'VE',"name"=> 'Venezuela'],
            ["code_phone" => "84", "code"=>'VN',"name"=> 'Vietnam'],
            ["code_phone" => "1", "code"=>'VG',"name"=> 'Virgin Islands British'],
            ["code_phone" => "1", "code"=>'VI',"name"=> 'Virgin Islands U.S.'],
            ["code_phone" => "967", "code"=>'YE',"name"=> 'Yemen'],
            ["code_phone" => "260", "code"=>'ZM',"name"=> 'Zambia'],
            ["code_phone" => "263", "code"=>'ZW',"name"=> 'Zimbabwe']
        ]);
    }
}